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
        return '<table class="table"> <tr> <th> Name </th> <th> Age </th> <th> City </th> </tr> <tr> <td> John Doe </td> <td> 30 </td> <td> New York </td> </tr> <tr> <td> Jane Smith </td> <td> 25 </td> <td> Los Angeles </td> </tr> </table>';
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
        $expectedHtml = '<table class="table"> <tr> <td> Name </td> <td> Age </td> <td> City </td> </tr> <tr> <td> John Doe </td> <td> 30 </td> <td> New York </td> </tr> <tr> <td> Jane Smith </td> <td> 25 </td> <td> Los Angeles </td> </tr> </table>';
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
        $expectedHtml = '<table class="table"> <tr> <th> Header 1 </th> <th> Header 2 </th> </tr> </table>';
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
        $expectedHtml = '<table class="table"> <tr> <td> A </td> <td> </td> <td> C </td> </tr> <tr> <td> </td> <td> E </td> <td> </td> </tr> <tr> <td> G </td> <td> H </td> <td> I </td> </tr> </table>';
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
        $expectedHtml = '<table class="table"> <tr> <th> <b>Bold Header</b> </th> <th> Normal Header </th> </tr> <tr> <td> <a href="#">Link</a> </td> <td> <i>Italic text</i> </td> </tr> </table>';
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
        $expectedHtml = '<table class="table"> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_table_missing_withHeadings_defaults_to_false_test(): void
    {
        // Arrange
        $blockData = [
            "type" => "table",
            "data" => [
                "content" => [
                    ["Col1", "Col2"],
                    ["Data1", "Data2"]
                ]
            ]
        ];
        $expectedHtml = '<table class="table"> <tr> <td> Col1 </td> <td> Col2 </td> </tr> <tr> <td> Data1 </td> <td> Data2 </td> </tr> </table>';
        $expectedHtml = preg_replace('/\s+/', ' ', $expectedHtml);
        
        // Act
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$blockData])));

        // Assert
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
