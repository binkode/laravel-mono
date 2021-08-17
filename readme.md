# laravel-mono

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
```

## Usage

### Account
```php
use Myckhel\Mono\Support\Account;

Account::auth($id, $params);

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

Payment::initiate();

Payment::verify();

Payment::oneTimePayment();

Payment::createPlan();

Payment::listPlans();

Payment::updatePlan();

Payment::deletePlan();
```

### Wallet
```php
use Myckhel\Mono\Support\Wallet;

Payment::balance($params);
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
