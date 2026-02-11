@php
$listType = $data['style'] ?? $data['type'] ?? 'unordered';
$tag = $listType === 'unordered' ? 'ul' : 'ol';
@endphp

<{{ $tag }}>
    @foreach($data['items'] as $item)
    <li>{{ array_key_exists('content', $item) ? $item['content'] : $item }}</li>
    @endforeach
</{{ $tag }}>
