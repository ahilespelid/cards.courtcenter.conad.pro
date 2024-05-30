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
                            <h2>ИСПОЛНИТЕЛЬНОЕ ПРОИЗВОДСТВО</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Номер дела</p>
                                <p class="blue__text">
                                {!! (empty($link = rr($data['UF_CRM_CONAD_CRD059'])) ? $nd : '<a target="_blank" href="'.$link.'">ССЫЛКА</a>') !!}
                                </p>
                            </div>
                        </div>
                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Взыскатель</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD050'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD051'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="gray__text">Информация о предоставлении в ФССП актуальной информации о задолженности, с учетом процентов на день взыскания</p>
                                    </div>
                                    <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD067'])) ? $nd : $html !!}</div>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Дата подачи исполнительного листа в ФССП</p>
                                <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD056'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Дата возбуждения исполнительного производства </p>
                                <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD057'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information ">
                            <div class="flex">
                                <p class="gray__text">Дата вступления решения в законную силу</p>
                                <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD052'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Срок для предъявления исполнительного листа к исполнению</p>
                                <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD053'])) ? $nd : $html !!}</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Сумма денежных требований</p>
                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD054'])) ? $nd : $html !!}<span class="black__text price currency">РУБ</span></p>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="courts__right">
                            <div class="third__apellation appeal">
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div><p class="gray__text">Стратегия</p></div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                </div>
                                </div>
                            
                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Информация о ходе исполнительного производства</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD060'])) ? $nd : $html !!}
                                </div>
                                <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Судебный пристав-исполнитель</p> 
                                   <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD058'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD062'])) ? $nd : $html !!}
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
                                        <div class="gray__block courts__information">
                                            <div class="flex">
                                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD061'])) ? $nd : $html !!}</p>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>Сведения о заложенном имуществе должника</h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>
                                    <div class="property none">
                                        <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD055'])) ? $nd : $html !!}</p>
                                        <div class="gray__block courts__information total__price">
                                             <div class="flex">
                                                <p class="gray__text">Стоимость имущества</p>
                                                <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1636705135040'])) ? $nd : $html !!}<span class="black__text price currency">РУБ</span></p>
                                             </div>
                                     </div>
                                     <div class="gray__block courts__information">
                                    <div class="complaint flex">
                                        <div class="complaint__text ">
                                            <p class="gray__text">Предложение взыскателю оставить  имущество за собой</p>
                                        </div>
                                        <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD065'])) ? $nd : $html !!}</div>
                                    </div>
                                    </div> 
                                    <div class="gray__block courts__information visit__dates">
                                        <p class="gray__text">Сведения о торгах, дата</p>
                                        <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD138'])) ? $nd : $html !!}</p>   
                                    </div>     
                                    <div class="gray__block courts__information visit__dates">
                                        <p class="gray__text">Сведения о результатах проведения торгов</p>
                                        <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD064'])) ? $nd : $html !!}</p>   
                                    </div> 
                                    <div class="gray__block courts__information">
                                        <div class="flex">
                                            <p class="gray__text small-width">Планируемая дата перечисления денежных средств</p>
                                            <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD066'])) ? $nd : $html !!}</p>
                                        </div>
                                     </div>
                                    <div class="gray__block courts__information">
                                        <div class="flex">
                                            <p class="gray__text small-width">Дата поступления денежных средств ИП взыскателю</p>
                                            <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD139'])) ? $nd : $html !!}</p>
                                        </div>
                                        <div class="flex"> 
                                            <p class="gray__text">Дата завершения исполнительного производства</p>
                                            <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD069'])) ? $nd : $html !!}</p>
                                        </div>
                                        <div class="flex">
                                            <p class="gray__text">Дата окончания следующей подачи исполнительного листа</p>
                                            <p class="black__text date">{!! empty($html = rr($data['UF_CRM_CONAD_CRD070'])) ? $nd : $html !!}</p>
                                        </div>
                                        <div class="flex">
                                            <p class="gray__text">Основание окончания исполнительного производства</p>
                                            <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD071'])) ? $nd : $html !!}</div>
                                        </div>
                                    </div>
                                    <div class="gray__block courts__information total__price">
                                         <div class="flex">
                                            <p class="gray__text">Сумма оказанных юридических услуг</p>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD072'])) ? $nd : $html !!}<span class="black__text price currency">РУБ</span></p>
                                         </div>
                                   </div>
                                </div>
                                <div class="closing__arrow none">
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
