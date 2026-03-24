<?php

declare(strict_types=1);

use AlAminFirdows\LaravelEditorJs\LaravelEditorJs;

if (!function_exists('editorjs')) {
    /**
     * @return LaravelEditorJs
     */
    function editorjs()
    {
        return app(LaravelEditorJs::class);
    }
}
