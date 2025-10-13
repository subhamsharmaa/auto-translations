<?php

namespace Subham\AutoTranslations\Commands;

use Illuminate\Console\Command;

class AutoTranslationsCommand extends Command
{
    public $signature = 'auto-translations';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
