# Technical Concerns & Debt

## 1. Security & Data Integrity
- **Checkout Simplification:** `CheckoutController` currently uses `billing_address => $request->shipping_address` as a simplification for the MVP. This needs to be expanded for proper e-commerce functionality.
- **Cart Session Persistence:** The cart is stored in the PHP Session. If a user logs out and logs back in, or switches devices, their cart is lost. Consider moving cart storage to the database for authenticated users.

## 2. Technical Debt
- **Missing Tests:** The custom Auth flows, RoleMiddleware, and Checkout process lack automated tests, making refactoring risky.
- **Mail Configuration:** The platform uses generic notification classes (e.g., `StatusUpdate.php`) but SMTP is not configured for production use.
- **Hardcoded Values:** Some views may still contain placeholder images (e.g., `https://via.placeholder.com/150` used in `CartController` fallback).

## 3. Pending Features (Roadmap)
- **Partner Commission Engine:** B2B integration is defined in the roles but the logic for calculating and distributing commissions is not yet implemented.
- **Payment Gateway:** Checkout currently relies on a `payment_method` string. Stripe integration is required before launch.
- **Vendor Payouts:** No system exists yet for vendors to withdraw earnings from their sales.

## 4. Fragile Areas
- **User Password Updates:** Because the `User` model casts the password to `hashed`, any developer who reflexively uses `Hash::make()` when updating a user record will break that user's login. This convention must be strictly communicated or safeguarded.
- **Product Inventory:** Inventory decrementing happens during checkout, but there are no concurrent transaction locks (e.g., `lockForUpdate()`) to prevent race conditions if two users buy the last item simultaneously.
