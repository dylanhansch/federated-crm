# Federated CRM
This is a customer relationship management platform built for Federated Insurance in MNSU's IT380 class.

## Code Style Guide
TODO

## Local Setup
You will need PHP 7.2 (or greater), [Composer](https://getcomposer.org/), [NodeJS](https://nodejs.org/en/), [NPM](https://www.npmjs.com/), and any other requirements listed in [Laravel's Server Requirements](https://laravel.com/docs/6.x#server-requirements).

Optionally, you can run a local MySQL server instance yourself. This is recommended. However, if you're uncomfortable with doing this you're welcome to use Dylan's remote MySQL server instead.

### Running The App Locally
1. Laravel provides a nice CLI tool called Artisan. It ships with the option to run a local PHP web server pre-bootstrapped for your application. Just run `php artisan serve` at the app root (/src).

2. If you are running a local MySQL server - make sure it's running.

3. If you are not using the "sync" queue driver locally, make sure your queue is running (e.g. Redis, Memcached, your DB)

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
