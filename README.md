# Task Manager Application

A modern Task Management Application built using Laravel 11, Blade, Bootstrap 5, and MySQL.  
The application includes authentication, task CRUD operations, AJAX-based multiple file uploads, pagination, filtering, search functionality, and responsive UI.

---

# Features

## Authentication
- User Registration
- User Login & Logout
- Middleware Protected Routes

## Task Management
- Create Task
- View Task List
- Edit Task
- Delete Task
- Task Status Management
- Due Date Management
- User-specific Tasks

## Multiple File Upload
- AJAX File Upload
- Multiple File Selection
- Image Preview
- PDF Preview
- Add More File Inputs
- Remove Preview Before Upload

## UI & UX
- Bootstrap 5 Responsive Design
- Mobile Friendly Interface
- Pagination
- Search & Filtering
- Modern Dashboard UI

## Architecture
- Service Pattern
- Form Request Validation
- Reusable Blade Components
- Clean Controller Structure

---

# Technology Stack

- Laravel 12
- PHP 8+
- Blade Template Engine
- Bootstrap 5
- MySQL
- JavaScript / AJAX

---

# Installation Steps

## 1. Clone Repository

```bash
git clone https://github.com/anupamchy/taskmanagement.git

2. Navigate to Project Folder

cd task-manager

3. Install Composer Dependencies
composer install

4. Install Node Modules
npm install

5. Copy Environment File
cp .env.example .env

6. Configure Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

7. Generate Application Key
php artisan key:generate

8. Run Database Migrations
php artisan migrate

9. Create Storage Link
php artisan storage:link

10. Start Laravel Development Server
php artisan serve