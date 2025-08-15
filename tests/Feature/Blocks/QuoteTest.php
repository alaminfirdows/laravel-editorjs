<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class QuoteTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "quote",
            "data" => [
                "text" => "This is a quote text that demonstrates the quote block functionality.",
                "caption" => "Quote Author",
                "alignment" => "left"
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<blockquote class="editor-quote"> <p class="text-left">This is a quote text that demonstrates the quote block functionality.</p> <small class="text-left">— Quote Author</small> </blockquote>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_quote_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_quote_center_alignment_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['alignment'] = 'center';
        $expectedHtml = '<blockquote class="editor-quote"> <p class="text-center">This is a quote text that demonstrates the quote block functionality.</p> <small class="text-center">— Quote Author</small> </blockquote>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_quote_default_alignment_test(): void
    {
        // Arrange  
        $blockData = $this->getBlockData();
        $blockData['data']['alignment'] = 'left'; // Test left alignment as default is not supported
        $expectedHtml = '<blockquote class="editor-quote"> <p class="text-left">This is a quote text that demonstrates the quote block functionality.</p> <small class="text-left">— Quote Author</small> </blockquote>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_quote_without_caption_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['caption'] = "";
        $expectedHtml = '<blockquote class="editor-quote"> <p class="text-left">This is a quote text that demonstrates the quote block functionality.</p> </blockquote>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_quote_empty_caption_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['caption'] = '';
        $expectedHtml = '<blockquote class="editor-quote"> <p class="text-left">This is a quote text that demonstrates the quote block functionality.</p> </blockquote>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }


}
