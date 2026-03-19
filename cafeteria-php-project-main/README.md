# Cafeteria PHP Project

A custom PHP MVC (Model-View-Controller) web application for managing a cafeteria. This project uses vanilla PHP without external frameworks, featuring a custom router and database integration.

## Features

*   **Custom MVC Architecture:** Clean separation of concerns with Models, Views, and Controllers.
*   **Custom Router:** Handles friendly URLs via `public/index.php` and `.htaccess`.
*   **Database Integration:** Basic MySQL database configuration.
*   **Autoloading:** Automatically loads controllers, models, and core classes.

## Prerequisites

*   PHP 7.4 or higher
*   MySQL/MariaDB
*   Apache Server (with `mod_rewrite` enabled for `.htaccess` routing)

## Project Structure

```text
cafeteria/
├── app/
│   ├── config/      # Database and application configuration
│   ├── Controllers/ # Application controllers
│   ├── Core/        # Core system classes (App, Controller, Database)
│   ├── database/    # Database scripts/migrations
│   ├── Models/      # Database models
│   └── Views/       # HTML view templates
├── public/
│   ├── index.php    # Application entry point
│   └── .htaccess    # Apache rewrite rules
└── README.md
```

## Setup and Installation

1. **Clone the repository** or copy the project files to your web server's root directory (e.g., `htdocs`, `/var/www/html/`).
2. **Setup the Database:**
   * Create a local MySQL database named `cafeteria`.
   * Import any existing SQL scripts located in `app/database/` to set up your tables.
3. **Configure the Environment:**
   * Open `app/config/config.php`.
   * Update the database credentials to match your local setup:
     ```php
     define('DB_HOST','localhost');
     define('DB_USER','your_username');
     define('DB_PASS','your_password');
     define('DB_NAME','cafeteria');
     define('URL_ROOT','http://localhost/cafeteria'); // Adjust based on your setup
     ```
4. **Configure Apache:**
   * Ensure that Apache's `mod_rewrite` is enabled.
   * Make sure the Document Root is pointing to the parent directory or properly routes to the `public/` directory so that `public/index.php` handles incoming requests.

## Usage

Access the application through your web browser by navigating to the URL root defined in your config, for example: `http://localhost/cafeteria/public/`. The custom router will automatically map the URL segments to the matching Controller and Method. For example, `http://localhost/cafeteria/public/users/profile` maps internally to the `Users` controller and its `profile` method.

## License

This project is open-source and available under the MIT License.