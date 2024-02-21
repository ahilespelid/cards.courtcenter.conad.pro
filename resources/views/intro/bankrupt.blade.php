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
                            <h2>БАНКРОТСТВО</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">

                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">@if(strlen($deal['UF_CRM_CONAD_CRD111'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD111'] }} @else {{ $nd }} @endif</p>
                                
                            </div>
                            <div class="flex">
                                <p class="gray__text">Ссылка на дело в суде</p>
                                <p class="black__text">
                                    <a class="link" href="#">
                                        Перейти на сайт
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Заявитель</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD112'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD112'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD113'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD113'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Конкурсный управляющий</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD114'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD114'] }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Госпошлина</p>
                                <p class="black__text price">@if(strlen($deal['UF_CRM_CONAD_CRD073'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD073'] }} @else {{ $nd }} @endif</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Депозит</p>
                                <p class="black__text price">@if(strlen($deal['UF_CRM_1679485736362'] ?? '')) {{ $deal['UF_CRM_1679485736362'] }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>

                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Стадии бакротства</p>
{{-- Где взять Недавние стадии --}}                                
                                <p class="black__text">@if(strlen($deal[''] ?? '')) {{ $deal[''] }} @else {{ $nd }} @endif</p>
{{-- Где взять Недавние стадии --}}                                
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Дата окончания текущей стадии</p>
                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD075'] ?? '') && $date = is_date($deal['UF_CRM_CONAD_CRD075'])) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                            </div>
                        </div>

                        <div class="instances">
                            <div class="third__apellation appeal">
                                <div class="instances">

                                    <div class="prohibitions flex">
                                        <h2>
                                            Информация о кредиторах
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>

                                    <div class="none">
                                        <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD115'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD115'] }} @else {{ $nd }} @endif</p>
                                    </div> 

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                                Информация об имуществе должника  и его оценка
                                            </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>

                                    <div class="property none">

                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">@if(strlen($deal['UF_CRM_1686038365473'] ?? '')) {{ $deal['UF_CRM_1686038365473'] }} @else {{ $nd }} @endif</p>
                                                <p class="black__text price">@if(strlen($deal['UF_CRM_1636705135040'] ?? '')) {{ $deal['UF_CRM_1636705135040'] }} @else {{ $nd }} @endif</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                                Информация о банковских счетах должника
                                            </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>

                                    <div class="property check none">
                                        <div class="gray__block courts__information">
                                        @if(count($deal['UF_CRM_CONAD_CRD118'] ?? [])) @foreach($deal['UF_CRM_CONAD_CRD118'] as $info)        
                                            <div class="flex">
                                                <p class="gray__text">{{ $info }}</p>
                                            </div>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                    </div>

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                                Информация о признании сделок/платежей недействительными
                                            </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>

                                    <div class="property invalid none">
                                        <div class="gray__block courts__information">
                                            @if(count($deal['UF_CRM_CONAD_CRD118'] ?? [])) @foreach($deal['UF_CRM_CONAD_CRD118'] as $info)
                                            @php list($n, $d) = array_pad(explode($ex, $info), 2, ''); @endphp
                                            <div class="flex">
                                                <p class="gray__text">@if(strlen($n ?? '')) {{ $n }} @else {{ $nd }} @endif</p>
                                                <div class="text-end">
                                                    <p class="black__text">недейств.</p>
                                                    <p class="gray__text">@if(strlen($d ?? '') && $date = is_date($d)) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                                </div>
                                            </div>
                                            @endforeach @else {{ $nd }} @endif
                                        </div>

                                        <div class="gray__block courts__information">
                                            <p class="gray__text">
                                                Платежи
                                            </p>
                                            @if(strlen($deal['UF_CRM_CONAD_CRD116'] ?? '')) 
                                            @php list($n, $s) = array_pad(explode($ex, $deal['UF_CRM_CONAD_CRD116']), 2, ''); @endphp
                                            <div class="flex mt-10">
                                                <p class="gray__text">@if(strlen($n ?? '')) {{ $n }} @else {{ $nd }} @endif</p>
                                                <p class="black__text price text-end">@if(strlen($s ?? '')) {{ $s }} @else {{ $nd }} @endif</p>
                                            </div>
                                            @else {{ $nd }} @endif
                                        </div>

                                        <div class="flex collector">
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Субсидированная ответственность</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD081'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD081'] }} @else {{ $nd }} @endif</p>
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Оценка имущества должностных лиц</p>
                                                <p class="black__text">@if(strlen($deal['UF_CRM_CONAD_CRD082'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD082'] }} @else {{ $nd }} @endif</p>
                                            </div>
                                        </div>

                                        <div class="gray__block requests courts__information">
                                            <div class="flex files text">
                                                <p class="gray__text">Результат банкротства</p>
                                                                                            
                                                <div class="flex files__second">
                                                @if(strlen($deal['UF_CRM_CONAD_CRD083'] ?? '')) @foreach(explode($ex, $deal['UF_CRM_CONAD_CRD083']) as $url)        
                                                    <a href="{{ $url }}" target="_blank">
                                                        <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                                    </a>
                                                @endforeach @else {{ $nd }} @endif
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gray__block courts__information total__price">
                                        <div class="flex">
                                            <p class="gray__text">
                                                Сумма оказанных юридических услуг
                                            </p>
                                            <p class="black__text price">@if(strlen($deal['UF_CRM_CONAD_CRD084'] ?? '')) {{ $deal['UF_CRM_CONAD_CRD084'] }} @else {{ $nd }} @endif</p>
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