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
            <div class="main_class courts content__wrapper">
                <div class="courts__left">
                    <div class="courts__left__header flex">
                        <a href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'index']) }}">
                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            <h2>СУДЫ</h2>
                            <div></div>
                        </a>
                    </div>
                    <div class="courts__left__body">
                        
                        <div class="instances">
                            <div class="first_instance instance flex">
                                <h2>
                                    Первая инстанция Наименование суда
                                </h2>
                                <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            </div>
                            

                            <div class="first__apellation appeal mobile none">
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Истец</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD130'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Ответчик</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD131'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Третье лицо</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD132'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD091'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD122'])) ? $nd : $html !!} 
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Название сделки</p>
                                    <p class="black__text">{!! empty($html = rr($data['TITLE'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата начала</p>
                                    <p class="black__text">{!! empty($html = rr($data['BEGINDATE'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD124'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD125'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Ближайшее заседание</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_1702719450'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Предмет спора</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD002'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Сумма иска</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1640249453073'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                        <div class="complaint__text">
                                            <p class="gray__text">Стратегия</p>
                                        </div> 
                                        <div class="complaint__files">      
                                                {!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}
                                        </div>
                                 </div> 
                            </div>
                            <div class="gray__block courts__information">
                                    <div class="flex">
                                        <p class="gray__text">Текущее состояние дела</p>
                                        <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD009'])) ? $nd : $html !!}</p>
                                    </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе дела</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD135'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Претензия</p>
                                    <p class="gray__text">Результат рассмотрения дела</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">       
                                        {!! empty($html = rr($data['UF_CRM_CONAD_CRD003'])) ? $nd : $html !!}
                                    </div>
                                    <div class="flex files__second">
                                        {!! empty($html = rr($data['UF_CRM_CONAD_CRD010'])) ? $nd : $html !!}<!--p class="gray__text right-column-text"></p-->
                                    </div>
                                </div>
                            </div>
                            <div class="courts__prices">
                                <div class="gray__block courts__information ">
                                    <p class="gray__text">
                                    Дата фактического изготовления судом решения</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD015'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information ">
                                    <p class="gray__text">
                                    Дата получения решения</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD016'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Срок на обжалование решения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD014'])) ? $nd : $html !!}</p> 
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Сведения о необходимости обжалования судебного акта</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD017'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Заявленные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD011'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Удовлетворенные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD012'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                                <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD004'])) ? $nd : $html !!}</p>
                                            <p class="gray__text">Дата оплаты: <span class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD006'])) ? $nd : $html !!}</span></p>
                                        </div> 
                                    </div>
                                    <div class=" files__second ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD005'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information interim__measures">
                                <p class="gray__text">Информация о наложении обеспечительных мер</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD008'])) ? $nd : $html !!}</p>
                                <div class="flex">
                                    <p class="gray__text">Залог</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1666170845189'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата вступления судебного акта в законную силу</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD013'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Дата подачи жалобы</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD018'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Дата принятия жалобы</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD019'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">Сумма оказанных юридических услуг</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD020'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        </div>

                            <div class="second_instance instance flex">
                                <h2>
                                    Апелляционная инстанция Наименование суда
                                </h2>
                                <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            </div>  
                            <!-- второй блок мобильный -->
                            <div class="second__apellation appeal mobile none">
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела в суде аппеляционной инстанции</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD101'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD133'])) ? $nd : $html !!}
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD126'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD127'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Заявитель</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD021'])) ? $nd : $html !!}</p>
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
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе рассмотрения аппеляционной жалобы</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD029'])) ? $nd : $html !!}
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">
                                        Краткая апелляционная жалоба
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD026'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">   
                                        Апелляционная жалоба 
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD025'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">
                                        Возражения на апелляционную жалобу
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD026'])) ? $nd : $html !!}</p>
                            </div>

                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата подачи жалобы</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD027'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата принятия судом</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD028'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата фактического изготовления апелляционного определения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD033'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата получения апелляционного определения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD034'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="courts__information white__block">
                                <p class="black__text"> Информация о необходимости обжалования апелляционного определения</p>    
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD035'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Дата назначения слушания</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD134'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div>
                                        <p class="gray__text">Результат рассмотрения дела</p>
                                    </div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_CONAD_CRD030'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Сумма заявленных требований</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD031'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Сумма удовлетворенных судом требований</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD032'])) ? $nd : $html !!}</p>
                                </div>
                            </div> 
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>   
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD022'])) ? $nd : $html !!}</p>
                                        </div> 
                                    </div>
                                    <div class=" files__second ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD023'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">
                                        Сумма оказанных юридических услуг
                                    </p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD036'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        
                        </div>
                            <div class="third_instance instance flex">
                                <h2>
                                    Кассационная инстанция Наименование суда
                                </h2>
                                <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                            </div>

                            <!-- третий мобильный блок -->

                            <div class="third__apellation appeal none">
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела в суде кассационной инстанции</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD102'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD137'])) ? $nd : $html !!}
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD128'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD129'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Заявитель</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD037'])) ? $nd : $html !!}</p>
                                </div>        
                            </div>
                                                    
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Дата назначения слушания</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD136'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div>
                                        <p class="gray__text">Стратегия</p>
                                    </div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="black__text">Кассационная жалоба</p>
                                    </div>
                                    <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD040'])) ? $nd : $html !!}</div>
                                </div>
                                <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="black__text">Возражения на кассационную жалобу</p>
                                    </div>
                                    <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD041'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата фактического изготовления судебного акта </p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD046'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата получения постановления суда</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD047'])) ? $nd : $html !!}</p>
                                </div>
                            </div> 
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                        <div class="complaint__text">
                                            <p class="gray__text">Результат рассмотрения дела</p>
                                        </div> 
                                        <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD043'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="courts__information white__block">
                                <p class="black__text"> Информация о дальнейших действиях</p>    
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD048'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе рассмотрения кассационной жалобы</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD042'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD038'])) ? $nd : $html !!}</p>
                                        </div> 
                                    </div>
                                    <div class=" files__second">{!! empty($html = rr($data['UF_CRM_CONAD_CRD039'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Заявленные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD044'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Удовлетворенные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD045'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">Сумма оказанных юридических услуг</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD049'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="courts__right"> 
                         <div class="first__apellation appeal none">
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Истец</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD130'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Ответчик</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD131'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Третье лицо</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD132'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD122'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD091'])) ? $nd : $html !!}
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Название сделки</p>
                                    <p class="black__text">{!! empty($html = rr($data['TITLE'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата начала</p>
                                    <p class="black__text">{!! empty($html = rr($data['BEGINDATE'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD124'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD125'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Ближайшее заседание</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_1702719450'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Предмет спора</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD002'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Сумма иска</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1640249453073'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                        <div class="complaint__text">
                                            <p class="gray__text">Стратегия</p>
                                        </div> 
                                        <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                 </div> 
                            </div>
                            <div class="gray__block courts__information">
                                    <div class="flex">
                                        <p class="gray__text">Текущее состояние дела</p>
                                        <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD009'])) ? $nd : $html !!}</p>
                                    </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе дела</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD135'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Претензия</p>
                                    <p class="gray__text">Результат рассмотрения дела</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">{!! empty($html = rr($data['UF_CRM_CONAD_CRD003'])) ? $nd : $html !!}</div>
                                    <div class="flex files__second">
                                        <p class="gray__text right-column-text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD010'])) ? $nd : $html !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="courts__prices">
                                <div class="gray__block courts__information ">
                                    <p class="gray__text">Дата фактического изготовления судом решения</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD015'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information ">
                                    <p class="gray__text">Дата получения решения</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD016'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Срок на обжалование решения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD014'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Сведения о необходимости обжалования судебного акта</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD017'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Заявленные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD011'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Удовлетворенные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD012'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                                <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD004'])) ? $nd : $html !!}</p>
                                            <p class="gray__text ">Дата оплаты: <span class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD006'])) ? $nd : $html !!}</span></p>
                                        </div> 
                                    </div>
                                    <div class=" files__second ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD005'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information interim__measures">
                                <p class="gray__text">Информация о наложении обеспечительных мер</p>
                                <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD008'])) ? $nd : $html !!}</p>
                                <div class="flex">
                                    <p class="gray__text">Залог</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_1666170845189'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата вступления судебного акта в законную силу</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD013'])) ? $nd : $html !!}</p>
                                </div> 
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Дата подачи жалобы</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD018'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Дата принятия жалобы</p>
                                    <p class="black__text ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD019'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">Сумма оказанных юридических услуг</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD020'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        </div>  
                                
                        <div class="second__apellation appeal none">
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела в суде аппеляционной инстанции</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD101'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD133'])) ? $nd : $html !!}
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD126'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD127'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Заявитель</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD021'])) ? $nd : $html !!}</p>
                                </div>        
                            </div>
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div><p class="gray__text">Стратегия</p></div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе рассмотрения аппеляционной жалобы</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD029'])) ? $nd : $html !!}
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">
                                        Краткая апелляционная жалоба
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD026'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">   
                                        Апелляционная жалоба 
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD025'])) ? $nd : $html !!}</p>
                            </div>
                            <div class="prohibitions">
                                    <div class="flex">
                                        <h2 class="white__block">
                                        Возражения на апелляционную жалобу
                                        </h2>
                                        <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                    </div>
                                </div>
                                <div class="property none">
                                    <p class="black__text property_desc">{!! empty($html = rr($data['UF_CRM_CONAD_CRD026'])) ? $nd : $html !!}</p>
                            </div>

                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата подачи жалобы</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD027'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата принятия судом</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD028'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата фактического изготовления апелляционного определения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD033'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата получения апелляционного определения</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD034'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="courts__information white__block">
                                <p class="black__text">Информация о необходимости обжалования апелляционного определения</p>    
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD035'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Дата назначения слушания</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD134'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div>
                                        <p class="gray__text">Результат рассмотрения дела</p>
                                    </div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_CONAD_CRD030'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Сумма заявленных требований</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD031'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Сумма удовлетворенных судом требований</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD032'])) ? $nd : $html !!}</p>
                                </div>
                            </div> 
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>   
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD022'])) ? $nd : $html !!}</p>
                                        </div> 
                                    </div>
                                    <div class=" files__second ">{!! empty($html = rr($data['UF_CRM_CONAD_CRD023'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">Сумма оказанных юридических услуг</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD036'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        
                        </div>               
                        <div class="third__apellation appeal none">
                        <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Номер дела в суде аппеляционной инстанции</p>
                                    <p class="blue__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD102'])) ? $nd : $html !!}</p>
                                    {!! empty($html = rr($data['UF_CRM_CONAD_CRD137'])) ? $nd : $html !!}
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Суд</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD128'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Судья</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD129'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Заявитель</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD037'])) ? $nd : $html !!}</p>
                                </div>        
                            </div>
                                                    
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Дата назначения слушания</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD136'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block requests courts__information">
                                <div class="flex files text">
                                    <div>
                                        <p class="gray__text">Стратегия</p>
                                    </div>
                                    <div class="flex files__second">{!! empty($html = rr($data['UF_CRM_1686046817804'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="black__text">Кассационная жалоба</p>
                                    </div>
                                    <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD040'])) ? $nd : $html !!}</div>
                                </div>
                                <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="black__text">Возражения на кассационную жалобу</p>
                                    </div>
                                    <div class="complaint__files">{!! empty($html = rr($data['UF_CRM_CONAD_CRD041'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Дата фактического изготовления судебного акта </p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD046'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="flex">
                                    <p class="gray__text">Дата получения постановления суда</p>
                                    <p class="black__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD047'])) ? $nd : $html !!}</p>
                                </div>
                            </div> 
                            <div class="gray__block courts__information">
                                <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="gray__text">Результат рассмотрения дела</p>
                                    </div> 
                                    <div class="complaint__files">      {!! empty($html = rr($data['UF_CRM_CONAD_CRD043'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class="courts__information white__block">
                                <p class="black__text"> Информация о дальнейших действиях</p>    
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">{!! empty($html = rr($data['UF_CRM_CONAD_CRD048'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information progress">
                                <p class="progress__header gray__text">Информация о ходе рассмотрения кассационной жалобы</p>
                                {!! empty($html = rr($data['UF_CRM_CONAD_CRD042'])) ? $nd : $html !!}
                            </div>
                            <div class="gray__block courts__information">
                                <div class="flex">
                                    <p class="gray__text">Госпошлина</p>
                                    <p class="gray__text">Плетежное поручение</p>
                                </div>
                                <div class="flex">
                                    <div class="flex files__first">
                                        <div>
                                            <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD038'])) ? $nd : $html !!}</p>
                                        </div> 
                                    </div>
                                    <div class=" files__second">{!! empty($html = rr($data['UF_CRM_CONAD_CRD039'])) ? $nd : $html !!}</div>
                                </div>
                            </div>
                            <div class=" courts__prices">
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Заявленные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD044'])) ? $nd : $html !!}</p>
                                </div>
                                <div class="gray__block courts__information">
                                    <p class="gray__text">Удовлетворенные требования</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD045'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                            <div class="gray__block courts__information total__price">
                                <div class="flex">
                                    <p class="gray__text">Сумма оказанных юридических услуг</p>
                                    <p class="black__text price">{!! empty($html = rr($data['UF_CRM_CONAD_CRD049'])) ? $nd : $html !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="closing__arrow none">
                <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
            </div>
    </main>

    <script src="/assets/js/script.js"></script>
</body>
</html>