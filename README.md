# Laravel Task Management System

A Task Management System built with **Laravel**, **TailwindCSS**, and **MySQL**.  
This project allows users to manage tasks, track progress, upload documents, and collaborate efficiently.

## 🚀 Features
- User Authentication (Login/Register)
- Task CRUD (Create, Read, Update, Delete)
- Task Priority & Status (Pending, Completed)
- File Uploads for Task Documents
- Dashboard with Stats (Total Tasks, Completed, Pending, Users)
- Responsive UI with TailwindCSS
- AJAX-powered operations for smooth experience

## 🛠️ Tech Stack
- **Framework**: Laravel 10
- **Frontend**: TailwindCSS, AlpineJS
- **Database**: MySQL
- **Other**: jQuery, DataTables

## 📦 Installation
1. Clone the repo
   ```bash
   git clone https://github.com/USERNAME/task-management-system.git
Install dependencies

bash
Copy code
composer install
npm install && npm run dev
Setup environment

bash
Copy code
cp .env.example .env
php artisan key:generate
Configure .env with your DB details

Run migrations

bash
Copy code
php artisan migrate
Start server

bash
Copy code
php artisan serve
