# Library Management System

## Introduction
The **Library Management System** is a web-based application built with Laravel that helps manage book records, user accounts, borrowing transactions, and return processes efficiently. It is designed for administrators, teachers, and students to manage library operations smoothly.

## Features
Here are the main features of this Library Management System:
1. The system supports three types of users: Admin, Teacher, and Student.
2. Students can create accounts, but their accounts remain pending until approved by an Admin.
3. Upon approval, students can request to borrow books.
4. Teachers have the same privileges as students.
5. Admins can approve or reject account creation requests from students and teachers, as well as manage book borrowing requests.
6. Admin can assign books manually to a user.
7. Admins can upload and update book information.
8.	Admins can edit user information, with the exception of passwords.
10.	Admins can manage and update other necessary system settings.

## Technologies Used
- **Frontend**: HTML, CSS, Bootstrap 5, and JavaScript
- **Backend**: Laravel 11
- **Database**: MySQL

## Screenshots of the Project

### Registration & Login Form

<p align="center">
   <img src="screenshots/student registration.PNG" width="800" alt="Student Registration">
</p>

<p align="center">
   <img src="screenshots/teacher registration.PNG" width="800" alt="teacher Registration">
</p>

<p align="center">
   <img src="screenshots/login page.PNG" width="800" alt="login">
</p>


### User Views
<p align="center"><b>Home Page</b></p>
<p align="center">   
   <img src="screenshots/home page.PNG" width="800" alt="home">
</p>

<p align="center"><b>Book Details Page</b></p>
<p align="center">
   <img src="screenshots/book details page.PNG" width="800" alt="book details">
</p>

<p align="center"><b>Search Results Page</b></p>
<p align="center">
   <img src="screenshots/search results page.PNG" width="800" alt="search results page">
</p>

<p align="center"><b>My Profile</b></p>
<p align="center">
   <img src="screenshots/my profile page.PNG" width="800" alt="my profile">
</p>

<p align="center"><b>My Requested Book List</b></p>
<p align="center">
   <img src="screenshots/my requested book list.PNG" width="800" alt="my requested book list">
</p>

<p align="center"><b>My Borrowed Book List</b></p>
<p align="center">
   <img src="screenshots/my borrowed book list.PNG" width="800" alt="my borrowed book list">
</p>

<p align="center"><b>My Returned Book List</b></p>
<p align="center">
   <img src="screenshots/my returned book list.PNG" width="800" alt="my returned book list">
</p>

### Admin Panel
<p align="center"><b>Dashboard</b></p>
<p align="center">
   <img src="screenshots/dashboard.PNG" width="800" alt="dashboard">
</p>

<p align="center"><b>Request List</b></p>
<p align="center">
   <img src="screenshots/request list.PNG" width="800" alt="request list">
</p>

<p align="center"><b>Assign Book Manually</b></p>
<p align="center">
   <img src="screenshots/assign book manually.PNG" width="800" alt="assign book manually">
</p>

<p align="center"><b>Issued Book List</b></p>
<p align="center">
   <img src="screenshots/issued book list.PNG" width="800" alt="issued book list">
</p>

<p align="center"><b>Returned List</b></p>
<p align="center">
   <img src="screenshots/returned list.PNG" width="800" alt="returned list">
</p>

<p align="center"><b>Add Book</b></p>
<p align="center">
   <img src="screenshots/add book.PNG" width="800" alt="add book">
</p>

<p align="center"><b>Book List</b></p>
<p align="center">
   <img src="screenshots/book list.PNG" width="800" alt="book list">
</p>

<p align="center"><b>Pending Members</b></p>
<p align="center">
   <img src="screenshots/pending members.PNG" width="800" alt="pending members">
</p>

<p align="center"><b>Member List</b></p>
<p align="center">
   <img src="screenshots/member list.PNG" width="800" alt="member list">
</p>

## Installation
### Requirements
Ensure your server meets the following requirements:
- PHP 8.0+
- MySQL 5.7+
- Composer
- Laravel 9+
- Apache/Nginx

### Setup Instructions
1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-repo/library-management.git
   cd library-management
   ```

2. **Install dependencies:**
   ```sh
   composer install
   npm install
   npm run dev
   ```

3. **Configure environment variables:**
   Copy the `.env.example` file to `.env` and update database credentials:
   ```sh
   cp .env.example .env
   ```
   Edit the `.env` file:
   ```env
   APP_URL=http://your-subdomain.example.com
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

5. **Run database migrations and seed data:**
   ```sh
   php artisan migrate --seed
   ```

6. **Setup Storage Symlink:**
   ```sh
   php artisan storage:link
   ```

7. **Start the Laravel development server:**
   ```sh
   php artisan serve
   ```

## Usage
- **Admin Dashboard**: `your-subdomain.example.com/admin`
- **User Login**: `your-subdomain.example.com/login`
