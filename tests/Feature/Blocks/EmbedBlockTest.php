<?php

declare(strict_types=1);

namespace AlAminFirdows\LaravelEditorJs\Tests\Feature\Blocks;

use AlAminFirdows\LaravelEditorJs\Tests\TestCase;

class EmbedBlockTest extends TestCase
{
    /**
     * Get Youtube embed block data
     */
    protected function getYoutubeBlockData()
    {
        return [
            'type' => 'embed',
            'data' => [
                'service' => 'youtube',
                'source' => 'https://www.youtube.com/watch?v=kBH6HLuAq14',
                'embed' => 'https://www.youtube.com/embed/kBH6HLuAq14',
                'width' => 580,
                'height' => 320,
                'caption' => 'Test Caption',
            ],
        ];
    }

    /**
     * Get expected HTML for Youtube embed
     */
    protected function getYoutubeBlockHtml()
    {
        return '<div class="editorjs-embed"><div class="editorjs-embed__content editorjs-embed__content--youtube"><iframe class="editorjs-embed__iframe" width="580" height="320" src="https://www.youtube.com/embed/kBH6HLuAq14" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div><div class="editorjs-embed__caption">Test Caption</div></div>';
    }

    /**
     * Get Twitter embed block data
     */
    protected function getTwitterBlockData()
    {
        return [
            'type' => 'embed',
            'data' => [
                'service' => 'twitter',
                'source' => 'https://twitter.com/jack/status/20',
                'embed' => 'https://twitter.com/jack/status/20',
                'width' => 580,
                'height' => 320,
                'caption' => 'Test Twitter Caption',
            ],
        ];
    }

    /**
     * Get expected HTML for Twitter embed
     */
    protected function getTwitterBlockHtml()
    {
        return '<div class="editorjs-embed"><div class="editorjs-embed__content editorjs-embed__content--twitter"><div class="editorjs-embed__twitter"><blockquote class="twitter-tweet"><a href="https://twitter.com/jack/status/20"></a></blockquote><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div></div><div class="editorjs-embed__caption">Test Twitter Caption</div></div>';
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_youtube_embed_block_test(): void
    {
        $this->assertHtml(
            $this->renderBlocks($this->getEditorData([$this->getYoutubeBlockData()])),
            $this->getYoutubeBlockHtml()
        );
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_twitter_embed_block_test(): void
    {
        $this->assertHtml(
            $this->renderBlocks($this->getEditorData([$this->getTwitterBlockData()])),
            $this->getTwitterBlockHtml()
        );
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function render_embed_block_with_custom_dimensions_test(): void
    {
        $blockData = $this->getYoutubeBlockData();
        $blockData['data']['width'] = 800;
        $blockData['data']['height'] = 600;

        $expectedHtml = '<div class="editorjs-embed"><div class="editorjs-embed__content editorjs-embed__content--youtube"><iframe class="editorjs-embed__iframe" width="800" height="600" src="https://www.youtube.com/embed/kBH6HLuAq14" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div><div class="editorjs-embed__caption">Test Caption</div></div>';

        $this->assertHtml(
            $this->renderBlocks($this->getEditorData([$blockData])),
            $expectedHtml
        );
    }
}
