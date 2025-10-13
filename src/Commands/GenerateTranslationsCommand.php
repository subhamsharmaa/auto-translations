<?php

namespace Subham\AutoTranslations\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateTranslationsCommand extends Command
{
    public $signature = 'auto-translations:generate';

    public $description = 'Automatically generate translation files for all models.';

    public function handle(): int
    {
        $this->info(' Scanning models for translatable attributes...');
        $prefix = config('autotranslations.prefix');
        $suffix = config('autotranslations.suffix');
        $locales = config('autotranslations.locale');
        $modelPaths = config('autotranslations.model_paths');
        $publishPath = config('autotranslations.publish_path', resource_path('lang/vendor/auto-translations'));

        if (! is_dir($publishPath)) {
            mkdir($publishPath, 0755, true);
        }

        $allModels = [];
        foreach ($modelPaths as $path) {
            if (! is_dir($path)) {
                $this->warn("Directory $path does not exist, skipping...");

                continue;
            }

            $files = glob($path.'/*.php');

            foreach ($files as $file) {
                $class = pathinfo($file, PATHINFO_FILENAME);
                if (str_contains($path, 'Modules')) {
                    $relative = str_replace('/app/', '/', $path);
                    $namespace = str_replace('/', '\\', $relative);
                    $namespace = rtrim($namespace, '\\');
                } else {
                    $namespace = 'App\\Models';
                }
                $fqcn = $namespace.'\\'.$class;

                if (class_exists($fqcn)) {
                    $allModels[] = $fqcn;
                } else {
                    $this->warn("Class $fqcn does not exist, skipping...");
                }
            }
        }
        $allTranslations = [];

        foreach ($allModels as $modelClass) {
            $model = new $modelClass;
            $columns = $model->getFillable();

            if (empty($columns)) {
                $this->warn("No fillable columns found for $modelClass, skipping...");

                continue;
            }

            $modelName = Str::snake(Str::plural(class_basename($modelClass)));

            foreach ($columns as $column) {
                $key = trim("{$prefix}.{$modelName}.{$column}.{$suffix}", '.');
                $allTranslations[$key] = ucwords(str_replace('_', ' ', $column));
            }
        }

        foreach ($locales as $locale) {
            $filePath = $publishPath;
            if (! is_dir($filePath)) {
                mkdir($filePath, 0755, true);
            }

            $file = $filePath."/$locale".'.json';
            file_put_contents($file, json_encode($allTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        $this->info('Translations generated successfully!');

        return self::SUCCESS;
    }
}
