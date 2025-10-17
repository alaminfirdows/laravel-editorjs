<?php

declare(strict_types=1);

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
            'time' => time(),
            'blocks' => $blocks,
            'version' => '2.28.0',
        ]);
    }

    protected function renderBlocks(string $content)
    {
        return preg_replace('/\R+/', '', LaravelEditorJs::render($content));
    }

    public function assertHtml(string $expectedHtml, string $actualHtml, string $message = ''): void
    {
        $expectedNormalized = $this->normalizeHtml($expectedHtml);
        $actualNormalized = $this->normalizeHtml($actualHtml);

        $this->assertEquals($expectedNormalized, $actualNormalized, $message);
    }

    private function normalizeHtml(string $html): string
    {
        // Remove unnecessary whitespace between tags and within tag attributes
        $html = preg_replace('/\s+/', ' ', $html);

        // Remove whitespace before and after starting tags
        $html = preg_replace('/\s*<\s*/', '<', $html);

        // remove whitespace before and after closing tags
        $html = preg_replace('/\s*>\s*/', '>', $html);

        return $html;
    }
}
