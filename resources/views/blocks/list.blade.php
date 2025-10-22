@php
$listType = $data['style'] ?? $data['type'] ?? 'unordered';
$tag = $listType === 'unordered' ? 'ul' : 'ol';
@endphp

<{{ $tag }}>
    @foreach($data['items'] as $item)
    <li>{!! editorjs_render_inline_code($item) !!}</li>
    @endforeach
</{{ $tag }}>
