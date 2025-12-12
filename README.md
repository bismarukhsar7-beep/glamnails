# GlamNails - Beauty & Nail Care E-Commerce Platform

![GlamNails Logo](https://img.shields.io/badge/GlamNails-Beauty%20Store-blue?style=for-the-badge&logo=laravel)

A comprehensive e-commerce platform built with Laravel for beauty and nail care products. This project showcases full-stack development with modern web technologies, featuring complete CRUD operations, AJAX integration, RESTful APIs, and a polished user interface.

## 🌟 Project Overview

GlamNails is a feature-rich e-commerce application designed for beauty and nail care products. The platform provides a seamless shopping experience with advanced search capabilities, category browsing, shopping cart functionality, and comprehensive order management. Built with Laravel and modern web technologies, it demonstrates best practices in full-stack development.

### ✨ Key Features

- **🛍️ Product Catalog**: Complete product management with categories, images, and detailed descriptions
- **🔍 Advanced Search**: AJAX-powered real-time search with instant results
- **🛒 Shopping Cart**: Full cart functionality with add, update, remove, and clear operations
- **📦 Order Management**: Complete order processing from placement to delivery tracking
- **⭐ Customer Reviews**: Product rating and review system
- **👨‍💼 Admin Dashboard**: Comprehensive admin panel for content management
- **📱 Responsive Design**: Mobile-friendly interface with Bootstrap 5
- **🔗 RESTful APIs**: Complete API endpoints for all modules
- **🔐 Admin Authentication**: Secure admin login system

## 🚀 Technology Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Database**: SQLite (development), MySQL/PostgreSQL (production)
- **Frontend**: Blade Templates, Bootstrap 5, Vanilla JavaScript
- **AJAX**: Fetch API for dynamic content loading
- **Styling**: Custom CSS with Bootstrap components
- **Image Handling**: Laravel Storage with public disk
- **Authentication**: Session-based admin authentication

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM (for asset compilation)
- SQLite/MySQL/PostgreSQL database

## 🛠️ Installation & Setup

### 1. Clone the Repository

```bash
git clone <your-repository-url>
cd SoftwareProject
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database settings in `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

### 5. Database Setup

```bash
# Create database file (for SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 6. Storage Link Setup

```bash
php artisan storage:link
```

### 7. Build Assets

```bash
npm run build
# or for development
npm run dev
```

### 8. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📖 Usage Guide

### Customer Features

#### 🏠 Home Page
- Browse featured categories and products
- Access main navigation and search functionality

#### 🔍 Product Search
- Use the search bar in the navigation for real-time AJAX search
- Filter by category or search by product name
- Instant dropdown results with product images and prices

#### 📄 Product Pages
- View detailed product information
- Add products to cart
- Submit customer reviews and ratings

#### 🛒 Shopping Cart
- Add, update, and remove cart items
- View cart total and item quantities
- Proceed to checkout

#### 📝 Checkout Process
- Complete order form with customer details
- Review order summary
- Receive order confirmation

#### 📞 Contact
- Submit contact messages through the contact form

### Admin Features

#### 🔐 Admin Login
Navigate to `/admin/login` and use default credentials:
- **Username**: admin@glamnails.com
- **Password**: password

#### 📊 Admin Dashboard
- Overview of all management sections
- Quick access to products, categories, orders, reviews, and messages

#### 📦 Product Management
- Create, read, update, delete products
- Upload product images
- Assign categories to products

#### 📂 Category Management
- Manage product categories
- Upload category images
- View products within categories

#### 📋 Order Management
- View all customer orders
- Update order status (pending, processing, shipped, completed, cancelled)
- View detailed order information with items

#### ⭐ Review Management
- Monitor customer reviews
- View review details with product information
- Delete inappropriate reviews

#### 💬 Message Management
- View contact form submissions
- Mark messages as read
- Delete processed messages

## 🔌 API Documentation

The application provides comprehensive RESTful APIs for all modules:

### Products API

```http
GET    /api/products              # Get all products with filtering
GET    /api/products/{id}         # Get specific product
GET    /api/products/search/{q}   # Search products
GET    /api/products/category/{c} # Get products by category
```

### Categories API

```http
GET    /api/categories            # Get all categories
GET    /api/categories/{id}       # Get specific category
GET    /api/categories/{id}/products # Get category products
```

### Orders API (Protected)

```http
GET    /api/orders                # Get all orders
GET    /api/orders/{id}           # Get specific order
POST   /api/orders                # Create new order
PUT    /api/orders/{id}           # Update order
DELETE /api/orders/{id}           # Delete order
```

### Reviews API

```http
GET    /api/reviews               # Get all reviews
GET    /api/reviews/{id}          # Get specific review
POST   /api/reviews               # Create new review
PUT    /api/reviews/{id}          # Update review
DELETE /api/reviews/{id}          # Delete review
GET    /api/reviews/product/{id}  # Get reviews for product
```

### API Response Format

All API endpoints return JSON responses:

```json
{
  "success": true,
  "data": { ... },
  "message": "Operation completed successfully"
}
```

## 🗄️ Database Schema

### Core Tables

- **users**: User authentication (Laravel default)
- **admins**: Admin user management
- **categories**: Product categories
- **products**: Product catalog
- **reviews**: Customer reviews and ratings
- **orders**: Customer orders
- **order_items**: Order line items
- **contact_messages**: Customer contact form submissions

### Relationships

- Products belong to Categories (many-to-one)
- Reviews belong to Products (many-to-one)
- Orders have many OrderItems (one-to-many)
- OrderItems belong to Products (many-to-one)

## 🎨 Frontend Standards

### Design Principles

- **Clean & Modern**: Professional beauty industry aesthetic
- **Responsive**: Mobile-first design with Bootstrap 5
- **Accessible**: Proper semantic HTML and ARIA attributes
- **Performance**: Optimized images and efficient loading

### Color Scheme

- Primary: `#c63e70` (Rose Pink)
- Secondary: `#dc769a` (Light Pink)
- Background: `#f0d3cf` (Light Pink Tint)
- Text: `#333333` (Dark Gray)

### Key Components

- Navigation with AJAX search
- Product cards with hover effects
- Bootstrap modals and forms
- Responsive image galleries
- Status badges and alerts
- **Customer Review Photos**: Image upload in product reviews

### 📸 Image Upload System

#### Features

- **Client-side Validation**: Real-time validation before upload
- **Image Preview**: Instant preview before form submission
- **File Type Validation**: Supports JPEG, PNG, GIF, and WebP formats
- **Size Limits**: Maximum 5MB per image file
- **Server-side Security**: Laravel validation with proper sanitization

#### Supported Formats

- **JPEG/JPG**: `image/jpeg`, `image/jpg`
- **PNG**: `image/png`
- **GIF**: `image/gif`
- **WebP**: `image/webp`

#### Upload Locations

- **Products**: `/storage/uploads/` directory
- **Categories**: `/storage/uploads/` directory
- **Public Access**: Via Laravel's `storage:link` symbolic link

#### JavaScript Preview Function

```javascript
function previewImage(input, previewId) {
    // Validates file type and size
    // Shows instant image preview
    // Handles validation errors with user feedback
}
```

#### Usage in Admin Panel

1. **Product Management**:
   - Create/Edit products with image upload
   - Preview images before saving
   - Automatic validation and error handling

2. **Category Management**:
   - Upload category images (optional)
   - Consistent validation across all forms
   - Image preview functionality

3. **Customer Reviews**:
   - Upload photos with reviews
   - Real-time image preview and validation
   - Click-to-zoom image viewing
   - Admin dashboard management of review images

### 📝 Customer Review System

#### Features

- **📷 Photo Upload**: Customers can upload images with their reviews
- **🔍 Image Preview**: Live preview before form submission
- **📱 Responsive Display**: Images displayed in reviews with click-to-zoom modal
- **✅ Validation**: File type and size validation (JPEG, PNG, GIF, WebP, max 5MB)
- **👨‍💼 Admin Oversight**: Admins can view and manage all review images
- **🌐 API Integration**: REST API supports image uploads in reviews

#### Usage

1. **Customer Experience**:
   - Visit any product page
   - Scroll to the review section
   - Fill out the review form
   - Optionally upload photos with the review
   - See live preview before submitting

2. **Admin Management**:
   - Access `/admin/reviews` to view all reviews
   - See thumbnail images in the reviews table
   - Click "View" to see full review details with images
   - Delete reviews with inappropriate images

#### Technical Implementation

```php
// Review form with image upload
<form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
    <!-- Review fields -->
    <input type="file" name="image" accept="image/*" onchange="previewReviewImage(this)">
</form>
```

## 🔧 Code Quality

### Standards Followed

- **PSR-4**: Autoloading standard
- **PSR-12**: Extended coding style guide
- **SOLID Principles**: Object-oriented design
- **DRY Principle**: No code duplication
- **MVC Pattern**: Clear separation of concerns

### Best Practices

- Comprehensive input validation
- SQL injection prevention with Eloquent ORM
- XSS protection with Blade templating
- CSRF protection on forms
- Proper error handling and logging

### Code Comments

All controllers, models, and complex logic include detailed PHPdoc comments explaining functionality, parameters, and return values.

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 📦 Deployment

### Production Setup

1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Run migrations: `php artisan migrate --force`
4. Optimize application: `php artisan optimize`
5. Build production assets: `npm run build`

### Environment Variables

```env
APP_NAME=GlamNails
APP_ENV=production
APP_KEY=your-app-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=glamnails
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit changes: `git commit -am 'Add feature'`
4. Push to branch: `git push origin feature-name`
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation for common solutions

## 🙏 Acknowledgments

- Laravel Framework for the robust backend foundation
- Bootstrap 5 for responsive UI components
- Font Awesome for icons
- All contributors and the open-source community

---

**Built with ❤️ using Laravel & Modern Web Technologies**
