<a class="editorjs-link" href="{{ $data['link'] }}" target="_blank" rel="nofollow">
    @php $metaImageUrl = $data['meta']['image']['url'] ?? '' @endphp
    @if ($metaImageUrl)
    <img class="editorjs-link__image" src="{{ $metaImageUrl }}">
    @endif

    <div class="editorjs-link__title">
        {{ $data['meta']['title'] }}
    </div>

    <div class="editorjs-link__description">
        {{ $data['meta']['description'] }}
    </div>

    <span class="editorjs-link__domain">
        {{ parse_url($data['link'], PHP_URL_HOST)}}
    </span>
</a>
