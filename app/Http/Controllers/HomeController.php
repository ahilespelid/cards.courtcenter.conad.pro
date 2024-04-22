<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Http\Controllers\BtxController;
use Cookie;
use \Crest;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use 
    App\Models\FirstInstance,               App\Models\FirstInstanceClaim,                              App\Models\FirstInstanceClaimMany, 
                                            App\Models\FirstInstanceClaimPrice,                         App\Models\FirstInstanceClaimPriceMany,
                                            App\Models\FirstInstanceStrategy,                           App\Models\FirstInstanceStrategyMany,
                                            App\Models\FirstInstanceCurrentStateCase,                   App\Models\FirstInstanceCurrentStateCaseMany,
                                            App\Models\FirstInstanceInformationProgress,                App\Models\FirstInstanceInformationProgressMany,
                                            App\Models\FirstInstanceStateDuty,                          App\Models\FirstInstanceStateDutyMany,
                                            App\Models\FirstInstanceDateUpcomingCase,                   App\Models\FirstInstanceDateUpcomingCaseMany,
                                    
    App\Models\CourtsAppeal,                App\Models\CourtsAppealStrategy,                            App\Models\CourtsAppealStrategyMany,
                                            App\Models\CourtsAppealDateUpcomingCase,                    App\Models\CourtsAppealDateUpcomingCaseMany,
                                    
                                            App\Models\CourtsAppealInformationProgress,                 App\Models\CourtsAppealInformationProgressMany,
    App\Models\CourtsСassation,             App\Models\CourtsCassationStrategy,                         App\Models\CourtsCassationStrategyMany,
                                            App\Models\CourtsCassationDateUpcomingCase,                 App\Models\CourtsCassationDateUpcomingCaseMany,
                                            App\Models\CourtsCassationInformationProgress,              App\Models\CourtsCassationInformationProgressMany,
                                    
    App\Models\Bankruptcy,                  App\Models\BankruptcyStrategy,                              App\Models\BankruptcyStrategyMany,
                                            App\Models\BankruptcyPayments,                              App\Models\BankruptcyPaymentsMany,
                                            App\Models\BankruptcyStage,                                 App\Models\BankruptcyStageMany,                      
                                            App\Models\BankruptcyInformationCourt,                      App\Models\BankruptcyInformationCourtMany,
                                    
    App\Models\Mediation,                   App\Models\MediationStrategy,                               App\Models\MediationStrategyMany,
                                            App\Models\MediationDiscountCalculation,                    App\Models\MediationDiscountCalculationMany,
                                            App\Models\MediationSecondOfferDebtor,                      App\Models\MediationSecondOfferDebtorMany,
                                            App\Models\MediationTypeDebt,
                                            
    App\Models\CourtsResumption,            App\Models\CourtsResumptionStrategy,                        App\Models\CourtsResumptionStrategyMany,
    
    App\Models\EnforcementProceedings,      App\Models\EnforcementProceedingsStrategy,                  App\Models\EnforcementProceedingsStrategyMany,
                                            App\Models\EnforcementProceedingsInformationProgress,       App\Models\EnforcementProceedingsInformationProgressMany,
                                            App\Models\EnforcementProceedingsInformationAuction,        App\Models\EnforcementProceedingsInformationAuctionMany,
                                            App\Models\EnforcementProceedingsDateVisitBailiff,          App\Models\EnforcementProceedingsDateVisitBailiffMany;
