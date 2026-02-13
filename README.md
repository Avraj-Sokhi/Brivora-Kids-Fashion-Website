# Brivora Kids Fashion Website

A modern e-commerce platform for children's clothing, built with Laravel 12 and featuring a vibrant, kid-friendly design.

##  Team Members

- **Avraj Sokhi** - 240081050
- **Musab Abbas** - 240005942
- **Muhammed Faizan Hussain** - 240151250
- **Oritsemisan Omamuli** - 240174477
- **Christal Dilworth** - 240337212
- **Gulshan Lohat** - 240134264
- **Khalid Al-Binali** - 230437434

##  Project Overview

Brivora Kids Fashion is a full-featured e-commerce website designed to provide a straightforward shopping experience for parents looking for quality children's clothing. The platform features a playful, colorful design that appeals to both children and parents while maintaining professional functionality.

##  Key Features

### Customer Features
- **Product Browsing**: Browse products by category (Accessories, Outerwear, Shoes, Tops, Trousers) and gender (Boys, Girls)
- **Advanced Filtering**: Filter products by category, gender, and search by name/description
- **Product Sorting**: Sort by newest, price (low to high, high to low), and name (A-Z)
- **Shopping Cart**: Add products to basket, update quantities, and manage cart items
- **User Authentication**: Secure registration and login system with password management
- **Order Management**: View order history and track order details
- **Contact Form**: Submit inquiries and feedback through the contact page
- **Responsive Design**: Mobile-friendly interface that works on all devices

### Admin Features
- **Product Management**: Full CRUD operations for products
- **Category Management**: Organize products into categories
- **Order Tracking**: Monitor and manage customer orders
- **User Management**: View and manage customer accounts

##  Technology Stack

### Backend
- **Framework**: Laravel 12.39.0
- **PHP Version**: 8.4.14
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Caching**: Database-based caching

### Frontend
- **CSS Framework**: Custom CSS with Bootstrap 5 pagination
- **JavaScript**: Vanilla JS with Vite bundling
- **Fonts**: Google Fonts (Fredoka One, Comic Neue, Poppins)
- **Icons**: Custom SVG icons

### Development Tools
- **Package Manager**: Composer & NPM
- **Build Tool**: Vite
- **Version Control**: Git

##  Installation & Setup

### Prerequisites
- PHP >= 8.4
- Composer
- MySQL
- Node.js & NPM

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Avraj-Sokhi/Brivora-Kids-Fashion-Website.git
   cd Brivora-Kids-Fashion-Website
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   - Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=brivorakidsdb
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Database** (Optional - adds sample products)
   ```bash
   php artisan db:seed
   ```

8. **Build Assets**
   ```bash
   npm run build
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   ```
