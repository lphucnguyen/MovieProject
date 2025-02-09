
# Movie project

1. Framework: Laravel (version 10)
1. Programming Language: php
1. Database: MySQL, Neo4J

<hr>

### Features:
1. Apply Command Bus pattern
1. Building Infrastructure as code in AWS
1. Building Dockerfile for this repo
1. Apply Clean Architecture
1. Payment Service Gateway

<hr>

### Clean Architecture:
1. <b>Domain Layer</b>: At the heart of the system is the Domain Layer. The domain layer consists of the core business entities. All the other layers in the system depend on the Domain layer and are there to support the Domain Layer. Domain Layer itself does not depend on any other Layer.
1. <b>Application Layer</b>: The Application layer is where all the magic happens. This is where your business logic resides.Based on the business rules and regulations, this layer controls the flow of data to and from your business entities. Generally, this layer consists of all your services, commands, queries, exceptions, logs, etc.
1. <b>Infrastructure Layer</b>: This is where all your external services and database logic are located. All your external services, like email service, storage solutions, message queues, third-party API calls, etc., are handled by this layer. Besides, it is also a common practice to separate database logic into its own Persistence Layer. This is where your DbContext and migrations, etc., will go.
1. <b>Presentation Layer</b>: This is the gateway or the entry point to your application. This layer is responsible for presenting data to the end user in an easily understandable manner. You will probably implement this layer as a Web or API project consisting of controllers defining the Action Methods or API endpoints.

<image src="https://images.viblo.asia/be6b962f-7cb5-4ce4-b54a-51ffaeda2c0b.png">

### Setup Steps:
1. composer install & composer update
1. add database info in .env
1. composer require laravel/passport
1. php artisan migrate
1. php artisan passport:install
1. php artisan storage:link

<hr>

### Libraries & Services Used:
1. JWPlayer : For video hosting
1. Laratrust: For roles & permissions
1. Passport: For API Authentication