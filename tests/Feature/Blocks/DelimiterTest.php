<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DelimiterTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'delimiter',
            'data' => [],
        ];
    }

    protected function getBlockHtml()
    {
        return '<div class="editor-delimiter" style="text-align: center;">***</div>';
    }

    #[Test]
    public function render_delimiter_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_multiple_delimiter_blocks_test(): void
    {
        // Arrange
        $blocks = [
            $this->getBlockData(),
            $this->getBlockData(),
            $this->getBlockData(),
        ];
        $expectedHtml = str_repeat($this->getBlockHtml(), 3);
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData($blocks)));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
