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
        <div class="content main__page">

            @include('intro.header')

            <img class="logo mobile" src="/assets/img/svg/logo.svg" alt="">

            <div class="content__wrapper">
                <div class="main__links">
                    <div class="first__links" id="list_block_left">
                        <div class="content__wrapper__block report__block gray__block">
                            <p class="gray__text">Отчет по делу: </p>
                            <p class="blue__text">{{ $deal_id }}</p>
                        </div>
                        <a class="nav-link" href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'FI']) }}">
                            <div class="content__wrapper__block gray__block">
                                <div>
                                    <h2>СУДЫ</h2>
                                </div>
                                <div>
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </a>
                        <a class="nav-link" href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'IP']) }}">
                            <div class="content__wrapper__block gray__block">
                                <div>
                                    <h2>ИСПОЛНИТЕЛЬНОЕ ПРОИЗВОДСТВО</h2>
                                </div>
                                <div>
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="second__links" id="list_block_right">
                        <a class="nav-link" href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'BR']) }}">
                            <div class="content__wrapper__block gray__block">
                                <div>
                                    <h2>БАНКРОТСТВО</h2>
                                </div>
                                <div>
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </a>
                        <a class="nav-link" href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'MD']) }}">
                            <div class="content__wrapper__block gray__block">
                                <div>
                                    <h2>МЕДИАЦИЯ</h2>
                                </div>
                                <div>
                                    <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </a>

                        <a class="nav-link" href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'RE']) }}">
                            <div class="content__wrapper__block gray__block">
                                <div>
                                    <h2>ВОЗОБНОВЛЕНИЕ ПРОИЗВОДСТВА ПО ДЕЛУ</h2>
                                </div>
                                <div>
                                <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/assets/js/script.js"></script>
</body>
</html>