# Book Management System

A complete PHP and MySQL book management system with login protection, dashboard analytics, CRUD operations, search, and a responsive UI.

## Features

- Login and logout with session protection
- Dashboard with summary cards and recent books
- Full book CRUD workflow
- Search across title, author, category, and ISBN
- Responsive interface with reusable layout files

## Folder Layout

- `index.php` - root router
- `dashboard.php` - authenticated overview page
- `config/database.php` - PDO connection and session bootstrap
- `database/database.sql` - schema and starter data
- `includes/` - shared layout and auth helpers
- `auth/` - login and logout flow
- `books/` - list, create, view, edit, delete, and search pages
- `assets/` - stylesheet and client-side behavior

## Setup

1. Import `database/database.sql` into MySQL.
2. Update `config/database.php` if your MySQL username, password, or database name is different.
3. Put the project in your web server root, then open the app in the browser.
4. Sign in with:
   - Username: `admin`
   - Password: `admin123`

## Notes

- The first successful login upgrades the default plain-text demo password to a hashed password automatically.
- If you change the project folder name, update `APP_BASE` in `config/database.php`.