# 🎟️ StagePass – Event Ticketing Platform

**StagePass** is a full-featured Laravel 12 + Livewire v3 application for managing and purchasing event tickets. It includes admin tools, seat maps, concurrency handling, and a clean user interface powered by Tailwind CSS and Alpine.js.

---

## 🔧 Requirements

- PHP >= 8.2
- Composer
- Node.js & npm (for compiling assets)
- MySQL or PostgreSQL
- Laravel Herd / Valet / Docker / Local server (optional)

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/amuvavi/stagepass.git
cd stagepass
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Create Environment File

```bash
cp .env.example .env
```

Update the `.env` with your database credentials:

```
DB_DATABASE=stagepass
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will populate the database with default admin, users, events, seats, and test data.

---

## 👤 Default Users

| Role  | Email               | Password  |
|-------|---------------------|-----------|
| Admin | admin@example.com   | password  |
| User  | user@example.com    | password  |

---

## 💻 Running the App Locally

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Role-based Redirection

- **Users** are redirected to `/events` after login.
- **Admins** are redirected to `/admin/events`.

---

## 🧪 Running Tests

```bash
php artisan test
```

To view coverage:

```bash
php artisan test --coverage
```

---

## 🧰 Developer Tools

- Livewire v3 + Volt
- Tailwind CSS & AOS (Animations)
- Alpine.js
- Rappasoft Livewire Tables
- Laravel Queues for concurrency simulation
- Custom actions, services, contracts pattern for testability
- PHPUnit feature and unit tests

---

## 👥 Contributors

- [@austinmuvavi](https://github.com/austinmuvavi)

---

## 📄 License

This project is open-sourced under the [MIT license](LICENSE).

