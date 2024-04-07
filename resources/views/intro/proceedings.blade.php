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
                            <h2>ИСПОЛНИТЕЛЬНОЕ ПРОИЗВОДСТВО</h2>
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
                        <div class="flex collector">
                            <div class="gray__block courts__information">
                                <p class="gray__text">Взыскатель</p>
                                <p class="black__text">Фамилия И.О.</p>
                            </div>
                            <div class="gray__block courts__information">
                                <p class="gray__text">Должник</p>
                                <p class="black__text">Фамилия И.О.</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="complaint flex">
                                    <div class="complaint__text">
                                        <p class="gray__text">Информация о предоставлении в ФССП актуальной информации о задолженности, с учетом процентов на день взыскания</p>
                                    </div> 
                                    <div class="complaint__files">      
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                    </div>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">Дата подачи исполнительного листа в ФССП</p>
                                <p class="black__text">01.01.01</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Дата возбуждения исполнительного производства </p>
                                <p class="black__text">01.01.01</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information ">
                            <div class="flex">
                                <p class="gray__text">Дата вступления решения в законную силу</p>
                                <p class="black__text">01.01.01</p>
                            </div>
                            <div class="flex">
                                <p class="gray__text">Срок для предъявления исполнительного листа к исполнению</p>
                                <p class="black__text">01.01.01</p>
                            </div>
                        </div>
                        <div class="gray__block courts__information">
                            <div class="flex">
                                <p class="gray__text">
                                     Сумма денежных требований
                                </p>
                                <p class="black__text price">
                                    00000   
                                </p>
                            </div>
                        </div>
                        
                        <div class="instances">
                            <div class="third__apellation appeal">
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
                            
                                <div class="gray__block courts__information progress">
                                    <p class="progress__header gray__text">Информация о ходе исполнительного производства</p>
                                    <div class="progress__bar">
                                        <div class="progress__bar__line">
                                            <div class="progress__bar__line__{{ $k+1 }}">
                                                <div id="{{ $k+1 }}_dot" class="progress__bar__dot {{ ((empty($k)) ? 'active' : '') }}"></div>
                                                <p class="black__text">
                                                     тест
                                                    <br>
                                                    Дата: 01.01.01
                                                    
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__2">
                                                <div id="2_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    тест
                                                    <br>
                                                    Дата: 01.01.01
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__3">
                                                <div id="3_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    тест
                                                    <br>
                                                    Дата: 01.01.01
                                                </p>
                                            </div>
                                            <div class="progress__bar__line__4">
                                                <!-- <div id="4_dot" class="progress__bar__dot"></div>
                                                <p class="gray__text">
                                                    тест
                                                    <br>
                                                    Дата: 01.01.01
                                                </p>
                                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Судебный пристав-исполнитель</p>      
                                    <p class="black__text">Фамилия И.О.<span class="black__text">  тел.</span><span class="black__text"> 000000000000</span></p>
                                </div>
                                <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации</p>      
                                    <p class="gray__text">Дата: <span class="black__text">01.01.01</span></p>   
                                    <p class="gray__text">Дата: <span class="black__text">01.01.01</span></p> 
                                    <p class="gray__text">Дата: <span class="black__text">01.01.01
                                        <!-- @if(isset($d) && $date = is_date($d)) {{ $date->format('d.m.Y') }} @else {{ $nd }} @endif -->
                                    </span></p>
                                    <!-- @endforeach @else {{ $nd }} @endif -->
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
                                    <!-- @if(isset($deal['UF_CRM_CONAD_CRD061']))
                                    @php list($l, $r) = array_pad(explode($ex, $deal['UF_CRM_CONAD_CRD061']), 2, ''); @endphp         -->
                                       
                                            <div class="gray__block courts__information">
                                            <div class="flex">
                                            
                                                <p class="black__text">Собственность по аресту</p>                                            </div>
                                            </div>
                                        zend_thread_id                                     
                                    </div> 

                                    <div class="prohibitions">
                                        <div class="flex">
                                            <h2>
                                            Сведения о заложенном имуществе должника
                                        </h2>
                                            <img class="big_arrow" src="/assets/img/svg/big_arrow.svg" alt=">">
                                        </div>
                                    </div>
                                    <div class="property none">
                                        <p class="black__text property_desc">
                                            текст текст текст текст текст текст текст текст текст текст текст текст текст текст
                                        </p>
                                        <div class="gray__block courts__information total__price">
                                             <div class="flex">
                                                <p class="gray__text">
                                                Стоймость имущества
                                             </p>
                                                <p class="black__text price">00000</p>
                                        </div>
                                     </div>
                                     <div class="gray__block courts__information">
                                    <div class="complaint flex">
                                        <div class="complaint__text ">
                                            <p class="gray__text">Предложение взыскателю оставить  имущество за собой</p>
                                        </div> 
                                        <div class="complaint__files">      
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    </div> 
                                    <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Сведения о торгах, дата </p>      
                                    <p class="black__text">текст<span class="black__text"> дата</span></p>   
                                    </div>     
                                    <div class="gray__block courts__information visit__dates">
                                    <p class="gray__text">Сведения о результатах проведения торгов </p>      
                                    <p class="black__text">текст текст текст</p>   
                                    </div> 
                                    <div class="gray__block courts__information">
                                        <div class="flex">
                                            <p class="gray__text small-width">Планируемая дата перечисления денежных средств</p>
                                            <p class="black__text">01.01.01</p>
                                        </div>
                                     </div>
                                    <div class="gray__block courts__information">
                                        <div class="flex">
                                            <p class="gray__text small-width">Дата поступления денежных средств ИП взыскателю</p>
                                            <p class="black__text">01.01.01</p>
                                        </div>
                                        <div class="flex"> 
                                            <p class="gray__text">Дата завершения исполнительного производства</p>
                                            <p class="black__text">01.01.01</p>
                                        </div>
                                        <div class="flex">
                                            <p class="gray__text">Дата окончания следующей подачи исполнительного листа</p>
                                            <p class="black__text">01.01.01</p>
                                        </div>
                                        <div class="flex">
                                            <p class="gray__text">Основание окончания исполнительного производства</p>
                                            <div class="complaint__files">      
                                            <a href="{{ $url }}" target="_blank">
                                                <img class="file" src="/assets/img/svg/{{ ('pdf' == strtolower(pathinfo($url, PATHINFO_EXTENSION))) ? 'pdf' : 'doc' }}.svg" alt="">
                                            </a>
                                        </div>
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