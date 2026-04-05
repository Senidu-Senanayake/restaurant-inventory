# Restaurant Inventory

A small **restaurant inventory** web app built with Laravel. Signed-in users manage a product catalog, adjust on-hand stock, and see a simple dashboard with totals and low-stock counts.

## Stack

- **PHP** 8.2+ and **Laravel** 12
- **Laravel Breeze** (Blade) for authentication
- **Vite** 7, **Tailwind CSS** 3, **Alpine.js**
- **Pest** for tests
- **MySQL** by default (configurable via `.env`; SQLite works if you point `DB_*` accordingly)

## Features

- **Authentication**: register, login, logout, password reset, email verification (Breeze), profile edit/delete
- **Home (`/`)**: redirects guests to **login**; authenticated users go to **dashboard**
- **Dashboard**: product count, total stock units (sum of quantities), count of products below the low-stock threshold
- **Products**: list, create, edit, delete; fields include name, description, price, optional image (stored on the `public` disk)
- **Stock**: per-product **available quantity**; add stock, remove stock (cannot go below zero), table view with quick actions

Low-stock threshold is defined as a constant on `DashboardController` (default **10** units). Change `LOW_STOCK_THRESHOLD` there if you want a different cutoff.

## Requirements

- PHP 8.2+ with usual Laravel extensions
- Composer
- Node.js and npm (for front-end assets)

## Setup

1. **Clone** the repository and enter the project directory.

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Environment**

   Copy `.env.example` to `.env` (e.g. `copy .env.example .env` on Windows, or `cp .env.example .env` on macOS/Linux), then:

   ```bash
   php artisan key:generate
   ```

   Edit `.env` and set `DB_*` (and `APP_URL`) for your database. The example file targets a MySQL database named `restaurant_inventory`.

4. **Database**

   ```bash
   php artisan migrate
   ```

5. **JavaScript / CSS**

   ```bash
   npm install
   npm run build
   ```

   For local development with hot reload, use `npm run dev` (often together with `php artisan serve`; see below).

6. **Product images**

   Uploaded images are served from `storage/app/public`. Link the public disk once:

   ```bash
   php artisan storage:link
   ```

## Running the app

**Option A — one command (Composer script)**  
Runs the dev server, queue worker, logs, and Vite:

```bash
composer run dev
```

**Option B — minimal**  
Two terminals:

```bash
php artisan serve
```

```bash
npm run dev
```

Then open the URL shown by `artisan serve` (typically `http://127.0.0.1:8000`).

## Tests

```bash
composer test
```

or:

```bash
php artisan test
```

## Project layout (high level)

| Path | Purpose |
|------|---------|
| `app/Http/Controllers/ProductController.php` | Product CRUD |
| `app/Http/Controllers/StockController.php` | Stock list, add/remove quantity |
| `app/Http/Controllers/DashboardController.php` | Dashboard metrics |
| `app/Models/Product.php` | Product model (`quantity` is on-hand stock) |
| `resources/views/layouts/app.blade.php` | Main app shell (sidebar) |
| `resources/views/products/` | Product views |
| `resources/views/stock/` | Stock views |
| `routes/web.php` | Web routes |
| `routes/auth.php` | Breeze auth routes |

## License

This project inherits the **MIT** license from the Laravel application skeleton (see `composer.json`).
