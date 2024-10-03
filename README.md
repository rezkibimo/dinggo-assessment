# dinggo-assessment

## Description

This project is created using Laravel's default starter; hence, there might be lots of unnecessary code.

The database schema can be found in the `database/migrations` directory.

Most of the code is written in the `app`, `resources`, and `routes` directories.

### The goal of this project is to follow:

-   [x] Use https://app.dev.aws.dinggo.com.au/phptest/cars to get a list of cars
-   [x] Save this list into your database
-   [x] Using this list of cars submit one to https://app.dev.aws.dinggo.com.au/phptest/quotes to return 2 sample quotes
-   [x] Save these quotes into the database
-   [x] Create a simple html/css page to display these quotes

## Prerequisites

Before running the application, ensure you have the following installed on your system:

-   **PHP**: Version 8.x
-   **Composer**: Dependency management for PHP
-   **Docker** (optional, if you choose to use Docker)

For managing PHP versions & environment for the Laravel development, you can use [Herd](https://herd.laravel.com/).

## How to Run the Application

You can run the application using either **PHP Artisan** or **Docker**. Follow the steps below based on your preferred method.

### Using PHP Artisan (Recommended)

1. **Copy the Environment File**

    Duplicate the provided ENV (via email)

2. **install project dependencies using Composer**

    ```
    composer install
    ```

3. **Built the initial sqlite database**

    ```
    php artisan migrate
    ```

4. **Run the Development Server**

    ```
    php artisan serve
    ```

### Using Docker

1. **Copy the Environment File**

    Duplicate the provided ENV (via email)

2. **Build the Docker Image**

Build the Docker image with the specified tag:

    ```
    docker build -t dinggo-assessment/laravel:0.1 .
    ```

3. **Run the Docker Container**

Start the Docker container, mapping port 8080 on your machine to port 80 in the container:

    ```
    docker run -p 8080:80 dinggo-assessment/laravel:0.1
    ```

The application will be accessible at http://localhost:8080.

Note: Unfortunately, I don't have a Docker paid subscription, so I can't share the Docker image easily. You'll need to build it manually using the steps above.
