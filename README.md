# Pickleball Equipment Inventory Management System

## Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm
- MySQL or MariaDB through XAMPP

## Setup

1. Create a MySQL database named `pickleball_inventory`:
   ```sql
   CREATE DATABASE pickleball_inventory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Copy the environment template:
   ```powershell
   Copy-Item .env.example .env
   ```

3. Confirm these database values in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pickleball_inventory
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Install dependencies and generate the application key:
   ```powershell
   composer install
   php artisan key:generate
   npm install
   npm run build
   ```

5. Run migrations and seed the administrator account and eight demonstration records:
   ```powershell
   php artisan migrate:fresh --seed
   ```

6. Start the application:
   ```powershell
   php artisan serve
   ```

Open `http://127.0.0.1:8000`.

## Administrator Login

- Username: `admin`
- Email: `admin@example.com`
- Password: `password`

The login field accepts either the username or email address.

## Application URL

For submission, enter the public or LAN URL here: **____________________________**

## Submission Hosting Note

For checking, keep the computer or hosting server running and ensure MySQL and `php artisan serve` remain available. For a stable public URL, deploy the project to a reachable PHP hosting service or an accessible LAN server and update `APP_URL`.
