# WasteGuardian

WasteGuardian is a smart waste management web application built with Laravel. It provides a platform for users to request waste pickup and cleaning services, for admins to manage requests and assign drivers, and for drivers to view and update their assigned tasks. The system also supports service bookings (like office cleaning) with online payment integration (eSewa).

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Structure](#database-structure)
- [Usage](#usage)
  - [User Flow](#user-flow)
  - [Admin Flow](#admin-flow)
  - [Driver Flow](#driver-flow)
  - [Service Booking](#service-booking)
- [Payment Integration](#payment-integration)
- [Customization](#customization)
- [Assets & Styling](#assets--styling)
- [Troubleshooting](#troubleshooting)
- [License](#license)

---

## Features

- **User Dashboard:**  
  - Request waste pickup and cleaning services
  - View request status and assigned driver
  - Book special cleaning services (e.g., office cleaning)
  - Pay for services via eSewa

- **Admin Dashboard:**  
  - Manage users, drivers, workers, and requests
  - Assign requests to drivers
  - View complaints and payments
  - Search and filter requests

- **Driver Dashboard:**  
  - View assigned requests
  - Update request status (Assigned, In Progress, Completed)

- **Service Booking:**  
  - Browse and book cleaning services
  - View service details and pricing
  - Secure payment via eSewa

---

## Tech Stack

- **Backend:** Laravel 10+
- **Frontend:** Blade, CSS (custom, Bootstrap, Material Icons)
- **Database:** MySQL/MariaDB
- **Payment:** eSewa (Nepal)
- **Other:** FontAwesome, jQuery (for some UI), Bootstrap components

---

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/wasteguardian.git
    cd wasteguardian
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Copy and configure environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    - Set your database credentials and mail settings in `.env`.

4. **Run migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

5. **Link storage for uploaded files:**
    ```bash
    php artisan storage:link
    ```

6. **Start the development server:**
    ```bash
    php artisan serve
    ```
    - Visit [http://localhost:8000](http://localhost:8000)

---

## Configuration

- **Database:**  
  Configure your `.env` file with your DB credentials.

- **Mail:**  
  Set up mail settings in `.env` for notifications.

- **eSewa:**  
  Add your eSewa merchant credentials in `.env` or `config/services.php`.

---

## Database Structure

Key tables:

- `users` — Registered users
- `drivers` — Driver accounts
- `requests` — Pickup/cleaning requests (`driver_id`, `status`, `photo`, etc.)
- `services` — Cleaning services (optional, if using DB for services)
- `bookings` — Service bookings (user, service, payment status, etc.)

---

## Usage

### User Flow

1. Register/login as a user.
2. Request waste pickup or cleaning.
3. View request status and assigned driver.
4. Book special cleaning services (e.g., Office Cleaning).
5. Pay for services via eSewa.

### Admin Flow

1. Login as admin.
2. Manage users, drivers, workers, and requests.
3. Assign requests to drivers.
4. View and resolve complaints.
5. Track payments.

### Driver Flow

1. Login as driver.
2. View assigned requests.
3. Update status (Assigned, In Progress, Completed).

### Service Booking

1. Browse services in the "Best Offers" section.
2. Click "Book" to view service details.
3. Login if required.
4. See price and proceed to book.
5. Pay via eSewa.

---

## Payment Integration

- **eSewa** is integrated for online payments.
- After booking a service, users are redirected to eSewa for payment.
- Payment status is updated upon return from eSewa.

---

## Customization

- **Styling:**  
  Edit `public/css/modern-dashboard.css` and `public/css/manage-requests.css` for UI changes.
- **Services:**  
  Add or edit services in the controller or database as needed.
- **Icons:**  
  Uses Material Icons and FontAwesome.

---

## Assets & Styling

- Images are stored in `public/images/services/`.
- Uploaded photos are stored in `storage/app/public` and accessed via `public/storage`.
- Use `php artisan storage:link` after deployment.

---

## Troubleshooting

- **Photo not showing:**  
  Ensure you have run `php artisan storage:link` and the `photo` field stores the correct relative path.
- **Route not found:**  
  Check your `routes/web.php` for missing or misnamed routes.
- **Migration errors:**  
  Ensure your database is set up and credentials are correct.

---

## License

This project is open-source and available under the MIT License.

---

**Developed by chhuparustam.com.np**