class HomeController extends Controller{    
///*/-----------------------------------Метод вывода в битрикс///*/
public function index(Request $request){
    $_REQUEST['deal_id'] = empty($_REQUEST['deal_id']) ? '' : $_REQUEST['deal_id'];
    $_REQUEST['tab'] = empty($_REQUEST['tab']) ? 'Not found' : $_REQUEST['tab'];
    $_REQUEST['PLACEMENT_OPTIONS'] = empty($_REQUEST['PLACEMENT_OPTIONS']) ? '' : $_REQUEST['PLACEMENT_OPTIONS'];
    
    $_REQUEST['deal_id'] = $deal_id = empty($deal = json_decode($_REQUEST['PLACEMENT_OPTIONS'], true)) ? 
        (empty($deal_id = $_REQUEST['deal_id']) ? null : $deal_id) : (empty($deal['ID']) ? null : $deal['ID']);
    $deal = (!empty($deal_id) && $deal = CRest::call('crm.deal.get', ['ID' => $deal_id])) ? 
        (isset($deal['result']) ? $deal['result'] : ['ID' => $deal['error_description']]) : $deal;
    $deal['ID'] = (empty($deal['ID'])) ? 'Not found' : $deal['ID'];        
    $deal['CATEGORY_ID'] = (empty($deal['CATEGORY_ID'])) ? null : $deal['CATEGORY_ID'];        
    $deal_into_id = (empty($deal['UF_CRM_1683462809'])) ? null : $deal['UF_CRM_1683462809'];
    $fields = @include(resource_path('arrays/fields.php'));
    pa($fields);
///*/ Вкладка Суды-первой инстанции ///*/        
    if($_REQUEST['tab'] == $view = 'first_instance'){
        ///*/
        if(empty($_id = FirstInstance::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new FirstInstance)->table;
            $I_id = (!empty($maxid = DB::connection('two')->select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getFirstInstance($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(1==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);
        pa($data);
    }else
///*/ Вкладка Суды-апеляция ///*/
    if($_REQUEST['tab'] == $view = 'courts_appeal'){
        if(empty($_id = CourtsAppeal::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsAppeal)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(2==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
        
    }else
///*/ Вкладка Суды-касация ///*/
    if($_REQUEST['tab'] == $view = 'courts_cassation'){
        if(empty($_id = CourtsСassation::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsСassation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsСassation($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(3==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
        
    }else
///*/ Исполнительное производство ///*/
    if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
        if(empty($_id = EnforcementProceedings::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new EnforcementProceedings)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getEnforcementProceedings($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(4==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
       
    }else
///*/ Банкротство ///*/
    if($_REQUEST['tab'] == $view = 'bankruptcy'){
        if(empty($_id = Bankruptcy::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Bankruptcy)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getBankruptcy($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(5==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
        
    }else
///*/ Медиации ///*/
    if($_REQUEST['tab'] == $view = 'mediation'){
        if(empty($_id = Mediation::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Mediation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getMediation($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(6==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
        
    }else
///*/ Суды-возобновление производства ///*/
    if($_REQUEST['tab'] == $view = 'courts_resumption'){
        if(empty($_id = CourtsResumption::where('deal_id', $deal_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsResumption)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsResumption($_id->id);
        }
        ///*/ Добавление пользовательских полей битрикса в приложение из файла resource/arrays/fields.php ///*/
        array_walk($fields, function($i,$k) use(&$data, $deal, $view){
            if(7==$i[3]){$data[$view][$i[1]] = ['type' => $i['type'], 'title' => $i[0], 'data' => $deal[$i[1]] ?? ''];}});
        //pa($deal);pa($data);
        
    }else{return view('front.undefine', ['deal' => $deal]);}
///*/>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Вывод ///*/    
    $id             = (!empty($data[$view]['id'])) ? $data[$view]['id'] : null ; 
    $created_at     = (!empty($data[$view]['created_at'])) ? $data[$view]['created_at'] : null; 
    $updated_at     = (!empty($data[$view]['updated_at'])) ? $data[$view]['updated_at'] : null;
    $deleted_at     = (!empty($data[$view]['deleted_at'])) ? $data[$view]['deleted_at'] : null;
    $remember_token = (!empty($data[$view]['remember_token'])) ? $data[$view]['remember_token'] : null;
    if(isset($data[$view]['id']) || isset($data[$view]['created_at']) || isset($data[$view]['updated_at']) || isset($data[$view]['deleted_at']) || isset($data[$view]['remember_token'])){
        unset($data[$view]['id'], $data[$view]['deal_id'], $data[$view]['deal_into_id'], $data[$view]['created_at'], $data[$view]['updated_at'], $data[$view]['deleted_at'], $data[$view]['remember_token']);
    }else{$data[$view='undefine'] = 'undefine';}
///*/ Проходимся по итоговому массиву данных перед выводом ///*/
    foreach($data[$view] as $key => $val){
        if(isset($val['type']) && 'o' == $val['type']){
            if('mediation' == $view){
                $MediationTypeDebt = MediationTypeDebt::where('deleted_at', '=', NULL)->get()->toArray();
                
                $option = (!empty($data[$view][$key]['data']['data'])) ? $data[$view][$key]['data']['data'] : '';
                $selected = (!empty($data[$view][$key]['data']['selected'])) ? $data[$view][$key]['data']['selected'] : 1;
                
                $data[$view][$key]['data'] = $option;
                $data[$view][$key]['selected'] = $selected;
            }
            $data[$view][$key]['data'] = (!empty($data[$view][$key]['data'] = json_decode($data[$view][$key]['data'], true))) ? $data[$view][$key]['data'] : (('mediation' == $view) ? $MediationTypeDebt : ['option' => 'Not found']);
        }
        if(!empty($val['type']) && str_contains($val['type'], 'm')){
            ///*/ Работа с датами во множественных полях, спасибо постгрис ///*/
            $data[$view][$key]['data'] = (json_validate($val['data'])) ? json_decode($val['data'], true) : $val['data'];
            
            if(!empty($data[$view][$key]['data']['updated_at'])){
                $data[$view][$key]['data']['updated_at'] = (is_date($data[$view][$key]['data']['updated_at'])) ? date_format(date_create($data[$view][$key]['data']['updated_at']), 'Y-m-d H:i:s') : null;
            }
        }
    }///*/ pa($data[$view]); if('10.10.0.24' == $_SERVER["REMOTE_ADDR"]){pa($data[$view][$key]); exit;}
    
    //session_save_path("/tmp"); session_start();
    //$_SESSION['link_token'] = now()->addMinutes(5);
    //pa($_SESSION);     
    /*
    if(isset($_SESSION['link_token']) && $expires = is_date($_SESSION['link_token'])){
        
        pa($expires);
    }else{
        $_SESSION['link_token'] = now()->addMinutes(5);
        
        $token = hash('sha256', Str::random(32));
        $cookie = cookie('link_token', $token, now()->addMinutes(1)->timestamp);
        echo $token;
        //echo $cookie;
        //$val = Cookie::get('link_token');
        //var_dump($val);
    
       
        
    }
    */
    // Временное решение убираем множественные поля из битрикса, на 0 поле заменяем
    foreach($data[$view] as $key => $d){
        if(is_array($d['data'])){$data[$view][$key]['data'] = $d['data'][0] ?? '';}
    }
    $veiw = view('front.'.$view, [
        'id' => $id, 'created_at' => $created_at, 'updated_at' => $updated_at,
        'data' => $data[$view],
        'request' => $request,
        'deal' => $deal,'deal_into_id' => $deal_into_id,
    ]);
    //pa($data[$view]);exit;
return response($veiw);}
///*/-----------------------------------Метод сохранения в базу///*/
public function save(Request $request){
    //pa($_POST); exit;

    $request->validate([
        'id' => 'required|regex:/^\d+$/u',
        'tab' => 'required|regex:/^[a-z_]+$/u',
        'deal_id' => 'required',
        'deal_into_id' => 'required',
        //'deal_id' => 'nullable|date',
    ]);

    $request->updated_at = date('Y-m-d H:i:s');
    
    $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$request->tab.'.php');
    foreach($structura as $k => $v){if('m' == $structura[$k]['type']){unset($structura[$k]);}}
    $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
    $structura = ['id'=>'','deal_id'=>'','deal_into_id'=>'']+$structura+['updated_at'=>''];
    
    $fields = @include(resource_path('arrays/fields.php'));
    
    //pa($request->all());
    if(!empty($request->deal_id) && !empty($UF_CRM_CONAD_LIST = array_column($fields, 1)) && is_array($UF_CRM_CONAD_LIST)){
        foreach($UF_CRM_CONAD_LIST as $UF_CRM_CONAD_NUM){if(!empty($request->$UF_CRM_CONAD_NUM)){
            $UF_CRM_CONAD_UPDATE [$UF_CRM_CONAD_NUM]= $request->$UF_CRM_CONAD_NUM;
        }}
        @CRest::call('crm.deal.update', ['id' => $request->deal_id, 'fields' => $UF_CRM_CONAD_UPDATE, 'params'  => ['REGISTER_SONET_EVENT' => 'Y']]);
    }
    //pa($UF_CRM_CONAD_UPDATE);
    //exit;
    
    
///*/ Вкладка Суды-первой инстанции ///*/        
    if($request->tab == $view = 'first_instance'){
        ///*/ pa($_POST); exit;
        $request->validate([
            'name_and_number'        => 'nullable|string',
            'parties_to_case'        => 'nullable|string',
            'who_represent'          => 'nullable|string',
            'subject_dispute'        => 'nullable|string',
            'deposit'                => 'nullable|string',
            'strategy'               => 'nullable|string', // m
            'claim'                  => 'nullable|string', // m
            'claim_price'            => 'nullable|string', // m
            'state_duty'             => 'nullable|string', // m
            'date_start'             => 'nullable|string',
            'number_case'            => 'nullable|string',
            'court_judge'            => 'nullable|string',
            'information_progress'   => 'nullable|string', // m
            'date_upcoming_case'     => 'nullable|string', // m
            'information_case'       => 'nullable|string',
            'current_state_case'     => 'nullable|string', // m
            'result_case'            => 'nullable|string',
            'sum_case'               => 'nullable|string',
            'date_force_case'        => 'nullable|string',
            'time_limit'             => 'nullable|string',
            'date_production_case'   => 'nullable|string',
            'date_receipt_case'      => 'nullable|string',
            'appeal_case'            => 'nullable|string',
            'date_filing_appeal'     => 'nullable|string',
            'date_acceptance_appeal' => 'nullable|string',
            'sum_services'           => 'nullable|string',
            //'exp' => 'nullable|date',
        ]);    
       
        ///*/ Создаём или выбираем модель ///*/
        $ob_ = FirstInstance::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : FirstInstance::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = FirstInstanceStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
                //pa($subpush->toArray());exit;
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaim)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaim)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->claim) && $push = FirstInstanceClaim::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->claim; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceClaimMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->claim_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimPrice)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimPrice)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->claim_price) && $push = FirstInstanceClaimPrice::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->claim_price; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimPriceMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimPriceMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceClaimPriceMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->claim_price_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStateDuty)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStateDuty)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->state_duty) && $push = FirstInstanceStateDuty::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->state_duty; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStateDutyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStateDutyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceStateDutyMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->state_duty_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceInformationProgress)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceInformationProgress)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_progress) && $push = FirstInstanceInformationProgress::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_progress; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceInformationProgressMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceInformationProgressMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceInformationProgressMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->information_progress_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceDateUpcomingCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceDateUpcomingCase)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->date_upcoming_case) && $push = FirstInstanceDateUpcomingCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->date_upcoming_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceDateUpcomingCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceDateUpcomingCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceDateUpcomingCaseMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->date_upcoming_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceCurrentStateCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceCurrentStateCase)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->current_state_case) && $push = FirstInstanceCurrentStateCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->current_state_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceCurrentStateCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceCurrentStateCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceCurrentStateCaseMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->current_state_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }}else
///*/ Вкладка Суды-апеляция ///*/
    if($_REQUEST['tab'] == $view = 'courts_appeal'){
        ///*/ pa($_POST); exit;

        $request->validate([
            'applicant_complaint'           => 'nullable|string',
            'strategy'                      => 'nullable|string', // m
            'state_duty'                    => 'nullable|string',
            'brief_complaint'               => 'nullable|string',
            'complaint'                     => 'nullable|string',
            'objections'                    => 'nullable|string', 
            'date_filing_complaint'         => 'nullable|string', 
            'date_acceptance_complaint'     => 'nullable|string', 
            'court_judge'                   => 'nullable|string', 
            'date_upcoming_case'            => 'nullable|string', // m
            'number_case'                   => 'nullable|string',
            'link'                          => 'nullable|string',
            'information_case'              => 'nullable|string', 
            'result_case'                   => 'nullable|string', 
            'sum_case'                      => 'nullable|string',
            'date_production_case'          => 'nullable|string', 
            'date_receipt_case'             => 'nullable|string',
            'information_progress'          => 'nullable|string', // m
            'date_filing_appeal'            => 'nullable|string',
            'date_acceptance_appeal'        => 'nullable|string',
            'sum_services'                  => 'nullable|string',
            //'exp' => 'nullable|date',
        ]);    
        
        ///*/ Создаём или выбираем модель ///*/
        $ob_ = CourtsAppeal::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : CourtsAppeal::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = CourtsAppealStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsAppealStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_appeal_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealDateUpcomingCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealDateUpcomingCase)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->date_upcoming_case) && $push = CourtsAppealDateUpcomingCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->date_upcoming_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealDateUpcomingCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealDateUpcomingCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsAppealDateUpcomingCaseMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_appeal_id = $ob_->id; $subpush->date_upcoming_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealInformationProgress)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealInformationProgress)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_progress) && $push = CourtsAppealInformationProgress::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_progress; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsAppealInformationProgressMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsAppealInformationProgressMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsAppealInformationProgressMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_appeal_id = $ob_->id; $subpush->information_progress_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }        
    }else
