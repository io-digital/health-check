# HealthCheck

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


HealthCheck provides your Laravel application with a `/healthcheck` endpoint to make it easier nice and easy to view the status of your application.


## Install

*supports package auto discovery for Laravel*

Via Composer

``` bash
$ composer require io-digital/health-check
```

Add the ServiceProvider to your config/app.php providers array:

``` php
IoDigital\HealthCheck\HealthCheckServiceProvider::class,
```

Then run the following command artisan command:

```bash
$ php artisan vendor:publish --provider="IoDigital\HealthCheck\HealthCheckServiceProvider" 
```

This will publish the package config file to `config/healthcheck.php`.

You currently have the options to select which tests to perform:

```php
'ssl' => true,
'database' => true,
'application' => true,
```

## Usage

The package automatically adds the `/healthcheck` endpoint to your application. All you need to do is hit that route.

For now the endpoint returns the following:

* `200` reponse
* JSON object with the following layout:

```json
{
    "application": {
        "message": "Application is running",
        "success": true
    },
    "database": {
        "message": "There was an error connecting to the database. Error has been logged.",
        "success": false
    },
    "ssl": {
        "message": "SSL is working.",
        "success": false
    }
}
```

Future releases will hope to expand on what is tested.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/io-digital/healthcheck.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/io-digital/health-check
[link-downloads]: https://packagist.org/packages/io-digital/health-check
[link-author]: https://github.com/io-digital
[link-contributors]: ../../contributors
