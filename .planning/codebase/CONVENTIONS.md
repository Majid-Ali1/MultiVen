# Coding Conventions

## PHP & Laravel Conventions
- Follows PSR-12 coding standards (enforced by Laravel Pint).
- **PHP 8 Attributes:** Heavy use of PHP 8 Attributes in Eloquent Models instead of protected properties:
  ```php
  #[Fillable(['name', 'email', 'password', 'role_id', 'status'])]
  #[Hidden(['password', 'remember_token'])]
  class User extends Authenticatable
  ```
- **Type Hinting:** Standard Laravel type hinting for requests and responses.
- **Transactions:** Critical database operations (like Checkout) are wrapped in `DB::beginTransaction()` and `DB::commit()` / `DB::rollBack()`.

## Authentication & Authorization
- **No Facade Hashing in Controllers:** The `User` model defines `'password' => 'hashed'` in the `casts()` method. Therefore, passwords should *not* be manually hashed with `Hash::make()` before saving, as it causes double-hashing.
- **Middleware Over Checks:** Role enforcement is handled at the route level via middleware (`role:admin`), rather than within controller methods.

## Frontend & Views
- **Blade Components:** UI elements are extracted into Blade components (e.g., `<x-ui.button>`).
- **Tailwind CSS:** Styling is handled exclusively with Tailwind CSS utility classes. Avoid custom CSS unless necessary.
- **Form Handling:** Forms must include `@csrf`.

## Error Handling
- Controllers use standard Laravel validation (`$request->validate()`).
- Exception handling in critical paths (like Checkout) catches `\Exception` and redirects back with an error flash message.

## State/Status Values
- **User Status:** `pending` (awaiting admin approval), `active` (normal), `suspended` (blocked).
- **Order Status:** `pending`, `processing`, `completed`, `cancelled`.
- **Payment Status:** `pending`, `paid`, `failed`.
