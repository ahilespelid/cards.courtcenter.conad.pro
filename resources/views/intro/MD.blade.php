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
                            <h2>МЕДИАЦИЯ</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Контакт должника</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD086'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Стадия медиации</p>     
                                <p class="black__text">{!! empty($html = rr($data['STAGE'])) ? $nd : $html !!}</p><!-- название стадии сделки -->                               
                            </div>
                        </div>

                        <div class="gray__block requests courts__information">
                            <div class="flex files text">
                                <div>
                                    <p class="gray__text">Процессуальное правопреемство</p>
                                    <p class="gray__text">(дата определения АС)</p>
                                </div>
                                <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_CONAD_CRD085'])) ? $nd : $html !!}</div>
                            </div>
                        </div>
                        </div>
                        </div>

                        <div class="courts__right">
                            <div class="third__apellation appeal">
                                <div class="gray__block courts__information">
                                    <div class="flex">
                                        <div>
                                            <p class="gray__text">Стоймость имущества</p>
                                            <p class="black__text">{!! empty($html = rr($data['UF_CRM_1686038365473'])) ? $nd : $html !!}</p>
                                        </div>
                                        <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1636705135040'])) ? $nd : $html !!}</p> 
                                    </div>
                                </div>
                                <div class="gray__block requests courts__information">
                                    <div class="flex files text">
                                        <div><p class="gray__text">Стратегия</p></div>
                                        <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                    </div>
                                </div>
                                <div class="gray__block courts__information">
                                    <div class="flex">
                                        <p class="gray__text">Расчет дисконта</p>
                                        <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD087'])) ? $nd : $html !!}</p>
                                    </div>
                                    <div class="flex">
                                        <p class="gray__text">Рентабельность</p>
                                        <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD144'])) ? $nd : $html !!}</p>
                                    </div>
                                </div>

                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Отчет о работе</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD088'])) ? $nd : $html !!}
                                </div>
                                <div class="closing__arrow closing__arrow_mobile">
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </main>
    <script src="/assets/js/script.js"></script>
</body>
</html>