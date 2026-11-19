# Pickleball Equipment Inventory Management System

## Requirements
PHP 8.2+, Composer, Node.js, MySQL

## Setup
1. Clone the repository
2. composer install
3. npm install, then npm run build
4. Copy .env.example to .env
5. php artisan key:generate
6. Create an empty MySQL database named pickleball_inventory
7. Set DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
8. php artisan migrate --seed
9. php artisan serve, then open http://127.0.0.1:8000

## Administrator account
Username: admin (or email: admin@example.com)
Password: password
