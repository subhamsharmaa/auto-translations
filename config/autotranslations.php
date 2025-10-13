<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prefix for generated translation keys
    |--------------------------------------------------------------------------
    |
    | This prefix will be added before every translation key.
    |
    */
    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Locale(s) for generated translation files
    |--------------------------------------------------------------------------
    |
    | The translation files will be generated for these locales.
    |
    */
    'locale' => ['en'],

    /*
    |--------------------------------------------------------------------------
    | Suffix for generated translation keys
    |--------------------------------------------------------------------------
    |
    | This suffix will be added after every translation key.
    |
    */
    'suffix' => '',

    /*
    |--------------------------------------------------------------------------
    | Directories to scan for models
    |--------------------------------------------------------------------------
    |
    | List of folders where your models are stored. Can be multiple paths.
    |
    */
    'model_paths' => [
        // app_path('Models'),
        // base_path('Modules/MyModule/Models'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Where to publish the generated translations
    |--------------------------------------------------------------------------
    |
    | Example: resources/lang/vendor/auto-translations
    |
    */
    'publish_path' => resource_path('lang'),

];
