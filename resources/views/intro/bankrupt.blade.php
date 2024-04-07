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
                            <h2>БАНКРОТСТВО</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">0000</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Заявитель</p>
                                <p class="black__text">Фамилия И.О.</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">Фамилия И.О.</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Конкурсный управляющий</p>
                                <p class="black__text">Фамилия И.О.</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Госпошлина</p>
                                <p class="black__text price">0000000</p>
                            </div>
                            <div class="flex">
                                <a class="ikon" href="{{ $url }}" target="_blank">
                                    <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                </a>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Депозит</p>
                                <p class="black__text price">0000000,0Р</p>
                            </div>
                        </div>

                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Стадии бакротства</p>
                                <p class="black__text">Недавние стадии</p>
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Дата окончания текущей стадии</p>
                                <p class="black__text">01.01.01</p>
                            </div>
                        </div>
                        <div class="gray__block requests courts__information">
                                      <div class="flex files text">
                                        <div>
                                            <p class="gray__text">Стратегия</p>
                                        </div>
                                        <div class="flex files__second">
                                        <!-- @if(isset($deal['UF_CRM_CONAD_CRD085'])) @foreach(explode($ex, $deal['UF_CRM_CONAD_CRD085']) as $url)         -->
                                            <a class="ikon" href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        <!-- @endforeach @else {{ $nd }} @endif -->
                                        </div>
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
                                        <p class="black__text">кредитор    кредитор кредитор кредитор   кредитор     кредитор кредитор  кредитор       кредитор кредитор    кредитор    кредитор  кредитор     кредитор   кредитор кредито</p>
                                    </div> 

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                            Стоймость имущества                                             </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                        
                                    </div>
                                    <div class="property none">
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">имущество должника 1 </p>
                                                <p class="black__text price">00000</p>
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
                                        <!-- @if(isset($deal['UF_CRM_CONAD_CRD118'])) @foreach($deal['UF_CRM_CONAD_CRD118'] as $info)         -->
                                            <div class="flex">
                                                <p class="gray__text">счет <span class="gray__text">000000</span></p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text">счет <span class="gray__text">000000</span></p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text">счет <span class="gray__text">000000</span></p>
                                            </div>
                                        <!-- @endforeach @else {{ $nd }} @endif -->
                                        </div>
                                    </div>

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                            Информация о признании сделок/платежей недействительными                                            </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>
                                    <div class="property check none">
                                        <div class="gray__block courts__information">
                                        <!-- @if(isset($deal['UF_CRM_CONAD_CRD118'])) @foreach($deal['UF_CRM_CONAD_CRD118'] as $info)         -->
                                            <div class="flex">
                                                <p class="gray__text">сделка <span class="gray__text">000000</span></p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text">платеж <span class="gray__text">000000</span></p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text">платеж <span class="gray__text">000000</span></p>
                                            </div>
                                        <!-- @endforeach @else {{ $nd }} @endif -->
                                        </div>
                                    </div>
                                    <div class="prohibitions flex">
                                        <h2>
                                        Информация об участии финансового управляющего на судебных заседаниях                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>

                                    <div class="property none">
                                        <p class="black__text property_desc">кредитор    кредитор кредитор кредитор   кредитор     кредитор кредитор  кредитор       кредитор кредитор    кредитор    кредитор  кредитор     кредитор   кредитор кредито</p>
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">Поступление денежных средств</p>
                                                <p class="black__text price">00000</p>
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text"> дата</p>
                                                <p class="black__text"></p>
                                            </div>
                                        </div>
                                        <div class="flex collector">
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Субсидированная ответственность</p>
                                                <p class="black__text">текст</p>
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Оценка имущества должностных лиц</p>
                                                <p class="black__text">00000</p>
                                            </div>
                                        </div>
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">Результат банкротства</p>
                                            </div>
                                            </div>
                                        <div class="gray__block courts__information total__price">
                                         <div class="flex">
                                            <p class="gray__text">
                                               Сумма оказанных юридических услуг
                                            </p>
                                            <p class="black__text price">00000</p>
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