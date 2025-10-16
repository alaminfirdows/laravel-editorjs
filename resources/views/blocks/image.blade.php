@php
$classes = '';
if ($data['stretched']){
$classes .= ' editorjs-image--stretched';
}
if ($data['withBorder']){
$classes .= ' editorjs-image--bordered';
}
if ($data['withBackground']){
$classes .= ' editorjs-image--backgrounded';
}
@endphp

<figure class="editorjs-image {{ $classes }}">
    <img class="editorjs-image__media" src="{{ $data['file']['url'] }}" alt="{{ $data['caption'] ?: '' }}">
    @if (!empty($data['caption']))
    <footer class="editorjs-image__caption">
        {{ $data['caption'] }}
    </footer>
    @endif
</figure>
