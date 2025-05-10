# Project Documentation

## Overview

This document outlines the key decisions, development approach, and setup instructions for the project. It captures why certain tools and techniques were chosen, the structure of the codebase, and suggestions for future improvements.

## Key Decisions and Reasoning

### Frontend Styling

Instead of trying to fix the outdated SCSS setup, I chose to use **Tailwind CSS**. Here’s why:

- **Modern Approach**: The old gulp-based SCSS setup (v3.9.1) wasn't compatible with the latest Node.js versions, making it more trouble than it was worth.
- **Fewer Headaches**: Many of the dependencies in `package.json` were outdated and breaking the build.
- **Faster Development**: Tailwind's utility-first classes made styling much quicker and easier without writing custom CSS from scratch.
- **Cleaner Code**: Using Tailwind results in a more maintainable codebase, especially when working with components.

### Architecture

The project keeps the **CodeIgniter HMVC architecture**. This decision was made to stay consistent with the existing modular structure, while still allowing us to build on top of it—especially for things like user authentication.

## Code Review

### What Works Well

- The HMVC structure does a solid job of keeping code organized and responsibilities separated.
- The modular approach makes it easier to work on different features in isolation.
- File and folder structures follow CodeIgniter standards, so it’s easy to navigate.

### What Could Be Improved

- The legacy SCSS setup is outdated and doesn’t work well with modern tools.
- Some important parts of the code could use better documentation.
- The current authentication setup could be more secure.
- UI components are a bit inconsistent and could use some polish.

## Local Setup Instructions

### What You Need

- Docker and Docker Compose
- Git

### How to Get Started

1. **Clone the repo:**
   ```bash
   git clone https://github.com/christianmartincabucos/ci-user-management
   cd ci-user-management
   ```
2. ## Database Configuration

To configure your database connection, create a file named `database.php` under `application/config/` with the following content:

   ```php
      <?php
      defined('BASEPATH') OR exit('No direct script access allowed');

      $db['development'] = array(
         'dsn' => '',
         'hostname' => 'db',
         'username' => 'test_user', // update with your actual username
         'password' => 'test_password', // update with your actual password
         'database' => 'test_db', // update with your actual database name
         'dbdriver' => 'mysqli',
         'dbprefix' => '',
         'pconnect' => FALSE,
         'db_debug' => TRUE,
         'cache_on' => FALSE,
         'cachedir' => '',
         'char_set' => 'utf8',
         'dbcollat' => 'utf8_general_ci',
         'swap_pre' => '',
         'encrypt' => FALSE,
         'compress' => FALSE,
         'stricton' => FALSE,
         'failover' => array(),
         'save_queries' => TRUE
      );
   ```
3. **Start the Docker environment:**
   ```bash
   docker-compose up -d
   ```

3. **Open the app:**
   Go to `http://localhost:8080` in your browser.

---

### Manual Setup (If You're Not Using Docker)

#### Requirements

- PHP 7.4+
- MySQL 5.7+
- Apache or Nginx

#### Database Setup

1. Create a new database.
2. Import the SQL schema (check the `database/` folder).
3. Update your DB settings in `application/config/database.php`.

#### Web Server Setup

- Make sure the document root points to the project directory.
- `.htaccess` should be configured properly (or use Nginx equivalent rules).

#### Application Settings

- Check and update values in `application/config/config.php`.
- Don’t forget to set the right environment variables.

## Database Access

You can access the database using **phpMyAdmin** at:

👉 [http://localhost:8081/](http://localhost:8081/)

## Database Schema

Here’s the SQL statement to create the `users` table:

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `temp_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
## Notes!

- The frontend uses **Tailwind CSS** and you can find the compiled file at `assets/css/tailwind.min.css`.
- Custom colors are handled with CSS variables in the common layout template.
- CodeIgniter's MVC structure is extended with HMVC for better modularity.
- Authentication is built using dedicated controllers and models.
