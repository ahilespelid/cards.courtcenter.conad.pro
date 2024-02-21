<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Суд</title>
</head>
<body>
    <main>
        <span id="top"></span>
        <div class="content">
            <div class="main_class proceedings content__wrapper">
                <div class="courts__left">
                    <div class="courts__left__header flex">
                        <a href="{{ route('front.up', ['deal_into_id' => $deal['ID'], 'tab' => 'index']) }}">
                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            <h2>ИСПОЛНИТЕЛЬНОЕ ПРОИЗВОДСТВО</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">@if(strlen($deal['UF_CRM_CONAD_CRD103'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD103'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Ссылка на дело в суде</p>
                                <p class="black__text">
                                    @if(strlen($deal['UF_CRM_CONAD_CRD059'] ?? '')) <a class="link" href="{{ $deal['UF_CRM_CONAD_CRD059'] }}">Перейти на сайт</a> @else {{ $nd }} @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Взыскатель</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD050'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD050'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD051'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD051'] }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Дата вступления решения в законную силу</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD052'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD052'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Срок для</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD053'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD053'] }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Сумма денежных требований</p>
                                <p class="black__text price">@if(strlen($deal['UF_CRM_CONAD_CRD054'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD054'] }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information proceeding__end">
                            <div class="flex">
                                <p class="gray__text">Дата окончания</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD075'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD075'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Причина окончания</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD104'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD104'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Сумма требования на момент постановления</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD105'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD105'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Дата окончания судебной процедуры</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD106'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD106'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information proceeding__end">
                            <div class="flex">
                                <p class="gray__text">
                                    Задолженность с учетом процентов на день взыскания
                                </p>
                                <p class="black__text price">
                                    @if(strlen($deal['UF_CRM_CONAD_CRD107'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD107'] }} @else {{ $nd }} @endif
                                </p>
                            </div>
                        </div>
                        <div class="instances">
                            <div class="third__apellation appeal">
                                <div class="gray__block requests courts__information">
                                    <div class="claim__header flex">
                                        <p class="gray__text">Запросы судебных приставов</p>
                                        <p class="gray__text">Ответ на запросы</p>
                                    </div>
                                    <div class="flex files">
                                        <div class="flex files__first">
                                        @if(count($deal['UF_CRM_CONAD_CRD108'] ?? [])) @foreach($deal['UF_CRM_CONAD_CRD108'] as $url)        
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                        <div class="flex files__second">
                                        @if(count($deal['UF_CRM_CONAD_CRD109'] ?? [])) @foreach($deal['UF_CRM_CONAD_CRD109'] as $url)        
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="gray__block requests courts__information">
                                    <div class="claim__header flex">
                                        <p class="gray__text">Стратегия</p>
                                        <p class="gray__text"></p>
                                    </div>
                                    <div class="flex files">
                                        <div class="flex files__first">
                                        @if(strlen($deal['UF_CRM_1686046817804'] ?? '')) @foreach(explode($ex, $deal['UF_CRM_1686046817804']) as $url)        
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                        <div class="flex files__second">
                                        @if(strlen($deal[''] ?? '')) @foreach(explode($ex, $deal['']) as $url)        
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Информация о ходе рассмотрения кассационной жалобы</p>
                                    @if(count($deal['UF_CRM_CONAD_CRD060'] ?? []))
                                    <div class="progress__bar">
                                        <div class="progress__bar__line">
                                            @foreach($deal['UF_CRM_CONAD_CRD060'] as $k => $d)
{{-- Переделать верстальщику class на числовой порядок --}}                                    
                                            <div class="progress__bar__line__first">
{{-- Переделать верстальщику class на числовой порядок --}}                                    
{{-- Переделать верстальщику id на числовой порядок --}}
                                                <div id="first_dot" class="progress__bar__dot {{ ((empty($k)) ? 'active' : '') }}"></div>
{{-- Переделать верстальщику id --}}                                       
                                                <p class="black__text">
                                                    Информация о ходе
                                                    <br>
                                                    Дата: @if(strlen($d ?? '') && $date = is_date($d)) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif
                                                </p>
                                            </div>
                                            <!--div class="progress__bar__line__second">
                                                <div id="second_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Информация о ходе
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__third">
                                                <div id="third_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Подачи исполнительного листа в ФССП
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__fourth">
                                                <div id="fourth_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Возбуждения исполнительного производства
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div-->
                                            @endforeach
                                        </div>
                                    </div>
                                    @else {{ $nd }} @endif 
                                </div>
                                <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Даты посещения судебного пристава-исполнителя</p>
                                    @if(count($deal['UF_CRM_CONAD_CRD062'] ?? [])) @foreach($deal['UF_CRM_CONAD_CRD062'] as $d)        
                                    <p class="gray__text">Дата: <span class="black__text">@if(strlen($d ?? '') && $date = is_date($d)) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</span></p>
                                    @endforeach @else {{ $nd }} @endif
                                </div>
                                <div class="instances">
                                    <div class="prohibitions flex">
                                        <h2>
                                            Аресты, запреты, обременения
                                            Сводные производства
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>

                                    <div class="arrest none">
                                    @if(strlen($deal['UF_CRM_CONAD_CRD085'] ?? ''))
                                    @php list($l, $r) = array_pad(explode($ex, $deal['UF_CRM_CONAD_CRD085']), 2, ''); @endphp        
                                        <div class="flex">
                                            <div class="gray__block courts__information">
                                                <p class="black__text">{{ $l }}</p>
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="black__text">{{ $r }}</p>
                                            </div>
                                        </div>
                                        <!--div class="flex">
                                            <div class="gray__block courts__information">
                                                <p class="black__text">Собственность</p>
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="black__text">Обременение</p>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <div class="gray__block courts__information">
                                                <p class="black__text">Что то и что то </p>
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="black__text">Что то</p>
                                            </div>
                                        </div-->
                                    @else {{ $nd }} @endif                                        
                                    </div> 

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                                Имущество должника
                                            </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                        <!--div class="prohibitions__desc">
                                            <p class="black__text"></p>
                                        </div-->
                                    </div>
                                    <div class="property none">
                                        <p class="black__text property_desc">
                                            @if(strlen($deal['UF_CRM_CONAD_CRD055'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD055'] }} @else {{ $nd }} @endif
                                        </p>
                                        <div class="flex courts__prices">
{{-- Верстальщику растянуть блок --}}                                 
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">                
                                                    Сумма
                                                </p>
                                                <p class="black__text price">@if(strlen($deal['UF_CRM_1636705135040'] ?? '')) {{ $deal['UF_CRM_1636705135040'] }} @else {{ $nd }} @endif</p>
                                            </div>
{{-- Верстальщику растянуть блок --}}                                            
                                            <!--div class="gray__block courts__information">
                                                <p class="gray__text">
                                                    Сумма имущества
                                                </p>
                                                <p class="black__text price">@if(strlen($deal[''] ?? '')) {{ $deal[''] }} @else {{ $nd }} @endif</p>
                                            </div-->
                                        </div>

                                        <div class="gray__block requests courts__information">
                                            <div class="flex files">
                                                <div class="flex files__first">
                                                    <p class="gray__text">Предложение взыскателю оставить имущество за собой</p>
                                                </div>
                                                <div class="flex files__second">
                                                @if(strlen($deal['UF_CRM_CONAD_CRD065'] ?? '')) @foreach(explode($ex, $deal['UF_CRM_CONAD_CRD065']) as $url)        
                                                    <a href="{{ $url }}" target="_blank">
                                                        <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                                    </a>
                                                @endforeach @else {{ $nd }} @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="gray__block courts__information total__price">
                                            <div class="flex">
                                                <p class="gray__text">
                                                    Сумма оказанных юридических услуг
                                                </p>
                                                <p class="black__text price">@if(strlen($deal['UF_CRM_CONAD_CRD072'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD072'] }} @else {{ $nd }} @endif</p>
                                            </div>
                                        </div>

                                        <div class="gray__block courts__information visit__dates">
                                            <p class="gray__text">Торги</p>
                                            <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD100'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD100'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                        </div>
                                        <div class="gray__block courts__information visit__dates">
                                            <p class="gray__text">Результат проведения торгов</p>
                                            <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD110'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD110'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                        </div>
                                        <div class="gray__block courts__information total__price">
                                            <div class="flex">
                                                <p class="gray__text">
                                                    Планируемая дата перечисления денежных средств
                                                </p>
                                                <p class="black__text price">@if(strlen($deal['UF_CRM_CONAD_CRD066'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD066'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                            </div>
                                        </div>

                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text mw-300">Дата поступления денежных средств ИП взыскателю</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD068'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD068'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text mw-300">Дата завершения исполнительного производства</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD069'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD069'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text mw-300">Дата окончания следующей подачи исполнительного листа</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD070'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD070'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text mw-300">Основание окончания исполнительного производства</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD071 '] ?? '')) <a href="{{ $deal['UF_CRM_CONAD_CRD071 '] }}" target="_blank">Основание</a> @else Основание @endif</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="closing__arrow">
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/assets/js/script.js"></script>
</body>
</html>