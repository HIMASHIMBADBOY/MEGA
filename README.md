# HSFAMIS - Tanzania Online Field Trainings Application System

![image](https://github.com/user-attachments/assets/d97c1432-3cfb-4acc-b1ea-a105d4176ff7)


A web-based application system for managing field training applications in Tanzania, connecting students with field opportunities and streamlining the administration process.

## Key Features

### Student Portal
- ✅ Secure login/registration with email activation
- 📋 Field space selection and application
- 📊 Application progress tracking
- 🔔 Notification system for updates
- 📩 Email feedback from administrators

### Admin Portal
- 👨‍💼 Field space management (add/edit/remove)
- 📝 Application review (accept/reject)
- 📈 Student progress monitoring
- ✉️ Feedback system for students
- 📊 Reporting and analytics

### System Features
- ✉️ PHP Mailer integration for all email communications
- 🔐 Password recovery system
- 📧 Contact form for public inquiries
- 📱 Responsive design (works on mobile/desktop)

## Technologies Used
- **Backend**: PHP
- **Frontend**: HTML, JavaScript, Tailwind CSS
- **Database**: MySQL
- **Email**: PHPMailer
- **Security**: Password hashing, Email verification

## Installation

1. Clone the repository:
```bash
git clone https://github.com/your-username/HSFAMIS.git
cd HSFAMIS

2.Set up database:
Import database/hsfamis.sql to MySQL
Configure credentials in config/database.php

3.    Configure email (PHPMailer):
// config/mail.php
define('MAIL_HOST', 'smtp.yourprovider.com');
define('MAIL_USERNAME', 'your@email.com');
define('MAIL_PASSWORD', 'yourpassword');
define('MAIL_PORT', 587);

4.SCREENSHOTS
Signup page
![image](https://github.com/user-attachments/assets/a2b132a6-86fb-4bc2-8bfc-8df0ad253bb4)

Admin dashboard
![image](https://github.com/user-attachments/assets/9ad9c442-7e6c-4277-be16-4e2df7512672)

