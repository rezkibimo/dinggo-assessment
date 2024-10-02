# dinggo-assessment

## Prerequisites

Before running the application, ensure you have the following installed on your system:

-   **PHP**: Version 8.x
-   **Composer**: Dependency management for PHP
-   **Docker** (optional, if you choose to use Docker)

For managing PHP versions easily, you can use [Herd](https://herd.laravel.com/).

## How to Run the Application

You can run the application using either **PHP Artisan** or **Docker**. Follow the steps below based on your preferred method.

### Using PHP Artisan

1. **Copy the Environment File**

    Duplicate the provided ENV (via email)

2. **Run the Development Server**

    ```
    php artisan serve
    ```

Dependencies: After copying the .env file, you might need to install project dependencies using Composer:

    ```
    composer install
    ```

### Using Docker

1. **Copy the Environment File**

    Duplicate the provided ENV (via email)

2. **Build the Docker Image**

Build the Docker image with the specified tag:

    ```
    docker build -t dinggo-assessment/laravel:0.1 .
    ```

2. **Run the Docker Container**

Start the Docker container, mapping port 8080 on your machine to port 80 in the container:

    ```
    docker run -p 8080:80 dinggo-assessment/laravel:0.1
    ```

The application will be accessible at http://localhost:8080.

Note: Unfortunately, I don't have a Docker paid subscription, so I can't share the Docker image easily. You'll need to build it manually using the steps above.
