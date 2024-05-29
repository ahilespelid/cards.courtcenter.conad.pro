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
                            <h2>БАНКРОТСТВО</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD111'])) ? $nd : (empty($link = rr($data['UF_CRM_CONAD_CRD143'])) ? $html : '<a target="_blank" href="'.$link.'">'.$html.'</a>') !!}
                                </p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Заявитель</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD140'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD141'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Конкурсный управляющий</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD142'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Госпошлина</p>
                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD073'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="flex">{!! empty($html = rr($data['UF_CRM_CONAD_CRD074'])) ? $nd : $html !!}</div>
                            <div class="flex">
                                <p class="gray__text">Депозит</p>
                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1679485736362'])) ? $nd : $html !!}</p>
                            </div>
                        </div>

                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Стадии бакротства</p>
                                <p class="black__text">{!! empty($html = rr($data['STAGE'])) ? $nd : $html !!}</p> <!-- Название стадии сделки -->
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Дата окончания текущей стадии</p>  
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD075'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block requests courts__information">
                            <div class="flex files text">
                                <div>
                                    <p class="gray__text">Стратегия</p>
                                </div>
                                <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                            </div>
                                </div>
                                </div>
                                </div>
                                
                        <div class="courts__right">
                            <div class="third__apellation appeal">
                                <div class="instances">

                                    <div class="prohibitions flex">
                                        <h2>Информация о кредиторах</h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                    <div class="none">
                                        <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD115'])) ? $nd : $html !!}</p>
                                    </div> 

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>Стоимость имущества</h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>
                                    <div class="property none">
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">имущество должника 1</p>
                                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1636705135040'])) ? $nd : $html !!}</p>
                                {!! empty($html = rr($data['UF_CRM_1686038365473'])) ? $nd : $html !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>Информация о банковских счетах должника</h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>

                                    <div class="property check none">
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">счет <span class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD076'])) ? $nd : $html !!}</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>Информация о признании сделок/платежей недействительными</h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>
                                    <div class="property check none">
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">сделка <span class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD077'])) ? $nd : $html !!}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="prohibitions flex">
                                        <h2>Информация об участии финансового управляющего на судебных заседаниях</h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>

                                    <div class="property none">
                                        <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD078'])) ? $nd : $html !!}</p>                                        
                                
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">Поступление денежных средств</p>
                                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD079'])) ? $nd : $html !!}</p>
                                
                                            </div>
                                            <div class="flex">
                                                <p class="gray__text">дата</p>
                                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD080'])) ? $nd : $html !!}</p>
                                
                                            </div>
                                        </div>
                                        <div class="flex collector">
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Субсидированная ответственность</p>
                                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD081'])) ? $nd : $html !!}</p>
                                
                                            </div>
                                            <div class="gray__block courts__information">
                                                <p class="gray__text">Оценка имущества должностных лиц</p>
                                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD082'])) ? $nd : $html !!}</p>
                                
                                            </div>
                                        </div>
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="gray__text">Результат банкротства</p>
                                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD083'])) ? $nd : $html !!}</p>
                                
                                            </div>
                                            </div>
                                        <div class="gray__block courts__information total__price">
                                         <div class="flex">
                                            <p class="gray__text">
                                               Сумма оказанных юридических услуг
                                            </p>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD084'])) ? $nd : $html !!}</p>
                                         </div>
                                   </div>
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
