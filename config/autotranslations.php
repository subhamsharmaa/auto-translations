<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prefix for generated translation keys
    |--------------------------------------------------------------------------
    |
    | This prefix will be added before every translation key.
    |
    | Format: {prefix}.{table_name}.{column_name}.{suffix}
    | Example with prefix 'fields': fields.users.name.label
    |
    */
    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Suffix for generated translation keys
    |--------------------------------------------------------------------------
    |
    | This suffix will be added after every translation key.
    |
    | Format: {prefix}.{table_name}.{column_name}.{suffix}
    | Example with suffix 'label': fields.users.name.label
    |
    */
    'suffix' => '',

    /*
    |--------------------------------------------------------------------------
    | Locale(s) for generated translation files
    |--------------------------------------------------------------------------
    |
    | The translation files will be generated for these locales.
    |
    | IMPORTANT: All generated translations will be in English (base language).
    | The package only creates the file structure and keys - you need to
    | manually translate the values for each locale afterward.
    | Example: ['en', 'es', 'fr', 'de']
    |
    */
    'locale' => ['en'],

    /*
    |--------------------------------------------------------------------------
    | Directories to scan for models
    |--------------------------------------------------------------------------
    |
    | List of folders where your models are stored. Can be multiple paths.
    |
    */
    'model_paths' => [
        app_path('Models'),
        // base_path('Modules/MyModule/app/Models'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Where to publish the generated translations
    |--------------------------------------------------------------------------
    |
    | The directory where translation JSON files will be created.
    | Example: resources/lang
    |
    */
    'publish_path' => resource_path('lang'),

];
