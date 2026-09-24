# WasteGuardian — Smart Waste Management Platform

WasteGuardian is a Laravel-based smart waste management web application for Nepal-focused use cases. Citizens can request waste pickup, book paid cleaning services, file complaints and track status. Admins manage users, drivers, workers, pickup requests, cleaning services and revenue. Drivers/workers get dedicated dashboards with assigned tasks and analytics charts.

Repository: `https://github.com/chhuparustam/WasteGuardian.git`

---

## Table of Contents

- [Features](#features)
- [Roles & Access](#roles--access)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Default Credentials](#default-credentials)
- [Usage Guide](#usage-guide)
- [Routes Overview](#routes-overview)
- [Dashboards & Analytics](#dashboards--analytics)
- [Payments](#payments)
- [Database](#database)
- [Assets & Storage](#assets--storage)
- [Troubleshooting](#troubleshooting)
- [Roadmap / Known Gaps](#roadmap--known-gaps)
- [License](#license)

---

## Features

**User**
- Register / login, view profile, edit profile
- Create waste pickup request with photo (`name, address, landmark, photo, message`)
- View / edit / delete own requests (delete/edit only while `pending`)
- Browse cleaning services, view details, book with date + time + notes
- View booked services, cancel booking
- File complaints, view complaints, delete pending complaints
- Personal dashboard with totals, recent activity, 7/30-day charts

**Admin (session-based, hardcoded credentials)**
- Dashboard with counts: users, drivers, requests, complaints
- Revenue analytics: monthly revenue, total earnings, today’s requests/users/complaints/bookings
- Manage users (list/edit/update/delete)
- Manage drivers (create/list/edit/update/delete)
- Manage workers (list)
- Manage pickup requests: list, search/filter, view, assign driver, approve, delete
- Manage cleaning services (resource CRUD)
- Chart APIs for requests + revenue + status breakdown

**Driver (stored as `users.type = driver`, Auth-based)**
- Login with email + password
- Dashboard: assigned routes, pending pickups, completed pickups
- 7/30-day completed-pickups chart

**Worker (separate `workers` table, session-based)**
- Register / login, edit profile
- Dashboard: assigned tasks, pending tasks, completed tasks
- 7/30/365-day completed-tasks chart

**Cross-cutting**
- Activity log (`activities` table) for request/service/complaint/payment events
- Photo uploads via `public` disk (`storage/app/public/photos`)
- Email notification via `Mail::raw()` after successful Stripe/Khalti payment

---

## Roles & Access

| Role | Auth mechanism | Login route | Dashboard |
|---|---|---|---|
| User | Laravel `Auth` (`users`) | `GET /login`, `GET /register` | `GET /user/dashboard` |
| Admin | Session flag `admin_logged_in` (hardcoded check) | `GET /admin-login` | `GET /admin/dashboard` |
| Driver | Laravel `Auth` + `users.type=driver` + session flags | `GET /driver/login` | `GET /driver/dashboard` |
| Worker | Session flags `worker_logged_in`, `worker_id` (`workers` table) | `GET /worker/login`, `GET /worker/register` | `GET /worker/dashboard` |

> Auth is a mix of Laravel Auth and raw session flags. There is no role middleware — controllers check `Auth::id()` / session manually on each method.

---

## Tech Stack

- **Backend:** PHP `^8.1`, Laravel Framework `^8.0` (`composer.json`)
- **Auth:** Laravel Auth + Session (`laravel/sanctum ^2.15` installed, not heavily used)
- **Frontend:** Blade templates, custom CSS (`public/css/*`), Bootstrap + Material Icons / FontAwesome in views, Chart.js-style JSON chart endpoints
- **Build:** Laravel Mix `^5.0.1`, Webpack (`npm run dev/prod/watch`)
- **DB:** MySQL / MariaDB (default `DB_CONNECTION=mysql`)
- **Payments:** Stripe (`stripe/stripe-php ^17.4`) + Khalti ePayment v2 (`dev.khalti.com/api/v2/epayment/initiate/`)
- **HTTP client:** Guzzle `^7.0`
- **Testing:** PHPUnit `^9.3`

---

## Project Structure

```
app/
  Http/Controllers/
    UserAuthController.php          # user register/login/profile
    PickupRequestController.php     # pickup CRUD (user side)
    UserDashboardController.php     # user dashboard + chartData
    ComplaintController.php         # complaints
    User/ServiceController.php      # cleaning service browse/book
    StripeController.php            # /checkout/{id}, /charge
    KhaltiController.php            # /khalti-init, /khalti-check
    WorkerAuthController.php        # worker register/login/profile
    Worker/WorkerDashboardController.php # worker dashboard + chartData
    Driver/LoginController.php      # driver login + dashboard + chartData
    Admin/
      AdminLoginController.php      # hardcoded admin login + dashboard + chartData
      AdminRequestController.php    # admin request list/show/assign/approve/delete
      UserController.php            # admin user CRUD
      DriverController.php          # admin driver CRUD
      WorkerController.php          # admin worker list
      CleaningServiceController.php # cleaning service resource + landing indexFront
  Models/
    User.php, Worker.php
    PickupRequest.php (-> `requests` table)
    CleaningService.php, ServiceBooking.php
    Complaint.php, Activity.php
  Support/
    DashboardStats.php              # shared chart/stat helper
routes/web.php                      # all web routes (see below)
resources/views/
  index.blade.php                   # landing page
  auth/ (login, register, select-login/register, admin-login)
  user/ (dashboard, my-requests, edit-request, profile, services/*, complaints/*)
  admin/ (dashboard, users/*, drivers/*, workers/*, requests/*, cleaning_services/*)
  driver/ (login, dashboard)
  worker/ (login, register, dashboard, edit-profile)
  stripe/checkout.blade.php
database/migrations/                # users, drivers, workers, requests, complaints,
                                    # cleaning_services, service_bookings, activities, ...
public/css/ (manage-requests.css, user-dashboard.css, worker-dashboard.css, ...)
public/images/services/
config/services.php                 # stripe key/secret via env
```

Key helper — `app/Support/DashboardStats.php`:
- `normalizeStatus()`, `days($days)`, `dailyCounts($query, $statuses, $days)`
- `revenueByDay($days)` (sums `service_bookings.amount` where `payment_status=paid`)
- `countByStatus($query)` (Pending / In Progress / Assigned / Approved / Completed / Cancelled / Other)

---

## Requirements

- PHP 8.1+, Composer
- Node.js + npm (for Mix)
- MySQL / MariaDB
- Stripe account (for card payments) + Khalti merchant key (for Khalti)

---

## Installation

```bash
git clone https://github.com/chhuparustam/WasteGuardian.git
cd WasteGuardian

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Edit `.env` — DB, mail, app URL, Stripe:

```env
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wasteguardian
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

Then:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
# visit http://localhost:8000

# frontend (separate terminal, optional for dev)
npm run dev
# or
npm run watch
# production
npm run prod
```

---

## Configuration

- **Database:** standard Laravel `.env` (`DB_*`). Default DB name in example is `laravel` — change to your own.
- **Mail:** `MAIL_*` in `.env`. Payment success sends `Mail::raw()`; use Mailtrap for local testing.
- **Stripe:** `config/services.php` reads `STRIPE_KEY` / `STRIPE_SECRET`. Set both in `.env`.
- **Khalti:** currently hardcoded in `KhaltiController@init` (`dev.khalti.com`, test key, `return_url=http://rustam.test/khalti-check`). Update to env-based values before production.
- **Storage:** uploads go to `photos` on the `public` disk. Must run `php artisan storage:link` or photos will 404.
- **Admin login:** hardcoded in `AdminLoginController` — see below. No `.env` toggle.

---

## Default Credentials

Admin login is hardcoded (not from DB):

```
Email:    admin@wasteguardian.com
Password: admin123
Route:    GET /admin-login
```

Drivers/workers/users have no default seed — create via:
- User: `GET /register`
- Worker: `GET /worker/register`
- Driver: admin creates via `GET /admin/drivers/create`

---

## Usage Guide

**Landing:** `GET /` shows cleaning services front list (`CleaningServiceController@indexFront`).

**As User:**
1. `GET /register` → register, then `GET /login`
2. `GET /user/dashboard` → submit pickup request (photo required, jpg/jpeg/png ≤2MB)
3. `GET /user/my-requests` → edit/delete while pending
4. `GET /user/services` → view service → `POST /user/services/{service}/book` with `booking_date`, `booking_time`, `special_notes`
5. `GET /user/booked-services` → pay via Stripe (`GET /checkout/{bookingId}`) or Khalti
6. `GET /user/complaints/create` → file complaint → track at `GET /user/complaints`

**As Admin:**
1. `GET /admin-login` → dashboard
2. `GET /admin/requests` → `GET /admin/requests/{request}` → assign driver (`POST .../assign`) / approve (`POST .../approve`) / delete (`DELETE ...`)
3. `GET /admin/users`, `GET /admin/drivers`, `GET /admin/workers`
4. `GET /admin/cleaning-services` (resource) → CRUD services shown on landing + user booking

**As Driver:**
1. `GET /driver/login` → `GET /driver/dashboard` (assigned/pending/completed counts + chart)

**As Worker:**
1. `GET /worker/register` → `GET /worker/login` → `GET /worker/dashboard` → `GET /worker/edit/profile`

---

## Routes Overview

Auth & landing:
```
GET  /                                   -> CleaningServiceController@indexFront (home)
GET  /login, POST /login-submit          -> UserAuthController
GET  /register, POST /register
GET  /user-logout
GET  /select-login, /select-register
GET  /dashboard                          -> auth.dashboard view
```

User:
```
GET  /user/dashboard (+ /chart-data)     -> UserDashboardController@index/chartData
GET  /user/my-requests, /my-requests-delete/{id}, /my-requests-edit/{id}, POST /my-requests-update/{id}
POST /pickup-request                     -> PickupRequestController@store
GET  /user/services, /services/{service} -> ServiceController@index/show
POST /user/services/{service}/book       -> ServiceController@store
GET  /user/booked-services, /booked-services-cancel/{id}
GET  /user/complaints, /complaints/create, POST /complaints, GET /complaints/{id} (delete)
GET  /user/profile, /edit-profile, PUT /update-profile
```

Admin:
```
GET  /admin-login, POST /admin-login     -> AdminLoginController
GET  /admin/dashboard (+ /dashboard/chart-data)
GET  /admin/users, /users/{id}/edit, PUT /users/{id}, DELETE /users/{id}
GET  /admin/drivers, /drivers/create, POST /drivers, /drivers/{id}/edit, PUT, DELETE
GET  /admin/workers
GET  /admin/requests, GET /requests/{request}, POST /{request}/assign, POST /{request}/approve, DELETE /{request}
RESOURCE /admin/cleaning-services + /admin/admin/cleaning-services
```

Worker / Driver:
```
GET  /worker/register, POST /worker/register
GET  /worker/login, POST /worker/login
GET  /worker/dashboard (+ /chart-data)   -> WorkerDashboardController
GET  /worker/edit/profile, POST /worker/edit/profile
GET  /driver/login, POST /driver/login
GET  /driver/dashboard (+ /chart-data)   -> Driver\LoginController
```

Payments:
```
GET  /checkout/{id}, POST /charge        -> StripeController
POST /khalti-init, GET /khalti-check     -> KhaltiController
```

> `routes/web.php` contains some duplicate `user/services` groups and overlapping `admin/cleaning-services` resources — cleanup recommended but functional.

---

## Dashboards & Analytics

All four dashboards expose JSON chart endpoints:

```
GET /admin/dashboard/chart-data?period=week|month
GET /user/dashboard/chart-data?period=week|month
GET /driver/dashboard/chart-data?period=week|month
GET /worker/dashboard/chart-data?period=week|month|year
```

- `week` = last 7 days, `month` = last 30 days, worker `year` = 365 days
- Admin returns `labels`, `datasets[New Requests, Completed, Revenue]`, `statusBreakdown`
- User returns `labels`, `datasets[Total Requests, Completed]`
- Driver/Worker return completed pickups/tasks per day
- Shared logic in `App\Support\DashboardStats` normalizes statuses (`complete/completed/done`, `cancel/cancelled`, `inprogress/in progress`, etc.)

---

## Payments

**Stripe** (`StripeController`):
1. `GET /checkout/{bookingId}` stores `payment_service_id` in session, shows `stripe/checkout.blade.php`
2. `POST /charge` with `service_id`, `amount`, `stripeToken` → `Charge::create()` → updates `service_bookings` to `payment_status=Paid`, `status=Approved`, random `ref_id` → creates `Activity` → sends mail → redirects to `user.services.booked`

**Khalti** (`KhaltiController`):
1. `POST /khalti-init` calls Khalti ePayment initiate (currently hardcoded amount/order/customer — replace with real booking data)
2. `GET /khalti-check` checks `status=Completed` → marks booking `Paid/Approved` → mail → redirect; else redirects to `payment.failed` (route currently missing — needs defining)

> Note: old docs mention eSewa — current code implements Stripe + Khalti. eSewa flow is not present.

---

## Database

Main tables (via `database/migrations/`):

| Table | Purpose | Key fields |
|---|---|---|
| `users` | users + drivers (`type=driver`) | `name, email, password, phone (string), type, address` |
| `drivers` | legacy driver table | `name, email, password, ...` |
| `workers` | worker accounts | `name, email, password, phone, address, ...` |
| `requests` | pickup requests (model `PickupRequest`) | `user_id, driver_id, name, address, landmark, photo, message, status` |
| `cleaning_services` | bookable services | `title, description, price, image, ...` |
| `service_bookings` | bookings + payments | `user_id, cleaning_service_id, details, amount, payment/payment_status, status, ref_id, booking_date, booking_time` |
| `complaints` | user complaints | `user_id, subject, description, status` |
| `activities` | activity feed | `user_id, type, description` |
| `password_resets`, `failed_jobs` | framework | — |

Request statuses observed: `pending, assigned, approved, in progress/inprogress, complete/completed/done, cancel/cancelled`. Charts normalize these — keep them consistent when adding new flows.

---

## Assets & Storage

- Custom CSS: `public/css/manage-requests.css`, `user-dashboard.css`, `worker-dashboard.css`
- Service images: `public/images/services/`
- Uploads: `storage/app/public/photos` → served via `public/storage` (requires `storage:link`)
- Mix output: `public/js/app.js`, `public/css/app.css`, `public/mix-manifest.json` (compiled — don’t hand-edit)

---

## Troubleshooting

- **Photos 404:** run `php artisan storage:link`, check `APP_URL`, ensure `photo` stores `photos/xxx.jpg` on `public` disk.
- **Stripe error:** verify `STRIPE_KEY`/`STRIPE_SECRET` in `.env` + `config/services.php`, clear config cache.
- **Khalti redirect fails:** `return_url` is hardcoded to `http://rustam.test/khalti-check` — update to your `APP_URL/khalti-check`; missing `payment.failed` route will throw on failed payments.
- **Admin login fails:** uses hardcoded `admin@wasteguardian.com / admin123`, not DB. Check session driver.
- **Driver dashboard empty:** driver tasks match `requests.driver_id = Auth::id()` (`users.id`). Ensure admin assigned correct driver id.
- **Worker chart empty:** matches `requests.driver_id = session(worker_id)` — workers share driver assignment column.
- **Migration errors:** check `DB_*` in `.env`, create DB first, then `php artisan migrate`.
- **Mix build fails:** `npm install` then `npm run dev`; Node version must support Mix 5 / Webpack 4-5 chain.

---

## Roadmap / Known Gaps

- Move admin credentials + Khalti keys to `.env` / config (no hardcoding)
- Add auth middleware per role (replace manual session checks)
- Define missing `payment.failed` route
- De-duplicate `user/services` routes and overlapping `admin/cleaning-services` resources
- Separate `worker_id` column on `requests` (currently reuses `driver_id` for workers)
- Add seeders + PHPUnit coverage (`php artisan migrate --seed` currently has no seeds)

---

## License

MIT — free for educational / commercial use. See `composer.json` (`laravel/laravel` base).

Developed by [chhuparustam.com.np](https://chhuparustam.com.np) — contributions welcome via PR to `main`.
