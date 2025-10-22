@php
$level = $data['level'] ?? 1;
$tag = "h{$level}";
@endphp

<{{ $tag }}>{!! editorjs_render_inline_code($data['text'] ?? '') !!}</{{ $tag }}>
