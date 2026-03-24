@php
$listType = $data['style'] ?? $data['type'] ?? 'unordered';
$tag = $listType === 'unordered' ? 'ul' : 'ol';

$renderItems = function($items, $style) use (&$renderItems) {
    $tag = $style === 'unordered' ? 'ul' : 'ol';
    $html = "<{$tag}>";
    
    foreach($items as $item) {
        $content = $item['content'] ?? $item;
        $meta = $item['meta'] ?? [];
        $subitems = $item['items'] ?? [];
        
        $checked = $meta['checked'] ?? false;
        $checkedAttr = ($style === 'checklist' && $checked) ? ' checked' : '';
        $inputType = ($style === 'checklist') ? '<input type="checkbox" disabled' . $checkedAttr . '> ' : '';
        
        $html .= "<li>";
        if ($style === 'checklist') {
            $html .= $inputType . $content;
        } else {
            $html .= $content;
        }
        
        if (!empty($subitems)) {
            $html .= $renderItems($subitems, $style);
        }
        
        $html .= "</li>";
    }
    
    $html .= "</{$tag}>";
    return $html;
};
@endphp

{!! $renderItems($data['items'], $listType) !!}
