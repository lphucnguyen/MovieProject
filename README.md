### Planning Steps:
1. Upgrade Laravel 7 to Laravel 10 - Done
1. Building Infrastruct as code in AWS - Doing
1. Building Dockerfile for this repo - Doing
1. Refactoring code - Doing
1.1. Seperating bussiness logic to Service class
1.1. Seperating Repository class to handle database access


<hr>

### Setup Steps:
1. composer install & composer update
1. add database info in .env
1. composer require laravel/passport
1. php artisan migrate
1. php artisan passport:install
1. php artisan storage:link
1. Change (Clients, Films, Actors) Images.
1. Import (Films.postman_collection.json) in postman to show api links.

<hr>

### Libraries & Services Used:
1. JWPlayer : For video hosting
1. Laratrust: For roles & permissions
1. Passport: For API Authentication


