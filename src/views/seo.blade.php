@php
if (isset($page) && $page && method_exists($page, 'getSeoMeta')) {
    $seo = $page->getSeoMeta();
} elseif (isset($seo) && $seo && is_array($seo) && isset($seo['title'])) {
    $seo = $seo;
} else {
    $seo = [
        'title' => config('app.name', 'Laravel'),
        'description' => null,
        'keywords' => null
    ];
}

if(!empty($seo['params'])){
    if(!empty($seo['params']->title_format)){
        $seo['title'] = str_replace(':text', $seo['title'], $seo['params']->title_format);
    }

}
@endphp

<title>{{ $seo['title'] }}</title>

@if(config('seo.seo_status'))
    @if(isset($seo['description']) && $seo['description'])
    <meta name="description" content="{{ $seo['description'] }}" />
    @endif
    @if(isset($seo['keywords']) && $seo['keywords'])
    <meta name="keywords" content="{{ $seo['keywords'] }}" />
    @endif
    @if(!empty($seo['title']))
    <meta property="og:title" content="{{ $seo['title'] }}" />
    <meta name="twitter:title" content="{{ $seo['title'] }}" />
    @endif
    @if(!empty($seo['description']))
    <meta property="og:description" content="{{ $seo['description'] }}" />
    <meta name="twitter:description" content="{{ $seo['description'] }}" />
    @endif
    @if(!empty($seo['image_path']))
    <meta property="og:image" content="{{ $seo['image_path'] }}" />
    <meta name="twitter:image" content="{{ $seo['image_path'] }}" />
    @endif
@else
<meta name="robots" content="{{ !empty($seo['follow_type']) && config('seo.seo_status') ? $seo['follow_type'] : 'noindex, nofollow' }}" />
@endif
