<?php

use AlAminFirdows\LaravelEditorJs\LaravelEditorJs;

if (! function_exists('editorjs')) {
    /**
     * @return LaravelEditorJs
     */
    function editorjs()
    {
        return app(LaravelEditorJs::class);
    }
}

if (! function_exists('editorjs_render_inline_code')) {
    /**
     * Render text allowing only <span class="inline-code"> ... </span> tags; escape everything else.
     */
    function editorjs_render_inline_code(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }

        // Escape everything first
        $escaped = e($text);

        // Unescape ONLY <span class="inline-code"> and </span>
        // Convert the exact escaped opening tag back to real HTML
        $escaped = str_replace('&lt;/span&gt;', '</span>', $escaped);

        // Replace opening span with class="inline-code" only
        // Use a regex to match exactly class="inline-code" (order and spacing normalized by browser is irrelevant here as we control the output)
        $escaped = preg_replace(
            '/&lt;span\s+class=&quot;inline-code&quot;&gt;/i',
            '<span class="inline-code">',
            $escaped
        );

        return $escaped;
    }
}
