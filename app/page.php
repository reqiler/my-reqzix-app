<?php
$isLogin = isset($_SESSION['user']);
?>

<h2>Home Page</h2>

<ul>
    <li><a href="/post/999">Post 999</a></li>
    <li><a href="/api/users">API Users</a></li>
</ul>

<hr>

<?php if (!$isLogin): ?>
    <!-- ยังไม่ login -->
    <a href="/api/login">
        <button>➕ Add Session User (Login)</button>
    </a>
<?php else: ?>
    <!-- login แล้ว -->
    <p>👤 User: <?= htmlspecialchars($_SESSION['user']['name']) ?></p>

    <a href="/api/logout">
        <button>➖ Delete Session User (Logout)</button>
    </a>

    <br><br>

    <a href="/admin">
        <button>🔐 Go to Admin</button>
    </a>
<?php endif; ?>
