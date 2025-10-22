<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class WarningTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'warning',
            'data' => [
                'title' => 'Note:',
                'message' => 'Avoid using this method just for lulz. It can be very dangerous opposite your daily fun stuff.',
            ],
        ];
    }

    protected function getBlockHtml()
    {
        return '<div class="editorjs-warning"> <div class="editorjs-warning__title">Note:</div> <div class="editorjs-warning__message">Avoid using this method just for lulz. It can be very dangerous opposite your daily fun stuff.</div></div>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_with_html_tags_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['title'] = '<b>Important:</b>';
        $blockData['data']['message'] = 'This is a <i>critical</i> warning with <a href="#">links</a> and <code>code</code>.';
        $expectedHtml = '<div class="editorjs-warning"> <div class="editorjs-warning__title"><b>Important:</b></div> <div class="editorjs-warning__message">This is a <i>critical</i> warning with <a href="#">links</a> and <code>code</code>.</div></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_empty_title_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['title'] = '';
        $expectedHtml = '<div class="editorjs-warning"> <div class="editorjs-warning__title"></div> <div class="editorjs-warning__message">Avoid using this method just for lulz. It can be very dangerous opposite your daily fun stuff.</div></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_empty_message_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['message'] = '';
        $expectedHtml = '<div class="editorjs-warning"> <div class="editorjs-warning__title">Note:</div> <div class="editorjs-warning__message"></div></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_long_content_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['title'] = 'Very Long Warning Title That Should Still Render Properly';
        $blockData['data']['message'] = 'This is a very long warning message that contains multiple sentences and should test how the warning block handles longer content. It includes various punctuation marks, numbers like 123, and special characters like @#$%.';
        $expectedHtml = '<div class="editorjs-warning"> <div class="editorjs-warning__title">Very Long Warning Title That Should Still Render Properly</div> <div class="editorjs-warning__message">This is a very long warning message that contains multiple sentences and should test how the warning block handles longer content. It includes various punctuation marks, numbers like 123, and special characters like @#$%.</div></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_warning_with_special_characters_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['title'] = '⚠️ Warning!';
        $blockData['data']['message'] = 'This contains special characters: émojis 🚨, accents café, quotes "double" and \'single\', and symbols & < >.';
        $expectedHtml = '<div class="editorjs-warning"> <div class="editorjs-warning__title">⚠️ Warning!</div> <div class="editorjs-warning__message">This contains special characters: émojis 🚨, accents café, quotes "double" and \'single\', and symbols &amp; &lt; &gt;.</div></div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
