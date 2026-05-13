# Directory Structure

## Root Level
Standard Laravel structure with a few specific additions.
- `/app` — Core PHP application logic.
- `/bootstrap` — Framework bootstrap and configuration (`app.php`).
- `/config` — Application configuration files.
- `/database` — Migrations, seeders, and factories.
- `/public` — Web root, assets, and Vite build output.
- `/resources` — Frontend assets (CSS/JS) and Blade views.
- `/routes` — Route definitions.
- `/tests` — Automated test suites.
- `/.planning` — GSD framework context and documentation.

## Application Code (`/app`)
- `/Http/Controllers/`
  - `/Admin` — Admin-specific controllers.
  - `/Vendor` — Vendor-specific controllers.
  - `/Customer` — Customer-specific controllers.
  - `/Partner` — Partner-specific controllers.
  - `/Auth` — Custom authentication controllers.
- `/Http/Middleware/`
  - `RoleMiddleware.php` — Core RBAC logic.
- `/Models/`
  - `User.php`, `Role.php`, `Product.php`, `Order.php`, etc.

## Resources (`/resources`)
- `/views/` — Blade templates, heavily structured by role:
  - `/admin` — Admin dashboard and management views.
  - `/vendor` — Vendor dashboard views.
  - `/customer` — Customer dashboard views.
  - `/partner` — Partner dashboard views.
  - `/auth` — Login, registration, and status notices (`pending.blade.php`).
  - `/checkout` & `/cart` — E-commerce flows.
  - `/components/ui` — Reusable Blade components.

## Naming Conventions
- **Controllers:** `EntityController.php` (e.g., `ProductController`). Role-specific controllers use namespaces (e.g., `Admin\ProductController`).
- **Routes:** Named routes use dot notation matching the namespace/action (e.g., `admin.products.index`).
- **Views:** Organized in folders matching the route/controller structure (e.g., `admin/products/index.blade.php`).
