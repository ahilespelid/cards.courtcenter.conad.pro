<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css?time=<?=time();?>">
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
                            <h2>ВОЗОБНОВЛЕНИЕ ПРОИЗВОДСТВА ПО ДЕЛУ</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Инициатор</p>
                                <p class="black__text">
                                   тест
                                </p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Стадия возобновления дела</p>
                                <p class="black__text">тест</p>
                            </div>
                        </div>
                         <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Причина возобновления дела</p>
                                <p class="black__text">тест</p>
                            </div>
                        </div>

                        <div class="gray__block requests courts__information">
                            <div class="flex files text">
                                <div class="flex files__first">
                                    <p class="gray__text">Стратегия</p>
                                </div>
                                <div class="flex files__second">
                                <!-- @if(isset($deal['UF_CRM_1686046817804'])) @foreach(explode($ex, $deal['UF_CRM_1686046817804']) as $url)         -->
                                    <a class="ikon" href="{{ $url }}" target="_blank">
                                        <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                    </a>
                                <!-- @endforeach @else {{ $nd }} @endif -->
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