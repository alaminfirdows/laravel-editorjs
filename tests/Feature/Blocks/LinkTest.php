<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class LinkTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "linkTool",
            "data" => [
                "link" => "https://example.com",
                "meta" => [
                    "title" => "Example Website",
                    "description" => "This is an example website for testing purposes",
                    "image" => [
                        "url" => "https://example.com/image.jpg"
                    ]
                ]
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<a class="embed-link" href="https://example.com" target="_blank" rel="nofollow"> <img class="embed-link__image" src="https://example.com/image.jpg"> <div class="embed-link__title"> Example Website </div> <div class="embed-link__description"> This is an example website for testing purposes </div> <span class="embed-link__domain"> example.com </span> </a>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_link_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_link_without_image_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        unset($blockData['data']['meta']['image']);
        $expectedHtml = '<a class="embed-link" href="https://example.com" target="_blank" rel="nofollow"> <div class="embed-link__title"> Example Website </div> <div class="embed-link__description"> This is an example website for testing purposes </div> <span class="embed-link__domain"> example.com </span> </a>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_link_with_empty_image_url_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['meta']['image']['url'] = '';
        $expectedHtml = '<a class="embed-link" href="https://example.com" target="_blank" rel="nofollow"> <div class="embed-link__title"> Example Website </div> <div class="embed-link__description"> This is an example website for testing purposes </div> <span class="embed-link__domain"> example.com </span> </a>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_link_with_subdomain_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['link'] = 'https://blog.example.com/article';
        $expectedHtml = '<a class="embed-link" href="https://blog.example.com/article" target="_blank" rel="nofollow"> <img class="embed-link__image" src="https://example.com/image.jpg"> <div class="embed-link__title"> Example Website </div> <div class="embed-link__description"> This is an example website for testing purposes </div> <span class="embed-link__domain"> blog.example.com </span> </a>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_link_minimal_data_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "linkTool",
            "data" => [
                "link" => "https://minimal.com",
                "meta" => [
                    "title" => "Minimal Link",
                    "description" => "Basic description"
                ]
            ]
        ];
        $expectedHtml = '<a class="embed-link" href="https://minimal.com" target="_blank" rel="nofollow"> <div class="embed-link__title"> Minimal Link </div> <div class="embed-link__description"> Basic description </div> <span class="embed-link__domain"> minimal.com </span> </a>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
