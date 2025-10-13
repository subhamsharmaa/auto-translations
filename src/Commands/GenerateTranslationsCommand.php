<?php

namespace Subham\AutoTranslations\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateTranslationsCommand extends Command
{
    public $signature = 'auto-translations:generate 
                        {--force : Force overwrite existing translations}
                        {--append : Append new translations to existing files}';

    public $description = 'Automatically generate translation files for all models.';

    public function handle(): int
    {        
        $prefix = config('autotranslations.prefix');
        $suffix = config('autotranslations.suffix');
        $locales = config('autotranslations.locale');
        $modelPaths = config('autotranslations.model_paths');
        $publishPath = config('autotranslations.publish_path', resource_path('lang'));

        $force = $this->option('force');
        $append = $this->option('append');

        if ($force && $append) {
            $this->error('Cannot use --force and --append together. Please choose one.');
            return self::FAILURE;
        }

        if (!is_dir($publishPath)) {
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

            $file = $filePath . "/$locale.json";
            
            if (file_exists($file)) {
                if ($force) {
                    $finalTranslations = $allTranslations;
                } elseif ($append) {
                    $existingTranslations = json_decode(file_get_contents($file), true) ?? [];
                    
                    $finalTranslations = array_merge($allTranslations, $existingTranslations);

                } else {
                    if (!$this->confirm("Translation file for $locale already exists. Overwrite?", false)) {
                        $this->info("Skipping $locale...");
                        continue;
                    }
                    $finalTranslations = $allTranslations;
                }
            } else {
                $finalTranslations = $allTranslations;
            }

            ksort($finalTranslations);

            file_put_contents($file, json_encode($finalTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        return self::SUCCESS;
    }
}