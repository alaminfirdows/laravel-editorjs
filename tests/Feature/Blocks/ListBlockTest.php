<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

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
        return '<ul>        <li>Hello</li>        <li>World</li>    </ul>';
    }

    #[Test]
    public function render_paragraph_block_test(): void
    {
        $this->assertEquals(
            $this->renderBlocks($this->getEditorData([$this->getBlockData()])),
            $this->getBlockHtml()
        );
    }
}