///*/ Вкладка Суды-касация ///*/
    if($_REQUEST['tab'] == $view = 'courts_cassation'){
        ///*/ pa($_POST); exit; ///*/

        $request->validate([
            'applicant_complaint'           => 'nullable|string',
            'strategy'                      => 'nullable|string', // m
            'state_duty'                    => 'nullable|string',
            'complaint'                     => 'nullable|string',
            'objections'                    => 'nullable|string',
            'court_judge'                   => 'nullable|string', 
            'date_upcoming_case'            => 'nullable|string', // m
            'number_case'                   => 'nullable|string',
            'link'                          => 'nullable|string',
            'information_progress'          => 'nullable|string', // m
            'result_case'                   => 'nullable|string', 
            'sum_case'                      => 'nullable|string',
            'date_production_case'          => 'nullable|string', 
            'date_receipt_case'             => 'nullable|string',
            'information_case'              => 'nullable|string', 
            'sum_services'                  => 'nullable|string',
            //'exp' => 'nullable|date',
        ]);    
        
        ///*/ Создаём или выбираем модель ///*/
        $ob_ = CourtsСassation::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : CourtsСassation::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        //pa($ob_->toArray()); exit;
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = CourtsCassationStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsCassationStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_сassation_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationDateUpcomingCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationDateUpcomingCase)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->date_upcoming_case) && $push = CourtsCassationDateUpcomingCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->date_upcoming_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationDateUpcomingCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationDateUpcomingCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsCassationDateUpcomingCaseMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_сassation_id = $ob_->id; $subpush->date_upcoming_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationInformationProgress)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationInformationProgress)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_progress) && $push = CourtsCassationInformationProgress::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_progress; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsCassationInformationProgressMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsCassationInformationProgressMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsCassationInformationProgressMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_сassation_id = $ob_->id; $subpush->information_progress_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }           
    }else
///*/ Исполнительное производство ///*/
    if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
        ///*/ pa($_POST); exit; ///*/

        $request->validate([
            'recoverer'                             => 'nullable|string',
            'debtor'                                => 'nullable|string', 
            'date_force'                            => 'nullable|string',
            'time_limit'                            => 'nullable|string',
            'sum_case'                              => 'nullable|string',
            'information_mortgaged_property'        => 'nullable|string', 
            'strategy'                              => 'nullable|string', // m
            'date_submission_fssp'                  => 'nullable|string',
            'date_initiation_fssp'                  => 'nullable|string',
            'contact_bailiff'                       => 'nullable|string', 
            'link'                                  => 'nullable|string', 
            'information_progress'                  => 'nullable|string', // m
            'arrests_bans_encumbrances'             => 'nullable|string', 
            'date_visit_bailiff'                    => 'nullable|string', // m
            'property_valuation'                    => 'nullable|string', 
            'information_auction'                   => 'nullable|string', // m
            'information_auction_result'            => 'nullable|string',
            'offer_recoverer'                       => 'nullable|string',
            'date_transfer_founds'                  => 'nullable|string',
            'information_provision_debt_fssp'       => 'nullable|string',
            'date_transfer_founds_recoverer'        => 'nullable|string',
            'date_completion'                       => 'nullable|string',
            'date_end_execution'                    => 'nullable|string',
            //'exp' => 'nullable|date',
        ]);    

        ///*/ Создаём или выбираем модель ///*/
        $ob_ = EnforcementProceedings::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : EnforcementProceedings::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        //pa($ob_->toArray()); exit;
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = EnforcementProceedingsStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = EnforcementProceedingsStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->enforcement_proceedings_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsInformationProgress)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsInformationProgress)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_progress) && $push = EnforcementProceedingsInformationProgress::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_progress; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsInformationProgressMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsInformationProgressMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = EnforcementProceedingsInformationProgressMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->enforcement_proceedings_id = $ob_->id; $subpush->information_progress_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsDateVisitBailiff)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsDateVisitBailiff)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->date_visit_bailiff) && $push = EnforcementProceedingsDateVisitBailiff::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->date_visit_bailiff; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsDateVisitBailiffMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsDateVisitBailiffMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = EnforcementProceedingsDateVisitBailiffMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->enforcement_proceedings_id = $ob_->id; $subpush->date_visit_bailiff_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsInformationAuction)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsInformationAuction)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_auction) && $push = EnforcementProceedingsInformationAuction::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_auction; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new EnforcementProceedingsInformationAuctionMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new EnforcementProceedingsInformationAuctionMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = EnforcementProceedingsInformationAuctionMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->enforcement_proceedings_id = $ob_->id; $subpush->information_auction_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }
    }else
///*/ Банкротство ///*/
    if($_REQUEST['tab'] == $view = 'bankruptcy'){
        ///*/ pa($_POST); exit; ///*/

        $request->validate([
            'applicant'                     => 'nullable|string',
            'debtor'                        => 'nullable|string', 
            'bankruptcy_trustee'            => 'nullable|string',
            'strategy'                      => 'nullable|string', // m
            'state_duty'                    => 'nullable|string',
            'deposit'                       => 'nullable|string', 
            'number_case'                   => 'nullable|string', 
            'link'                          => 'nullable|string',
            'stage'                         => 'nullable|string', // m
            'date_current_stage'            => 'nullable|string', 
            'information_creditors'         => 'nullable|string', 
            'property_valuation'            => 'nullable|string', 
            'bank_accounts'                 => 'nullable|string', 
            'information_invalidation'      => 'nullable|string', 
            'information_court'             => 'nullable|string', // m
            'payments'                      => 'nullable|string', // m
            'subsidiary_liability'          => 'nullable|string',
            'assessment_property'           => 'nullable|string',
            'result_case'                   => 'nullable|string',
            //'exp' => 'nullable|date',
        ]);    

        ///*/ Создаём или выбираем модель ///*/
        $ob_ = Bankruptcy::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : Bankruptcy::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        //pa($ob_->toArray()); exit;
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = BankruptcyStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = BankruptcyStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->bankruptcy_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyStage)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyStage)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->stage) && $push = BankruptcyStage::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->stage; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyStageMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyStageMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = BankruptcyStageMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->bankruptcy_id = $ob_->id; $subpush->stage_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyInformationCourt)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyInformationCourt)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->information_court) && $push = BankruptcyInformationCourt::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_court; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyInformationCourtMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyInformationCourtMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = BankruptcyInformationCourtMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->bankruptcy_id = $ob_->id; $subpush->information_court_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyPayments)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyPayments)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->payments) && $push = BankruptcyPayments::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->payments; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new BankruptcyPaymentsMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new BankruptcyPaymentsMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = BankruptcyPaymentsMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->bankruptcy_id = $ob_->id; $subpush->payments_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }        
    }else
