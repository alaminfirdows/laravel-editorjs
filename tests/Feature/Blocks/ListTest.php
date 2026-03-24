<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ListTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'list',
            'data' => [
                'style' => 'unordered',
                'items' => [
                    'First item',
                    'Second item',
                    'Third item',
                ],
            ],
        ];
    }

    protected function getBlockHtml()
    {
        return '<ul> <li>First item</li> <li>Second item</li> <li>Third item</li> </ul>';
    }

    #[Test]
    public function render_unordered_list_block_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_ordered_list_block_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['style'] = 'ordered';
        $expectedHtml = '<ol> <li>First item</li> <li>Second item</li> <li>Third item</li> </ol>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_list_with_type_property_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'list',
            'data' => [
                'style' => 'ordered',
                'items' => [
                    'First item',
                    'Second item',
                ],
            ],
        ];
        $expectedHtml = '<ol> <li>First item</li> <li>Second item</li> </ol>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_list_default_style_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'list',
            'data' => [
                'style' => 'unordered',
                'items' => [
                    'Only item',
                ],
            ],
        ];
        $expectedHtml = '<ul> <li>Only item</li> </ul>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_empty_list_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'list',
            'data' => [
                'style' => 'unordered',
                'items' => [],
            ],
        ];
        $expectedHtml = '<ul> </ul>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[Test]
    public function render_list_with_html_content_test(): void
    {
        // Arrange
        $blockData = [
            'type' => 'list',
            'data' => [
                'style' => 'unordered',
                'items' => [
                    '<b>Bold item</b>',
                    '<i>Italic item</i>',
                    '<a href="https://example.com">Link item</a>',
                ],
            ],
        ];
        $expectedHtml = '<ul> <li>&lt;b&gt;Bold item&lt;/b&gt;</li> <li>&lt;i&gt;Italic item&lt;/i&gt;</li> <li>&lt;a href=&quot;https://example.com&quot; target=&quot;_blank&quot; rel=&quot;noreferrer noopener&quot;&gt;Link item&lt;/a&gt;</li> </ul>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);

        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
