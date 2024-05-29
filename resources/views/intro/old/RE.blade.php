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
        <div class="content main__page">@include('intro.header')
            <div class="main_class proceedings content__wrapper">
                <div class="courts__left">
                    <div class="courts__left__header flex">
                        <a href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'index']) }}">
                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            <h2>ВОЗОБНОВЛЕНИЕ ПРОИЗВОДСТВА ПО ДЕЛУ</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Инициатор</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD090'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Стадия возобновления дела</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD145'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                         <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Причина возобновления дела</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD089'])) ? $nd : $html !!}</p>
                            </div>
                        </div>

                        <div class="gray__block requests courts__information">
                            <div class="flex files text">
                                <div class="flex files__first">
                                    <p class="gray__text">Стратегия</p>
                                </div>
                                <div class="flex files__second">
                                    {!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}
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