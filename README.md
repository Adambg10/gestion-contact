# Gestion Contact

A contact management web application built with Laravel, designed for organizing and managing your contacts efficiently. Features include user authentication, contact CRUD operations, advanced search functionality, and an admin dashboard for centralized data management.

## Features

- User authentication with secure login
- Create, edit, and delete contacts
- Contact search and filtering
- Admin dashboard for user and contact management
- Contact organization by owner/user
- Responsive interface with Bootstrap
- Role-based access control

## Tech Stack

- **Backend:** Laravel 10, PHP 8.2
- **Frontend:** Blade templates, Bootstrap 5, SCSS/CSS
- **Database:** MySQL
- **Build Tools:** Vite, Npm
- **Admin Panel:** Ladmin by Hexters (ready-made admin dashboard framework)

## Requirements

- PHP 8.2+
- Composer
- Node.js / NPM
- MySQL 8.0+

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Adambg10/gestion-contact.git
   cd gestion-contact
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node dependencies:
   ```bash
   npm install
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure database in `.env` then run migrations:
   ```bash
   php artisan migrate
   ```

## Running the Application

Start the web server (using XAMPP or Laravel):
```bash
php artisan serve
```

In a separate terminal, run the frontend asset compiler:
```bash
npm run dev
```

Access the application at:
- User app: `http://localhost/gestion-contact`
- Admin panel: `http://localhost/gestion-contact/administrator/login`

## Screenshots

### User Dashboard
(add your contact list screenshot here)

### Contact Details Page
(add your contact details/edit screenshot here)

### Admin Dashboard
(add your admin panel screenshot here)

### Contact Creation Form
(add your add/edit contact form screenshot here)

## Project Structure

- `app/Models/` - Database models (User, Contact)
- `app/Http/Controllers/` - Application controllers
- `resources/views/` - Blade templates
- `Modules/Ladmin/` - Admin dashboard module
- `database/migrations/` - Database schemas

## Database Schema

The application uses three main tables:
- `users` - Application users
- `contacts` - Contact records (belongs to user)
- `ladmin_accounts` - Admin accounts

## License

Open source project

## Author

Adam Ben Guedria