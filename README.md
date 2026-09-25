# Hotel Booking System

A complete manual hotel booking system built with Laravel 12 and Bootstrap 5.

## Features

**Public Application (Customers)**
- Beautiful, responsive Homepage with Location Search.
- Hotel listings with filtering options.
- Detailed Hotel pages with Amenity & Gallery displays.
- Room listings per hotel.
- Manual Booking request form (no payment gateway required, pay on arrival).
- Dedicated Contact Us page.
- Travel Blog and Static Pages (Privacy Policy, About Us).

**Admin Panel (Staff/Admin)**
- **Dashboard**: High-level overview of bookings, revenue, and active hotels.
- **Hotel Management**: Full CRUD capability with image uploads and JSON amenities.
- **Room Management**: Define room types, prices, and capacities for each hotel.
- **Booking Management**: Approve, reject, or mark bookings as completed.
- **Enquiry Management**: View and respond to customer inquiries.
- **Blog CMS**: Create and publish rich-text blog posts.
- **Pages CMS**: Manage static pages dynamically.

## Installation Instructions

1. **Clone or Extract** the repository to your local server (e.g., `c:\xampp\htdocs\hotel-booking`).
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   npm run build
   ```
3. **Environment Setup**:
   Copy `.env.example` to `.env` and update your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hotel_booking
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. **Generate App Key**:
   ```bash
   php artisan key:generate
   ```
5. **Storage Link** (crucial for images):
   ```bash
   php artisan storage:link
   ```
6. **Migrate & Seed Data**:
   ```bash
   php artisan migrate:fresh --seed
   ```
   *This will create the default admin account, hotels, rooms, and pages.*

## Default Admin Credentials

- **Email**: `admin@hotelres.com`
- **Password**: `password`

## Usage Guide

1. Navigate to your local server url (e.g. `http://localhost/hotel-booking/public`).
2. As a customer, you can browse hotels, view details, and submit booking requests without registering.
3. As an admin, click "Staff Login", use the default credentials, and you will be redirected to the Admin Dashboard.
4. From the Dashboard, you can process incoming bookings, add new properties, write blog posts, and more!
