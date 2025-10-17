<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class CodeTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'code',
            'data' => [
                'code' => "<?php\n\necho 'Hello World!';\n\n// This is a comment\nfunction test() {\n    return true;\n}",
            ],
        ];
    }

    protected function getBlockHtml()
    {
        return '<div class="editorjs-code"> <code class="editorjs-code__content">&amp;lt;?phpecho &amp;#039;Hello World!&amp;#039;;// This is a commentfunction test() { return true;}</code></div>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_code_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_code_block_with_special_characters_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'code',
            'data' => [
                'code' => "<script>alert('XSS');</script>\n&amp; special chars",
            ],
        ];
        $expectedHtml = '<div class="editorjs-code"> <code class="editorjs-code__content">&amp;lt;script&amp;gt;alert(&amp;#039;XSS&amp;#039;);&amp;lt;/script&amp;gt;&amp;amp;amp; special chars</code></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_empty_code_block_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'code',
            'data' => [
                'code' => '',
            ],
        ];
        $expectedHtml = '<div class="editorjs-code"> <code class="editorjs-code__content"></code></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
