## Admin Login Access

This document describes how to access the admin login for the lara-radar app, seeded credentials, and common troubleshooting steps.

- **Login URL:** `/login`
- **Layout:** The login page uses the Mazer admin template. The logo is referenced as `asset('logo.png')` so ensure `public/logo.png` exists.

### Seeded Admin Accounts

When you run the database seeders (`php artisan db:seed`) the `CompanySeeder` creates one admin user per company with these credentials:

- **Email:** `admin+{company_id}@example.test` (e.g. `admin+1@example.test`)
- **Password:** `password`

Use these credentials to sign in during development. For production, create secure accounts and change passwords immediately.

### Create / Update Admin User (artisan tinker)

If you need to create or update an admin account manually, use `php artisan tinker`:

```bash
php artisan tinker
// create a user for company id 1
App\\Models\\User::create([
  'company_id' => 1,
  'name' => 'Admin User',
  'email' => 'admin@example.test',
  'password' => bcrypt('your-secure-password'),
]);
```

Assign roles using Spatie permissions (example):

```php
$user = App\\Models\\User::where('email', 'admin@example.test')->first();
$user->assignRole('admin');
```

### Password Reset (web)

- Visit `/forgot-password` and follow the email flow (ensure mail is configured in `config/mail.php`).
- For development without mail, you can reset via tinker:

```bash
php artisan tinker
$user = App\\Models\\User::where('email','admin+1@example.test')->first();
$user->password = bcrypt('new-password');
$user->save();
```

### Troubleshooting

- If the login page looks unstyled, clear compiled views and cached assets:

```bash
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

- If `public/logo.png` is not present the header will show a broken image — place your `logo.png` into the `public/` directory.

- If seeding fails with column not found errors, see `database/factories/*` and `database/migrations/*` to ensure factories match migration columns. Running `php artisan migrate:fresh --seed` in development can help (destructive).

- Database connection issues: confirm `.env` DB_* values and that MySQL (MAMP) is running.

### Next steps / Security

- Replace seeded passwords with secure passwords for any demo accounts before sharing the environment.
- Consider disabling seeded admin accounts or restricting access when deploying to staging/production.

If you want, I can commit these docs and push them to `origin/main`, and then proceed to enhance the Domain Detail page using seeded data.
