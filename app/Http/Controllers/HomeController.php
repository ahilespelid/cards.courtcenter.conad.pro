<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use \Crest;
use 
    App\Models\FirstInstance,
    App\Models\FirstInstanceClaim,
    App\Models\FirstInstanceCurrentStateCase,
    App\Models\BankruptcyPaymentsMany,
    App\Models\FirstInstanceInformationProgress,
    App\Models\FirstInstanceStateDuty,
    App\Models\FirstInstanceStrategy,
    App\Models\FirstInstanceClaimPrice,
    App\Models\FirstInstanceClaimPriceMany,
    App\Models\FirstInstanceClaimMany,
    App\Models\FirstInstanceCurrentStateCaseMany,
    App\Models\BankruptcyPayments,
    App\Models\FirstInstanceInformationProgressMany,
    App\Models\FirstInstanceStateDutyMany,
    App\Models\FirstInstanceStrategyMany,
    App\Models\CourtsAppeal,
    App\Models\CourtsAppealStrategy,
    App\Models\MediationStrategy,
    App\Models\FirstInstanceDateUpcomingCase,
    App\Models\FirstInstanceDateUpcomingCaseMany,
    App\Models\CourtsAppealDateUpcomingCase,
    App\Models\CourtsAppealInformationProgress,
    App\Models\CourtsAppealStrategyMany,
    App\Models\CourtsAppealDateUpcomingCaseMany,
    App\Models\CourtsAppealInformationProgressMany,
    App\Models\CourtsResumption,
    App\Models\CourtsСassation,
    App\Models\EnforcementProceedingsStrategyMany,
    App\Models\EnforcementProceedingsInformationProgressMany,
    App\Models\EnforcementProceedingsInformationAuctionMany,
    App\Models\EnforcementProceedingsDateVisitBailiffMany,
    App\Models\BankruptcyStrategy,
    App\Models\BankruptcyStage,
    App\Models\BankruptcyStageMany,
    App\Models\BankruptcyInformationCourtMany,
    App\Models\CourtsCassationStrategy,
    App\Models\CourtsCassationStrategyMany,
    App\Models\CourtsCassationDateUpcomingCase,
    App\Models\CourtsCassationDateUpcomingCaseMany,
    App\Models\CourtsCassationInformationProgress,
    App\Models\CourtsCassationInformationProgressMany,
    App\Models\EnforcementProceedings,
    App\Models\EnforcementProceedingsStrategy,
    App\Models\EnforcementProceedingsInformationProgress,
    App\Models\EnforcementProceedingsInformationAuction,
    App\Models\EnforcementProceedingsDateVisitBailiff,
    App\Models\Bankruptcy,
    App\Models\BankruptcyStrategyMany,
    App\Models\BankruptcyInformationCourt,
    App\Models\Mediation,
    App\Models\MediationStrategyMany,
    App\Models\MediationTypeDebt,
    App\Models\MediationDiscountCalculation,
    App\Models\MediationDiscountCalculationMany,
    App\Models\MediationSecondOfferDebtor,
    App\Models\MediationSecondOfferDebtorMany,
    App\Models\CourtsResumptionStrategy,
    App\Models\CourtsResumptionStrategyMany;


