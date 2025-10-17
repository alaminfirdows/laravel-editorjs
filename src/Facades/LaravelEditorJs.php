<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlAminFirdows\LaravelEditorJs\LaravelEditorJs
 */
class LaravelEditorJs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-editorjs';
    }
}
