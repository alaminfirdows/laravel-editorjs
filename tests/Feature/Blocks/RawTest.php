<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class RawTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "raw",
            "data" => [
                "html" => "<div class=\"custom-widget\">\n    <h3>Custom HTML Content</h3>\n    <p>This is raw HTML content.</p>\n</div>"
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> <div class="custom-widget"> <h3>Custom HTML Content</h3> <p>This is raw HTML content.</p> </div> </div>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_raw_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_raw_block_with_script_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "raw",
            "data" => [
                "html" => "<script>console.log('Hello World!');</script>"
            ]
        ];
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> <script>console.log(\'Hello World!\');</script> </div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_raw_block_with_complex_html_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "raw",
            "data" => [
                "html" => "<iframe src=\"https://example.com\" width=\"100%\" height=\"400\"></iframe>"
            ]
        ];
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> <iframe src="https://example.com" width="100%" height="400"></iframe> </div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_empty_raw_block_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "raw",
            "data" => [
                "html" => ""
            ]
        ];
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> </div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_raw_block_with_text_content_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "raw",
            "data" => [
                "html" => "Plain text content without HTML tags"
            ]
        ];
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> Plain text content without HTML tags </div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
