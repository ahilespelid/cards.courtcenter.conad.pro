<?php //ini_set('memory_limit', '-1');
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Http\Controllers\BtxController; use \Crest;
use App\Models\History;

class IndexController extends Controller{
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
protected $not_found_data       = 'н\д';
protected $date_format_full     = 'Y-m-d H:i:s';
protected $date_format_short    = 'Y-m-d';
protected $bx, $cr;
public function __construct(){$this->bx = new BtxController; $this->cr = new CRest;}    
///*/-----------------------------------Метод вывода///*/
public function index(Request $request){//pa($_REQUEST);
    ///*/ делаем выборку из массива файлов вида в зависимости от псевдонима маршрута и инстанции ///*/
    $as_rout = $request->route()->getAction()['as'];
    $fl_view = $this->file_view[$as_rout.(('index'==$request->instance || 'front.index'==$as_rout) ?  '' : ($request->instance ?? ''))];
    ///*/ технические переменные ///*/
    $ar_sepo = $this->array_seporator;
    $nf_data = $this->not_found_data;
    ///*/ получаем ID сделки ///*/
    $DEAL_ID = (empty($request->PLACEMENT_OPTIONS) ? false : json_decode($request->PLACEMENT_OPTIONS,true)); //$DEAL_ID = 3876;
    $DEAL_ID = ($DEAL_ID && !empty($DEAL_ID['ID'])) ? $DEAL_ID['ID'] : $request->deal_id ?? 3876;
    
    if($DEAL_ID){
        ///*/ выбираем поля сделки из битрикс ///*/
        $BX = $this->bx; $BX->crest = $this->cr;
        $DEAL = $BX->bx24->getDeal($DEAL_ID);
        ///*/ формируем переменные необходимые для отображения из некоторых полей сделки ///*/
        $CATEGORY_ID = (empty($DEAL['CATEGORY_ID'])) ? false : $DEAL['CATEGORY_ID'];
        $STAGE_ID = (empty($DEAL['STAGE_ID'])) ? false : $DEAL['STAGE_ID']; //explode(':', $DEAL['STAGE_ID']); $STAGE_ID = $STAGE_ID[1] ?? false;
        ///*/ выбираем структуру данных и ключи - они же ИД пользовательских полей, из массива от марселя ///*/
        $STRUCTURE = $keys = @include(resource_path($this->array_fields));
        ///*/ формируем псевдомассив с ключами битрикс полей по инстанциям, для будующего анализа принадлежности полей к инстанциям ///*/
        array_walk($keys, function($i, $k) use(&$keys){$keys[$k] = array_keys($i);}); //pa($keys);
        ///*/ если инстанция не передаётся в запросе, берём первую инстанцию из псевдомассива ///*/
        $INSTANCE = (('index'==$request->instance) ?  array_key_first($keys) : ($request->instance ?? array_key_first($keys)));
        ///*/ формируем массив текущей инстанции для наполнения данными, для всего массива полей без учёта инстанции следует использовать $DATA = array_merge(...array_values($STRUCTURE)); ///*/
        $keys_INSTANCE = ('front.report' == $as_rout && ('FI' == $INSTANCE || 'AI' == $INSTANCE || 'CI' ==$INSTANCE)) ?
            array_flip($keys['FI'])+array_flip($keys['AI'])+array_flip($keys['CI']) : array_flip($keys[$INSTANCE]);
        $DATA = array_intersect_key(array_merge(...array_values($STRUCTURE)), $keys_INSTANCE); 
        ///*/ достаём из битрикса стадию сделки по $STAGE_ID ///*/
        $STAGES = $BX->crest->call('crm.status.list');
        foreach(($STAGES['result'] ?? null) as $s){if($STAGE_ID == $s['STATUS_ID']){$DEAL['STAGE'] = $s['NAME']; break;}}

        //pa($_REQUEST); pa($BX->crest->call('user.current'));
        
        foreach((empty($DATA) ? null : $DATA)  as $k => $v){ 
            ///*/ пропускаем и удаляем из результируещего массива поле, если данных для поля в битрикс нет ///*/
            // if(empty($DEAL[$k])){unset($DATA[$k]); continue;}
            
            ///*/ если данные поля строка, убираем вокруг данных ///*/
            if(is_string($DEAL[$k])){$DEAL[$k] = trim($DEAL[$k]);} //pa($k); pa($DATA); pa($DEAL[$k]); exit;
            if(in_array($DATA[$k]['type'], ['date','mdate'])){
                $d = is_date($DEAL[$k]); 
                $DEAL[$k] = is_a($d, '\DateTime') ? $d->format(('front.index'==$as_rout) ? $this->date_format_full : $this->date_format_short) : $DEAL[$k];} 
            //pa($DATA[$k]['type']);
            if('money' == $DATA[$k]['type']){$DEAL[$k] = number_format((int)$DEAL[$k], 0, '', ' ');} 
            if('link' == $DATA[$k]['type']){$DATA[$k]['sepo'] = $ar_sepo;} 
            
            ///*/ при выборе всех полей без учёта инстанций определяет принадлежность поля к инстанции ///*/
             $instance = array_keys(array_filter($keys, function($i, $key) use (&$k){return (in_array($k, $i));}, ARRAY_FILTER_USE_BOTH))[0];
            
            ///*/ выбираем из базы историй все модификации поля, по ключу и инстанции ///*/
            $h = History::where('key', $k)->where('instance', $INSTANCE);
            ///*/ если история изменений есть запоминаем в переменной, если нет то формируем из вновь прибывших данных ///*/
            $history = $h->exists() ? $h->orderByDesc('id')->offset(0)->limit(10)->get()->toArray() : 
                [History::create([
                    'instance' => $instance, 
                    'name' => $v['title'], 
                    'key' => $k,
                    ///*/ если множественное поле из битрикса пришло пишем в базу строкой по разделителю $ar_sepo ///*/ 
                    'value' => (is_array($DEAL[$k]) ? implode($ar_sepo, $DEAL[$k]) : (empty($DEAL[$k]) ? NULL : $DEAL[$k]))]
                )->toArray()];
            ///*/ для множественных полей изменяем данные изменений из строки с разделителем $ar_sepo обратно в массив ///*/
            foreach($history as $kk => $hh){$history[$kk]['value'] = (is_array($DEAL[$k])) ? explode($ar_sepo, $hh['value']) : [$hh['value']];}
            //if(is_array($DEAL[$k])){
            //    foreach($history as $kk => $hh){pa($hh); $history[$kk]['value'] = explode($ar_sepo, $hh['value']);}}
            ///*/ дополняем результирующий массив данными ///*/
            $DATA[$k]['instance'] = $INSTANCE; $DATA[$k]['bitrix'] = (is_array($DEAL[$k])) ? $DEAL[$k] : [$DEAL[$k]]; $DATA[$k]['history'] = $history;
        }//pa($BX->bx24->getDealFields($DEAL_ID)); //pa(count($DATA)); pa(count($DATA)); 
        //pa($DEAL['UF_CRM_CONAD_CRD029']);
        //pa($DATA['UF_CRM_CONAD_CRD029']);
        ///*/ формируем данные на фронт ///*/ 
        $veiw = view($fl_view, [
            'data'          => $DATA,
            'deal_id'       => $DEAL_ID,
            'deal'          => $DEAL,
            'category_id'   => $CATEGORY_ID,
            'instance'      => $INSTANCE,
            'nd'            => $nf_data,
            'ex'            => $ar_sepo,
        ]);}

    ///*/ вывод фронта ///*/        
return ($DEAL_ID && $CATEGORY_ID) ? response($veiw) : abort(403);}
///*/-----------------------------------Метод сохранения в базу///*/
public function save(Request $request){ //pa($_REQUEST);
    $fl_view = $this->file_view;

    ///*/ выбираем структуру данных и ключи - они же ИД пользовательских полей, из массива от марселя ///*/
    $STRUCTURE = $keys = @include(resource_path($this->array_fields));
    ///*/ формируем массив ключей инстанций для валидации пришедшей ищ запроса инстанции на присутствие в массиве ///*/
    $INSTANCES = array_keys($STRUCTURE);
    ///*/ валидация данных из запроса ///*/
    $request->validate(['deal_id' => 'required|regex:/^\d+$/u', 'instance' => ['required', 'regex:#^('.(is_array($INSTANCES) ? implode('|', $INSTANCES) : $request->instance).')$#u']]); 
    ///*/ получаем ID сделки && берём инстанцию из запроса ///*/
    if(($DEAL_ID = $request->deal_id ?? false) && ($INSTANCE = $request->instance ?? false)){
        ///*/ выбираем поля сделки из битрикс ///*/
        $BX = $this->bx; $BX->crest = $this->cr;
        //$DEAL = $BX->bx24->getDeal($DEAL_ID);
        
        ///*/ формируем массив данных для обновления из запроса полей битрикс ///*/
        foreach(array_keys($keys = $STRUCTURE[$request->instance]) as $field){
            if(empty($request->{$field})){continue;}
            if('money' == $STRUCTURE[$INSTANCE][$field]['type']){
                $request->{$field} = intval(preg_replace('/[^0-9]+/', '', $request->{$field}), 10);}
            if('integer' == $STRUCTURE[$INSTANCE][$field]['type']){
                $request->{$field} = intval(preg_replace('/[^0-9]+/', '', $request->{$field}), 10);}
            if(strpos($STRUCTURE[$INSTANCE][$field]['type'], 'date') !== false){
                $d = is_date($request->{$field}); //pa($request->{$field});pa($d); 
                $request->{$field} = (is_a($d, '\DateTime')) ? $d->format('Y-m-d H:i:s') : '';}
            if(empty($request->{$field})){continue;}
            $bx_array_update[$field] = $request->{$field}; //pa($bx_array_update[$field].' -> '.$STRUCTURE[$INSTANCE][$field]['type']);
        }//pa($bx_array_update); exit;
        ///*/ обновляем поля в битриксе ///*/
        if(!empty($bx_array_update) && $bx_is_updated = $BX->bx24->updateDeal($DEAL_ID, $bx_array_update)){
        ///*/ если в битриксе обновились, запускаю анализатор на изменение полей в нашей базе, если какое либо значение поля изменилось добавляю новое значение в базу ///*/
            foreach($bx_array_update as $k => $v){//pa($keys[$k]['title']); exit;
                ///*/ выбираем из базы историй все модификации поля, по ключу и инстанции ///*/
                $h = History::where('key', $k)->where('instance', $INSTANCE)->where('value', $v);
                ///*/ если история изменений есть запоминаем в переменной, если нет то формируем из вновь прибывших данных ///*/
                $history[$k][] = $h->exists() ? $h->first()->toArray() : 
                    History::create([
                        'instance' => $INSTANCE, 
                        'name' => $keys[$k]['title'], 
                        'key' => $k,
                        'value' => $v]
                    )->toArray();
        }}else{$bx_is_updated = false;}        
    }//pa(count($bx_array_update)); pa($bx_array_update); pa(count($request->toArray())); pa($request->toArray());
    
    ///*/ вывод фронта ///*/
// redirect()->action([IndexController::class, 'index'], ['instance' => $request->instance, 'deal_id' => $request->deal_id]) 
return ($bx_is_updated) ?  view('front.undefine', ['deal_id' => $request->deal_id]): 0;}
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
}}

}?>