<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description')">
    
        <title>@yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="/assets/css/app.css?<?=time();?>"/>
        <!-- Script -->
        <script src="//api.bitrix24.com/api/v1/"></script>
        <script src="/assets/js/app.js?<?=time();?>"></script>
        <script src="/assets/js/autosize.min.js?<?=time();?>"></script>
</head>
<body>
<header id="head"></header>
<section><div></div>
  <div class="bar">
    <div class="bar__body">
        <span class="bar__body_title">Инстанции</span>
        <div class="bar__body__list">
            <a href="{{ route('front.index', ['deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i i_width50"><=</div></a>
@if(isset($category_id))
@if(4 == $category_id)
            <a href="{{ route('front.index', ['instance' => 'MD', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('MD' == $instance) __list_i_check @endif">Медиация</div></a>
@elseif(6 == $category_id)
            <a href="{{ route('front.index', ['instance' => 'FI', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('FI' == $instance) __list_i_check @endif">Первая Инстанция</div></a>
            <a href="{{ route('front.index', ['instance' => 'AI', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('AI' == $instance) __list_i_check @endif" style="line-height: 20px;">Апелляционная Инстанция</div></a>
            <a href="{{ route('front.index', ['instance' => 'CI', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('CI' == $instance) __list_i_check @endif" style="line-height: 20px;">Кассационная<br>Инстанция</div></a>
            <a href="{{ route('front.index', ['instance' => 'RE', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('RE' == $instance) __list_i_check @endif" style="line-height: 20px;">Возобновление производства по делу</div></a>
@elseif(8 == $category_id)
            <a href="{{ route('front.index', ['instance' => 'BR', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('BR' == $instance) __list_i_check @endif">Банкротство</div></a>
@elseif(10 == $category_id)
            <a href="{{ route('front.index', ['instance' => 'BR', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('BR' == $instance) __list_i_check @endif">Банкротство</div></a>
@elseif(12 == $category_id)
            <a href="{{ route('front.index', ['instance' => 'IP', 'deal_id' => $deal_id ?? '']) }}"><div class="bar__body__list_i @if('IP' == $instance) __list_i_check @endif" style="line-height: 20px;">Исполнительное производство</div></a>
@else
@endif
@endif
        </div>
    </div>
  </div><div></div><div></div>
  <div class="content">
        @yield('content')
        <footer>@yield('footer')</footer>
  </div><div></div>
</section>
</body>
