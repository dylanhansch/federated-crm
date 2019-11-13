# Federated CRM
This is a customer relationship management platform built for Federated Insurance in MNSU's IT380 class.

## Code Style Guide
We will follow [PSR-12](https://www.php-fig.org/psr/psr-12/) except for the below changes:

### 2.4 Indenting
- Code MUST use an indent of 1 tab for each indent level, and MUST NOT use spaces for indenting.

### 3. Declare Statements, Namespace, and Import Statements
- Compound namespaces with a depth of more than two MAY be used.

### 4.1 Extends and Implements
- The opening brace for the class MUST NOT go on its own line; the closing brace for the class MUST go on the next line after the body.
- Opening braces MUST NOT be on their own line and MUST NOT be followed by a blank line.

### 4.4 Methods and Functions
- The opening brace MUST NOT go on its own line, and the closing brace MUST go on the next line following the body.
- There MUST be one space after the closing parenthesis.

## Local Setup
You will need PHP 7.2 (or greater), [Composer](https://getcomposer.org/), [NodeJS](https://nodejs.org/en/), [NPM](https://www.npmjs.com/), and any other requirements listed in [Laravel's Server Requirements](https://laravel.com/docs/6.x#server-requirements).

### Basic Setup Commands
In the src directory:
- ``composer install``
- ``npm install``

To compile assets (e.g. SASS and JS): ``npm run dev``

### Running The App Locally
1. Laravel provides a nice CLI tool called Artisan. It ships with the option to run a local PHP web server pre-bootstrapped for your application. Just run `php artisan serve` at the app root (/src).

2. If you are running a local SQL server - make sure it's running.

3. If you are not using the "sync" queue driver locally, make sure your queue is running (e.g. Redis, Memcached, your DB)

## Learning Laravel
Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
