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
        return '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> &lt;div class=&quot;custom-widget&quot;&gt; &lt;h3&gt;Custom HTML Content&lt;/h3&gt; &lt;p&gt;This is raw HTML content.&lt;/p&gt;&lt;/div&gt;</div>';
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
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> &lt;script&gt;console.log(&#039;Hello World!&#039;);&lt;/script&gt;</div>';
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
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> &lt;iframe src=&quot;https://example.com&quot; width=&quot;100%&quot; height=&quot;400&quot;&gt;&lt;/iframe&gt;</div>';
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
        $expectedHtml = '<div style="min-height: 200px; background-color: #1e2128; font-family: Menlo, Monaco, Consolas, Courier New, monospace; font-size: 14px; line-height: 1.6; letter-spacing: -0.2px; color: #e2e2e2; padding: 10px 12px;"> Plain text content without HTML tags</div>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
