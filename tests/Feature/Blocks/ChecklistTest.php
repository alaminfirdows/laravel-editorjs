<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class ChecklistTest extends TestCase
{
    protected function getBlockData()
    {
        return [
            'type' => 'checklist',
            'data' => [
                'items' => [
                    [
                        'text' => '<a href="https://githuh.com/lmottasin">LINK</a>',
                        'checked' => true,
                    ],
                    [
                        'text' => '<b>BOLD</b>',
                        'checked' => false,
                    ],
                    [
                        'text' => '<i>ITALIC</i>',
                        'checked' => false,
                    ],
                    [
                        'text' => 'PLAIN TEXT',
                        'checked' => false,
                    ],
                ],
            ],
        ];

    }

    protected function getBlockHtml()
    {
        return '<ul class="editorjs-checklist"> <li class="editorjs-checklist__item editorjs-checklist__item--checked"> <input class="editorjs-checklist__checkbox" type="checkbox" checked disabled> <span class="editorjs-checklist__text"><a href="https://githuh.com/lmottasin" target="_blank" rel="noreferrer noopener">LINK</a></span> </li> <li class="editorjs-checklist__item editorjs-checklist__item--unchecked"> <input class="editorjs-checklist__checkbox" type="checkbox" disabled> <span class="editorjs-checklist__text"><b>BOLD</b></span> </li> <li class="editorjs-checklist__item editorjs-checklist__item--unchecked"> <input class="editorjs-checklist__checkbox" type="checkbox" disabled> <span class="editorjs-checklist__text"><i>ITALIC</i></span> </li> <li class="editorjs-checklist__item editorjs-checklist__item--unchecked"> <input class="editorjs-checklist__checkbox" type="checkbox" disabled> <span class="editorjs-checklist__text">PLAIN TEXT</span> </li> </ul>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_checklist_block_test(): void
    {
        // This replaces any sequence of whitespace (including tabs and newlines) with a single space,
        // normalizing the formatting in both the expected and actual HTML strings.

        $expectedHtml = preg_replace('/\s+/', ' ', $this->getBlockHtml());
        $actualHtml = preg_replace('/\s+/', ' ', $this->renderBlocks($this->getEditorData([$this->getBlockData()])));

        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
