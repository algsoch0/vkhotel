# VK Hotel - Advanced Hotel Booking Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat-square&logo=tailwind-css" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
</p>

## 🏨 Overview

**VK Hotel** is a modern, fully-responsive hotel booking management system built with Laravel 10, Tailwind CSS, and Alpine.js. It features an advanced admin dashboard, real-time booking management, comprehensive reporting, and seamless payment integration.

### ✨ Key Features

- **Advanced Room Management**: Manage unlimited room types with dynamic pricing, availability calendars, and amenities
- **Smart Booking System**: Real-time availability checking, automated confirmation emails, and instant notifications
- **Admin Dashboard**: Comprehensive analytics, revenue reports, booking metrics, and guest management
- **Guest Portal**: User-friendly booking interface, booking history, profile management, and cancellation handling
- **Payment Integration**: Secure payment processing with Stripe/PayPal support
- **Responsive Design**: Mobile-first UI with Tailwind CSS for all devices
- **Real-time Notifications**: Email notifications, SMS alerts (optional), and in-app notifications
- **Advanced Search & Filtering**: Smart room search with multiple filters, price ranges, and amenities
- **Multi-language Support**: Built for international hotels with multi-currency support
- **Advanced Security**: Role-based access control (RBAC), two-factor authentication, CSRF protection
- **API Endpoints**: RESTful API for third-party integrations
- **Performance Optimized**: Caching, lazy loading, and database query optimization

---

## 🚀 Tech Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 10 |
| **Frontend** | Tailwind CSS 3, Alpine.js 3 |
| **Database** | PostgreSQL / MySQL |
| **Authentication** | Laravel Sanctum |
| **Build Tool** | Vite 5 |
| **UI Components** | Bootstrap 5, Swiper, SweetAlert2 |
| **Animations** | AOS (Animate On Scroll) |
| **Real-time** | Laravel Broadcasting |

---

## 📋 Prerequisites

- **PHP**: 8.1 or higher
- **Node.js**: 16+ (for build tools)
- **Composer**: Latest version
- **Database**: PostgreSQL 12+ or MySQL 5.7+
- **Git**: For version control

---

## 🔧 Local Installation & Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd vk-hotel
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Update .env File
```env
APP_NAME="VK Hotel"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vk_hotel
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@vkhotel.com

# Payment Gateway (Optional)
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

### 6. Create Database & Run Migrations
```bash
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
```

### 7. Build Assets
```bash
# Development mode with hot reload
npm run dev

# Or build for production
npm run build
```

### 8. Start Development Server
```bash
php artisan serve
```

Access the application at: **http://localhost:8000**

### Default Credentials
- **Email**: admin@vkhotel.com
- **Password**: password

---

## 🎯 Advanced Features Guide

### Room Management
- Create unlimited room types with detailed descriptions and amenities
- Set dynamic pricing based on seasons and demand
- Manage room availability with a visual calendar
- Upload multiple room images with gallery support
- Track room maintenance schedules

### Booking Management
- Accept/reject/confirm bookings with automatic emails
- Manage special requests and notes from guests
- Handle cancellations and refunds
- Track booking status in real-time
- Generate booking confirmations and invoices

### Dashboard Analytics
- Revenue charts and trends
- Occupancy rates and statistics
- Guest demographics and booking patterns
- Performance metrics and KPIs
- Exportable reports (PDF, Excel)

### Guest Portal
- Easy room search and booking
- Secure payment processing
- Account dashboard with booking history
- Digital receipt and invoices
- Review and rating system

---

## 🌐 Deployment on Render

### Prerequisites for Render
- GitHub account with repository connected
- PostgreSQL database (Render provides this)
- Render.com account

### Step-by-Step Deployment

#### 1. Connect GitHub Repository
- Push your code to GitHub
- Ensure `.env.example` is committed (but `.env` is in `.gitignore`)

#### 2. Create Render Service
```bash
# In your Render dashboard:
1. Click "New +" → Select "Web Service"
2. Connect your GitHub repository
3. Configure build command: `./scripts/build.sh`
4. Configure start command: `./start.sh`
```

#### 3. Set Environment Variables
In Render Dashboard → Environment:
```env
APP_NAME=VK Hotel
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your-postgresql-host
DB_PORT=5432
DB_DATABASE=vk_hotel
DB_USERNAME=postgres
DB_PASSWORD=your_db_password

APP_KEY=your_app_key_from_local_env

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@vkhotel.com

