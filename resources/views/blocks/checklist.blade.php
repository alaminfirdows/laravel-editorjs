<ul>
    @foreach($data['items'] as $item)
        <li>
            <input type="checkbox" {{ $item['checked'] ? 'checked' : '' }} disabled>
            <span>{!! editorjs_render_inline_code($item['text'] ?? '') !!}</span>
        </li>
    @endforeach
</ul>

