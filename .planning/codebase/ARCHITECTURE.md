# System Architecture

## Architecture Pattern
The project follows standard **MVC (Model-View-Controller)** architecture typical of Laravel applications, but with a strong emphasis on **Role-Based Access Control (RBAC)** defining boundaries.

## Logical Layers

### 1. Routing Layer (`routes/web.php`)
Acts as the primary entry point, cleanly separating traffic by user role:
- **Public Storefront:** Guest accessible (`/`, `/products`, `/cart`).
- **Auth Routes:** Guest accessible (`/login`, `/register`).
- **Protected Dashboards:** Guarded by `auth` and custom `role` middleware.
  - Admin (`/admin/*`)
  - Vendor (`/vendor/*`)
  - Partner (`/partner/*`)
  - Customer (`/customer/*`)

### 2. Middleware Layer (`app/Http/Middleware/RoleMiddleware.php`)
Critical boundary for the multi-vendor ecosystem. It handles:
- Authentication verification.
- Account status checks (blocks `pending` and `suspended` users).
- Role-based authorization (`$request->user()->role->slug`).

### 3. Controller Layer (`app/Http/Controllers/`)
Controllers are organized into namespaces matching the role boundaries:
- `Admin/` (e.g., `DashboardController`, `VendorController`)
- `Vendor/` (e.g., `ProductController`, `OrderController`)
- `Customer/`
- `Partner/`
- Root level (e.g., `HomeController`, `CartController`, `CheckoutController`) for shared/public actions.

### 4. Data Layer (`app/Models/`)
Standard Eloquent ORM. Key relationships form the ecosystem core:
- **Users & Roles:** A `User` belongsTo a `Role`.
- **E-commerce:** `Order` hasMany `OrderItem` belongsTo `Product` belongsTo `Vendor` (User).

## Data Flow (Checkout Example)
1. User adds item to session cart (`CartController@add`).
2. User proceeds to checkout (`CheckoutController@index`).
3. User submits order (`CheckoutController@store`).
4. System creates `Order` and `OrderItem` records inside a Database Transaction.
5. System decrements `Product` inventory.
6. Session cart is cleared.

## State Management
- **Cart:** Stored in the server-side Laravel Session (`session()->get('cart')`).
- **Auth:** Standard Laravel Session-based authentication.
- **User Status:** Database-driven (`pending`, `active`, `suspended`).
