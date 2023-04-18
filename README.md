# DotEnv Writer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gaming-engine/dotenv-writer.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/dotenv-writer)
[![Total Downloads](https://img.shields.io/packagist/dt/gaming-engine/dotenv-writer.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/dotenv-writer)
![GitHub Actions](https://github.com/gaming-engine/dotenv-writer/actions/workflows/main.yml/badge.svg)

A quick and easy way to modify your `.env` files programmatically.

## Installation

You can install the package via composer:

```bash
composer require gaming-engine/dotenv-writer
```

## Usage

```php
use GamingEngine\DotEnv\Writer;

(new Writer())
    ->load(__DIR__.'./.env') // Loads an existing file
    ->setValue('config', 'hello') // Overrides the value
    ->write(__DIR__.'./.env'); // Writes it back out to disk
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email andrew@judd.dev instead of using the issue tracker.

## Credits

- [Andrew Judd](https://github.com/gaming-engine)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
