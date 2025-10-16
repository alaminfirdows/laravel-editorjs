@php
$listType = $data['style'] ?? $data['type'] ?? 'unordered';
$tag = $listType === 'unordered' ? 'ul' : 'ol';
@endphp

<{{ $tag }} class="editorjs-list editorjs-list--{{ $listType }}">
    @foreach($data['items'] as $item)
    <li class="editorjs-list__item editorjs-list__item--{{ $loop->odd ? 'odd' : 'even' }}">{{ $item }}</li>
    @endforeach
</{{ $tag }}>
