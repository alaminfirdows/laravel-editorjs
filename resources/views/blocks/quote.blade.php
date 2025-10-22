@php
$class = '';

if('center' === $data['alignment']) {
$class = 'text-center';
} elseif('left' === $data['alignment']) {
$class = 'text-left';
} else {
$class = 'text-right';
}
@endphp

<blockquote class="editor-quote">
    <p class="{{ $class }}">{!! editorjs_render_inline_code($data['text'] ?? '') !!}</p>
    @if (!empty($data['caption']))
    <small class="{{ $class }}">— {!! editorjs_render_inline_code($data['caption']) !!}</small>
    @endif
</blockquote>
