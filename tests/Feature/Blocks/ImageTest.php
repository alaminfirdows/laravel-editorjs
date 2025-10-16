<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class ImageTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "image",
            "data" => [
                "file" => [
                    "url" => "https://example.com/image.jpg"
                ],
                "caption" => "Sample image caption",
                "withBorder" => false,
                "stretched" => false,
                "withBackground" => false
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<figure class="editorjs-image "> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt="Sample image caption"> <footer class="editorjs-image__caption"> Sample image caption </footer> </figure>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_with_border_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['withBorder'] = true;
    $expectedHtml = '<figure class="editorjs-image editorjs-image--bordered"> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt="Sample image caption"> <footer class="editorjs-image__caption"> Sample image caption </footer> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_stretched_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['stretched'] = true;
    $expectedHtml = '<figure class="editorjs-image editorjs-image--stretched"> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt="Sample image caption"> <footer class="editorjs-image__caption"> Sample image caption </footer> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_with_background_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['withBackground'] = true;
    $expectedHtml = '<figure class="editorjs-image editorjs-image--backgrounded"> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt="Sample image caption"> <footer class="editorjs-image__caption"> Sample image caption </footer> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_all_options_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['withBorder'] = true;
        $blockData['data']['stretched'] = true;
        $blockData['data']['withBackground'] = true;
    $expectedHtml = '<figure class="editorjs-image editorjs-image--stretched editorjs-image--bordered editorjs-image--backgrounded"> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt="Sample image caption"> <footer class="editorjs-image__caption"> Sample image caption </footer> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_without_caption_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['caption'] = "";
    $expectedHtml = '<figure class="editorjs-image "> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt=""> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_image_empty_caption_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['caption'] = '';
    $expectedHtml = '<figure class="editorjs-image "> <img class="editorjs-image__media" src="https://example.com/image.jpg" alt=""> </figure>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
