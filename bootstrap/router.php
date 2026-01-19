<?php

function resolve_route(string $uri): array
{
    // ---------- API ----------
    if (strpos($uri, 'api/') === 0) {
        $file = 'api/' . substr($uri, 4) . '.php';
        if (file_exists($file)) {
            return [
                'type' => 'api',
                'file' => $file,
            ];
        }
        http_response_code(404);
        exit('API Not Found');
    }

    $segments = $uri === '' ? [] : explode('/', $uri);

    // ✅ start from app only (เหมือน Next.js)
    $route = match_route_next_style('app', $segments);
    if ($route) return $route;

    http_response_code(404);
    exit('404 Not Found');
}

function dispatch_api(string $file): void
{
    $handlers = require $file;

    if (!is_array($handlers)) {
        json_error(500, 'API file must return an array of handlers');
        return;
    }

    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

    // รองรับ HEAD ให้เหมือน GET แต่ไม่ส่ง body
    $isHead = ($method === 'HEAD');
    if ($isHead && isset($handlers['GET'])) {
        $method = 'GET';
    }

    // OPTIONS (CORS / preflight)
    if ($method === 'OPTIONS') {
        header('Allow: ' . implode(', ', array_keys($handlers)));
        http_response_code(204);
        return;
    }

    if (!isset($handlers[$method]) || !is_callable($handlers[$method])) {
        header('Allow: ' . implode(', ', array_keys($handlers)));
        json_error(405, "Method $method Not Allowed");
        return;
    }

    // เรียก handler
    $result = ($handlers[$method])();

    // ถ้า handler จัดการ output เองแล้ว (echo/exit) ก็จบ
    if ($result === null) return;

    json($result);
}

function json(mixed $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

function json_error(int $status, string $message, array $extra = []): void
{
    json(array_merge(['error' => $message], $extra), $status);
}

// ------------------------------------------------------

function match_route_next_style(string $base, array $segments): ?array
{
    $visited = []; // กันวนลูป
    return walk_routes($base, $segments, 0, [], [], $visited);
}

/**
 * เดินไฟล์แบบ Next.js:
 * - โฟลเดอร์ (name) = group (ไม่กิน URL segment)
 * - โฟลเดอร์ [id] = dynamic (กิน URL segment)
 * - โฟลเดอร์ธรรมดา = static (กิน URL segment)
 */
function walk_routes(
    string $path,
    array $segments,
    int $idx,
    array $groups,
    array $params,
    array &$visited
): ?array {
    $key = $path . '|' . $idx;
    if (isset($visited[$key])) return null;
    $visited[$key] = true;

    // ✅ 1) ลอง "เข้า group dirs" ก่อน (ไม่ consume segment)
    foreach (list_group_dirs($path) as $gdir) {
        $gname = trim(basename($gdir), '()');
        $found = walk_routes($gdir, $segments, $idx, array_merge($groups, [$gname]), $params, $visited);
        if ($found) return $found;
    }

    // ✅ 2) ถ้ากิน segment หมดแล้ว: เช็ค page.php
    if ($idx >= count($segments)) {
        $page = $path . '/page.php';
        if (file_exists($page)) {
            $layouts = resolve_layouts_for_page_dir($path);
            return [
                'type'     => 'page',
                'file'     => $page,
                'page_dir' => $path,
                'layouts'  => $layouts,
                'params'   => $params,
                'groups'   => $groups, // ✅ เก็บทุก group ที่เจอ
            ];
        }
        return null;
    }

    $seg = $segments[$idx];

    // ✅ 3) static dir match
    if (is_dir($path . '/' . $seg)) {
        $found = walk_routes($path . '/' . $seg, $segments, $idx + 1, $groups, $params, $visited);
        if ($found) return $found;
    }

    // ✅ 4) dynamic dir match ([id])
    foreach (glob($path . '/[[]*[]]') as $dyn) {
        if (!is_dir($dyn)) continue;

        $keyName = trim(basename($dyn), '[]');
        $newParams = $params;
        $newParams[$keyName] = $seg;

        $found = walk_routes($dyn, $segments, $idx + 1, $groups, $newParams, $visited);
        if ($found) return $found;
    }

    return null;
}

/**
 * คืน path ของ group dirs เช่น app/(auth), app/(admin)
 */
function list_group_dirs(string $path): array
{
    if (!is_dir($path)) return [];

    $out = [];
    $items = @scandir($path);
    if ($items === false) return [];

    foreach ($items as $name) {
        if ($name === '.' || $name === '..') continue;
        $full = $path . '/' . $name;
        if (!is_dir($full)) continue;

        // name แบบ (xxx)
        if (preg_match('/^\(.+\)$/', $name)) {
            $out[] = $full;
        }
    }
    return $out;
}

/**
 * หา layout.php จากโฟลเดอร์ของ page ย้อนขึ้นไปจนถึง app/layout.php
 * คืนค่าเป็น array ของ path เรียงจาก "ใกล้สุด" -> "root"
 */
function resolve_layouts_for_page_dir(string $pageDir): array
{
    $layouts = [];
    $pageDir = str_replace('\\', '/', $pageDir);

    $dir = $pageDir;
    while (true) {
        $layoutFile = $dir . '/layout.php';
        if (file_exists($layoutFile)) {
            $layouts[] = $layoutFile; // ใกล้สุดมาก่อน
        }

        if ($dir === 'app') break;

        $parent = str_replace('\\', '/', dirname($dir));
        if ($parent === '.' || $parent === '/' || $parent === $dir) break;

        $dir = $parent;
    }

    // กันพลาด: root layout
    if (file_exists('app/layout.php') && !in_array('app/layout.php', $layouts, true)) {
        $layouts[] = 'app/layout.php';
    }

    return $layouts;
}