class HomeController extends Controller{    
public function index(){
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
    //pa($deal['CATEGORY_ID']); // exit;pa($tab);  exit;

    //$deal = CRest::call('crm.deal.categoria', ['ID' => '6']);

//pa($_REQUEST, 5, '');
//
/*/
pa((!empty($data) ? $data : []), 5, '');
pa($_REQUEST, 5, '');
pa($_POST);
pa(CRest::call('profile'));
pa(FirstInstance::all()->first());
pa(CRest::call('crm.deal.list')); 

$id = $data['first_instance']['id'];                         unset($data['first_instance']['id']);
$created_at = $data['first_instance']['created_at'];         unset($data['first_instance']['created_at']);
$updated_at = $data['first_instance']['updated_at'];         unset($data['first_instance']['updated_at']);
$deleted_at = $data['first_instance']['deleted_at'];         unset($data['first_instance']['deleted_at']);
$remember_token = $data['first_instance']['remember_token']; unset($data['first_instance']['remember_token']);
///*/
   
///*/ Вкладка Суды-первой инстанции ///*/        
    if($_REQUEST['tab'] == $view = 'first_instance'){
        ///*/
        if(empty($_id = FirstInstance::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new FirstInstance)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getFirstInstance($_id->id);
        }
        ///*/ pa($data); exit; //pa($_SERVER["REMOTE_ADDR"]);           
    }else
///*/ Вкладка Суды-апеляция ///*/
    if($_REQUEST['tab'] == $view = 'courts_appeal'){
        if(empty($_id = CourtsAppeal::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsAppeal)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Вкладка Суды-касация ///*/
    if($_REQUEST['tab'] == $view = 'courts_cassation'){
        if(empty($_id = CourtsСassation::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsСassation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsСassation($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Исполнительное производство ///*/
    if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
        if(empty($_id = EnforcementProceedings::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new EnforcementProceedings)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getEnforcementProceedings($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Банкротство ///*/
    if($_REQUEST['tab'] == $view = 'bankruptcy'){
        if(empty($_id = Bankruptcy::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Bankruptcy)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getBankruptcy($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Медиации ///*/
    if($_REQUEST['tab'] == $view = 'mediation'){
        if(empty($_id = Mediation::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Mediation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getMediation($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Суды-возобновление производства ///*/
    if($_REQUEST['tab'] == $view = 'courts_resumption'){
        if(empty($_id = CourtsResumption::where('deal_into_id', $deal_into_id)->select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsResumption)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsResumption($_id->id);
        }
        ///*/ pa($data); exit;           
    }else{return view('front.undefine', ['deal' => $deal]);}
    
    $id             = (!empty($data[$view]['id'])) ? $data[$view]['id'] : null ; 
    $created_at     = (!empty($data[$view]['created_at'])) ? $data[$view]['created_at'] : null; 
    $updated_at     = (!empty($data[$view]['updated_at'])) ? $data[$view]['updated_at'] : null;
    $deleted_at     = (!empty($data[$view]['deleted_at'])) ? $data[$view]['deleted_at'] : null;
    $remember_token = (!empty($data[$view]['remember_token'])) ? $data[$view]['remember_token'] : null;
    
    if(isset($data)){unset($data[$view]['id'],
        $data[$view]['deal_id'], 
        $data[$view]['deal_into_id'], 
        $data[$view]['created_at'], 
        $data[$view]['updated_at'], 
        $data[$view]['deleted_at'], 
        $data[$view]['remember_token']);
    }else{$data[$view='undefine'] = 'undefine';}
///*/ Проходимся по итоговому массиву данных перед выводом ///*/
    foreach($data[$view] as $key => $val){
        if(isset($val['type']) && 'o' == $val['type']){
            if('mediation' == $view){
                $MediationTypeDebt = MediationTypeDebt::where('deleted_at', '=', NULL)->get()->toArray();
                $data[$view][$key]['selected'] = (!empty($selected = json_decode($val['data'], true))) ? $selected['id'] : null; 
            }
            $data[$view][$key]['data'] = (!empty($val['data'] = json_decode($val['data'], true))) ?: (('mediation' == $view) ? $MediationTypeDebt : ['option' => 'Not found']);
        }
        if(isset($val['type']) && 'm' == $val['type']){
            ///*/ Поебёмся с датами во множественных полях, спасибо постгрис ///*/
            $data[$view][$key]['data'] = json_decode($val['data'], true);
            if(!empty($data[$view][$key]['data']['updated_at'])){
                $data[$view][$key]['data']['updated_at'] = (is_date($data[$view][$key]['data']['updated_at'])) ? date_format(date_create($data[$view][$key]['data']['updated_at']), 'Y-m-d H:i:s') : null;
                //if('10.10.0.24' == $_SERVER["REMOTE_ADDR"]){pa($data[$view][$key]); exit;}
            }
        }
    }
///*/ Вывод ///*/ pa($data[$view]);
    return view('front.'.$view, [
         ///*/
        'id' => $id,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'data' => $data[$view],
        'deal' => $deal,
        'deal_into_id' => $deal_into_id,
         ///*/
    ]);
}





public function save(Request $request){
    //pa($_POST); //exit;

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
        $ob_ = FirstInstance::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
        $ob_ = CourtsAppeal::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
        $ob_ = CourtsСassation::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
        $ob_ = EnforcementProceedings::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
        $ob_ = Bankruptcy::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
        $ob_ = Mediation::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
                $subpush->mediation_id = $ob_->id; $subpush->stage_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationSecondOfferDebtor)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationSecondOfferDebtor)->table.";"))) ? $_id[0]->maxid : null;
            if(!empty($request->second_offer_debtor) && $push = MediationSecondOfferDebtor::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->second_offer_debtor; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new MediationSecondOfferDebtorMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new MediationSecondOfferDebtorMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = MediationSecondOfferDebtorMany::create(['id' => $subpush_id, 'mediation_id' => $ob_->id, 'second_offer_debtor_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->mediation_id = $ob_->id; $subpush->information_court_id = $push->id; $subpush->save();
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
        $ob_ = CourtsResumption::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
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
}