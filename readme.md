# laravel-mono
Use [Mono](https://mono.co) Apis in your laravel project.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/myckhel/laravel-mono.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/myckhel/laravel-mono.svg?style=flat-square)](https://packagist.org/packages/myckhel/laravel-mono)

## [Mono Doc Link](https://docs.mono.co/reference)

## Install
`composer require myckhel/laravel-mono`

## Setup
The package will automatically register a service provider.

You need to publish the configuration file:

```php artisan vendor:publish --provider="Myckhel\Mono\MonoServiceProvider"```

### Publish config
This is the default content of the config file ```mono.php```:
```php
<?php

return [
    "secret_key"    => env("MONO_SECRET_KEY"),
    "url"           => env("MONO_URL", 'https://api.withmono.com'),
    "version"       => 1,

    "route" => [
        "middleware"    => ['api'], // For injecting middleware to the package's routes
        "prefix"    => 'api', // For injecting middleware to the package's routes
    ],
];
```

### Update env
Update Your Projects `.env` with their credentials:
```bash
MONO_SECRET_KEY=XXXXXXXXXXXXXXXXXXXX
MONO_PUBLIC_KEY=XXXXXXXXXXXXXXXXXXXX
MONO_WEBHOOK_SECRET_KEY=XXXXXXXXXXXX
```

## Usage

### Account
```php
use Myckhel\Mono\Support\Account;

Account::auth($code, $params);

Account::info($id, $params);

Account::statement($id, $params);

Account::pollpdf($id, $params);

Account::transactions($id, $params);

Account::income($id, $params);

Account::identity($id, $params);

Account::sync($id, $params);

Account::reauthorise($id, $params);

Account::unlink($id, $params);

Account::coverage($params);
```

### Cac
```php
use Myckhel\Mono\Support\Cac;

Cac::lookup($params);

Cac::company($id, $params);
```

### Payment
```php
use Myckhel\Mono\Support\Payment;

Payment::initiate($params);

Payment::verify($params);

Payment::oneTimePayment($params);

Payment::createPlan($params);

Payment::listPlans($params);

Payment::updatePlan($params);

Payment::deletePlan($params);
```

### Wallet
```php
use Myckhel\Mono\Support\Wallet;

Payment::balance($params);
```

## Mono
- ### `verifyWebHook`
Method to verify incoming webhook secret
```php
use Mono;

Mono::verifyWebHook($request->header('mono-webhook-secret'));
```

### Using WebHook route
Laravel mono provides you a predefined endpoint that listens to and validates incoming mono's webhook events.
It emits `Myckhel\Mono\Events\Hook` on every incoming hooks which could be listened to.

## Setup Mono Webhook
[Check official page for instructions setting up mono webhook](https://docs.mono.co/docs/setting-up-webhook-url)
laravel-mono exposes `hooks` api endpoint
use the enddpoints url to for the mono webhook url during the setup.
```
| POST      | /hooks                                |               | Myckhel\Mono\Http\Controllers\HookController@hook              | api            |
```

## Listening to laravel-mono Hook event
You may start listening to incoming mono webhooks after setup by registering the event in your laravel project's `EventServiceProvider` file.

- ### Create an event listener class
```bash
php artisan make:listener MonoWebHookListener --event=Myckhel\Mono\Events\Hook
```
- ### Handle mono webhook events
```php
<?php

namespace App\Listeners;

use Myckhel\Mono\Events\Hook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MonoWebHookListener
{
    /**
     * Handle the event.
     *
     * @param  Myckhel\Mono\Events\Hook  $event
     * @return void
     */
    public function handle(Hook $event)
    {
        Log::debug($event->event);
        /* {
            "event": "direct_debit.payment_successful",
            "data": {
              "type": "onetime-debit",
              "object": {
                "id": "txd_9AhCg0PNkwHiq6RqLLdiqKDf",
                "status": "successful",
                "amount": 30000,
                "description": "free shirt",
                "fee": 300,
                "currency": "NGN",
                "account": "611d575feef5d3371ca9d0d8",
                "customer": "611adcd9a5fda23baf58140d",
                "reference": "djdjj3939394949944",
                "liveMode": true,
                "created_at": "2021-08-18T18:54:23.491Z",
                "updated_at": "2021-08-18T18:55:16.055Z"
              }
            }
          }
        */
    }
}
```
- ### Register `MonoWebHookListener`
```php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Myckhel\Mono\Events\Hook;
use App\Listeners\MonoWebHookListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ...
        Hook::class => [
            MonoWebHookListener::class,
        ],
    ];
```

### Using built in routes
```
+--------+-----------+---------------------------------------------+---------------+----------------------------------------------------------------+----------------+
| Domain | Method    | URI                                         | Name          | Action                                                         | Middleware     |
+--------+-----------+---------------------------------------------+---------------+----------------------------------------------------------------+----------------+
|        | GET|HEAD  | /                                           |               | Closure                                                        | web            |
|        | POST      | api/v1/account/auth                         |               | Myckhel\Mono\Http\Controllers\AccountController@auth           | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}                        |               | Myckhel\Mono\Http\Controllers\AccountController@info           | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}/identity               |               | Myckhel\Mono\Http\Controllers\AccountController@identity       | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}/income                 |               | Myckhel\Mono\Http\Controllers\AccountController@income         | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/accounts/{id}/reauthorise            |               | Myckhel\Mono\Http\Controllers\AccountController@reauthorise    | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}/statement              |               | Myckhel\Mono\Http\Controllers\AccountController@statement      | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}/statement/jobs/{jobId} |               | Myckhel\Mono\Http\Controllers\AccountController@pollPdf        | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/accounts/{id}/sync                   |               | Myckhel\Mono\Http\Controllers\AccountController@sync           | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/accounts/{id}/transactions           |               | Myckhel\Mono\Http\Controllers\AccountController@transactions   | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/accounts/{id}/unlink                 |               | Myckhel\Mono\Http\Controllers\AccountController@unlink         | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/cac/company/{id}                     |               | Myckhel\Mono\Http\Controllers\CacController@company            | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/cac/lookup                           |               | Myckhel\Mono\Http\Controllers\CacController@lookup             | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/coverage                             |               | Myckhel\Mono\Http\Controllers\AccountController@coverage       | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/payments/initiate                    |               | Myckhel\Mono\Http\Controllers\PaymentController@initiate       | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/payments/one-time-payment            |               | Myckhel\Mono\Http\Controllers\PaymentController@oneTimePayment | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/payments/plans                       |               | Myckhel\Mono\Http\Controllers\PaymentController@createPlan     | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | GET|HEAD  | api/v1/payments/plans                       |               | Myckhel\Mono\Http\Controllers\PaymentController@listPlans      | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | PUT       | api/v1/payments/plans/{planId}              |               | Myckhel\Mono\Http\Controllers\PaymentController@updatePlan     | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | DELETE    | api/v1/payments/plans/{{planId}}            |               | Myckhel\Mono\Http\Controllers\PaymentController@deletePlan     | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/payments/verify                      |               | Myckhel\Mono\Http\Controllers\PaymentController@verify         | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
|        | POST      | api/v1/hooks                                |               | Myckhel\Mono\Http\Controllers\HookController@hook              | api            |
|        |           |                                             |               |                                                                | api.version:v1 |
+--------+-----------+---------------------------------------------+---------------+----------------------------------------------------------------+----------------+
```

<!-- 
## Testing
Run the tests with:

``` bash
vendor/bin/phpunit
```
 -->
## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [myckhel](https://github.com/myckhel)
- [All Contributors](https://github.com/myckhel/laravel-mono/contributors)

## Security
If you discover any security-related issues, please email myckhel1@hotmail.com instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
