<center><img alt="Lumen Rate limiting" src="https://banners.beyondco.de/Lumen%20Rate%20limiting.png?theme=light&packageName=rogervila%2Flumen-rate-limiting&pattern=architect&style=style_1&description=Lumen+port+of+Laravel+ThrottleRequests+middleware&md=1&showWatermark=1&fontSize=100px&images=shield-check"></center>

<a href="https://packagist.org/packages/rogervila/lumen-rate-limiting"><img src="https://img.shields.io/packagist/dt/rogervila/lumen-rate-limiting" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/rogervila/lumen-rate-limiting"><img src="https://img.shields.io/packagist/v/rogervila/lumen-rate-limiting" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/rogervila/lumen-rate-limiting"><img src="https://img.shields.io/packagist/l/rogervila/lumen-rate-limiting" alt="License"></a>

## About

This package contains Lumen port of Laravel's [ThrottleRequests middleware](https://github.com/laravel/framework/blob/master/src/Illuminate/Routing/Middleware/ThrottleRequests.php)

## Install

1. Require the package on your Lumen application

```sh
composer require rogervila/lumen-rate-limiting
```

2. Make sure that `AppServiceProvider` and `AuthServiceProvider` are uncommented on `bootstrap/app.php`

```php
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
```

3. Configure a rate limiter on the `AppServiceProvider` `boot` method

```php
/**
 * Configure global rate limiter
 *
 * @return void
 */
public function boot()
{
    app(\Illuminate\Cache\RateLimiter::class)->for('global', function () {
        return \Illuminate\Cache\RateLimiting\Limit::perMinute(60)->by(request()->ip());
    });
}
```

4. Register the middleware on `bootstrap/app.php`

```php
$app->routeMiddleware([
    'throttle' => \LumenRateLimiting\ThrottleRequests::class,
]);
```

5. Add the middleware to the global router group on `bootstrap/app.php`

```php
$app->router->group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'throttle:global',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});
```

The middleware can be placed on specific routes instead of globally, as defined on the [official documentation](https://lumen.laravel.com/docs/8.x/middleware#registering-middleware).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
