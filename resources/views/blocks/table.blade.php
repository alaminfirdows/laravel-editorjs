<table class="table">
    @foreach($data['content'] as $row)
    <tr>
        @php $tag = ($loop->first && $data['withHeadings']) ? 'th' : 'td'; @endphp

        @foreach($row as $cell)
        <{{ $tag }}> {!! editorjs_render_inline_code($cell) !!} </{{ $tag }}>
        @endforeach
    </tr>
    @endforeach
</table>
