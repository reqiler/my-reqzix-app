# Reqziel
### Next.js–Style App Router Framework in Pure PHP

A **lightweight PHP framework inspired by Next.js App Router**  
Built with **file-based routing, layouts, middleware, and API routes**  
— without Laravel or heavy abstractions.

> 🚀 Built for learning, experimentation, and lightweight production  
> 🧠 Designed to understand how modern frameworks work under the hood

---

## 📦 Create Project

```bash
composer create-project reqiler/reqziel my-reqziel-app
```

Then start the dev server:

```bash
reqziel dev & composer dev
```

Open in browser:

```
http://localhost:8000
```

---

## ✨ Features

- 📁 **File-based Routing** (like Next.js App Router)
- 🔀 **Dynamic Routes** using `[param]` syntax  
  - Example: `/post/[id]` → `/post/123`
- 🧩 **Route Groups** using `(auth)` (not affecting URL)
- 🧱 **Nested Layouts** (`layout.php`)
- 🔐 **Middleware System** (route guards)
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
Folders wrapped with parentheses **do not appear in URL**

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

Rules:
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

## 🛠 Development

```bash
composer dev
```

or

```bash
php cli/app.php dev
```

---

## 🚀 Deployment

Use Apache or Nginx.  
Set document root to `/public`.

---

## 📜 License

MIT License
