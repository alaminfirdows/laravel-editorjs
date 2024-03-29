<?php

namespace AlAminFirdows\LaravelEditorJs;

use EditorJS\EditorJS;
use EditorJS\EditorJSException;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class LaravelEditorJs
{
    /**
     * Render blocks
     *
     * @param string $data
     * @return string
     */
    public function render(string $data): string
    {
        try {
            $configJson = json_encode(config('laravel_editorjs.config') ?: []);

            $editor = new EditorJS($data, $configJson);

            $renderedBlocks = [];

            foreach ($editor->getBlocks() as $block) {

                $viewName = "laravel_editorjs::blocks." . Str::snake($block['type'], '-');

                if (!View::exists($viewName)) {
                    $viewName = 'laravel_editorjs::blocks.not-found';
                }

                $renderedBlocks[] = View::make($viewName, [
                    'type' => $block['type'],
                    'data' => $block['data']
                ])->render();
            }

            return implode($renderedBlocks);
        } catch (EditorJSException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
