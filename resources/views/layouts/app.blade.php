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
</head>
<body>
<header id="head"></header>
<section><div></div>
  <div class="bar">
    <div class="bar__body">
        <span class="bar__body_title">Инстанции</span>
        <div class="bar__body__list">
            <a href="{{ route('front.home', ['deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i i_width50"><=</div></a>
@if(4 == $deal['CATEGORY_ID'])
            <a href="{{ route('front.home', ['tab' => 'mediation', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('mediation' == $_REQUEST['tab']) __list_i_check @endif">Медиация</div></a>
@elseif(6 == $deal['CATEGORY_ID'])
            <a href="{{ route('front.home', ['tab' => 'first_instance', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('first_instance' == $_REQUEST['tab']) __list_i_check @endif">Суды-Первая</div></a>
            <a href="{{ route('front.home', ['tab' => 'courts_appeal', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('courts_appeal' == $_REQUEST['tab']) __list_i_check @endif">Суды-Апелляционная</div></a>
            <a href="{{ route('front.home', ['tab' => 'courts_cassation', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('courts_cassation' == $_REQUEST['tab']) __list_i_check @endif">Суды-Кассационная</div></a>
            <a href="{{ route('front.home', ['tab' => 'courts_resumption', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('courts_resumption' == $_REQUEST['tab']) __list_i_check @endif" style="line-height: 20px;">Суды-Возобновление производства по делу</div></a>
@elseif(8 == $deal['CATEGORY_ID'])
            <a href="{{ route('front.home', ['tab' => 'bankruptcy', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('bankruptcy' == $_REQUEST['tab']) __list_i_check @endif">Банкротство</div></a>
@elseif(10 == $deal['CATEGORY_ID'])
            <a href="{{ route('front.home', ['tab' => 'bankruptcy', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('bankruptcy' == $_REQUEST['tab']) __list_i_check @endif">Банкротство</div></a>
@elseif(12 == $deal['CATEGORY_ID'])
            <a href="{{ route('front.home', ['tab' => 'enforcement_proceedings', 'deal_id' => $deal['ID']]) }}"><div class="bar__body__list_i @if('enforcement_proceedings' == $_REQUEST['tab']) __list_i_check @endif" style="line-height: 20px;">Исполнительное производство</div></a>
@else
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