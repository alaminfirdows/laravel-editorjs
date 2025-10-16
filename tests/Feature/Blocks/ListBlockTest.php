<?php

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class ListBlockTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'list',
            'data' => [
                'style' => 'unordered',
                'items' => [
                    'Hello',
                    'World',
                ],
            ],
        ];
    }

    protected function getBlockHtml()
    {
        return "<ul class=\"editorjs-list editorjs-list--unordered\">        <li class=\"editorjs-list__item editorjs-list__item--odd\">Hello</li>        <li class=\"editorjs-list__item editorjs-list__item--even\">World</li>    </ul>";
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
