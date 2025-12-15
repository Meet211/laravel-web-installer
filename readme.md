# Laravel Web Installer

A modern, web-based installer for your Laravel application. It guides you through server requirements, permissions, environment setup, database migrations, seeding, and creating a Super Admin user.

## Features
- Server requirements check (PHP version and extensions)
- Folder permissions check
- Environment (.env) setup helper
- Super Admin user creation (configurable fields)
- Database migrate and seed flow
- Clean, Tailwind-based UI

## Requirements
- PHP 8.1+
- Laravel 10.x or 11.x

## Installation
Require this package with Composer:

```bash
composer require meetahir/laravel-web-installer
```

The package supports Laravel auto-discovery. If you disabled auto-discovery, register the service provider manually.

- For Laravel 10.x and below: add to `config/app.php` providers array
```php
'providers' => [
    // ...
    Meetahir\LaravelWebInstaller\Providers\LaravelInstallerServiceProvider::class,
];
```

- For Laravel 11.x+: add to `bootstrap/providers.php`
```php
return [
    // ...
    Meetahir\LaravelWebInstaller\Providers\LaravelInstallerServiceProvider::class,
];
```

Publish assets, views and translations (optional but recommended for customization):
```bash
php artisan vendor:publish --provider="Meetahir\\LaravelWebInstaller\\Providers\\LaravelInstallerServiceProvider"
```

This will publish:
- `config/installer.php` – server requirements and folder permissions
- `public/installer/*` – assets used by the installer
- `resources/views/vendor/installer/*` – installer views
- `resources/lang/en/installer_messages.php` – translation strings

## Usage
1. Ensure you have a `.env` file at the project root (the installer can help fill DB fields).
2. Visit the installer at:
   - http://your-app.test/install
3. Follow the steps:
   - Welcome
   - Environment (database credentials)
   - Super Admin (create initial admin user)
   - Requirements
   - Permissions
   - Finish

## Screenshots
Below are example screenshots of the steps you will see in the web installer:

- Welcome
  
  ![Welcome](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-1.png)

- Environment
  
  ![Environment](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-2.png)

- Super Admin
  
  ![Super Admin](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-3.png)

- Requirements
  
  ![Requirements](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-4.png)

- Permissions
  
  ![Permissions](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-5.png)

- Finished
  
  ![Finished](https://raw.githubusercontent.com/Meet211/laravel-web-installer/refs/heads/main/src/assets/img/steps/step-6.png)

Note: If the images above don’t load, they are just references; you can replace them with your own screenshots in your project’s README or documentation.

## Configuration
- Edit `config/installer.php` to change required PHP version, extensions and folder permissions.
- Customize fields for the Super Admin form via `config('installer.super_admin.fields')`.
- Adjust UI text in `resources/lang/*/installer_messages.php`.

## License
MIT

## Credits
Inspired by the community and tailored for Meet Ahir's Laravel projects.

