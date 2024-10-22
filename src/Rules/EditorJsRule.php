<?php

namespace AlAminFirdows\LaravelEditorJs\Rules;

use Closure;
use EditorJS\EditorJS;
use EditorJS\EditorJSException;
use Illuminate\Contracts\Validation\ValidationRule;

class EditorJsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            $fail('The :attribute must be a string.');
            return;
        }

        try {
            $decodedData = json_decode($value, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $fail('The :attribute must be a valid JSON string.');
                return;
            }

            if (!isset($decodedData['blocks']) || !is_array($decodedData['blocks'])) {
                $fail('The :attribute must contain a blocks array.');
                return;
            }

            $configJson = json_encode(config('laravel_editorjs.config') ?: []);
            new EditorJS($value, $configJson);

        } catch (EditorJSException $e) {
            $this->handleEditorJSException($e, $decodedData['blocks'] ?? [], $fail);
        }
    }

    /**
     * Handle EditorJS exceptions and call the fail closure with appropriate messages
     *
     * @param EditorJSException $e
     * @param array $blocks
     * @param Closure(string): void $fail
     */
    private function handleEditorJSException(EditorJSException $e, array $blocks, Closure $fail): void
    {
        $message = $e->getMessage();

        if (preg_match('/Tool `(.+)` not found/', $message, $matches)) {
            $invalidTool = $matches[1];
            $blockIndex = $this->findBlockIndex($blocks, $invalidTool);

            $fail("Block type '{$invalidTool}' is not supported" .
                ($blockIndex !== null ? " (found in block {$blockIndex})" : ""));

        } elseif (preg_match('/Not found required param `(.+)`/', $message, $matches)) {
            $missingParam = $matches[1];
            $location = $this->findParameterLocation($blocks, $missingParam);

            $errorMessage = "Missing required parameter '{$missingParam}'";
            if ($location) {
                $errorMessage .= " in block {$location['blockIndex']} (type: {$location['blockType']})";
            }

            $fail($errorMessage);

        } elseif (preg_match('/Found extra param `(.+)`/', $message, $matches)) {
            $extraParam = $matches[1];
            $location = $this->findParameterLocation($blocks, $extraParam);

            $errorMessage = "Unexpected parameter '{$extraParam}'";
            if ($location) {
                $errorMessage .= " in block {$location['blockIndex']} (type: {$location['blockType']})";
            }

            $fail($errorMessage);

        } else {
            $fail($message);
        }
    }

    /**
     * Find block index by type
     *
     * @param array $blocks
     * @param string $type
     * @return int|null
     */
    private function findBlockIndex(array $blocks, string $type): ?int
    {
        foreach ($blocks as $index => $block) {
            if (isset($block['type']) && $block['type'] === $type) {
                return $index;
            }
        }
        return null;
    }

    /**
     * Find parameter location in blocks
     *
     * @param array $blocks
     * @param string $param
     * @return array|null
     */
    private function findParameterLocation(array $blocks, string $param): ?array
    {
        foreach ($blocks as $index => $block) {
            if (isset($block['data']) && array_key_exists($param, $block['data'])) {
                return [
                    'blockIndex' => $index,
                    'blockType' => $block['type'] ?? 'unknown',
                ];
            }
        }
        return null;
    }
}
