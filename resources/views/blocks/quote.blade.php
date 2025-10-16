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

<blockquote class="editorjs-quote">
    <p class="editorjs-quote__text {{ $class }}">{{ $data['text'] }}</p>
    @if (!empty($data['caption']))
    <small class="editorjs-quote__caption {{ $class }}">— {{ $data['caption'] }}</small>
    @endif
</blockquote>
