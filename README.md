# Reqziel
### App Router–Style PHP Framework

**Reqziel** is a lightweight PHP framework inspired by modern App Router concepts.
It brings **file-based routing, nested layouts, middleware, and API routes** to PHP
— without Laravel or heavy abstractions.

> 🚀 Built for learning, experimentation, and lightweight production  
> 🧠 Designed to understand how modern frameworks work under the hood

---

## 📦 Create Project

```bash
composer create-project reqiler/reqziel my-reqziel-app
```

Start the development server:

```bash
composer dev
```

or

```bash
php cli/app.php dev
```

Open in browser:

```
http://localhost:8000
```

---

## ✨ Features

- 📁 File-based Routing
- 🔀 Dynamic Routes using `[param]`
- 🧩 Route Groups using `(group)` (not affecting URL)
- 🧱 Nested Layout System
- 🔐 Middleware / Route Guards
- 🔌 API Routes under `/api`
- ⚙️ Dev Command similar to modern frameworks
- ❌ No Laravel, No heavy framework

---

## 📂 Project Structure

```
my-reqziel-app/
├─ app/
│  ├─ page.php              # /
│  ├─ layout.php            # root layout
│  ├─ post/
│  │  └─ [id]/
│  │     └─ page.php        # /post/123
│  └─ (auth)/
│     └─ admin/
│        ├─ layout.php
│        └─ page.php        # /admin (protected)
│
├─ api/
│  └─ users.php             # /api/users
│
├─ bootstrap/
│  ├─ app.php               # bootstrap
│  ├─ router.php            # file-based router
│  └─ middleware.php        # middleware handler
│
├─ public/
│  ├─ index.php             # front controller
│  ├─ router.php            # dev router (php -S)
│  └─ .htaccess             # Apache rewrite
│
├─ cli/
│  └─ app.php               # CLI commands
│
├─ storage/
├─ composer.json
└─ README.md
```

---

## 🧱 Layout System (Updated)

Layouts are resolved automatically based on directory hierarchy.

Rules:
- The closest `layout.php` wraps the page
- Root `app/layout.php` wraps everything
- Layouts receive rendered page content via `$content`

Example:

```
app/layout.php
app/(auth)/admin/layout.php
```

Inside `layout.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <title>Reqziel</title>
</head>
<body>
    <?= $content ?>
</body>
</html>
```

---

## 🔐 Middleware

Route groups like `(auth)` can be protected automatically.

```php
if ($route['group'] === 'auth' && !isset($_SESSION['user'])) {
    redirect('/');
}
```

---

## 🔌 API Routes

All files inside `/api` are treated as API endpoints.

```
api/users.php → /api/users
```

Example:

```php
header('Content-Type: application/json');
echo json_encode(['ok' => true]);
```

---

## 🚀 Deployment

- Apache or Nginx
- Set document root to `/public`
- No Node.js required
- Tailwind via CDN supported

---

## 📜 License

MIT License
