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
        ///*/ pa($data); exit;           
    }else
///*/ Вкладка Суды-апеляция ///*/
    if($_REQUEST['tab'] == $view = 'courts_appeal'){
        if(empty($_id = CourtsAppeal::select('id')->orderBy('id','desc')->first())){
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
        if(empty($_id = CourtsСassation::select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsСassation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Исполнительное производство ///*/
    if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
        if(empty($_id = EnforcementProceedings::select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new EnforcementProceedings)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Банкротство ///*/
    if($_REQUEST['tab'] == $view = 'bankruptcy'){
        if(empty($_id = Bankruptcy::select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Bankruptcy)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Медиации ///*/
    if($_REQUEST['tab'] == $view = 'mediation'){
        if(empty($_id = Mediation::select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new Mediation)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
        }
        ///*/ pa($data); exit;           
    }else
///*/ Суды-возобновление производства ///*/
    if($_REQUEST['tab'] == $view = 'courts_resumption'){
        if(empty($_id = CourtsResumption::select('id')->orderBy('id','desc')->first())){
            $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$view.'.php');
            $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
            
            $data[$view] = $this->mergeLabel($structura, $view);
            $I_table = (new CourtsResumption)->table;
            $I_id = (!empty($maxid = DB::select("SELECT setval(pg_get_serial_sequence('".$I_table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".$I_table.";"))) ? $maxid[0]->maxid : null;
            $data[$view]['id'] = $I_id; 
        }else{
            $data[$view] = $this->getCourtsAppeal($_id->id);
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
            $val['data'] = json_decode($val['data'], true);
            if(!empty($val['data']['created_at'])){
                $val['data']['created_at'] = (is_date($val['data']['created_at'])) ? date_format(date_create($val['data']['created_at']), 'Y-m-d H:i:s') : null;
                $val['data']['updated_at'] = (is_date($val['data']['updated_at'])) ? date_format(date_create($val['data']['updated_at']), 'Y-m-d H:i:s') : null;
                $val['data']['deleted_at'] = (is_date($val['data']['deleted_at'])) ? date_format(date_create($val['data']['deleted_at']), 'Y-m-d H:i:s') : null;
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
    
    $structura = ['id'=>'','deal_id'=>'','deal_into_id'=>'']+$structura;
    
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
        $req = [
            'id'                     => $request->id,
            'deal_id'                => $request->deal_id,
            'deal_into_id'           => $request->deal_into_id,
            'name_and_number'        => $request->name_and_number,
            'parties_to_case'        => $request->parties_to_case,
            'who_represent'          => $request->who_represent,
            'subject_dispute'        => $request->subject_dispute,
            'deposit'                => $request->deposit,
            'date_start'             => $request->date_start,
            'number_case'            => $request->number_case,
            'court_judge'            => $request->court_judge,
            'information_case'       => $request->information_case,
            'result_case'            => $request->result_case,
            'sum_case'               => $request->sum_case,
            'date_force_case'        => $request->date_force_case,
            'time_limit'             => $request->time_limit,
            'date_production_case'   => $request->date_production_case,
            'date_receipt_case'      => $request->date_receipt_case,
            'appeal_case'            => $request->appeal_case,
            'date_filing_appeal'     => $request->date_filing_appeal,
            'date_acceptance_appeal' => $request->date_acceptance_appeal,
            'sum_services'           => $request->sum_services,
            'updated_at'             => $request->updated_at,
        ]; ///*/ pa($req); //exit; ///*/      
       
        ///*/ Создаём или выбираем модель ///*/
        $ob_ = FirstInstance::where('id', $request->id)->orWhere('deal_into_id', $request->deal_into_id); 
        $ob_ = ($ob_->exists()) ? $ob_->first() : FirstInstance::create(['id' => $request->id]); 
        ///*/ Обновляем модель ///*/
        foreach($structura as $k => $v){if(empty($request->{$k})){continue;} $ob_->{$k} = ($put = $request->{$k}) ?: '';}
        ///*/ Сохраняем модель в базе ///*/ pa($ob_->toArray()); exit; ///*/
        if($ob_->save()){
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStrategy)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStrategy)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceStrategy::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->strategy; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStrategyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStrategyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceStrategyMany::create(['id' => $subpush_id, 'first_instance_id' => $ob_->id, 'strategy_id' => $push->id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->strategy_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaim)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaim)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceClaim::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->claim; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceClaimMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->claim_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimPrice)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimPrice)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceClaimPrice::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->claim_price; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceClaimPriceMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceClaimPriceMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceClaimPriceMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->claim_price_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStateDuty)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStateDuty)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceStateDuty::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->state_duty; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceStateDutyMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceStateDutyMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceStateDutyMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->state_duty_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceInformationProgress)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceInformationProgress)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceInformationProgress::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->information_progress; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceInformationProgressMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceInformationProgressMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceInformationProgressMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->information_progress_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceDateUpcomingCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceDateUpcomingCase)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceDateUpcomingCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->date_upcoming_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceDateUpcomingCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceDateUpcomingCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceDateUpcomingCaseMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->date_upcoming_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
            ///*/ --- ///*/
            $push_id = (!empty($_id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceCurrentStateCase)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceCurrentStateCase)->table.";"))) ? $_id[0]->maxid : null;
            if($push = FirstInstanceCurrentStateCase::create(['id' => $push_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at])){
                $push->data = $request->current_state_case; $push->save();               
                $subpush_id = (!empty($__id = DB::select("SELECT setval(pg_get_serial_sequence('".(new FirstInstanceCurrentStateCaseMany)->table."', 'id'), coalesce(max(id)+1, 1), false) as maxid FROM ".(new FirstInstanceCurrentStateCaseMany)->table.";"))) ? $__id[0]->maxid : null;
                $subpush = FirstInstanceCurrentStateCaseMany::create(['id' => $subpush_id, 'created_at' => $request->updated_at, 'updated_at' => $request->updated_at]);
                $subpush->first_instance_id = $ob_->id; $subpush->current_state_case_id = $push->id; $subpush->save();
            }unset($push_id,$push,$subpush,$subpush_id,$_id,$__id);
        }}else
