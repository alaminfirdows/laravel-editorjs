<?php

namespace AlAminFirdows\LaravelEditorJs;

use AlAminFirdows\LaravelEditorJs\Rules\EditorJsRule;
use EditorJS\EditorJS;
use EditorJS\EditorJSException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class LaravelEditorJs
{
    /**
     * Render blocks
     *
     * @param string $data
     * @return string
     * @throws Exception
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

    /**
     * Check if the data is valid
     *
     * @param string $data
     * @return bool
     */
    public function isValid(string $data): bool
    {
        $validator = Validator::make(['data' => $data], [
            'data' => ['required', 'string', new EditorJsRule]
        ]);

        if ($validator->passes()) {
            return true;
        }

        return false;
    }
}
