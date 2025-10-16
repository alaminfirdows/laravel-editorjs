<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class HeaderTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "header",
            "data" => [
                "text" => "This is a Header",
                "level" => 2
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<h2 class="editorjs-header editorjs-header--level-2">This is a Header</h2>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_header_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_header_h1_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "header",
            "data" => [
                "text" => "Main Title",
                "level" => 1
            ]
        ];
    $expectedHtml = '<h1 class="editorjs-header editorjs-header--level-1">Main Title</h1>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_header_h3_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "header",
            "data" => [
                "text" => "Subtitle",
                "level" => 3
            ]
        ];
    $expectedHtml = '<h3 class="editorjs-header editorjs-header--level-3">Subtitle</h3>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_header_default_level_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "header",
            "data" => [
                "text" => "Default Header",
                "level" => 1
            ]
        ];
    $expectedHtml = '<h1 class="editorjs-header editorjs-header--level-1">Default Header</h1>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_header_empty_text_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "header",
            "data" => [
                "text" => "",
                "level" => 2
            ]
        ];
    $expectedHtml = '<h2 class="editorjs-header editorjs-header--level-2"></h2>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
