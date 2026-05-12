# Testing Strategy

## Framework
- **PHPUnit:** The primary testing framework (v12.5.12).
- Currently, the project is configured for Pest plugin compatibility in `composer.json`, but standard PHPUnit files exist.

## Current State
- The testing suite is currently sparse.
- Default `ExampleTest.php` files exist in `tests/Feature/` and `tests/Unit/`.
- No comprehensive coverage for the custom authentication flow, RBAC, or checkout processes yet.

## Test Structure
- `tests/Unit/` — For isolated logic tests (e.g., pricing calculations, commission algorithms).
- `tests/Feature/` — For testing HTTP requests, route protection, and end-to-end flows.

## Required Coverage (Action Items)
To ensure platform stability, tests need to be written for:
1. **RBAC Middleware:** Ensure a `vendor` cannot access `/admin` routes, and a `customer` cannot access `/vendor` routes.
2. **Status Enforcement:** Ensure `pending` or `suspended` users are properly redirected and cannot access their dashboards.
3. **Checkout Flow:** Mock database transactions to ensure cart items convert to order items correctly and inventory is decremented.
4. **Password Hashing:** Verify that updating a password does not result in double-hashing (preventing the previous bug).

## Tooling
- `php artisan test` — Runs the test suite.
- Factories: Currently only `UserFactory` exists. Need factories for `Product`, `Order`, `Category`, etc., to facilitate testing.
