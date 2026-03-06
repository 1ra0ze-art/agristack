# 🌾 AgriStack — Irish Potato Marketplace

**A cooperative listing and bulk order management system connecting Musanze farmers to bulk buyers.**

> Built for Web Development Assignment 2 — INES Ruhengeri

---

## 🚀 Live URL

> `[Add your hosted URL here after deployment]`

---

## 📁 Repository Structure

```
agristack/
├── index.php              ← Front controller
├── .htaccess              ← URL rewriting
├── app/
│   ├── core/              ← Config, Database class, Helpers
│   ├── controllers/       ← AuthController, FarmerController, BuyerController, AdminController
│   ├── models/            ← UserModel, ListingModel, BookingModel
│   └── views/             ← Role-based views + partials
├── database/
│   └── schema.sql         ← Full MySQL schema + seed data
├── docs/                  ← All Phase 1, 2, 4 documentation
│   ├── problem.md
│   ├── stakeholders.md
│   ├── user-stories.md
│   ├── scope.md
│   ├── ui-style.md
│   ├── page-map.md
│   ├── testing.md
│   ├── AI-usage.md
│   └── wireframes/
└── public/
    └── css/style.css
```

---

## ⚙️ Local Setup Instructions

### Requirements
- PHP >= 8.0
- MySQL >= 5.7 or MariaDB >= 10.4
- Apache with mod_rewrite enabled (XAMPP / WAMP / Laragon)

### Step 1 — Clone or Download
```bash
git clone https://github.com/YOUR_USERNAME/agristack.git
```
Place the folder in your server root:
- **XAMPP**: `C:/xampp/htdocs/agristack`
- **WAMP**:  `C:/wamp64/www/agristack`

### Step 2 — Create Database

Open **phpMyAdmin** or MySQL client and run:

```sql
CREATE DATABASE agristack CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 3 — Import Schema

```sql
USE agristack;
SOURCE /path/to/agristack/database/schema.sql;
```

Or via phpMyAdmin: select `agristack` database → Import → choose `database/schema.sql` → Go

### Step 4 — Configure Database

Edit `app/core/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // your MySQL username
define('DB_PASS', '');         // your MySQL password
define('DB_NAME', 'agristack');
define('BASE_URL', 'http://localhost/agristack');
```

### Step 5 — Enable mod_rewrite (Apache)

In `httpd.conf` or virtual host config:
```
AllowOverride All
```

### Step 6 — Open in Browser

```
http://localhost/agristack/login
```

---

## 🔑 Default Login Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@agristack.rw | password |
| Farmer | farmer@agristack.rw | password |
| Farmer 2 | farmer2@agristack.rw | password |
| Buyer | buyer@agristack.rw | password |
| Buyer 2 | buyer2@agristack.rw | password |

> ⚠️ **Change all passwords before deploying to production!**

---

## 🌐 Deployment (InfinityFree / 000webhost)

1. Upload all files via FTP (FileZilla) to `public_html/agristack/`
2. Create MySQL database in hosting panel
3. Import `database/schema.sql` via phpMyAdmin
4. Update `app/core/config.php`:
   - Set `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` from hosting panel
   - Set `BASE_URL` to your live domain, e.g. `https://agristack.infinityfreeapp.com`
5. Ensure `.htaccess` is uploaded and URL rewriting is enabled

---

## 🏗 Architecture

**MVC Pattern:**
- **Models** — All database queries using MySQLi prepared statements
- **Views** — Pure HTML/PHP templates, zero SQL
- **Controllers** — Business logic, role validation, redirects

**Security:**
- Passwords hashed with `password_hash()` (bcrypt)
- All DB writes use prepared statements (SQL injection safe)
- Session-based auth with role checks on every protected page
- Input sanitized with `htmlspecialchars()` + `strip_tags()`

---

## 👥 Team Members & Roles

| Name | Student ID | Git Username | Role |
|---|---|---|---|
| [Name 1] | [ID] | @username | Lead Developer, DB |
| [Name 2] | [ID] | @username | Frontend, CSS |
| [Name 3] | [ID] | @username | Documentation, Testing |

---

## 📄 License

Academic project — INES Ruhengeri 2024. Not for commercial distribution.
