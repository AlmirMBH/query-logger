# Single-middleware Query Logger

Single-middleware Query Logger is a standalone project designed to provide a simple yet effective solution for logging
database queries in a Laravel application. It consists of a single middleware that logs database queries based on
specified conditions. For simplicity and clarity, this implementation avoids specific design patterns and principles.
The primary focus is on the straightforward logging of queries.


## Features
- Easy Integration: Copy-paste the middleware into your Laravel project, and you are good to go.
- Flexible Configuration: Log queries based on execution time, memory usage, connection, endpoint, and more.
- Environment-Based Logging: Log queries selectively based on the environment (e.g., 'local', 'production', etc.).
- Custom Logging Channels: Configure your desired logging channel, allowing flexibility in logging destinations
  (e.g., file, Slack, etc.).
- Seeders for Authors and Posts: Seeder included to populate authors and posts, demonstrating query logging with related
  models.
- Loggable query details:
  - Query execution time,
  - Query size,
  - Route name,
  - Bindings,
  - Raw SQL query,
  - Connection name,
  - Database name,
  - Host, port, and driver,
  - Endpoint name, etc.


## Usage
Create a middleware in your project, for example:

```
php artisan make:middleware QueryLogger
```

Copy the code from QueryLogger.php into your project's middleware (`QueryLogger`). You can change the name of the
middleware if you want, but make sure to update the references to the middleware in the code.
Register Middleware in the app/Http/Kernel.php file:

```
'api' => [
            ...
            \App\Http\Middleware\QueryLogger::class,
        ],


protected $middlewareAliases = [
        ...
        'queryLogger' => \App\Http\Middleware\QueryLogger::class,
    ];
```

Depending on the type of your application, you may want to register the middleware in the `api` or `web` middleware
group.


## Add middleware to routes
Wrap your routes with the `queryLogger` middleware in your routes file (e.g., api.php):


## Configure logging
Configure the logging channel in the config/logging.php file:

```
'channels' => [
    // Other channels...

    'database_query_log' => [
        'driver' => 'single',
        'path' => storage_path('logs/db_query.log'),
        'days' => 14,
        'level' => 'info',
    ],
],
```

The logging file will be created automatically when the middleware is executed. It will be located in the storage/logs
directory, and it will be named `db_query.log`, as specified in the path parameter. The logs will be deleted after 14
days, as specified in the `days` parameter.


## Migrations and Seeders
If you do not have your own project, you can use this project to test the middleware. To do so, follow these steps:
- Clone the project
- Copy .env.example .env (cp .env.example .env)
- Create a database, e.g., `query_logger`
- Configure the database in the .env file (DB_DATABASE=query_logger)
- Run `composer install`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan serve`
- Open the project in your browser (e.g., http://127.0.0.1:8000)

Some of the available routes that you can use for logging queries are:
- http://localhost:8000/api/authors
- http://localhost:8000/api/authors/1
- http://localhost:8000/api/authors/1/posts
- http://localhost:8000/api/authors/1/posts/1
- http://localhost:8000/api/posts
- http://localhost:8000/api/posts/1


## Start logging
Queries will now be logged in the specified log file (db_query.log) when the middleware is active. Only queries that
meet the specified conditions will be logged. The default conditions are specified below, but you can change them to
anything you want.

- Execution time > 20 milliseconds
- Memory usage > 3 MB
- Environment = 'local' (specified in the .env file)


