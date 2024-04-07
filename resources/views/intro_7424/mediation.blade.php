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
                            <h2>МЕДИАЦИЯ</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">{{ $deal['UF_CRM_CONAD_CRD119'] ?? $nd }}</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Контакт должника</p>
                                <p class="black__text">
                                    {{ $deal['UF_CRM_CONAD_CRD086'] ?? $nd }}
                                </p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Стадия медиации</p>
{{-- Где взять стадию мидиации --}}                                
                                <p class="black__text">{{-- $deal[''] ?? $nd --}}</p>
{{-- Где взять стадию мидиации --}}                                
                            </div>
                        </div>

                        <div class="gray__block requests courts__information">
                            <div class="flex files text">
                                <div>
                                    <p class="gray__text">Процессуальное правопреемство</p>
                                    <p class="gray__text">дата определения АС</p>
                                    <p class="black__text">@if(isset($deal['UF_CRM_CONAD_CRD123']) && $deal['UF_CRM_CONAD_CRD123'] = is_date($deal['UF_CRM_CONAD_CRD123'])) {{ $deal['UF_CRM_CONAD_CRD123']->format('d.m.Y') }} @else {{ $nd }} @endif</p>
                                </div>
                                 
                                <div class="flex files__second">
                                @if(isset($deal['UF_CRM_CONAD_CRD085'])) @foreach(explode($ex, $deal['UF_CRM_CONAD_CRD085']) as $url)        
                                    <a href="{{ $url }}" target="_blank">
                                        <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                    </a>
                                @endforeach @else {{ $nd }} @endif
                                </div>
                            </div>
                        </div>

                        <div class="instances">
                            <div class="third__apellation appeal">
                                <div class="gray__block courts__information">
                                    <div class="flex">
                                        <div>
                                            <p class="gray__text">имущество должника</p>
                                            <p class="black__text">{{ $deal['UF_CRM_1686038365473'] ?? $nd }}</p>
                                        </div>
                                        <p class="black__text">{{ $deal['UF_CRM_1636705135040'] ?? $nd }}</p>
                                    </div>
                                </div>
                                <div class="gray__block requests courts__information">
                                    <div class="claim__header flex">
                                        <p class="gray__text">Стратегия</p>
                                        <p class="gray__text"></p>
                                    </div>
                                    <div class="flex files">
                                        <div class="flex files__first">
                                        </div>
                                        <div class="flex files__second">
                                        @if(isset($deal['UF_CRM_1686046817804'])) @foreach(explode($ex, $deal['UF_CRM_1686046817804']) as $url)        
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        @endforeach @else {{ $nd }} @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="gray__block courts__information">
                                    <div class="flex">
                                        <p class="gray__text">Расчет дисконта</p>
                                        <p class="black__text">{{ $deal['UF_CRM_CONAD_CRD087'] ?? $nd }}</p>
                                    </div>
                                    <div class="flex">
                                        <p class="gray__text">Рентабельность</p>
                                        <p class="black__text">{{ $deal['UF_CRM_CONAD_CRD120'] ?? $nd }}</p>
                                    </div>
                                </div>

                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Отчет о работе</p>
                                    @if(isset($deal['UF_CRM_CONAD_CRD088']))
                                    <div class="progress__bar">
                                        <div class="progress__bar__line">
                                            @foreach($deal['UF_CRM_CONAD_CRD088'] as $k => $d)
{{-- Переделать верстальщику class на числовой порядок --}}                                    
                                            <div class="progress__bar__line__{{ $k+1 }}">
{{-- Переделать верстальщику class на числовой порядок --}}                                    
{{-- Переделать верстальщику id на числовой порядок --}}
                                                <div id="{{ $k+1 }}_dot" class="progress__bar__dot {{ ((empty($k)) ? 'active' : '') }}"></div>
{{-- Переделать верстальщику id --}}                                       
                                                <p class="black__text">
                                                    {{ $d ?? $nd}} {{-- Отчет о работе --}}
                                                    <br>
                                                    {{--
                                                    Дата: @if(strlen($d ?? '') && $date = is_date($d)) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif
                                                    --}}
                                                </p>
                                            </div>
                                            <!--div class="progress__bar__line__2">
                                                <div id="2_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Отчет о работе
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__3">
                                                <div id="3_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Отчет о работе Отчет о работе
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__4">
                                                <div id="4_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    Отчет о работе
                                                    <br>
                                                    Дата: 01.01.23
                                                </p>
                                            </div-->
                                        @endforeach
                                        </div>
                                    </div>
                                    @else {{ $nd }} @endif 
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