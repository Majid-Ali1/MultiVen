# External Integrations

## Database
- **MySQL** — Primary relational data store
  - Connection: `DB_CONNECTION=mysql` in `.env`
  - 17 migration files covering RBAC, products, orders, settings, notifications
  - Eloquent ORM with PHP 8 Attribute-based `#[Fillable]` declarations

## Authentication
- **Custom implementation** — No Laravel Breeze, Jetstream, or Fortify
  - `app/Http/Controllers/Auth/LoginController.php` — Login with role-based redirect
  - `app/Http/Controllers/Auth/RegisterController.php` — Registration with role selection
  - Session-based auth via Laravel's built-in `Auth` facade
  - Password hashing via `'password' => 'hashed'` Eloquent cast

## Notifications
- **Laravel Notifications** — Database + Mail channels
  - `app/Notifications/StatusUpdate.php` — Generic status notification
  - Database channel: stores in `notifications` table
  - Mail channel: uses default Laravel mailer (not configured for production)

## File Storage
- **Laravel Storage** — Local filesystem
  - `php artisan storage:link` creates `public/storage` symlink
  - Used for product images and category images
  - No cloud storage (S3/GCS) configured

## External APIs
- **None currently integrated**
  - No payment gateway (Stripe, PayPal) — checkout uses `payment_method` string only
  - No email service (Mailgun, SES) — uses default SMTP
  - No search engine (Algolia, Meilisearch)
  - No analytics or monitoring

## Queue System
- **Database queue driver** (default Laravel config)
  - `jobs`, `job_batches`, `failed_jobs` tables exist via migration
  - `composer dev` includes `queue:listen` process
  - Used by notifications (StatusUpdate is `Queueable`)

## Caching
- **File-based cache** (Laravel default)
  - `cache` and `cache_locks` tables exist but file driver is default
