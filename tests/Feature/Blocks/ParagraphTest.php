<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class ParagraphTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "paragraph",
            "data" => [
                "text" => "This is a simple paragraph with some text content."
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<p>This is a simple paragraph with some text content.</p>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_paragraph_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_paragraph_with_html_content_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "paragraph",
            "data" => [
                "text" => "This paragraph contains <b>bold</b>, <i>italic</i>, and <a href=\"https://example.com\">link</a> elements."
            ]
        ];
        $expectedHtml = '<p>This paragraph contains <b>bold</b>, <i>italic</i>, and <a href="https://example.com">link</a> elements.</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_empty_paragraph_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "paragraph",
            "data" => [
                "text" => ""
            ]
        ];
        $expectedHtml = '<p></p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_paragraph_with_line_breaks_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "paragraph",
            "data" => [
                "text" => "This is line one\nThis is line two\nThis is line three"
            ]
        ];
        $expectedHtml = '<p>This is line one This is line two This is line three</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_paragraph_with_special_characters_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "paragraph",
            "data" => [
                "text" => "Special chars: &amp; &lt; &gt; &quot; &#39;"
            ]
        ];
        $expectedHtml = '<p>Special chars: &amp; &lt; &gt; &quot; &#39;</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_multiple_paragraphs_test(): void
    {
        // Arrange
        $blocks = [
            [
                "type" => "paragraph",
                "data" => [
                    "text" => "First paragraph"
                ]
            ],
            [
                "type" => "paragraph",
                "data" => [
                    "text" => "Second paragraph"
                ]
            ]
        ];
        $expectedHtml = '<p>First paragraph</p><p>Second paragraph</p>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData($blocks)));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
