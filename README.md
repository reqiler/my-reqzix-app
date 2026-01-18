# PHP Next-Style App Router

A **Next.js-inspired App Router framework written in pure PHP**
File-based routing, dynamic routes, layouts, middleware, and API routes
— without Laravel.

> 🚀 Built for learning, experimentation, and lightweight production use
> 🧠 Designed to understand how modern frameworks actually work under the hood

---

## ✨ Features

- 📁 **File-based Routing** (like Next.js App Router)
- 🔀 **Dynamic Routes** using `[param]` syntax  
  - Example: `/post/[id]` → `/post/123`
- 🧩 **Route Groups** with `(auth)` (not affecting URL)
- 🧱 **Nested Layouts** (`layout.php`)
- 🔐 **Middleware System** (auth guard)
- 🔌 **API Routes** under `/api`
- ⚙️ **Dev Command** similar to `next dev`
- ❌ No Laravel, No heavy framework

---

## 📂 Project Structure

```
my-php-app/
├─ app/
│  ├─ page.php              # /
│  ├─ layout.php            # root layout
│  ├─ post/
│  │  └─ [id]/
│  │     └─ page.php        # /post/123
│  └─ (auth)/
│     └─ admin/
│        └─ page.php        # /admin (auth required)
│
├─ api/
│  └─ users.php             # /api/users
│
├─ bootstrap/
│  ├─ app.php               # app bootstrap
│  ├─ router.php            # file-based router
│  └─ middleware.php        # middleware + render
│
├─ public/
│  ├─ index.php             # front controller
│  ├─ router.php            # dev router (php -S only)
│  └─ .htaccess             # Apache rewrite
│
├─ cli/
│  └─ app.php               # dev command
│
├─ storage/
└─ composer.json
```

---

## 🚦 Routing Rules

### Pages
- `app/page.php` → `/`
- `app/store/page.php` → `/store`
- `app/post/[id]/page.php` → `/post/123`

### Route Groups
- `(auth)` folder does **not appear in URL**
- Used for logic grouping (middleware)

Example:
```
app/(auth)/admin/page.php → /admin
```

---

## 🔐 Middleware

Routes inside `(auth)` are protected automatically.

```php
if ($route['group'] === 'auth' && !isset($_SESSION['user'])) {
    redirect('/');
}
```

---

## 🧱 Layout System

Layouts work like **Next.js nested layouts**.

```
app/layout.php
app/(auth)/admin/layout.php
```

- Closest layout wraps the page
- Root layout wraps everything

Inside `layout.php`:
```php
<?= $content ?>
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

## 🛠 Development (DEV)

### Start Dev Server

```bash
composer dev
```

or

```bash
php cli/app.php dev
```

This uses:
- PHP built-in server
- `public/router.php` to simulate rewrite

Open:
```
http://localhost:8000
```

---

## 🚀 Deployment (PRODUCTION)

> ⚠️ **Do NOT use `php -S` in production**

### Apache (Shared Hosting / VPS)

1. Set **DocumentRoot** to `/public`
2. Enable `mod_rewrite`
3. Use `.htaccess`

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
```

### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## 🧠 Philosophy

This project is intentionally minimal.

Frameworks like:
- Laravel
- Next.js
- Symfony

are **built on the same concepts**:
- Front Controller
- Routing
- Middleware
- Layout composition

This project exists to **learn and control those concepts directly**.

---

## ⚠️ Notes

- This is **not Laravel**
- No ORM, no DI container (yet)
- You own the architecture
- You are the framework author

---

## 🛣 Roadmap (Ideas)

- `make:page` CLI command
- Route cache (`build`)
- `.env` support
- Error overlay (dev)
- API middleware
- SSR helpers

---

## 📜 License

MIT — do whatever you want.  
Learn, fork, break, rebuild.

---

## 🙌 Author

Built by a developer who wanted  
to understand frameworks — not just use them.

Enjoy 🚀
