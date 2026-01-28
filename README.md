## Brivora Fashion Admin Dashboard

A Laravel-based admin dashboard with role-based access control, product management, order tracking, and customer management.

## Features Implemented

### Authentication & Authorization
- **Role-Based Access Control (RBAC)** using Spatie Laravel Permission
- **Admin-only access** with dedicated middleware
- **Login/Logout functionality** with secure session management

### Dashboard
- **Dynamic Statistics** populated from database:
  - Total Products count
  - Total Customers count
  - Total Orders count
  - Orders Awaiting Processing (pending status)
  - Low Stock Alerts count
- **Low Stock Products Table** showing items below threshold
- **Responsive Layout** with sidebar navigation and header
- **Tailwind CSS** for modern, utility-first styling


### User Roles
- **Admin Role** with full permissions
- **Simplified Seeding**

## Installation Instructions

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or PostgreSQL
- Node.js & NPM (for frontend assets if needed)

### Step 1: Clone the Repository
```bash
Download the repository as a ZIP file. 
Extract the ZIP file to your desired location (e.g., `C:\xampp\htdocs\admin-dashboard`).
cd admin-dashboard
```

### Step 2: Install Dependencies
```bash
composer install
```

Update the `.env` file with your database credentials:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Database Setup
```bash
php artisan migrate
php artisan db:seed
```

This will create all tables and seed them with sample data including:
- Admin user (email: admin@example.com, password: password)
- Sample products with stock levels
- Sample customers and orders
- Admin notifications



### Step 6: Run the Application
```bash
php artisan serve
```

Visit `http://localhost:8000/login` and log in with:
- Email: admin@example.com
- Password: password

## Admin Dashboard Access

After logging in, you'll be redirected to the admin dashboard at `/admin/dashboard` which displays:
- Real-time statistics from your database
- Low stock alerts for products
- Quick navigation to all admin sections (Products, Orders, Customers, Reports, Settings....to be implemented)

## Available Admin Routes

All admin routes are prefixed with `/admin` and require authentication:
- `/admin/dashboard` - Main dashboard with statistics
- `/admin/products` - Product management (404 for now)
- `/admin/orders` - Order management (404 for now)
- `/admin/customers` - Customer management (404 for now)
- `/admin/reports` - Reports section (404 for now)
- `/admin/settings` - System settings (404 for now)

## Security Features

- **CSRF Protection** on all forms
- **Authentication Required** for admin sections
- **Role-Based Access Control** using Spatie permissions
- **Secure Logout** with POST method and CSRF token

## Technologies Used

- **Laravel 10.x** - PHP Framework
- **Tailwind CSS** - Utility-first CSS framework
- **Spatie Laravel Permission** - Role-based access control
- **MySQL** - Database
- **Blade Templating** - Laravel's templating engine

## Next Steps

Future features to implement:
- Product CRUD operations
- Order management interface
- Customer management tools
- Reports and analytics
- Settings management
- File upload for product images

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).