# Optional: Payment Gateway
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
```

#### 4. Database Setup
- Create PostgreSQL instance on Render
- Copy connection string to `DATABASE_URL` in environment
- Render will automatically use this for Postgres connection

#### 5. Run Database Migrations
After first deployment, run:
```bash
# Via Render Shell
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder
```

#### 6. View Deployment Status
- Render Dashboard → Web Service → Logs
- Monitor real-time logs during deployment

### Complete Render Deployment Files

The project includes automated deployment scripts:

```
scripts/
├── build.sh     → Build and optimize for production
├── start.sh     → Start the application server
└── postdeploy.sh → Run migrations and seeders
```

---

## 📁 Project Structure

```
vk-hotel/
├── app/
│   ├── Models/              # Eloquent models
│   │   ├── Room.php
│   │   ├── Booking.php
│   │   ├── User.php
│   │   └── Contact.php
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   │   ├── Admin/
│   │   │   ├── User/
│   │   │   ├── Auth/
│   │   │   └── API/
│   │   ├── Requests/        # Form validation
│   │   ├── Resources/       # API resources
│   │   └── Middleware/      # Custom middleware
│   └── Services/            # Business logic services
├── database/
│   ├── migrations/          # Database schema
│   ├── seeders/            # Database seeders
│   └── factories/           # Model factories
├── resources/
│   ├── views/              # Blade templates
│   │   ├── layouts/
│   │   ├── auth/
│   │   ├── admin/
│   │   ├── user/
│   │   └── components/
│   ├── css/                # Tailwind styles
│   └── js/                 # Alpine.js & JavaScript
├── routes/                 # Route definitions
│   ├── web.php            # Web routes
│   ├── api.php            # API routes
│   └── auth.php           # Auth routes
├── config/                # Configuration files
├── storage/               # File storage
├── tests/                 # PHPUnit tests
├── public/                # Public assets
└── scripts/               # Deployment scripts
```

---

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ XSS prevention with Blade escaping
- ✅ SQL injection protection via Eloquent ORM
- ✅ Password hashing with bcrypt
- ✅ Rate limiting on auth routes
- ✅ Role-based access control (RBAC)
- ✅ Secure session management
- ✅ HTTPS enforced in production
- ✅ Input validation on all endpoints
- ✅ Sanctum API token authentication

---

## 📊 API Documentation

### Authentication
```bash
POST /api/login
POST /api/logout
POST /api/register
```

### Rooms
```bash
GET    /api/rooms              # List all rooms
GET    /api/rooms/{id}         # Get room details
POST   /api/rooms              # Create room (Admin)
PUT    /api/rooms/{id}         # Update room (Admin)
DELETE /api/rooms/{id}         # Delete room (Admin)
GET    /api/rooms/search       # Advanced search
```

### Bookings
```bash
GET    /api/bookings           # List bookings
POST   /api/bookings           # Create booking
GET    /api/bookings/{id}      # Get booking details
PUT    /api/bookings/{id}      # Update booking
DELETE /api/bookings/{id}      # Cancel booking
```

### Availability
```bash
GET    /api/availability?room_id={id}&start={date}&end={date}
```

---

## 🧪 Testing

### Run Test Suite
```bash
php artisan test
```

### Run Specific Test
```bash
php artisan test tests/Feature/BookingTest.php
```

### With Coverage Report
```bash
php artisan test --coverage
```

---

## 🛠️ Development Commands

```bash
# Start development server with hot reload
npm run dev

# Build production assets
npm run build

# Laravel commands
php artisan migrate              # Run migrations
php artisan db:seed            # Run seeders
php artisan tinker             # Interactive shell
php artisan cache:clear        # Clear cache
php artisan queue:listen       # Listen for queued jobs
php artisan make:controller     # Generate controller
php artisan make:model          # Generate model
php artisan make:migration      # Generate migration
```

---

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Verify database credentials in .env
# Ensure database exists
php artisan db:create

# Check connection
php artisan tinker
DB::connection()->getPDO();
```

### Assets Not Loading
```bash
# Rebuild frontend assets
npm install
npm run build

# Clear Laravel cache
php artisan cache:clear
php artisan config:clear
```

### Permission Issues
```bash
# Fix storage directory permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Queue Issues
```bash
# Ensure jobs table exists
php artisan queue:table
php artisan migrate

# Listen to queue
php artisan queue:listen
```

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)
- [Render Deployment Guide](https://render.com/docs)

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 💬 Support

For support, email support@vkhotel.com or open an issue on GitHub.

---

**Last Updated**: April 2026  
**Version**: 1.0.0  
**Status**: Active Development
