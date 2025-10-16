<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class TableTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            "type" => "table",
            "data" => [
                "withHeadings" => true,
                "content" => [
                    ["Name", "Age", "City"],
                    ["John Doe", "30", "New York"],
                    ["Jane Smith", "25", "Los Angeles"]
                ]
            ]
        ];
    }

    protected function getBlockHtml()
    {
        return '<table class="editorjs-table"> <tr class="editorjs-table__row"> <th class="editorjs-table__cell"> Name </th> <th class="editorjs-table__cell"> Age </th> <th class="editorjs-table__cell"> City </th> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> John Doe </td> <td class="editorjs-table__cell"> 30 </td> <td class="editorjs-table__cell"> New York </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> Jane Smith </td> <td class="editorjs-table__cell"> 25 </td> <td class="editorjs-table__cell"> Los Angeles </td> </tr> </table>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_with_headings_test(): void
    {
        // Arrange
        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_without_headings_test(): void
    {
        // Arrange
        $blockData = $this->getBlockData();
        $blockData['data']['withHeadings'] = false;
    $expectedHtml = '<table class="editorjs-table"> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> Name </td> <td class="editorjs-table__cell"> Age </td> <td class="editorjs-table__cell"> City </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> John Doe </td> <td class="editorjs-table__cell"> 30 </td> <td class="editorjs-table__cell"> New York </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> Jane Smith </td> <td class="editorjs-table__cell"> 25 </td> <td class="editorjs-table__cell"> Los Angeles </td> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_single_row_table_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "withHeadings" => true,
                "content" => [
                    ["Header 1", "Header 2"]
                ]
            ]
        ];
    $expectedHtml = '<table class="editorjs-table"> <tr class="editorjs-table__row"> <th class="editorjs-table__cell"> Header 1 </th> <th class="editorjs-table__cell"> Header 2 </th> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_with_empty_cells_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "withHeadings" => false,
                "content" => [
                    ["A", "", "C"],
                    ["", "E", ""],
                    ["G", "H", "I"]
                ]
            ]
        ];
    $expectedHtml = '<table class="editorjs-table"> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> A </td> <td class="editorjs-table__cell"> </td> <td class="editorjs-table__cell"> C </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> </td> <td class="editorjs-table__cell"> E </td> <td class="editorjs-table__cell"> </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> G </td> <td class="editorjs-table__cell"> H </td> <td class="editorjs-table__cell"> I </td> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_with_html_content_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "withHeadings" => true,
                "content" => [
                    ["<b>Bold Header</b>", "Normal Header"],
                    ["<a href=\"#\">Link</a>", "<i>Italic text</i>"]
                ]
            ]
        ];
    $expectedHtml = '<table class="editorjs-table"> <tr class="editorjs-table__row"> <th class="editorjs-table__cell"> &lt;b&gt;Bold Header&lt;/b&gt; </th> <th class="editorjs-table__cell"> Normal Header </th> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> &lt;a href=&quot;#&quot;&gt;Link&lt;/a&gt; </td> <td class="editorjs-table__cell"> &lt;i&gt;Italic text&lt;/i&gt; </td> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_empty_table_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "withHeadings" => false,
                "content" => []
            ]
        ];
    $expectedHtml = '<table class="editorjs-table"> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_with_default_withHeadings_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "withHeadings" => false,
                "content" => [
                    ["Col1", "Col2"],
                    ["Data1", "Data2"]
                ]
            ]
        ];
    $expectedHtml = '<table class="editorjs-table"> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> Col1 </td> <td class="editorjs-table__cell"> Col2 </td> </tr> <tr class="editorjs-table__row"> <td class="editorjs-table__cell"> Data1 </td> <td class="editorjs-table__cell"> Data2 </td> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
