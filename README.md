# Society Management System

A comprehensive PHP-based web application for managing residential society operations, including member management, notices, complaints, payments, and photo galleries.

## Features

### User Features
- User registration and login
- View notices and announcements
- Submit complaints
- Make payments
- View photo gallery
- View payment history

### Admin Features
- Admin login
- Manage society members
- Add/view notices
- View complaints
- View payment records
- Manage photo gallery

## System Requirements

- Web server (Apache recommended)
- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web browser with JavaScript support

## Installation

1. Clone or download the repository to your web server directory (e.g., htdocs)
2. Create a MySQL database named `society_management`
3. Import the database schema (if available)
4. Configure database connection in `db.php`:
   ```php
   $host = "localhost";
   $user = "root"; 
   $pass = "";
   $dbname = "society_management";
   $port = 3307; // Change if using different port
   ```
5. Access the application through your web browser

## File Structure

```
society/
├── add_notice.php          - Admin page to add new notices
├── admin_home.php          - Admin dashboard
├── admin_login.php         - Admin login page
├── db.php                  - Database connection configuration
├── index.php               - Homepage with society information
├── logout.php              - Logout functionality
├── make_payment.php        - Payment processing page
├── manage_members.php      - Admin member management
├── photo_gallery.php       - Photo gallery management
├── register.php            - User registration page
├── submit_complaint.php    - Complaint submission form
├── user_home.php           - User dashboard
├── user_login.php          - User login page
├── view_complaint.php      - View complaints
├── view_gallery.php        - View photo gallery
├── view_notices.php        - View society notices
├── view_payments.php       - View payment records
├── css/                    - CSS stylesheets
│   ├── admin.css           - Admin interface styles
│   ├── img.css             - Image gallery styles
│   ├── notice.css          - Notice display styles
│   ├── payment.css         - Payment interface styles
│   ├── photo.css           - Photo gallery styles
│   └── user.css            - User interface styles
├── database/               - Database files
│   ├── database            - Database export (if available)
│   └── k                   - Additional database files
├── images/                 - Society images and assets
└── uploads/                - User-uploaded files
```

## Usage

1. **For Residents**:
   - Register as a new user
   - Login to access member features
   - View notices, submit complaints, make payments
   - Browse photo gallery

2. **For Administrators**:
   - Login using admin credentials
   - Manage society members
   - Post new notices
   - View and respond to complaints
   - Monitor payments
   - Manage photo gallery

## Screenshots

![Homepage](images/society-banner.jpg)
![Admin Dashboard](images/event.jpg)
![User Dashboard](images/garden1.jpg)

## Technologies Used

- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP
- Database: MySQL
- Server: Apache

## License

This project is licensed under the MIT License.

## Contact

For any inquiries, feel free to reach out to me at [nalawadenikhil492@gmail.com]
