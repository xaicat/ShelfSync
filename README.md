<div align="center">

<p align="center">
  <img src="https://raw.githubusercontent.com/xaicat/ShelfSync/d10bcc9fbae7e004461007947d4cb4df0ab5e84b/public/img/diushelf%20sync.svg" alt="ShelfSync" width="300">
</p>

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Groq AI](https://img.shields.io/badge/Groq_AI-Llama_3.1-F55036?style=for-the-badge)](https://groq.com)
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
- **AI Book Assistant** — Click ⓘ on any book to get AI-generated metadata (author, publisher, genre, summary) and chat with the **Llama 3.1** AI about the book
- **Contact Form** — Submit inquiries directly to the library

### Student Features
- **Registration & Profile** — Secure onboarding with Laravel Breeze (Streamlined for local deployments)
- **Digital Library Card** — Apply for a glassmorphic digital ID card with 6-month validity
- **Book Renting** — Submit rental requests with a chosen return date
- **My Rentals** — Track approved, pending, and returned rentals with fine details
- **Fine Appeal** — Dispute overdue fines with a written appeal
- **Reading Tracker** — Log progress and mark books as completed
- **Wishlist** — Bookmark books for future renting (AJAX toggle)
- **Persistent AI Chat** — AI conversations saved per-book across sessions (Graceful degradation prevents crashes if offline)

### Admin Features
- **Dashboard** — Consolidated stats: users, books, active rentals, outstanding fines
- **Rental Approval Workflow** — Approve / reject / process returns with auto-fine calculation
- **Dual-Layer Book Fetcher** — Instantly add books by ISBN using the ultra-fast Google Books API, with an automatic fallback to the OpenLibrary API.
- **Local Cover Engine** — Automatically intercepts remote hotlinks and downloads book covers to local storage for instant loading.
- **Category Management** — Add and remove book categories
- **Library Card Management** — Approve, reject, or revoke membership cards
- **Fine Management** — Manually clear or adjust fines
- **Appeal Resolution** — Review and resolve student fine disputes

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11 (PHP 8.x) |
| **Database** | MySQL (via XAMPP) |
| **ORM** | Eloquent |
| **Authentication** | Laravel Breeze |
| **Frontend** | Blade Templating + Vanilla CSS |
| **AI Integration** | Groq REST API (Llama 3.1 8B Instant model) |
| **Metadata Engine**| Google Books API & OpenLibrary API Proxy |
| **UI Design** | Custom Glassmorphism Dark Mode Design System |

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

This will create all the necessary tables in your `shelfsync` database.

---

### Step 7 — Build Frontend Assets

```bash
npm run dev
```

> For a one-time production build:
> ```bash
> npm run build
> ```

---

### Step 8 — Launch the Application

**Use Laravel's built-in server:**
```bash
php artisan serve
```
Then open [http://localhost:8000](http://localhost:8000)

---

## Environment Configuration

Open your `.env` file and configure these key variables:

```env
# ── Application ────────────────────────────────────────────
APP_NAME="ShelfSync"
APP_ENV=local
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost:8000

# ── Database ───────────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shelfsync
DB_USERNAME=root
DB_PASSWORD=

# ── Groq AI (Llama 3.1) ────────────────────────────────────
GROQ_API_KEY=your_groq_api_key_here
GROQ_MODEL=llama-3.1-8b-instant
```

---

## Setting Up the Groq AI API Key

The AI Book Assistant requires a Groq API key. It is extremely fast and **completely free**.

1. Visit **[Groq Console](https://console.groq.com/keys)**
2. Sign in with your account
3. Click **"Create API Key"**
4. Copy the generated key
5. Paste it into your `.env` file:

```env
GROQ_API_KEY=gsk_your_key_here
GROQ_MODEL=llama-3.1-8b-instant
```

6. Run `php artisan config:clear` to clear the config cache!

> **Security & Stability:** The API key is never sent to the browser. All AI calls are made server-side. The app features *Graceful Degradation* — if you are offline or the API rate limits, the UI remains perfectly functional and displays a polite offline message.

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

## ⭐ Security Features

- ✅ **CSRF Protection** — All forms and AJAX calls include CSRF tokens
- ✅ **Role Middleware** — Admin routes double-protected by `auth` + `admin` middleware  
- ✅ **Server-Side AI Calls** — API tokens never exposed to the browser
- ✅ **Backend Data Proxy** — Metadata fetching is routed through the server to bypass campus WiFi firewalls and CORS errors.

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
- [Groq & Meta Llama](https://groq.com) — Powering the hyper-fast AI Book Assistant
- [Google Books API](https://developers.google.com/books) — Lightning-fast ISBN lookups
- [Font Awesome](https://fontawesome.com/) — Icons

---

<div align="center">

**Made with ❤️ for the love of reading and clean code.**

⭐ Star this repo if you found it useful!

</div>
