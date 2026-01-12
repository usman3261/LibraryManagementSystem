# 📚 Library Management System (LMS)

A robust web application built with Laravel 10/11 designed to streamline library operations, including book inventory management, student registration, and automated borrowing requests with email notifications.

## 🚀 Features

* **Role-Based Access Control (RBAC):** Distinct interfaces and permissions for Librarians and Students.
* **Book Inventory:** Full CRUD (Create, Read, Update, Delete) for books, including image uploads.
* **Borrowing System:** Manual book issuance by Librarians and digital book requests by Students.
* **Email Notifications:** Integrated with Gmail SMTP to notify Librarians of new book requests.
* **Student History:** Students can track their personal borrowing history and due dates.
* **Secure Authentication:** Password hashing using BCRYPT and protected routes.

---

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Blade Templates, Bootstrap 5 (Local Assets)
* **Database:** MySQL
* **Mailing:** SMTP (Gmail)

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
```bash
git clone https://github.com/yourusername/lms-laravel.git
cd lms-laravel

```


2. **Install dependencies:**
```bash
composer install

```


3. **Configure environment variables:**
* Duplicate `.env.example` to `.env`.
* Set your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
* Set your Gmail SMTP credentials for notifications.


4. **Generate App Key & Migrate:**
```bash
php artisan key:generate
php artisan migrate

```


5. **Run the application:**
```bash
php artisan serve

```



---

## 📂 Project Structure (MVC)

* **Controllers:** Located in app/Http/Controllers/. Handles the core application logic.
* **Models:** Located in app/Models/. Defines database tables and Eloquent relationships.
* **Views:** Located in resources/views/. Contains Blade templates and Bootstrap styling.
* **Routes:** Defined in routes/web.php.

---

## 🔒 Security Implementation

* **Middleware:** Ensures only authenticated users can access the dashboard.
* **Controller Guards:** Server-side role verification to prevent students from accessing Librarian URLs.
* **Data Integrity:** Foreign key constraints between users, books, and borrowing records.

---
