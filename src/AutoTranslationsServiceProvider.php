<?php

namespace Subham\AutoTranslations;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Subham\AutoTranslations\Commands\GenerateTranslationsCommand;

class AutoTranslationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('auto-translations')
            ->hasConfigFile('autotranslations')
            ->hasViews()
            ->hasCommand(GenerateTranslationsCommand::class);
    }
}
