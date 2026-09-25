# Alzikrayat photo sharing

#Description

Alzikrayat is a PHP/MySQL web application for storing and sharing memories through a photo gallery.

## Main Features

- User registration and login
- Secure password hashing
- Session-based authentication
- Logout functionality
- Last-login information using a cookie
- Photo upload
- Photo title and description
- Photo gallery
- Multiple gallery display styles
- Photo details
- Comments
- Photo deletion by the owner
- CSRF protection
- Server-side validation
- HTML5 validation
- JavaScript validation
- MySQL database using PDO
- Foreign keys with `ON DELETE CASCADE`
- Responsive Bootstrap interface

## Technologies

- PHP
- MySQL
- PDO
- HTML5
- CSS
- JavaScript
- Bootstrap
- Apache/XAMPP

## Project Structure

```text
alzikrayat/
├── config/
├── controllers/
├── models/
├── views/
├── public/
│   └── js/
├── uploads/
└── index.php
```

## Database

The application uses three main tables:

- `users`
- `photos`
- `comments`

Relationships:

- `photos.user_id` references `users.id`
- `comments.photo_id` references `photos.id`
- `comments.user_id` references `users.id`

Foreign keys use `ON DELETE CASCADE`.

## Running the Project

1. Install XAMPP.
2. Start Apache and MySQL.
3. Place the project inside the XAMPP `htdocs` directory.
4. Create/import the project database in phpMyAdmin.
5. Configure the database connection in `config/database.php`.
6. Open:

`http://localhost/alzikrayat/`

## Security

The application uses password hashing, prepared SQL statements through PDO, sessions, CSRF protection, validation, and controlled file-upload handling.

## Project Purpose

The project demonstrates MVC architecture, authentication, database relationships, CRUD functionality, file uploading, validation, and responsive web design in a PHP/MySQL application.

Student name: ali adil mohamed 
