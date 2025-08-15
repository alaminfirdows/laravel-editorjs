<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class NotFoundTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "unknownBlock",
            "data" => [
                "someProperty" => "someValue"
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<p style="color: red">unknownBlock: Block Not Found!</p>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_unknown_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_different_unknown_block_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "customWidget",
            "data" => []
        ];
        $expectedHtml = '<p style="color: red">customWidget: Block Not Found!</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_multiple_unknown_blocks_test(): void
    {
        // Arrange
        $blocks = [
            [
                "type" => "unknownType1",
                "data" => []
            ],
            [
                "type" => "unknownType2", 
                "data" => []
            ]
        ];
        $expectedHtml = '<p style="color: red">unknownType1: Block Not Found!</p><p style="color: red">unknownType2: Block Not Found!</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData($blocks)));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_empty_type_block_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "",
            "data" => []
        ];
        $expectedHtml = '<p style="color: red">: Block Not Found!</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
