<ul class="editorjs-checklist">
    @foreach($data['items'] as $item)
        <li class="editorjs-checklist__item editorjs-checklist__item--{{ $item['checked'] ? 'checked' : 'unchecked' }}">
            <input class="editorjs-checklist__checkbox" type="checkbox" {{ $item['checked'] ? 'checked' : '' }} disabled>
            <span class="editorjs-checklist__text">{!! $item['text'] !!}</span>
        </li>
    @endforeach
</ul>

