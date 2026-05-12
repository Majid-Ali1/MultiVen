# Phase 1: Foundation & Auth Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Establish the core multi-role authentication system and base layout.

**Architecture:** We use a centralized `roles` and `permissions` system linked to the `users` table. Access is controlled via RoleMiddleware and Laravel Policies.

**Tech Stack:** Laravel, Blade, Tailwind, MySQL.

---

### Task 1: Role & Permission Schema

**Files:**
- Create: `database/migrations/YYYY_MM_DD_create_roles_table.php`
- Create: `database/migrations/YYYY_MM_DD_create_permissions_table.php`
- Create: `database/migrations/YYYY_MM_DD_create_permission_role_table.php`
- Modify: `database/migrations/0001_01_01_000000_create_users_table.php`
- Create: `app/Models/Role.php`
- Create: `app/Models/Permission.php`

**Step 1: Modify Users table to add role_id**
Modify `database/migrations/0001_01_01_000000_create_users_table.php` to add `foreignId('role_id')->constrained()` and `string('status')->default('active')`.

**Step 2: Create Roles table migration**
```php
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});
```

**Step 3: Create Permissions and Pivot table migrations**
Create migrations for `permissions` and `permission_role`.

**Step 4: Create Models with relationships**
- `Role` hasMany `User`, belongsToMany `Permission`.
- `Permission` belongsToMany `Role`.
- `User` belongsTo `Role`.

**Step 5: Run Migrations**
Run `php artisan migrate`.

**Step 6: Seed Roles**
Create a seeder `RoleSeeder` with admin, customer, partner, vendor, staff.

---

### Task 2: Middleware & Auth Logic

**Files:**
- Create: `app/Http/Middleware/RoleMiddleware.php`
- Modify: `app/Http/Kernel.php` (or `bootstrap/app.php` in Laravel 11+)
- Modify: `app/Models/User.php` (add `hasRole`, `hasPermission` methods)

**Step 1: Implement RoleMiddleware**
Check if user is authenticated and has the required role.

**Step 2: Register Middleware**
Register it as an alias (e.g., `role`).

**Step 3: Update User model helpers**
```php
public function hasRole($role) {
    return $this->role->slug === $role;
}
```

---

### Task 3: Base Layouts & Components

**Files:**
- Create: `resources/views/layouts/base.blade.php`
- Create: `resources/views/layouts/admin.blade.php`
- Create: `resources/views/layouts/customer.blade.php`
- Create: `resources/views/components/ui/button.blade.php`

**Step 1: Create Base Layout**
Include Tailwind, Vite assets, and CSRF token.

**Step 2: Create Panel-specific Layouts**
Admin (Sidebar), Customer (Navbar/Footer).