///*/ Вкладка Суды-апеляция ///*/
    if($_REQUEST['tab'] == $view = 'courts_appeal'){
        //
        /*/
        if(!empty($_id = CourtsAppeal::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['courts_appeal'] = !empty($courts_appeal = $this->getCourtsAppeal($_id['id'])) ? $courts_appeal : '';
        }
        ///*/           
    }else
///*/ Вкладка Суды-касация ///*/
    if($_REQUEST['tab'] == $view = 'courts_cassation'){
        //
        /*/
        if(!empty($_id = CourtsСassation::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['courts_cassation'] = !empty($courts_cassation = $this->getCourtsСassation($_id['id'])) ? $courts_cassation : '';
        }
        ///*/            
    }else
///*/ Исполнительное производство ///*/
    if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
        //
        /*/
        if(!empty($_id = EnforcementProceedings::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['enforcement_proceedings'] = !empty($enforcement_proceedings = $this->getEnforcementProceedings($_id['id'])) ? $enforcement_proceedings : '';
        }
        ///*/            
        
    }else
///*/ Банкротство ///*/
    if($_REQUEST['tab'] == $view = 'bankruptcy'){
        //
        /*/
        if(!empty($_id = Bankruptcy::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['bankruptcy'] = !empty($bankruptcy = $this->getBankruptcy($_id['id'])) ? $bankruptcy : '';
        }
        ///*/            
    }else
///*/ Медиации ///*/
    if($_REQUEST['tab'] == $view = 'mediation'){
        //
        /*/
        if(!empty($_id = Mediation::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['mediation'] = !empty($mediation = $this->getMediation($_id['id'])) ? $mediation : '';
        }
        ///*/            
    }else
///*/ Суды-возобновление производства ///*/
    if($_REQUEST['tab'] == $view = 'courts_resumption'){
        //
        /*/
        if(!empty($_id = CourtsResumption::select('id')->orderBy('id','desc')->first()->toArray())){
            $data['courts_resumption'] = !empty($courts_resumption = $this->getCourtsResumption($_id['id'])) ? $courts_resumption : '';
        }
        ///*/            
    }else{return view('front.undefine', ['deal' => $deal]);}

    return redirect()->action([HomeController::class, 'index'], ['tab' => $request->tab, 'deal_id' => $request->deal_id]);

}


}
