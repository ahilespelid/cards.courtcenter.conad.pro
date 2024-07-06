<?php  //ini_set('memory_limit', '-1');
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

use App\Http\Controllers\BtxController; use \Crest;
use App\Models\History;

class IndexController extends Controller{
protected $domain               = 'courtcenter.bitrix24.ru';
protected $file_view            = ['front.index' => 'front.tz4_ot_23032024', 'front.report' => 'intro.index', 
                                                                             'front.reportFI' => 'intro.FI_AI_CI', 
                                                                             'front.reportAI' => 'intro.FI_AI_CI', 
                                                                             'front.reportCI' => 'intro.FI_AI_CI', 
                                                                             'front.reportIP' => 'intro.IP', 
                                                                             'front.reportBR' => 'intro.BR', 
                                                                             'front.reportMD' => 'intro.MD', 
                                                                             'front.reportRE' => 'intro.RE'];    
protected $array_fields         = 'arrays/tz4_ot_23032024.php';
protected $array_seporator      = ',';
protected $not_found_data       = 'н/д';
protected $view_multifields     = '3';
protected $date_format_full     = 'Y-m-d H:i:s';
protected $date_format_short    = 'Y-m-d';
protected $uf_conad             = 'UF_CRM_CONAD';
protected $bx, $cr;
public function __construct(){$this->bx = new BtxController; $this->cr = new CRest;}    
///*/-----------------------------------Метод вывода///*/
public function index(Request $request){ //pa($_REQUEST); pa($request->toArray()); 
    ///*/ делаем выборку из массива файлов вида в зависимости от псевдонима маршрута и инстанции ///*/
    $as_rout = $request->route()->getAction()['as'];
    $fl_view = $this->file_view[$as_rout.(('index'==$request->instance || 'front.index'==$as_rout) ?  '' : ($request->instance ?? ''))];
    ///*/ технические переменные ///*/
    $ar_sepo = $this->array_seporator;
    $nf_data = $this->not_found_data;
    ///*/ получаем ID сделки ///*/
    $DEAL_ID    = (empty($request->PLACEMENT_OPTIONS) ? false : json_decode($request->PLACEMENT_OPTIONS,true));
    $DEAL_ID    = ($DEAL_ID && !empty($DEAL_ID['ID'])) ? $DEAL_ID['ID'] : $request->deal_id ?? null;
    ///*/ получаем домен сервера, домен битрикса ///*/
    $DOMAIN     = (empty($request->DOMAIN) ? false : $request->DOMAIN); 
    $DOMAIN_BX  = parse_url($_SERVER['HTTP_ORIGIN'] ?? 'https://'.$this->domain)['host'];
    
    if($DEAL_ID){
        ///*/ ahilespelid берём число из id сделки ///*/
        $DEAL_ID = intval($DEAL_ID);
        
        ///*/ выбираем поля сделки из битрикс ///*/
        $BX = $this->bx; $BX->crest = $this->cr;
        $DEAL = $BX->bx24->getDeal($DEAL_ID);
        $FIEL = $BX->bx24->getDealFields();
        $CATEGORYS[] = $CATEGORY_ID = (empty($DEAL['CATEGORY_ID'])) ? null : $DEAL['CATEGORY_ID'];
        
        if(isset($_GET['dev'])){

        ///*/ достаём из битрикса дочерние сделки ///*/
        $CHILDS = $BX->crest->call('crm.deal.list', ['ORDER' => ['ID' => 'ASC'], 'FILTER' => ['UF_CRM_1683462809' => $DEAL['ID']], 'SELECT' => ['*','UF_*']]);
        if(!empty($CHILDS = $CHILDS['result'] ?? false)){
            foreach($CHILDS as $i => $CHILD){
                if(empty($CHILD) || !is_array($CHILD) || $CHILD['ID'] == $DEAL['ID']){continue;}
                $CATEGORYS[] = (empty($CHILD['CATEGORY_ID'])) ? null : $CHILD['CATEGORY_ID'];
                foreach($CHILD as $k => $field){
                    if(strncmp($this->uf_conad, $k, 12) === 0){
                        $ret[$i][$k] = $field;
                        $DEAL[$k] = (empty($DEAL[$k])) ? $field : $DEAL[$k];
        }}}}
        pa($CATEGORYS, 2, 'воронки');
        }
        ///*/ соединяем данные полей с их свойствами ///*/ 
        foreach($DEAL as $k=>$v){$DEAL[$k] = ['DATA' => $v, 'INFO' => (empty($FIEL[$k]) ? '' : $FIEL[$k])];}

        ///*/ формируем переменные необходимые для отображения из некоторых полей сделки ///*/
        $STAGE_ID = (empty($DEAL['STAGE_ID']['DATA'])) ? false : $DEAL['STAGE_ID']['DATA'];
        
        ///*/ выбираем структуру данных и ключи - они же ИД пользовательских полей, из массива от марселя ///*/
        $STRUCTURE = $keys = @include(resource_path($this->array_fields));
        
        ///*/ формируем псевдомассив с ключами битрикс полей по инстанциям, для будующего анализа принадлежности полей к инстанциям ///*/
        array_walk($keys, function($i, $k) use(&$keys){$keys[$k] = array_keys($i);}); 
        
        ///*/ если инстанция не передаётся в запросе, берём первую инстанцию из псевдомассива ///*/
        $first_key_instance = array_key_first($keys);
        $INSTANCE = (('index' == $request->instance) ? (($request->session()->exists('instance')) ? $request->session()->get('instance') : $first_key_instance) : 
                                                        ($request->instance ?? $first_key_instance));
        $request->session()->flash('instance', $INSTANCE);
        
        ///*/ формируем массив текущей инстанции для наполнения данными, для всего массива полей без учёта инстанции следует использовать $DATA = array_merge(...array_values($STRUCTURE)); ///*/
        $keys_INSTANCE = ('front.report' == $as_rout && ('FI' == $INSTANCE || 'AI' == $INSTANCE || 'CI' ==$INSTANCE)) ?
            array_flip($keys['FI'])+array_flip($keys['AI'])+array_flip($keys['CI']) : array_flip($keys[$INSTANCE]);
        $DATA = array_intersect_key(array_merge(...array_values($STRUCTURE)), $keys_INSTANCE); 
        
        ///*/ достаём из битрикса стадию сделки по $STAGE_ID ///*/
        $STAGES = $BX->crest->call('crm.status.list');
        
        if(empty($STAGES['errore'])){
            foreach(($STAGES['result'] ?? null) as $s){if($STAGE_ID == $s['STATUS_ID']){$DEAL['STAGE']['DATA'] = $s['NAME']; break;}}
        }
        
        foreach((empty($DATA) ? null : $DATA)  as $k => $v){ 
            ///*/ пропускаем и удаляем из результируещего массива поле, если данных для поля в битрикс нет ///*/
            // if(empty($DEAL[$k])){unset($DATA[$k]); continue;}
            
            ///*/ если данные поля строка, убираем пробелы вокруг данных ///*/
            if(is_string($DEAL[$k]['DATA'])){$DEAL[$k]['DATA'] = trim($DEAL[$k]['DATA']);}
            if(in_array($DATA[$k]['type'], ['date','mdate'])){
                $d = is_date($DEAL[$k]['DATA']); 
                $DEAL[$k]['DATA'] = is_a($d, '\DateTime') ? $d->format(('front.index'==$as_rout) ? $this->date_format_full : $this->date_format_short) : $DEAL[$k]['DATA'];} 
            
            if('money' == $DATA[$k]['type']){$DEAL[$k]['DATA'] = number_format((int)$DEAL[$k]['DATA'], 0, '', ' ');} 
            if('integer' == $DATA[$k]['type']){$DEAL[$k]['DATA'] = intval($DEAL[$k]['DATA']);} 
            if('link' == $DATA[$k]['type']){$DATA[$k]['sepo'] = $ar_sepo;} 
            
            ///*/ при выборе всех полей без учёта инстанций определяет принадлежность поля к инстанции ///*/
            $instances = array_keys(array_filter($keys, function($i, $key) use (&$k){return (in_array($k, $i));}, ARRAY_FILTER_USE_BOTH));
            $instance = (in_array($INSTANCE, $instances)) ? $INSTANCE : $instances[0]; 
            
            ///*/ выбираем из базы историй все модификации поля, по ключу и инстанции ///*/
            $h = History::where('deal', $DEAL_ID)->where('key', $k)->where('instance', $instance);
            
            ///*/ если история изменений есть запоминаем в переменной, если нет то формируем из вновь прибывших данных ///*/
            $history = $h->exists() ? $h->orderByDesc('id')->offset(0)->limit($this->view_multifields)->get()->toArray() : 
                [History::create([
                    'deal'      => $DEAL_ID,
                    'instance'  => $instance, 
                    'name'      => $v['title'], 
                    'key'       => $k,
                    ///*/ если множественное поле из битрикса пришло пишем в базу строкой по разделителю $ar_sepo ///*/ 
                    'value'     => (is_array($DEAL[$k]['DATA']) ? implode($ar_sepo, $DEAL[$k]['DATA']) : (empty($DEAL[$k]['DATA']) ? NULL : $DEAL[$k]['DATA']))]
                )->toArray()]; //pa($history);
            
            ///*/ для множественных полей изменяем данные изменений из строки с разделителем $ar_sepo обратно в массив ///*/
            foreach($history as $kk => $hh){$history[$kk]['value'] = (is_array($DEAL[$k]['DATA'])) ? explode($ar_sepo, $hh['value']) : [$hh['value']];}
            
            ///*/ дополняем результирующий массив данными ///*/
            $DATA[$k]['instance'] = $INSTANCE; 
            $DATA[$k]['bitrix'] = (is_array($DEAL[$k]['DATA'])) ? $DEAL[$k]['DATA'] : [$DEAL[$k]['DATA']]; 
            $DATA[$k]['info'] = (empty($DEAL[$k]['INFO'])) ? [] : $DEAL[$k]['INFO']; 
            $DATA[$k]['history'] = $history;
            
            ///*/ если из битрикса пришёл список формируем массив для select на фронт ///*/
            if(isset($DATA[$k]['info']['type']) && 'enumeration' == $DATA[$k]['info']['type']){ //pa($DATA[$k]);
                $bitrix = [];
                if(!empty($list = $DATA[$k]['info']['items']) && is_array($list)){
                    for($i=0,$c=count($list); $i<$c; $i++){
                        $bitrix[$i] = ($DATA[$k]['bitrix'][0] == $list[$i]['ID']) ? [
                            'value' => $list[$i]['ID'],
                            'title' => $list[$i]['VALUE'],
                            'selected' => 1
                        ] : [
                            'value' => $list[$i]['ID'],
                            'title' => $list[$i]['VALUE'],
                            'selected' => 0
                        ];}
                }
             $DATA[$k]['bitrix'] = $bitrix;}
        }
        ///*/ формируем данные на фронт ///*/
        $agent = new Agent();
        $veiw = view($fl_view, $ret = [
            'data'          => $DATA,
            'deal_id'       => $DEAL_ID,
            'deal'          => $DEAL,
            'categorys'   => $CATEGORYS,
            'category_id'   => $CATEGORY_ID,
            'instance'      => $INSTANCE,
            'domain'        => $DOMAIN,
            //'instance_sud'  => ($request->session()->exists('instance')) ? $request->session()->get('instance') : $INSTANCE,
            'nd'            => $nf_data,
            'ex'            => $ar_sepo,
            'agent'         => $agent,
        ]);}

    ///*/ ahilespelid если открыто приложение не из битрикса убираем ID сделки ///*/
    $DEAL_ID = ('front.index' == $as_rout && $DOMAIN <> $DOMAIN_BX) ? false : $DEAL_ID;                   
    
    ///*/ вывод фронта ///*/        
return ($DEAL_ID && $CATEGORY_ID) ? ((1 == $request->sync) ? response()->json($ret) : response($veiw)) : view('front.undefine');}
///*/-----------------------------------Метод сохранения в базу///*/
public function save(Request $request){ //pa($_REQUEST);
    $fl_view = $this->file_view;
    $ar_sepo = $this->array_seporator;

    ///*/ выбираем структуру данных и ключи - они же ИД пользовательских полей, из массива от марселя ///*/
    $STRUCTURE = $keys = @include(resource_path($this->array_fields));
    ///*/ формируем массив ключей инстанций для валидации пришедшей ищ запроса инстанции на присутствие в массиве ///*/
    $INSTANCES = array_keys($STRUCTURE);
    ///*/ валидация данных из запроса ///*/
    $request->validate(['deal_id' => 'required|regex:/^\d+$/u', 'instance' => ['required', 'regex:#^('.(is_array($INSTANCES) ? implode('|', $INSTANCES) : $request->instance).')$#u']]); 
    ///*/ получаем ID сделки && берём инстанцию из запроса ///*/
    if(($DEAL_ID = $request->deal_id ?? false) && ($INSTANCE = $request->instance ?? false)){
        ///*/ ahilespelid берём число из id сделки ///*/
        $DEAL_ID = intval($DEAL_ID);
        ///*/ выбираем поля сделки из битрикс ///*/
        $BX = $this->bx; $BX->crest = $this->cr;
        //$DEAL = $BX->bx24->getDeal($DEAL_ID);
        
        ///*/ формируем массив данных для обновления из запроса полей битрикс ///*/
        foreach(array_keys($keys = $STRUCTURE[$request->instance]) as $field){
            if(empty($request->{$field})){continue;}
            
            if(is_string($request->{$field})){$request->{$field} = trim($request->{$field});} //pa($k); pa($DATA); pa($DEAL[$k]); exit;
            if(in_array($keys[$field]['type'], ['date','mdate'])){
                $d = is_date($request->{$field}); 
                $request->{$field} = is_a($d, '\DateTime') ? $d->format($this->date_format_full) : $request->{$field};} 
            if('money' == $keys[$field]['type']){
                $request->{$field} = filter_var($request->{$field}, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $request->{$field} = $request->{$field}.'|RUB';//number_format($request->{$field}, 0, '', ' ');
                pa($field); pa($request->{$field});
            } 
            if('integer' == $keys[$field]['type']){$request->{$field} = intval($request->{$field});} 

/*            
            if('money' == $STRUCTURE[$INSTANCE][$field]['type']){
                $request->{$field} = intval(preg_replace('/[^0-9]+/', '', $request->{$field}), 10);}
            if('integer' == $STRUCTURE[$INSTANCE][$field]['type']){
                $request->{$field} = intval(preg_replace('/[^0-9]+/', '', $request->{$field}), 10);}
            if(strpos($STRUCTURE[$INSTANCE][$field]['type'], 'date') !== false){
                $d = is_date($request->{$field}); //pa($request->{$field});pa($d); 
                $request->{$field} = (is_a($d, '\DateTime')) ? $d->format('Y-m-d H:i:s') : '';}
*/
            if(empty($request->{$field})){continue;}
            //pa($field); exit;
            $bx_array_update[$field] = (in_array($keys[$field]['type'],['mstring','mdate'])) ? [$request->{$field}] : $request->{$field}; //pa($bx_array_update[$field].' -> '.$STRUCTURE[$INSTANCE][$field]['type']);
        }//pa($bx_array_update); //exit;
        ///*/ обновляем поля в битриксе ///*/
        //pa($keys); pa($bx_array_update); pa($BX->crest->call('crm.deal.update', ['id' => $DEAL_ID, 'fields' => $bx_array_update])); exit; 
        if(!empty($bx_array_update) && $bx_is_updated = $BX->bx24->updateDeal($DEAL_ID, $bx_array_update)){ //pa($DEAL_ID);pa($bx_is_updated); exit;
        ///*/ если в битриксе обновились, запускаю анализатор на изменение полей в нашей базе, если какое либо значение поля изменилось добавляю новое значение в базу ///*/
            foreach($bx_array_update as $k => $v){//pa($keys[$k]['title']); exit;
                ///*/ ahilespelid преводим значения к строке если массив ///*/
                $v = (is_array($v)) ? $v[0] : $v;
                ///*/ выбираем из базы историй все модификации поля, по ключу и инстанции ///*/
                $h = History::where('deal', $DEAL_ID)->where('key', $k)->where('instance', $INSTANCE);
                
                ///*/ ahilespelid если такое значение есть и оно равно самому свежему изменению то пропускаем создание модели///*/
                if($h->exists()){
                    $check = $h->orderByDesc('id')->offset(0)->limit(1)->get()->toArray()[0]['value'];
                    if($v == $check){$continue[$DEAL_ID][$k] = $v; continue;}}
                    
                ///*/ если история изменений есть запоминаем в переменной, если нет то формируем из вновь прибывших данных ///*/
                //$history[$k][] = $h->exists() ? $h->first()->toArray() : 
                    History::create([
                        'deal'      => $DEAL_ID,
                        'instance'  => $INSTANCE, 
                        'name'      => $keys[$k]['title'], 
                        'key'       => $k,
                        ///*/ если множественное поле из битрикса пришло пишем в базу строкой по разделителю $ar_sepo ///*/ 
                        'value'     => (is_array($v) ? implode($ar_sepo, $v) : (empty($v) ? NULL : $v))]
                    ); 
        }}else{$bx_is_updated = false;}        
    }//pa(count($bx_array_update)); pa($bx_array_update); pa(count($request->toArray())); pa($request->toArray()); //pa($con);exit;

    ///*/ вывод фронта ///*/
// redirect()->action([IndexController::class, 'index'], ['instance' => $request->instance, 'deal_id' => $request->deal_id])
$redirect = ['instance' => $request->instance, 'deal_id' => $request->deal_id]; //pa($redirect); exit; 
return ($bx_is_updated) ? redirect()->action([IndexController::class, 'index'], $redirect) : view('front.undefine', ['deal_id' => $request->deal_id]);}
///*/-----------------------------------Метод добавления новых пользовательских полей в битрикс///*/
public function addfields(){
    $fields = @include(resource_path('arrays/fields.php'));
    for($i=0,$c=count($fields); $i<$c; $i++){
        $FIELD_NAME         = str_replace(['UF_CRM_', ' '], '', $fields[$i][1]);
        $EDIT_FORM_LABEL    = trim($fields[$i][0]);
        $USER_TYPE_ID       = trim($fields[$i][2]);
        $SHOW_FILTER        = 'Y';
        $SHOW_IN_LIST       = 'Y';
        $EDIT_IN_LIST       = 'Y';
        $IS_SEARCHABLE      = 'Y';
        $MULTIPLE           = trim($fields[$i]['MULTIPLE']);
        $LIST_COLUMN_LABEL  = $fields[$i]['LIST_COLUMN_LABEL'] ?? $EDIT_FORM_LABEL;
        
        //echo strlen($FIELD_NAME).' = '.nl2br($FIELD_NAME.PHP_EOL);
        //echo strlen($EDIT_FORM_LABEL).' = '.nl2br($EDIT_FORM_LABEL.PHP_EOL);
        //echo strlen($USER_TYPE_ID).' = '.nl2br($USER_TYPE_ID.PHP_EOL);
    
    
    $arParametr = ['fields' => [
        'FIELD_NAME'                => $FIELD_NAME,
        'EDIT_FORM_LABEL'           => $EDIT_FORM_LABEL,
        'USER_TYPE_ID'              => $USER_TYPE_ID,
        'SHOW_FILTER'               => $SHOW_FILTER,
        'SHOW_IN_LIST'              => $SHOW_IN_LIST,
        'EDIT_IN_LIST'              => $EDIT_IN_LIST,
        'IS_SEARCHABLE'             => $IS_SEARCHABLE,
        'MULTIPLE'                  => $MULTIPLE,
        'LIST_COLUMN_LABEL'         => $LIST_COLUMN_LABEL,
        'SORT'                      => 9999,
    ]];
    if(isset($fields[$i]['LIST'])){$arParametr['fields']['LIST'] = $fields[$i]['LIST'];}
    
    pa($arParametr);
    //pa(CRest::call('crm.deal.userfield.add', $arParametr));
return null;}}
///*/-----------------------------------Метод синхронизации///*/
use \App\Refcurl;
public function sync(){
    ///*/ выбираем все сделки в генератор ///*/
    $BX = $this->bx; $generator = $BX->bx24->fetchDealList();
    ///*/ выбираем структуру данных и ключи - они же ИД пользовательских полей, из массива от марселя ///*/
    $STRUCTURE = $keys = @include(resource_path($this->array_fields));
    ///*/ формируем массив ключей инстанций для валидации пришедшей из запроса инстанции на присутствие в массиве ///*/
    $INSTANCES = array_keys($STRUCTURE);
    
    foreach($generator as $deals){foreach($deals as $deal){/*pa($deal['ID']);*/ $ret[] = $deal['ID']; foreach($INSTANCES as $ins){/*pa($ins);*/
        
        //pa($this->go($deal['ID'],$ins));
        //$this->go($deal['ID'],$ins);
    }}}
    //pa($ret);
return null;}

}?>