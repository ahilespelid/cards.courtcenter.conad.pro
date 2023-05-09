<?php
return [
'applicant_complaint'       => ['type' => 's', 'title' => 'Заявитель жалобы'], 
'strategy'                  => ['type' => 'm', 'title' => 'Стратегия'], 
'state_duty'                => ['type' => 'i', 'title' => 'Госпошлина'],
'complaint'                 => ['type' => 's', 'title' => 'Кассационная жалоба'], 
'objections'                => ['type' => 's', 'title' => 'Возражения на кассационную жалобу'],
'court_judge'               => ['type' => 's', 'title' => 'Суд, Судья'],
'date_upcoming_case'        => ['type' => 'm', 'title' => 'Дата назначения к слушанию'],
'number_case'               => ['type' => 's', 'title' => 'Номер дела в суде кассационной инстанции'],
'link'                      => ['type' => 's', 'title' => 'Ссылка на дела в суде кассационной инстанции'],
'information_progress'      => ['type' => 'm', 'title' => 'Информация о ходе рассмотрения кассационной жалобы'],
'result_case'               => ['type' => 's', 'title' => 'Результат рассмотрения'],
'sum_case'                  => ['type' => 'i', 'title' => 'Сумма заявленных требований и удовлетворенных судом'],
'date_production_case'      => ['type' => 'd', 'title' => 'Дата фактического изготовления судебного акта'],
'date_receipt_case'         => ['type' => 'd', 'title' => 'Дата получения постановления суда кассационной инстанции'],
'information_case'          => ['type' => 's', 'title' => 'Информация о дальнейших действиях'],
'sum_services'              => ['type' => 'i', 'title' => 'Сумма оказанных юридических услуг'],
];
