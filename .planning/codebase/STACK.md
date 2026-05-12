# Technology Stack

## Runtime & Language
- **PHP 8.3** — Primary backend language
- **JavaScript (ES Modules)** — Frontend asset bundling

## Framework
- **Laravel 13.7** — Full-stack PHP framework (latest major version)
  - Blade templating engine (server-rendered views)
  - Eloquent ORM with PHP 8 Attributes (`#[Fillable]`, `#[Hidden]`)
  - Session-based authentication (no Breeze/Jetstream/Fortify scaffolding — custom auth controllers)

## Frontend
- **Tailwind CSS v4** — Utility-first CSS via `@tailwindcss/vite` plugin
- **Vite 8** — Asset bundler via `laravel-vite-plugin` v3.1
- **Instrument Sans** — Custom font via Bunny Fonts (loaded through Vite)
- No frontend JavaScript framework (no React, Vue, or Alpine) — vanilla JS only

## Database
- **MySQL** — Primary data store (configured via `.env`, `DB_CONNECTION=mysql`)
- Database: `multiven`, User: `root`, no password (local dev)

## Key Dependencies

### Production (`composer.json` require)
| Package | Version | Purpose |
|---------|---------|---------|
| `laravel/framework` | ^13.7 | Core framework |
| `laravel/tinker` | ^3.0 | REPL for debugging |

### Development (`composer.json` require-dev)
| Package | Version | Purpose |
|---------|---------|---------|
| `fakerphp/faker` | ^1.23 | Test data generation |
| `laravel/pail` | ^1.2.5 | Real-time log viewer |
| `laravel/pao` | ^1.0.6 | Unknown (new Laravel tool) |
| `laravel/pint` | ^1.27 | Code style fixer |
| `mockery/mockery` | ^1.6 | Test mocking |
| `phpunit/phpunit` | ^12.5.12 | Testing framework |

### NPM (`package.json` devDependencies)
| Package | Version | Purpose |
|---------|---------|---------|
| `tailwindcss` | ^4.0.0 | CSS framework |
| `@tailwindcss/vite` | ^4.0.0 | Vite integration for Tailwind |
| `vite` | ^8.0.0 | Asset bundler |
| `laravel-vite-plugin` | ^3.1 | Laravel ↔ Vite bridge |
| `concurrently` | ^9.0.1 | Parallel dev server runner |

## Configuration
- **Entry points:** `resources/css/app.css`, `resources/js/app.js`
- **Dev server:** `composer dev` runs 4 processes concurrently: `php artisan serve`, `queue:listen`, `pail`, `npm run dev`
- **Build:** `npm run build` (production Vite build)
- **Setup script:** `composer setup` handles full bootstrap (install, key:generate, migrate, npm install, build)

## Environment
- **Local:** Laragon on Windows, Apache + MySQL
- **PHP Extensions:** `zip` enabled manually in `php.ini`
