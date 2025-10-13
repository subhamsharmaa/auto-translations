<?php

namespace Subham\AutoTranslations\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Subham\AutoTranslations\AutoTranslations
 */
class AutoTranslations extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Subham\AutoTranslations\AutoTranslations::class;
    }
}
