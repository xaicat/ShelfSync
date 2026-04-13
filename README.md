<div align="center">

<p align="center">
  <img src="https://raw.githubusercontent.com/xaicat/ShelfSync/d10bcc9fbae7e004461007947d4cb4df0ab5e84b/public/img/diushelf%20sync.svg?token=BAAAA77GWM67QU7RTNPNTU3J3SHZC" alt="ShelfSync" width="300">
</p>

### Digital Library Management System

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Gemini AI](https://img.shields.io/badge/Gemini_AI-2.5_Flash-4285F4?style=for-the-badge&logo=google&logoColor=white)](https://ai.google.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

**A next-generation, glassmorphic web application that fully digitizes university library operations — from book rentals and digital membership cards to automated fines and an AI-powered book assistant.**

[Features](#-features) · [Tech Stack](#-tech-stack) · [Installation](#-installation) · [Configuration](#-environment-configuration) · [Usage](#-usage-guide) · [Folder Structure](#-project-structure)

</div>

---
<div align="center">
  <a href="https://www.youtube.com/watch?v=w15mMk5oCMs">
    <img src="https://img.youtube.com/vi/w15mMk5oCMs/maxresdefault.jpg" alt="Watch the video" style="width:100%; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
    <br>
    <sub><b>Click to play video on YouTube</b></sub>
  </a>
</div>

## Overview

ShelfSync replaces paper-based library workflows with a fast, beautiful, and fully automated web system. Students can browse books, apply for a digital library card, rent books, track their reading, and get AI-powered book insights — all without leaving their browser.

Librarians get a powerful admin panel to manage inventory, approve rentals, process returns, handle fine disputes, and manage student memberships — all from one consolidated dashboard.

---

## Features

### Public (No Login Required)
- **Landing Page** — Featured books, platform features showcase, how-it-works timeline, and FAQ
- **Live Book Catalog** — Real-time search by title, author, or category with instant results
- **Category Filter** — Filter the catalog by book category
- **AI Book Assistant** — Click ⓘ on any book to get AI-generated metadata (author, publisher, genre, summary) and chat with Gemini AI about the book
- **Contact Form** — Submit inquiries directly to the library

### Student Features
- **Registration & Email Verification** — Secure onboarding with Laravel Breeze
- **Digital Library Card** — Apply for a glassmorphic digital ID card with 6-month validity
- **Book Renting** — Submit rental requests with a chosen return date
- **My Rentals** — Track approved, pending, and returned rentals with fine details
- **Fine Appeal** — Dispute overdue fines with a written appeal
- **Reading Tracker** — Log progress and mark books as completed
- **Wishlist** — Bookmark books for future renting (AJAX toggle)
- **Persistent AI Chat** — AI conversations saved per-book across sessions

### Admin Features
- **Dashboard** — Consolidated stats: users, books, active rentals, outstanding fines
- **Rental Approval Workflow** — Approve / reject / process returns with auto-fine calculation
- **Book Management (CRUD)** — Create, edit, and delete books with external image URLs
- **Category Management** — Add and remove book categories
- **Library Card Management** — Approve, reject, or revoke membership cards
- **Fine Management** — Manually clear or adjust fines
- **Appeal Resolution** — Review and resolve student fine disputes
- **Member Management** — View all users, promote to admin or demote

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11 (PHP 8.x) |
| **Database** | MySQL (via XAMPP) |
| **ORM** | Eloquent |
| **Authentication** | Laravel Breeze |
| **Frontend** | Blade Templating + Vanilla CSS |
| **AI Integration** | Google Gemini 2.5 Flash (REST API v1beta) |
| **UI Design** | Custom Glassmorphism Dark Mode Design System |
| **Web Server** | Apache (XAMPP) |

---

## Prerequisites

Before you begin, ensure you have the following installed:

| Requirement | Version | Download |
|-------------|---------|----------|
| **XAMPP** | 8.x (PHP 8.1+) | [apachefriends.org](https://www.apachefriends.org/) |
| **Composer** | 2.x | [getcomposer.org](https://getcomposer.org/) |
| **Git** | Latest | [git-scm.com](https://git-scm.com/) |
| **Node.js & NPM** | 18.x+ | [nodejs.org](https://nodejs.org/) |

---

## Installation

Follow these steps exactly to get ShelfSync running on your local machine.

### Step 1 — Clone the Repository

Open your terminal and navigate to your XAMPP `htdocs` folder:

```bash
cd C:/xampp/htdocs
```

Clone the project:

```bash
git clone https://github.com/YOUR_USERNAME/school_project.git shelfsync
```

Navigate into the project directory:

```bash
cd shelfsync
```

---

### Step 2 — Install PHP Dependencies

```bash
composer install
```

> If you get a memory error, run: `php -d memory_limit=-1 /path/to/composer install`

---

### Step 3 — Install Node.js Dependencies

```bash
npm install
```

---

### Step 4 — Set Up Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

> On Windows (Command Prompt):
> ```
> copy .env.example .env
> ```

Generate the application key:

```bash
php artisan key:generate
```

---

### Step 5 — Configure the Database

1. **Start XAMPP** — Open XAMPP Control Panel and start **Apache** and **MySQL**
2. **Open phpMyAdmin** — Go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
3. **Create a new database** — Click "New" and create a database named `shelfsync`

Now open `.env` in your code editor and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shelfsync
DB_USERNAME=root
DB_PASSWORD=
```

> **Note:** The default XAMPP MySQL has username `root` with an **empty password**. If you've set a password, enter it in `DB_PASSWORD`.

---

### Step 6 — Run Database Migrations

```bash
php artisan migrate
```

This will create all 10 tables in your `shelfsync` database.

> If you want to reset and re-run all migrations from scratch:
> ```bash
> php artisan migrate:fresh
> ```

---

### Step 7 — (Optional) Seed the Database

If a seeder is available to populate demo books and users:

```bash
php artisan db:seed
```

---

### Step 8 — Set Up Storage Link

```bash
php artisan storage:link
```

This links the `storage/app/public` directory to `public/storage` for file access.

---

### Step 9 — Build Frontend Assets

```bash
npm run dev
```

> For a one-time production build:
> ```bash
> npm run build
> ```

---

### Step 10 — Launch the Application

You can either:

**Option A — Use Laravel's built-in server:**
```bash
php artisan serve
```
Then open [http://localhost:8000](http://localhost:8000)

**Option B — Access via XAMPP Apache:**

Since you cloned into `htdocs/shelfsync`, visit:
```
http://localhost/shelfsync/public
```

> **Tip for XAMPP:** Set the `APP_URL` in `.env` to match:
> ```env
> APP_URL=http://localhost/shelfsync/public
> ```

---

## Environment Configuration

Open your `.env` file and configure these key variables:

```env
# ── Application ────────────────────────────────────────────
APP_NAME="ShelfSync"
APP_ENV=local
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost/shelfsync/public

# ── Database ───────────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shelfsync
DB_USERNAME=root
DB_PASSWORD=

# ── Mail (for Email Verification) ──────────────────────────
# For local testing, use 'log' driver (emails go to storage/logs)
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@shelfsync.com"
MAIL_FROM_NAME="ShelfSync"

# ── Google Gemini AI ───────────────────────────────────────
GEMINI_API_KEY=your_gemini_api_key_here
GEMINI_MODEL=gemini-2.5-flash
```

---

## Setting Up the Gemini AI API Key

The AI Book Assistant requires a Google Gemini API key. It is **free** to create.

1. Visit **[Google AI Studio](https://aistudio.google.com/)**
2. Sign in with your Google account
3. Click **"Get API Key"** → **"Create API Key"**
4. Copy the generated key
5. Paste it into your `.env` file:

```env
GEMINI_API_KEY=AIzaSy...your_key_here
GEMINI_MODEL=gemini-2.5-flash
```

6. Run `php artisan config:clear` to clear the config cache:

```bash
php artisan config:clear
```

> **Security:** The API key is never sent to the browser. All Gemini calls are made server-side through `AiController.php`.

---

## Usage Guide

### Creating an Admin Account

After registering a normal account, open **phpMyAdmin**, find your user in the `users` table, and change the `role` column from `user` to `admin`.

Or run this artisan command in Tinker:

```bash
php artisan tinker
```

```php
\App\Models\User::where('email', 'your@email.com')->update(['role' => 'admin']);
```

### Default URL Routes

| Route | Description |
|-------|-------------|
| `/` | Landing page |
| `/user/books` | Public book catalog |
| `/register` | Student registration |
| `/login` | Login page |
| `/user/dashboard` | Student dashboard (requires login) |
| `/admin/dashboard` | Admin panel (requires admin role) |
| `/profile` | Edit profile |

---

## 📁 Project Structure

```
shelfsync/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php     # All admin management logic
│   │   │   ├── UserController.php      # Student features logic
│   │   │   ├── AiController.php        # Gemini AI integration
│   │   │   └── ProfileController.php   # Profile management
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Book.php
│       ├── Category.php
│       ├── Rental.php
│       ├── LibraryCard.php
│       ├── FineAppeal.php
│       ├── Wishlist.php
│       ├── ReadingProgress.php
│       ├── ChatHistory.php
│       └── Contact.php
├── database/
│   └── migrations/             # 18 migration files
├── public/
│   └── css/
│       └── shelfsync.css       # Custom design system
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── user.blade.php          # Student layout
│       │   └── admin.blade.php         # Admin layout
│       ├── components/
│       │   ├── book-ai-modal.blade.php # AI modal component
│       │   └── global-fx.blade.php     # Cursor + particles
│       ├── user/                       # Student views
│       ├── admin/                      # Admin views
│       └── welcome.blade.php           # Landing page
├── routes/
│   └── web.php                 # All 30+ application routes
├── .env.example                # Environment template
└── composer.json
```

---

## User Roles

| Role | Access | How to Set |
|------|--------|-----------|
| **Guest** | Browse catalog, AI assistant, contact form | No account needed |
| **Student** | + Rent books, library card, wishlist, reading tracker, fine appeals | Register an account |
| **Admin** | + Full management panel | Set `role = admin` in the `users` table |

---

## Database Tables

| Table | Description |
|-------|-------------|
| `users` | All registered users (students + admins) |
| `categories` | Book categories |
| `books` | Library catalog with cover, author, quantity, price |
| `rentals` | Rental requests, approvals, returns, and fines |
| `fine_appeals` | Student fine dispute submissions |
| `library_cards` | Digital membership cards |
| `wishlists` | Student book bookmarks |
| `reading_progress` | Per-user book reading status |
| `chat_histories` | AI assistant conversation logs |
| `contacts` | Public contact form submissions |

---

## Security Features

- ✅ **CSRF Protection** — All forms and AJAX calls include CSRF tokens
- ✅ **Role Middleware** — Admin routes double-protected by `auth` + `admin` middleware  
- ✅ **Server-Side AI Calls** — Gemini API key never exposed to browser
- ✅ **Rate Limiting** — AI endpoints throttled at 15 requests/minute/IP
- ✅ **Password Hashing** — Bcrypt via Laravel's default Hash facade
- ✅ **Input Validation** — All form inputs validated server-side before DB interaction

---

## Troubleshooting

**`php artisan migrate` fails:**
- Ensure MySQL is running in XAMPP
- Verify `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`
- Make sure the database `shelfsync` was created in phpMyAdmin

**AI modal shows "Couldn't reach the AI service":**
- Check your `GEMINI_API_KEY` in `.env`
- Run `php artisan config:clear`
- Verify the key works at [Google AI Studio](https://aistudio.google.com/)

**404 errors on routes:**
- Make sure `APP_URL` in `.env` matches your actual URL
- If using XAMPP (not `php artisan serve`), ensure URL includes `/public`

**Page loads but CSS looks broken:**
- Run `npm run dev` or `npm run build`
- Ensure the `public/` folder is accessible

**Email verification not working:**
- Set `MAIL_MAILER=log` in `.env` for local development
- Verification emails will be written to `storage/logs/laravel.log`

---

## Contributing

Contributions are welcome! Please follow these steps:

1. **Fork** the repository
2. Create a new feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add: your feature description'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a **Pull Request**

### Coding Standards
- Follow **PSR-12** PHP coding standards
- Keep Controllers thin — move complex logic to Service classes or Model scopes
- All new database fields must be added via **new migration files**, never by editing existing ones
- Blade components go in `resources/views/components/`

---

## 📄 License

This project is licensed under the **MIT License** — see the [LICENSE](LICENSE) file for details.

---

## Authors

| Name | Role |
|------|------|
| **Mahadi Hassan** | Software Engineer |

---

## Acknowledgements

- [Laravel](https://laravel.com/) — The PHP framework for web artisans
- [Google Gemini AI](https://ai.google.dev/) — Powering the AI Book Assistant
- [Font Awesome](https://fontawesome.com/) — Icons
- [Google Fonts](https://fonts.google.com/) — Typography

---

<div align="center">

**Made with ❤️ for the love of reading and clean code.**

⭐ Star this repo if you found it useful!

</div>
