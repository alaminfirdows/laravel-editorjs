@php
$level = $data['level'] ?? 1;
$tag = "h{$level}";
@endphp

<{{ $tag }} class="editorjs-header editorjs-header--level-{{ $level }}">{{ $data['text'] ?? '' }}</{{ $tag }}>