///*/ Медиации ///*/
    if($_REQUEST['tab'] == $view = 'mediation'){
        ///*/ pa($_POST); exit; ///*/

        $request->validate([
            'procedural_succession'     => 'nullable|string',
            'assessment_property'       => 'nullable|string', 
            'strategy'                  => 'nullable|string', // m
            'type_debt'                 => 'nullable|string', 
            'contact_debtor'            => 'nullable|string',
            'discount_calculation'      => 'nullable|string', // m
            'first_offer_debtor'        => 'nullable|string', 
            'second_offer_debtor'       => 'nullable|string', // m
            'third_offer_debtor'        => 'nullable|string', 
            'fourth_offer_debtor'       => 'nullable|string', 
            'fifth_offer_debtor'        => 'nullable|string', 
            //'exp' => 'nullable|date',
        ]);    


        ///*/ Создаём или выбираем модель ///*/
        $ob_ = Mediation::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : Mediation::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        //pa($ob_->toArray()); exit;
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = MediationStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = MediationStrategyMany::create(['id' => $subpush_id, 'mediation_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->mediation_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationDiscountCalculation)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationDiscountCalculation)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->discount_calculation) && $push = MediationDiscountCalculation::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->discount_calculation; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationDiscountCalculationMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationDiscountCalculationMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = MediationDiscountCalculationMany::create(['id' => $subpush_id, 'mediation_id' => $ob_->id, 'discount_calculation_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->mediation_id = $ob_->id; $subpush->discount_calculation_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationSecondOfferDebtor)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationSecondOfferDebtor)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->second_offer_debtor) && $push = MediationSecondOfferDebtor::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->second_offer_debtor; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationSecondOfferDebtorMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationSecondOfferDebtorMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = MediationSecondOfferDebtorMany::create(['id' => $subpush_id, 'mediation_id' => $ob_->id, 'second_offer_debtor_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->mediation_id = $ob_->id; $subpush->second_offer_debtor_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }        

        //
        /*/
        if(!empty($_id = Mediation::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['mediation'] = !empty($mediation = $this->getMediation($_id['id'])) ? $mediation : '';
        }
        ///*/            
    }else
///*/ Суды-возобновление производства ///*/
    if($_REQUEST['tab'] == $view = 'courts_resumption'){
        ///*/ pa($_POST); exit; ///*/

        $request->validate([
            'reasons_resuming'      => 'nullable|string',
            'initiator'             => 'nullable|string', 
            'stage_resumption'      => 'nullable|string',
            'strategy'              => 'nullable|string', // m
            //'exp' => 'nullable|date',
        ]);    
        
        
        ///*/ Создаём или выбираем модель ///*/
        $ob_ = CourtsResumption::where('id', $request->id)->orWhere('deal_id', $request->deal_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : CourtsResumption::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        //pa($ob_->toArray()); exit;
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsResumptionStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsResumptionStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->strategy) && $push = CourtsResumptionStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new CourtsResumptionStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new CourtsResumptionStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = CourtsResumptionStrategyMany::create(['id' => $subpush_id, 'courts_resumption_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->courts_resumption_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }
    }else{return view('front.undefine', ['deal' => $deal]);}

return redirect()->action([HomeController::class, 'index'], ['tab' => $request->tab, 'deal_id' => $request->deal_id]);}
///*/-----------------------------------Метод добавления открытия сделки по кнонке Выгрузить в окне вне битрикса///*/
public function up(Request $request){
    $bx = new BtxController;
    $request->validate([
        'tab' => 'required',
        'deal_into_id' => 'required',
    ]);
    $deal = (!empty($request->deal_into_id) && $deal = CRest::call('crm.deal.get', ['ID' => $request->deal_into_id])) ? ($deal['result'] ?? ['ID' => $deal['error_description']]) : $deal; //
    pa($deal);
    pa($bx->bx24->getDeal($request->deal_into_id));
    ///*/ ahilespelid Первая инстанция ///*/
    $keyFI = [
        'DATE_CREATE',                 //- Дата создания карточки
        'UF_CRM_YR24_PLAINTIFFS',      //- Истец
        'UF_CRM_YR24_DEFENDANTS',      //- Ответчик
        'UF_CRM_YR24_OTHERS',          //- Третье лицо
        'UF_CRM_CONAD_CRD091',         //- Номер дела
        'UF_CRM_CONAD_CRD092',         //- Судья
        'UF_CRM_1702719450',           //- Ближайшее заседание
        'UF_CRM_YR24_NEAREST_SESSION', //- Ближайшее заседание ||
        'UF_CRM_CONAD_CRD003',         //+ Претензия
        'UF_CRM_CONAD_CRD015',         //- Дата фактического изготовления судом решения
        'UF_CRM_CONAD_CRD010',         //+ Результат рассмотрения дела
        'UF_CRM_CONAD_CRD011',         //- Сумма заявленных требований
        'UF_CRM_CONAD_CRD012',         //- Сумма удовлетворенных судом
        'UF_CRM_CONAD_CRD008',         //- Обеспечительные меры
        'UF_CRM_1666170845189',        //- Залог
        'UF_CRM_CONAD_CRD004',         //- Госпошлина
        'UF_CRM_CONAD_CRD016',         //- Дата получения решения
        'UF_CRM_CONAD_CRD013',         //- Дата вступления судебного акта в силу
        'UF_CRM_CONAD_CRD093',         //- Дата обжалования
        'UF_CRM_CONAD_CRD018',         //- Дата подачи жалобы
        'UF_CRM_CONAD_CRD019',         //- Дата принятия жалобы
        'UF_CRM_CONAD_CRD020'          //- Сумма оказанных юридических услуг
    ];
    
    ///*/ ahilespelid Апелляционная инстанция ///*/
    $keyAI = [
        'DATE_CREATE',                  //- Дата создания карточки
        'UF_CRM_YR24_PLAINTIFFS',       //- Истец
        'UF_CRM_YR24_DEFENDANTS',       //- Ответчик
        'UF_CRM_YR24_OTHERS',           //- Третье лицо
        'UF_CRM_CONAD_CRD101',          //- Номер дела
        'UF_CRM_CONAD_CRD092',          //- Судья
        'UF_CRM_1702719450',            //- Ближайшее заседание
        'UF_CRM_YR24_NEAREST_SESSION',  //- Ближайшее заседание ||
        'UF_CRM_CONAD_CRD037',          //- Заявитель
        'UF_CRM_CONAD_CRD024',          //-? Краткая апелляционная жалоба
        'UF_CRM_CONAD_CRD025',          //- Апелляционная жалоба
        'UF_CRM_CONAD_CRD027',          //- Дата подачи жалобы 
        'UF_CRM_CONAD_CRD028',          //-? Дата подачи жалобы 
        'UF_CRM_CONAD_CRD026',          //- Возражения на апелляционную жалобу
        'UF_CRM_CONAD_CRD096',          //- Дата возражения на апелляционную жалобу
        'UF_CRM_CONAD_CRD003',          //- Претензия
        'UF_CRM_CONAD_CRD034',          //- Дата получения апелляционного определения
        'UF_CRM_CONAD_CRD030',          //- Результат рассмотрения апелляционной жалобы (определение)
        'UF_CRM_CONAD_CRD031',          //- Сумма заявленных требований
        'UF_CRM_CONAD_CRD032',          //- Сумма удовлетворенных судом требований
        'UF_CRM_CONAD_CRD022',          //- Госпошлина
        'UF_CRM_CONAD_CRD036'           //- Сумма оказанных юридических услуг
    ];
    
    ///*/ ahilespelid Кассационная инстанция ///*/
    $keyCI = [
        'DATE_CREATE',                   //- Дата создания карточки
        'UF_CRM_YR24_PLAINTIFFS',        //- Истец
        'UF_CRM_YR24_DEFENDANTS',        //- Ответчик
        'UF_CRM_YR24_OTHERS',            //- Третье лицо
        'UF_CRM_CONAD_CRD102',           //- Номер дела
        'UF_CRM_CONAD_CRD092',           //- Судья
        'UF_CRM_1702719450',             //- Ближайшее заседание
        'UF_CRM_YR24_NEAREST_SESSION',   //- Ближайшее заседание ||
        'UF_CRM_CONAD_CRD095',           //- Заявитель
        'UF_CRM_CONAD_CRD042',           //- Информация о ходе рассмотрения кассационной жалобы
        'UF_CRM_CONAD_CRD040',           //- Кассационная жалоба
        'UF_CRM_CONAD_CRD097',           //- Дата кассационной жалобы
        'UF_CRM_CONAD_CRD098',           //- Дата принятия судом кассационной жалобы
        'UF_CRM_CONAD_CRD041',           //- Возражения на кассационную жалобу
        'UF_CRM_CONAD_CRD099',           //- Дата получения возражения на кассационную жалобу
        'UF_CRM_CONAD_CRD003',           //- Претензия
        'UF_CRM_CONAD_CRD043',           //- Результат рассмотрения
        'UF_CRM_CONAD_CRD046',           //- Дата фактического изготовления судебного акта
        'UF_CRM_CONAD_CRD044',           //- Сумма заявленных требований
        'UF_CRM_CONAD_CRD045',           //- Сумма удовлетворенных судом требований
        'UF_CRM_CONAD_CRD038',           //- Госпошлина
        'UF_CRM_CONAD_CRD049'            //- Сумма оказанных юридических услуг
    ];
    
    ///*/ ahilespelid Исполнительное производство ///*/
    $keyIP = [
        'UF_CRM_CONAD_CRD103',           //- Номер дела
        'UF_CRM_CONAD_CRD059',           //- Ссылка на исполнительное производство на сайте ФССП
        'UF_CRM_CONAD_CRD050',           //- Взыскатель
        'UF_CRM_CONAD_CRD051',           //- Должник
        'UF_CRM_CONAD_CRD052',           //- Дата вступления решения ИП в законную силу
        'UF_CRM_CONAD_CRD053',           //- Срок для предъявления исполнительного листа к исполнению
        'UF_CRM_CONAD_CRD069',           //- Дата завершения исполнительного производства
        'UF_CRM_CONAD_CRD104',           //- Причина окончания
        'UF_CRM_CONAD_CRD105',           //- Сумма требования на момент постановления
        'UF_CRM_CONAD_CRD106',           //- Дата окончания судебной процедуры
        'UF_CRM_CONAD_CRD107',           //- Задолженность с учетом процентов на день взыскания
        'UF_CRM_CONAD_CRD108',           //- Запросы судебных приставов
        'UF_CRM_CONAD_CRD109',           //- Ответ на запросы
        'UF_CRM_1686046817804',          //- Стратегия
        'UF_CRM_CONAD_CRD060',           //- Информация о ходе исполнительного производства
        'UF_CRM_CONAD_CRD062',           //- Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации
        'UF_CRM_CONAD_CRD061',           //- Аресты, запреты, обременения
        'UF_CRM_CONAD_CRD055',           //- Сведения о заложенном имуществе
        'UF_CRM_1636705135040',          //- Стоимость имущества
        'UF_CRM_CONAD_CRD065',           //- Предложение взыскателю оставить имущество за собой
        'UF_CRM_CONAD_CRD072',           //- Сумма оказанных юридических услуг
        'UF_CRM_CONAD_CRD100',           //- Сведения о торгах
        'UF_CRM_CONAD_CRD110',           //- Результат проведения торгов
        'UF_CRM_CONAD_CRD066',           //- Планируемая дата перечисления денежных средств 
        'UF_CRM_CONAD_CRD068',           //- Дата поступления денежных средств ИП взыскателю
        'UF_CRM_CONAD_CRD069',           //- Дата завершения исполнительного производства
        'UF_CRM_CONAD_CRD070',           //- Дата окончания следующей подачи исполнительного листа
        'UF_CRM_CONAD_CRD071'            //- Основание окончания исполнительного производства
    ];
    
    ///*/ ahilespelid Банкротство ///*/
    $keyBI = [
        'UF_CRM_CONAD_CRD111',           //- Номер дела
        'UF_CRM_CONAD_CRD122',           //- Ссылка на дело в суде
        'UF_CRM_CONAD_CRD112',           //- Заявитель
        'UF_CRM_CONAD_CRD113',           //- Должник
        'UF_CRM_CONAD_CRD114',           //- Конкурсный управляющий
        'UF_CRM_CONAD_CRD073',           //- Госпошлина
        'UF_CRM_1679485736362',          //- Депозит
        'UF_CRM_CONAD_CRD075',           //- Дата окончания текущей стадии
        'UF_CRM_CONAD_CRD115',           //- Информация о кредиторах
        'UF_CRM_1686038365473',          //- Комментарий по имуществу
        'UF_CRM_1636705135040',          //- Стоимость имущества
        'UF_CRM_CONAD_CRD118',           //- Информация о банковских счетах должника
        'UF_CRM_CONAD_CRD117',           //- Информация о признании сделок/платежей недействительными
        'UF_CRM_CONAD_CRD116',           //- Дата поступления ДС Банкротство
        'UF_CRM_CONAD_CRD081',           //- Субсидиарная ответственность
        'UF_CRM_CONAD_CRD082',           //- Оценка имущества должностных лиц 
        'UF_CRM_CONAD_CRD083',           //- Результат банкротства
        'UF_CRM_CONAD_CRD084'            //- Сумма оказанных юридических услуг
    ];
    
    ///*/ ahilespelid Медиация ///*/
    $keyMD = [                            
        'UF_CRM_CONAD_CRD119',           //- Номер дела
        'UF_CRM_CONAD_CRD086',           //- Контакт должника
        'UF_CRM_CONAD_CRD085',           //- Процессуальное правопреемство
        'UF_CRM_CONAD_CRD123',           //- Дата определения АС
        'UF_CRM_1686038365473',          //- Комментарий по имуществу
        'UF_CRM_1636705135040',          //- Стоимость имущества
        'UF_CRM_1686046817804',          //- Стратегия
        'UF_CRM_CONAD_CRD088'            //- Отчет о работе
    ];
    
    ///*/ ahilespelid Возобновление производства ///*/
    $keyRE = [
        'UF_CRM_CONAD_CRD119',           //- Номер дела
        'UF_CRM_CONAD_CRD090',           //- Инициатор
        'UF_CRM_CONAD_CRD089',           //- Причины, по которым возобновляется производство
        'UF_CRM_1686046817804'           //- Стратегия
    ];
    
    foreach($data = array_flip(array_merge($keyFI, $keyAI, $keyCI, $keyIP, $keyBI, $keyMD, $keyRE)) as $k => $v){
        if(isset($deal[$k]) && is_string($deal[$k])){$deal[$k] = trim($deal[$k]);}
        if(empty($deal[$k])){unset($data[$k]); continue;}
        
        $data[$k] = $deal[$k]; 
        
    }
    $data['ID'] = $deal['ID']; unset($deal);
    //var_dump($data['UF_CRM_YR24_OTHERS']);
    //pa($date1 = is_date($deal['UF_CRM_CONAD_CRD016']));  
    //pa($date1->diff($date2));    

    $send = [
        'deal' => $data, 
        'nd' => 'н\д', 
        'ex' => ',', 
        'tab' => $request->tab
    ]; 
    if('Not found' == $data['ID']){unset($data);} //pa($send);
     
return (empty($data)) ? abort(404) : view('intro.'.$request->tab, $send); //'<script>alert("[Сообщение отладки] номер сделки - '.$deal['ID'].'");window.close();</script>'

    $data['DATE_CREATE']                                = '';
    $data['UF_CRM_YR24_DIRECT_API_CASE_NUMBER']         = ''; 
    $data['UF_CRM_YR24_OTHERS']                         = ''; 
    $data['UF_CRM_YR24_NEAREST_SESSION']                = ''; 
    $data['UF_CRM_YR24_LAST_RESULT']                    = ''; 
    $data['UF_CRM_YR24_CASE_INSTANCE']                  = ''; 
    $data['UF_CRM_CFM_YR24_CASE_SUM']                   = ''; 
    $data['UF_CRM_YR24_INSTANCE_CODE']                  = ''; 
    $data['UF_CRM_1628845465']                          = ''; 
    $data['UF_CRM_TIMESHEET_CONTRACT']                  = ''; 
    $data['UF_CRM_1629712538']                          = ''; 
    $data['UF_CRM_1629713088']                          = ''; 
    $data['UF_CRM_1629714005']                          = ''; 
    $data['UF_CRM_1633008196']                          = ''; 
    $data['UF_CRM_1633818042']                          = ''; 
    $data['UF_CRM_1634158022']                          = []; 
    $data['UF_CRM_1634589360']                          = ''; 
    $data['UF_CRM_1634589392']                          = ''; 
    $data['UF_CRM_1636705135040']                       = ''; 
    $data['UF_CRM_1637688370986']                       = ''; 
    $data['UF_CRM_1637688937345']                       = ''; 
    $data['UF_CRM_1637688970721']                       = ''; 
    $data['UF_CRM_1637688990962']                       = ''; 
    $data['UF_CRM_1637689015673']                       = ''; 
    $data['UF_CRM_1637689156282']                       = ''; 
    $data['UF_CRM_1637689168593']                       = ''; 
    $data['UF_CRM_1637689195784']                       = ''; 
    $data['UF_CRM_1637689340050']                       = ''; 
    $data['UF_CRM_1637689394786']                       = ''; 
    $data['UF_CRM_1640249453073']                       = ''; 
    $data['UF_CRM_PAYMENT_FRAME']                       = ''; 
    $data['UF_CRM_PAYMENT_AMOUNT']                      = ''; 
    $data['UF_CRM_PAYMENT_REMAIN_PART']                 = ''; 
    $data['UF_CRM_KASSA_FIRST_INSTALLMENT']             = ''; 
    $data['UF_CRM_EXPECTED_AMOUNT_FIRST_PAYMENT']       = ''; 
    $data['UF_CRM_1644826472126']                       = ''; 
    $data['UF_CRM_1644826487749']                       = ''; 
    $data['UF_CRM_1648462561310']                       = ''; 
    $data['UF_CRM_1648462838079']                       = []; 
    $data['UF_CRM_1649412197222']                       = ''; 
    $data['UF_CRM_GONETS_BRAND']                        = ''; 
    $data['UF_CRM_YR24_PLAINTIFFS']                     = ''; 
    $data['UF_CRM_YR24_DEFENDANTS']                     = ''; 
    $data['UF_CRM_YR24_INSTANCE_URL']                   = ''; 
    $data['UF_CRM_YR24_INSTANCE_START_DATE']            = ''; 
    $data['UF_CRM_YR24_CASE_SUM']                       = ''; 
    $data['UF_CRM_YR24_DIRECT_API_CASE_DATA']           = ''; 
    $data['UF_CRM_INSTALLMENT_PLAN']                    = ''; 
    $data['UF_CRM_YR24_NEAREST_SESSION_STR']            = ''; 
    $data['UF_CRM_1657058316668']                       = false; 
    $data['UF_CRM_1657262153123']                       = ''; 
    $data['UF_CRM_1657262169339']                       = ''; 
    $data['UF_CRM_1657262189835']                       = ''; 
    $data['UF_CRM_1657262208442']                       = ''; 
    $data['UF_CRM_KASSA_SPENDING_AMOUNT']               = ''; 
    $data['UF_CRM_KASSA_LAST_PAYMENT_DATETIME']         = ''; 
    $data['UF_CRM_KASSA_LAST_PAYMENT_AMOUNT']           = ''; 
    $data['UF_CRM_1661424962']                          = ''; 
    $data['UF_CRM_1661424980']                          = ''; 
    $data['UF_CRM_1661425005']                          = ''; 
    $data['UF_CRM_1661425051']                          = ''; 
    $data['UF_CRM_1661425150']                          = ''; 
    $data['UF_CRM_1661428770']                          = ''; 
    $data['UF_CRM_1661428791']                          = ''; 
    $data['UF_CRM_1661428810']                          = ''; 
    $data['UF_CRM_1661432580']                          = ''; 
    $data['UF_CRM_1661432595']                          = ''; 
    $data['UF_CRM_1661445517']                          = ''; 
    $data['UF_CRM_1661446245']                          = ''; 
    $data['UF_CRM_1661544431509']                       = ''; 
    $data['UF_CRM_1665741141635']                       = ''; 
    $data['UF_CRM_1665741411696']                       = ''; 
    $data['UF_CRM_1665741461415']                       = ''; 
    $data['UF_CRM_1665741517039']                       = ''; 
    $data['UF_CRM_1665741568603']                       = ''; 
    $data['UF_CRM_1665741600403']                       = ''; 
    $data['UF_CRM_1665741696223']                       = ''; 
    $data['UF_CRM_1666171002316']                       = ''; 
    $data['UF_CRM_1673350343429']                       = ''; 
    $data['UF_CRM_1673350409097']                       = ''; 
    $data['UF_CRM_1673350440340']                       = ''; 
    $data['UF_CRM_1673350478458']                       = ''; 
    $data['UF_CRM_1673350504611']                       = ''; 
    $data['UF_CRM_1673350717490']                       = ''; 
    $data['UF_CRM_1674423386190']                       = ''; 
    $data['UF_CRM_KASSA_FIN_DATA_JSON']                 = ''; 
    $data['UF_CRM_1675173831524']                       = ''; 
    $data['UF_CRM_1678360275322']                       = ''; 
    $data['UF_CRM_1678361011084']                       = ''; 
    $data['UF_CRM_1678361366098']                       = ''; 
    $data['UF_CRM_1678361396516']                       = ''; 
    $data['UF_CRM_1678361470504']                       = ''; 
    $data['UF_CRM_1678361625817']                       = ''; 
    $data['UF_CRM_1678361658080']                       = ''; 
    $data['UF_CRM_1678433659521']                       = ''; 
    $data['UF_CRM_1678433821278']                       = []; 
    $data['UF_CRM_1678434048065']                       = ''; 
    $data['UF_CRM_1678434345887']                       = ''; 
    $data['UF_CRM_1678717755867']                       = ''; 
    $data['UF_CRM_1678717773013']                       = ''; 
    $data['UF_CRM_1678717832614']                       = ''; 
    $data['UF_CRM_1678718091414']                       = ''; 
    $data['UF_CRM_1678718150748']                       = ''; 
    $data['UF_CRM_1678718189059']                       = ''; 
    $data['UF_CRM_1678718300182']                       = ''; 
    $data['UF_CRM_1678719168010']                       = ''; 
    $data['UF_CRM_1678719458140']                       = ''; 
    $data['UF_CRM_1678719490379']                       = ''; 
    $data['UF_CRM_1678719517212']                       = ''; 
    $data['UF_CRM_DEAL_KAD_SEARCH']                     = ''; 
    $data['UF_CRM_1678962017348']                       = ''; 
    $data['UF_CRM_1678962331262']                       = ''; 
    $data['UF_CRM_1678962419965']                       = ''; 
    $data['UF_CRM_1678962921868']                       = ''; 
    $data['UF_CRM_1678963230713']                       = ''; 
    $data['UF_CRM_1679480157017']                       = ''; 
    $data['UF_CRM_1679480230525']                       = ''; 
    $data['UF_CRM_1679480311216']                       = ''; 
    $data['UF_CRM_1679480476102']                       = ''; 
    $data['UF_CRM_1679480515963']                       = ''; 
    $data['UF_CRM_1679480547887']                       = ''; 
    $data['UF_CRM_1679485692511']                       = ''; 
    $data['UF_CRM_1679485736362']                       = ''; 
    $data['UF_CRM_1679485782744']                       = ''; 
    $data['UF_CRM_1679485816286']                       = ''; 
    $data['UF_CRM_1679497969364']                       = ''; 
    $data['UF_CRM_1679497988097']                       = ''; 
    $data['UF_CRM_1680101086188']                       = ''; 
    $data['UF_CRM_1680255946761']                       = ''; 
    $data['UF_CRM_1681901482']                          = false; 
    $data['UF_CRM_1681901709332']                       = ''; 
    $data['UF_CRM_MGO_CC_ENTRY_ID']                     = ''; 
    $data['UF_CRM_MGO_CC_CHANNEL_TYPE']                 = ''; 
    $data['UF_CRM_MGO_CC_RESULT']                       = ''; 
    $data['UF_CRM_MGO_CC_ENTRY_POINT']                  = ''; 
    $data['UF_CRM_MGO_CC_CREATE']                       = ''; 
    $data['UF_CRM_MGO_CC_END']                          = ''; 
    $data['UF_CRM_MGO_CC_TAG_ID']                       = ''; 
    $data['UF_CRM_1681995354']                          = false; 
    $data['UF_CRM_1683462809']                          = ''; 
    $data['UF_CRM_1685707741043']                       = ''; 
    $data['UF_CRM_1686038343091']                       = ''; 
    $data['UF_CRM_1686038365473']                       = ''; 
    $data['UF_CRM_1686042158556']                       = ''; 
    $data['UF_CRM_1686042355264']                       = ''; 
    $data['UF_CRM_1686043096361']                       = ''; 
    $data['UF_CRM_1686046817804']                       = ''; 
    $data['UF_CRM_1686055165772']                       = []; 
    $data['UF_CRM_1686055269061']                       = []; 
    $data['UF_CRM_1686055437037']                       = []; 
    $data['UF_CRM_1687245071265']                       = ''; 
    $data['UF_CRM_1687245173805']                       = ''; 
    $data['UF_CRM_1687256241421']                       = ''; 
    $data['UF_CRM_1687256499']                          = ''; 
    $data['UF_CRM_1687257304766']                       = ''; 
    $data['UF_CRM_1687271410910']                       = ''; 
    $data['UF_CRM_1687452644']                          = ''; 
    $data['UF_CRM_1687455757']                          = ''; 
    $data['UF_CRM_1687455848']                          = ''; 
    $data['UF_CRM_1687516336609']                       = ''; 
    $data['UF_CRM_1687517512983']                       = ''; 
    $data['UF_CRM_1687528830415']                       = ''; 
    $data['UF_CRM_1688111914509']                       = ''; 
    $data['UF_CRM_1688111944606']                       = ''; 
    $data['UF_CRM_KASSA_ACT_AMOUNT']                    = ''; 
    $data['UF_CRM_KASSA_UNSIGNED_ACT_AMOUNT']           = ''; 
    $data['UF_CRM_1696419041352']                       = ''; 
    $data['UF_CRM_1696419290280']                       = ''; 
    $data['UF_CRM_TASKS_FIELD_FRAME']                   = ''; 
    $data['UF_CRM_TASKS_RESTART_BIZPROC']               = ''; 
    $data['UF_CRM_KASSA_TRANSIT_PAYMENT_AMOUNT']        = ''; 
    $data['UF_CRM_1702719450']                          = ''; 
    $data['UF_CRM_65C4CE7078D5E']                       = ''; 
    $data['UF_CRM_65C4CE70A4F50']                       = ''; 
    $data['UF_CRM_65C4CE70F01E0']                       = ''; 
    $data['UF_CRM_65C4CE71113ED']                       = ''; 
    $data['UF_CRM_65C4CE7126023']                       = ''; 
    $data['UF_CRM_KASSA_NEXT_INSTALLMENT']              = ''; 
    $data['UF_CRM_KASSA_NEXT_INSTALLMENT_AMOUNT']       = ''; 
    $data['UF_CRM_KASSA_EACH_INSTALLMENT_AMOUNT']       = ''; 
    $data['UF_CRM_KASSA_INSTALLMENT_OVERDUE']           = ''; 
    $data['UF_CRM_KASSA_INSTALLMENT_OVERDUE_TOTAL']     = ''; 
    $data['UF_CRM_PAYMENT_DELAY']                       = ''; 
    $data['UF_CRM_KASSA_ORDER_CRC']                     = ''; 
    $data['UF_CRM_KASSA_COMPANY']                       = ''; 
    $data['UF_CRM_1658321309037']                       = ''; 
    $data['UF_CRM_1661544301']                          = ''; 
    $data['UF_CRM_1666022745816']                       = ''; 
    $data['UF_CRM_1666170845189']                       = ''; 
    $data['UF_CRM_1666170866940']                       = '';
    $data['UF_CRM_1666170941724']                       = '';
    $data['UF_CRM_1666170986980']                       = '';
    $data['UF_CRM_1667127624']                          = ''; 
    $data['UF_CRM_DCT_UID']                             = ''; 
    $data['UF_CRM_DCT_CID']                             = '';
    $data['UF_CRM_DCT_YA_CID']                          = '';
    $data['UF_CRM_DCT_CITY']                            = ''; 
    $data['UF_CRM_DCT_SOURCE']                          = ''; 
    $data['UF_CRM_DCT_MEDIUM']                          = '';
    $data['UF_CRM_DCT_CAMPAIGN']                        = ''; 
    $data['UF_CRM_DCT_CONTENT']                         = ''; 
    $data['UF_CRM_DCT_TERM']                            = '';
    $data['UF_CRM_DCT_DURATION']                        = ''; 
    $data['UF_CRM_DCT_PAGE']                            = '';
    $data['UF_CRM_DCT_CONTEXT']                         = '';
    $data['UF_CRM_DCT_CUSTOM']                          = '';
    $data['UF_CRM_DCT_WID_NAME']                        = '';
    $data['UF_CRM_DCT_TYPE']                            = '';
    $data['UF_CRM_ROISTAT']                             = '';
    $data['UF_CRM_1667815684675']                       = false;
    $data['UF_CRM_CONAD_CRD001']                        = '';
    $data['UF_CRM_CONAD_CRD002']                        = ''; 
    $data['UF_CRM_CONAD_CRD003']                        = '';
    $data['UF_CRM_CONAD_CRD004']                        = ''; 
    $data['UF_CRM_CONAD_CRD005']                        = '';
    $data['UF_CRM_CONAD_CRD006']                        = ''; 
    $data['UF_CRM_CONAD_CRD007']                        = false;
    $data['UF_CRM_CONAD_CRD008']                        = ''; 
    $data['UF_CRM_CONAD_CRD009']                        = '';
    $data['UF_CRM_CONAD_CRD010']                        = '';
    $data['UF_CRM_CONAD_CRD011']                        = '';
    $data['UF_CRM_CONAD_CRD012']                        = '';
    $data['UF_CRM_CONAD_CRD013']                        = '';
    $data['UF_CRM_CONAD_CRD014']                        = '';
    $data['UF_CRM_CONAD_CRD015']                        = '';
    $data['UF_CRM_CONAD_CRD016']                        = ''; 
    $data['UF_CRM_CONAD_CRD017']                        = '';
    $data['UF_CRM_CONAD_CRD018']                        = ''; 
    $data['UF_CRM_CONAD_CRD019']                        = '';
    $data['UF_CRM_CONAD_CRD020']                        = '';
    $data['UF_CRM_CONAD_CRD021']                        = '';
    $data['UF_CRM_CONAD_CRD022']                        = '';
    $data['UF_CRM_CONAD_CRD023']                        = '';
    $data['UF_CRM_CONAD_CRD024']                        = ''; 
    $data['UF_CRM_CONAD_CRD025']                        = ''; 
    $data['UF_CRM_CONAD_CRD026']                        = ''; 
    $data['UF_CRM_CONAD_CRD027']                        = '';
    $data['UF_CRM_CONAD_CRD028']                        = ''; 
    $data['UF_CRM_CONAD_CRD029']                        = false; 
    $data['UF_CRM_CONAD_CRD030']                        = ''; 
    $data['UF_CRM_CONAD_CRD031']                        = '';
    $data['UF_CRM_CONAD_CRD032']                        = '';
    $data['UF_CRM_CONAD_CRD033']                        = '';
    $data['UF_CRM_CONAD_CRD034']                        = '';
    $data['UF_CRM_CONAD_CRD035']                        = '';
    $data['UF_CRM_CONAD_CRD036']                        = '';
    $data['UF_CRM_CONAD_CRD037']                        = ''; 
    $data['UF_CRM_CONAD_CRD038']                        = '';
    $data['UF_CRM_CONAD_CRD039']                        = '';
    $data['UF_CRM_CONAD_CRD040']                        = '';
    $data['UF_CRM_CONAD_CRD041']                        = '';
    $data['UF_CRM_CONAD_CRD042']                        = false;
    $data['UF_CRM_CONAD_CRD043']                        = '';
    $data['UF_CRM_CONAD_CRD044']                        = ''; 
    $data['UF_CRM_CONAD_CRD045']                        = ''; 
    $data['UF_CRM_CONAD_CRD046']                        = '';
    $data['UF_CRM_CONAD_CRD047']                        = '';
    $data['UF_CRM_CONAD_CRD048']                        = '';
    $data['UF_CRM_CONAD_CRD049']                        = ''; 
    $data['UF_CRM_CONAD_CRD050']                        = '';
    $data['UF_CRM_CONAD_CRD051']                        = '';
    $data['UF_CRM_CONAD_CRD052']                        = '';
    $data['UF_CRM_CONAD_CRD053']                        = '';
    $data['UF_CRM_CONAD_CRD054']                        = '';
    $data['UF_CRM_CONAD_CRD055']                        = '';
    $data['UF_CRM_CONAD_CRD056']                        = '';
    $data['UF_CRM_CONAD_CRD057']                        = '';
    $data['UF_CRM_CONAD_CRD058']                        = '';
    $data['UF_CRM_CONAD_CRD059']                        = '';
    $data['UF_CRM_CONAD_CRD060']                        = false;
    $data['UF_CRM_CONAD_CRD061']                        = '';
    $data['UF_CRM_CONAD_CRD062']                        = '';
    $data['UF_CRM_CONAD_CRD063']                        = '';
    $data['UF_CRM_CONAD_CRD064']                        = ''; 
    $data['UF_CRM_CONAD_CRD065']                        = '';
    $data['UF_CRM_CONAD_CRD066']                        = '';
    $data['UF_CRM_CONAD_CRD067']                        = '';
    $data['UF_CRM_CONAD_CRD068']                        = '';
    $data['UF_CRM_CONAD_CRD069']                        = '';
    $data['UF_CRM_CONAD_CRD070']                        = ''; 
    $data['UF_CRM_CONAD_CRD071']                        = ''; 
    $data['UF_CRM_CONAD_CRD072']                        = '';
    $data['UF_CRM_CONAD_CRD073']                        = '';
    $data['UF_CRM_CONAD_CRD074']                        = ''; 
    $data['UF_CRM_CONAD_CRD075']                        = '';
    $data['UF_CRM_CONAD_CRD076']                        = '';
    $data['UF_CRM_CONAD_CRD077']                        = '';
    $data['UF_CRM_CONAD_CRD078']                        = '';
    $data['UF_CRM_CONAD_CRD079']                        = '';
    $data['UF_CRM_CONAD_CRD080']                        = '';
    $data['UF_CRM_CONAD_CRD081']                        = '';
    $data['UF_CRM_CONAD_CRD082']                        = '';
    $data['UF_CRM_CONAD_CRD083']                        = '';
    $data['UF_CRM_CONAD_CRD084']                        = ''; 
    $data['UF_CRM_CONAD_CRD085']                        = ''; 
    $data['UF_CRM_CONAD_CRD086']                        = ''; 
    $data['UF_CRM_CONAD_CRD087']                        = ''; 
    $data['UF_CRM_CONAD_CRD088']                        = false;
    $data['UF_CRM_CONAD_CRD089']                        = ''; 
    $data['UF_CRM_CONAD_CRD090']                        = '';
    $data['UF_CRM_CONAD_CRD091']                        = '';
    $data['UF_CRM_CONAD_CRD092']                        = '';
    $data['UF_CRM_CONAD_CRD093']                        = ''; 
    $data['UF_CRM_CONAD_CRD094']                        = false; 
    $data['UF_CRM_CONAD_CRD095']                        = ''; 
    $data['UF_CRM_CONAD_CRD096']                        = '';
    $data['UF_CRM_CONAD_CRD097']                        = ''; 
    $data['UF_CRM_CONAD_CRD098']                        = ''; 
    $data['UF_CRM_CONAD_CRD099']                        = ''; 
    $data['UF_CRM_CONAD_CRD100']                        = ''; 
    $data['UF_CRM_CONAD_CRD101']                        = '';
    $data['UF_CRM_CONAD_CRD102']                        = ''; 
    $data['UF_CRM_CONAD_CRD103']                        = ''; 
    $data['UF_CRM_CONAD_CRD104']                        = ''; 
    $data['UF_CRM_CONAD_CRD105']                        = ''; 
    $data['UF_CRM_CONAD_CRD106']                        = ''; 
    $data['UF_CRM_CONAD_CRD107']                        = ''; 
    $data['UF_CRM_CONAD_CRD108']                        = false; 
    $data['UF_CRM_CONAD_CRD109']                        = false;
    $data['UF_CRM_CONAD_CRD110']                        = ''; 
    $data['UF_CRM_CONAD_CRD111']                        = ''; 
    $data['UF_CRM_CONAD_CRD112']                        = ''; 
    $data['UF_CRM_CONAD_CRD113']                        = ''; 
    $data['UF_CRM_CONAD_CRD114']                        = '';
    $data['UF_CRM_CONAD_CRD115']                        = ''; 
    $data['UF_CRM_CONAD_CRD116']                        = ''; 
    $data['UF_CRM_CONAD_CRD117']                        = false; 
    $data['UF_CRM_CONAD_CRD118']                        = false;
    $data['UF_CRM_CONAD_CRD119']                        = ''; 
    $data['UF_CRM_CONAD_CRD120']                        = ''; 
    $data['UF_CRM_CONAD_CRD121']                        = ''; 
    $data['UF_CRM_1676824599']                          = '';
}
///*/-----------------------------------Метод добавления открытия сделки по кнонке Выгрузить в окне вне битрикса///*/
public function up2(Request $request){//pa($_REQUEST); exit;
    $this->file_view[$request->route()->getAction()['as']];
    $ar_sepo = $this->array_seporator;

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
        $DEAL = $BX->bx24->getDeal($DEAL_ID);
        ///*/ формируем массив с ключами битрикс полей для заполнения данными ///*/
        $DATA = array_merge(...array_values($STRUCTURE));
        ///*/ наполняем массив с ключами битрикс полей данными ///*/
        foreach((empty($DATA) ? null : $DATA) as $k => $v){
            ///*/ пропускаем и удаляем из результируещего массива поле, если данных для поля в битрикс нет ///*/
            // if(empty($DEAL[$k])){unset($DATA[$k]); continue;}
            
            ///*/ если данные поля строка, убираем вокруг данных ///*/
            if(is_string($DEAL[$k])){$DEAL[$k] = trim($DEAL[$k]);} //pa($k); pa($DATA); pa($DEAL[$k]); exit;
            if(in_array($DATA[$k]['type'], ['date','mdate'])){$d = is_date($DEAL[$k]); $DEAL[$k] = is_a($d, '\DateTime') ? $d->format('Y-m-d H:i:s') : $DEAL[$k];} 
            
            ///*/ выбираем из базы историй все модификации поля, по ключу и инстанции ///*/
            $h = History::where('key', $k)->where('instance', $INSTANCE);
            ///*/ если история изменений есть запоминаем в переменной, если нет то формируем из вновь прибывших данных ///*/
            $history = $h->exists() ? $h->orderByDesc('id')->offset(0)->limit(10)->get()->toArray() : 
                [History::create([
                    'instance' => $INSTANCE, 
                    'name' => $v['title'], 
                    'key' => $k,
                    ///*/ если множественное поле из битрикса пришло пишем в базу строкой по разделителю $ar_sepo ///*/ 
                    'value' => (is_array($DEAL[$k]) ? implode($ar_sepo, $DEAL[$k]) : (empty($DEAL[$k]) ? NULL : $DEAL[$k]))]
                )->toArray()];
            ///*/ для множественных полей изменяем данные изменений из строки с разделителем $ar_sepo обратно в массив ///*/
            foreach($history as $kk => $hh){$history[$kk]['value'] = (is_array($DEAL[$k])) ? explode($ar_sepo, $hh['value']) : [$hh['value']];}
            ///*/ дополняем результирующий массив данными ///*/
            $DATA[$k]['instance'] = $INSTANCE; $DATA[$k]['bitrix'] = (is_array($DEAL[$k])) ? $DEAL[$k] : [$DEAL[$k]]; $DATA[$k]['history'] = $history;
        }

    }    
        pa($DATA); 
        exit;    

    $send = [
        'deal' => $data, 
        'nd' => 'н\д', 
        'ex' => ',', 
        'tab' => $request->tab
    ]; 
    if('Not found' == $data['ID']){unset($data);} //pa($send);
     
return (empty($data)) ? abort(404) : view('intro.'.$request->tab, $send);} //'<script>alert("[Сообщение отладки] номер сделки - '.$deal['ID'].'");window.close();</script>'
///*/-----------------------------------Метод сохранения EXEL///*/
public function download(Request $request){
    $request->validate([
        'deal_into_id' => 'required',
    ]);
    $temp_file = tempnam(sys_get_temp_dir(), 'EXEL');
    $ob_ = FirstInstance::where('deal_into_id', $request->deal_into_id); 
    if($ob_->exists()){
        
        $spreadsheet = new Spreadsheet();
        //$sheet = $spreadsheet->createSheet(1);
        $sheet = $spreadsheet->getSheet(0);
        
        $sheet->fromArray($ob_->get()->toArray(), NULL, 'A1');
        //$spreadsheet->removeSheetByIndex(0); $spreadsheet->setActiveSheetIndex(1);
        
        (new Xlsx($spreadsheet))->save($temp_file);
    }
    ///*/
header('Content-Disposition: attachment; filename=' . $request->deal_into_id.'.xlsx' );
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($temp_file));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: public');
    ///*/
    readfile($temp_file);
}
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

}