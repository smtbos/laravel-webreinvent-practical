# Todo Management System

This is a simple todo management system built with the Laravel 9.

## Demo

The project is hosted on personal hosting and can be accessed by clicking the link below:

[Click here](https://webreinvent.smtbos.com)

## Prerequisites

-   PHP 8.0 or higher
-   Composer
-   MySQL database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/smtbos/laravel-webreinvent-practical.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel-webreinvent-practical
    ```

3. Install the PHP dependencies:

    ```bash
    composer install
    ```

3. Install the node dependencies:

    ```bash
    npm install
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    Make sure to update the values in the `.env` file with your own values.

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Migrate the database:

    ```bash
    php artisan migrate
    ```

## Starting the server

To start the server, run the following command:

```bash
php artisan serve
```

## Starting the JS development server

To start the JS development server, run the following command:

```bash
npm run dev
```
