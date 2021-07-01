## About

Simple web application designed to extract data from excel files.

## Installation

-   Clone repository
-   Run "Composer Install"
-   Generate .env from .env.example and generate key using "php artisan key:generate"
-   Configure .env settings like DB connection, email sending.
-   Run "php artisan migrate:fresh --seed"

## For Centos User

If you run into permission issues, run this command.

-   chown -R apache /path/to/your/project/folder

ex. chown -R apache /var/html/www/myproject

## Framework used

-   **[Laravel 8](https://laravel.com/)**
-   **[Laravel Jetstream](https://jetstream.laravel.com/)**
-   **[Livewire](https://laravel-livewire.com/)**

### Developer

-   **[Richard Bernisca](https://richardbernisca.com/)**
