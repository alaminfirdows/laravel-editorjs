<table class="editorjs-table">
    @foreach($data['content'] as $row)
    <tr class="editorjs-table__row">
        @php $tag = ($loop->first && $data['withHeadings']) ? 'th' : 'td'; @endphp

        @foreach($row as $cell)
        <{{ $tag }} class="editorjs-table__cell"> {{ $cell }} </{{ $tag }}>
        @endforeach
    </tr>
    @endforeach
</table>
