<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

----
Anyone who downloads (clones) it will have a "blank" project without your local database or environment settings. To make it work-

Here is the standard "First-Time Setup" process you should document for new users:

### 1. The Environment File (`.env`)

Because your `.env` file was ignored by Git (to keep your passwords secret), the downloader won't have one. They need to create it.

* **Instruction:** Copy the example file: `cp .env.example .env`
* **Action:** Then open the new `.env` file and enter their own local database name, username, and password.

### 2. Install Dependencies

The `vendor` and `node_modules` folders were also not uploaded.

* **Instruction:** Run these two commands to install the PHP and JavaScript libraries:
* `composer install`
* `npm install && npm run build`



### 3. Generate the App Key

Laravel requires a unique security key for every installation.

* **Instruction:** Run `php artisan key:generate`. This will automatically update their `.env` file with a secure key.

---

### 4. Setting up the Database

This is the most important part. There are two ways to recreate your MySQL tables:

#### Option A: Using Laravel Migrations (Recommended)

If you built your tables using Laravel's migration files (located in your `database/migrations` folder), this is the easiest way.

* **Instruction:** "Run `php artisan migrate` to create the tables in your local database."
* **If you have seeders:** "Run `php artisan migrate --seed` to also add initial data."

#### Option B: Using a `.sql` Dump

If you didn't use migrations and instead exported a `.sql` file from phpMyAdmin:

* **Instruction:** "Create a new database in phpMyAdmin, then use the **Import** tab to upload the `database.sql` file provided in this repository."

---

### 5. Final Step: Start the Site

Once the database is linked, you can view the project just like you do.

* **Instruction:** Run `php artisan serve` and visit `http://localhost:8000`.

---

### Summary Table for your README

| Step | Command | Purpose |
| --- | --- | --- |
| **1** | `composer install` | Install PHP libraries |
| **2** | `cp .env.example .env` | Create environment file |
| **3** | `php artisan key:generate` | Set app security key |
| **4** | `php artisan migrate` | **Create Database Tables** |
| **5** | `php artisan serve` | Launch the project |

**Renaming Project**
----
To completely rename your project and database after downloading it, you need to update a few specific configuration files. Since the project uses **Vite** and **Tailwind** (as seen in your file structure), there are a couple of extra spots to check.

Here is the checklist of changes:

### 1. The `.env` File (Most Important)

This is where Laravel looks for its identity and database connection.

* **`APP_NAME`**: Change this to your new project name (e.g., `APP_NAME="My New App"`). If the name has spaces, use quotes.
* **`APP_URL`**: Update this to match your local URL (e.g., `http://localhost:8000`).
* **`DB_DATABASE`**: Change this to your **new** database name.

---

### 2. Create the New Database

Laravel won't create the physical database for you; it only tries to connect to it.

* Open **phpMyAdmin**.
* Click **New** and create a database with the exact name you just typed in your `.env` file.
* Run `php artisan migrate` in your terminal to build the tables in this new database.

---

### 3. Update `package.json`

Since you are using Vite, your project name is often defined in the metadata here.

* Open `package.json`.
* Change the `"name": "old-name"` field to your new project name (use lowercase and hyphens, e.g., `"my-new-app"`).

---

### 4. Update the Folder Name

While not strictly required for the code to run, you should rename the actual folder in `C:\xampp\htdocs\` to match your new project name.

* **Note:** If you rename the folder, remember to `cd` into the new folder name in your terminal before running `php artisan serve`.

---

### 5. Clear the Cache

Laravel "remembers" old configurations. After making these changes, run these commands to ensure the app recognizes the new names:

```bash
php artisan config:clear
php artisan cache:clear

```

### Summary of File Locations

| File | Variable to Change | Purpose |
| --- | --- | --- |
| **`.env`** | `APP_NAME` | Changes the name in emails and titles. |
| **`.env`** | `DB_DATABASE` | Points the app to your new MySQL DB. |
| **`package.json`** | `"name"` | Updates the JS/Node identity. |
| **`app.blade.php`** | `<title>` | (Optional) If you hardcoded the title in HTML. |
----
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

