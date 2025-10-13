# Laravel Auto Translation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/subham/auto-translations.svg?style=flat-square)](https://packagist.org/packages/subham/auto-translations)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/subham/auto-translations/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/subham/auto-translations/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/subham/auto-translations/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/subham/auto-translations/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/subham/auto-translations.svg?style=flat-square)](https://packagist.org/packages/subham/auto-translations)

Automatically generate translation files for all your Laravel models. This package scans your models and creates JSON translation files based on their fillable attributes.

## Installation

You can install the package via composer:

```bash
composer require subham/auto-translations
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="auto-translations-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="auto-translations-config"
```

This is the contents of the published config file:

```return [
    // Prefix for translation keys
    'prefix' => 'fields',
    
    // Suffix for translation keys
    'suffix' => 'label',
    
    // Locales to generate translations for
    'locale' => ['en', 'es', 'fr'],
    
    // Paths to scan for models
    'model_paths' => [
        app_path('Models'),
        // base_path('Modules/MyModule/Models'), // For modular apps
    ],
    
    // Where to publish translation files
    'publish_path' => resource_path('lang'),
];
```

## Translation Key Format
```{prefix}.{table_name}.{column_name}.{suffix}```

## Example
| Prefix  |  Model  | Column  |Suffix|Final Result|
|---------|---------|---------|------|------------|
|         |  User   | email   |      | users.email|
| fields  |  User   | email   |      | fields.users.email|
|fields   |  User   |email    |column| fields.users.email.column|
## Usage
**Basic Command**

Generate translation files for all models:

```
php artisan auto-translations:generate
```
This will prompt you for confirmation if translation files already exist.

**Force Overwrite**

Overwrite existing translation files without confirmation:
```
php artisan auto-translations:generate --force
```

**Append Mode**

Add new translations while preserving existing ones:
```
php artisan auto-translations:generate --append
```
Use this when translators have customized translations and you want to add new keys only.

## Example Output
For a **User** model with fillable attributes **['name', 'email', 'phone']** with prefix **fields** and suffix **label**:

**Generated Translation File**
```
{
  "fields.users.email.label": "Email",
  "fields.users.name.label": "Name",
  "fields.users.phone.label": "Phone"
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Subham Sharma](https://github.com/subham)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
