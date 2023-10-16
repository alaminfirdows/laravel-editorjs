<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class ParagraphBlockTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'paragraph',
            'data' => [
                'text' => 'Hello world!',
            ],
        ];
    }

    protected function getBlockHtml()
    {
        return "<p>Hello world!</p>";
    }

    /** @test */
    public function render_paragraph_block_test(): void
    {
        $this->assertEquals(
            $this->renderBlocks($this->getEditorData([$this->getBlockData()])),
            $this->getBlockHtml()
        );
    }
}
