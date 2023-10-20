<?php

namespace AlAminFirdows\LaravelEditorJs\Tests;

use AlAminFirdows\LaravelEditorJs\Facades\LaravelEditorJs;
use AlAminFirdows\LaravelEditorJs\LaravelEditorJsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelEditorJsServiceProvider::class,
        ];
    }

    protected function getEditorData(array $blocks)
    {
        return json_encode([
            'time'      => time(),
            'blocks'    => $blocks,
            'version'   => '2.28.0',
        ]);
    }

    protected function renderBlocks(string $content)
    {
        return preg_replace('/\R+/', '', LaravelEditorJs::render($content));
    }
}
