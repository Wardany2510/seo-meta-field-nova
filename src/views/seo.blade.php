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

@if(isset($seo['title']))
  <title>{{ $seo['title'] }}</title>
<meta name="twitter:title" content="{{ $seo['title'] }}">
<meta property="og:title" content="{{ $seo['title'] }}" />
@endif
<meta name="twitter:site" content="{{config('app.name', 'Laravel')}}">
<meta property="og:site_name" content="{{config('app.name', 'Laravel')}}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{request()->path()}}" />
@if(config('seo.seo_status'))
    @if(isset($seo['description']) && $seo['description'])
    <meta name="description" content="{{ $seo['description'] }}" />
    <meta property="og:description" content="{{ $seo['description'] }}" />
    <meta name="twitter:description" content="{{ $seo['description'] }}" />
    <meta name="twitter:card" content="{{ $seo['description'] }}">
    @endif
    @if(isset($seo['keywords']) && $seo['keywords'])
    <meta name="keywords" content="{{ $seo['keywords'] }}" />
    <meta property="article:tag" content="{{ $seo['keywords'] }}" />
    @endif
    @if(!empty($seo['title']))
    <meta property="og:title" content="{{ $seo['title'] }}" />
    <meta name="twitter:title" content="{{ $seo['title'] }}" />
    @endif
    @if(!empty($seo['image_path']))
    <meta property="og:image" content="{{ $seo['image_path'] }}" />
    <meta name="twitter:image" content="{{ $seo['image_path'] }}" />
    <meta name="twitter:image:src" content="{{ $seo['image_path'] }}">
<-- Twitter Summary card images must be at least 120x120px -->
    @endif

   

@else
<meta name="robots" content="{{ !empty($seo['follow_type']) && config('seo.seo_status') ? $seo['follow_type'] : 'noindex, nofollow' }}" />
@endif
