<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use \Crest;
use 
    App\Models\FirstInstance,
    App\Models\FirstInstanceClaim,
    App\Models\FirstInstanceCurrentStateCase,
    App\Models\BankruptcyPaymentsMany,
    App\Models\FirstInstanceInformationProgress,
    App\Models\FirstInstanceStateDuty,
    App\Models\FirstInstanceStrategy,
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
    public function index(int $page = 1){
        $_REQUEST['tab'] = empty($_REQUEST['tab']) ? '' : $_REQUEST['tab'];
        
        if($_REQUEST['tab'] == $view = 'first_instance'){
            pa(FirstInstance::all()->toArray(), 5, 'FirstInstance');

            pa(FirstInstanceClaim::all()->toArray(), 5, 'FirstInstanceClaim');
            pa(FirstInstanceCurrentStateCase::all()->toArray(), 5, 'FirstInstanceCurrentStateCase');
            pa(FirstInstanceInformationProgress::all()->toArray(), 5, 'FirstInstanceInformationProgress');
            pa(FirstInstanceStateDuty::all()->toArray(), 5, 'FirstInstanceStateDuty');
            pa(FirstInstanceStrategy::all()->toArray(), 5, 'FirstInstanceStrategy');
            pa(FirstInstanceClaimMany::all()->toArray(), 5, 'FirstInstanceClaimMany');
            pa(FirstInstanceCurrentStateCaseMany::all()->toArray(), 5, 'FirstInstanceCurrentStateCaseMany');
            pa(FirstInstanceInformationProgressMany::all()->toArray(), 5, 'FirstInstanceInformationProgressMany');
            pa(FirstInstanceStateDutyMany::all()->toArray(), 5, 'FirstInstanceStateDutyMany');
            pa(FirstInstanceStrategyMany::all()->toArray(), 5, 'FirstInstanceStrategyMany');
            pa(FirstInstanceDateUpcomingCase::all()->toArray(), 5, 'FirstInstanceDateUpcomingCase');
            pa(FirstInstanceDateUpcomingCaseMany::all()->toArray(), 5, 'FirstInstanceDateUpcomingCaseMany');
           
        }else
        if($_REQUEST['tab'] == $view = 'courts_appeal'){
            pa(CourtsAppeal::all()->toArray(), 5, 'CourtsAppeal');

            pa(CourtsAppealStrategy::all()->toArray(), 5, 'CourtsAppealStrategy');
            pa(CourtsAppealDateUpcomingCase::all()->toArray(), 5, 'CourtsAppealDateUpcomingCase');
            pa(CourtsAppealInformationProgress::all()->toArray(), 5, 'CourtsAppealInformationProgress');
            pa(CourtsAppealStrategyMany::all()->toArray(), 5, 'CourtsAppealStrategyMany');
            pa(CourtsAppealDateUpcomingCaseMany::all()->toArray(), 5, 'CourtsAppealDateUpcomingCaseMany');
            pa(CourtsAppealInformationProgressMany::all()->toArray(), 5, 'CourtsAppealInformationProgressMany');
            
        }else
        if($_REQUEST['tab'] == $view = 'courts_cassation'){
            pa(CourtsСassation::all()->toArray(), 5, 'CourtsСassation');

            pa(CourtsCassationStrategy::all()->toArray(), 5, 'CourtsCassationStrategy');
            pa(CourtsCassationStrategyMany::all()->toArray(), 5, 'CourtsCassationStrategyMany');
            pa(CourtsCassationDateUpcomingCase::all()->toArray(), 5, 'CourtsCassationDateUpcomingCase');
            pa(CourtsCassationDateUpcomingCaseMany::all()->toArray(), 5, 'CourtsCassationDateUpcomingCaseMany');
            pa(CourtsCassationInformationProgress::all()->toArray(), 5, 'CourtsCassationInformationProgress');
            pa(CourtsCassationInformationProgressMany::all()->toArray(), 5, 'CourtsCassationInformationProgressMany');
            
        }else
        if($_REQUEST['tab'] == $view = 'enforcement_proceedings'){
            pa(EnforcementProceedings::all()->toArray(), 5, 'EnforcementProceedings');

            pa(EnforcementProceedingsStrategyMany::all()->toArray(), 5, 'EnforcementProceedingsStrategyMany');
            pa(EnforcementProceedingsInformationProgressMany::all()->toArray(), 5, 'EnforcementProceedingsInformationProgressMany');
            pa(EnforcementProceedingsInformationAuctionMany::all()->toArray(), 5, 'EnforcementProceedingsInformationAuctionMany');
            pa(EnforcementProceedingsDateVisitBailiffMany::all()->toArray(), 5, 'EnforcementProceedingsDateVisitBailiffMany');
            pa(EnforcementProceedingsStrategy::all()->toArray(), 5, 'EnforcementProceedingsStrategy');
            pa(EnforcementProceedingsInformationProgress::all()->toArray(), 5, 'EnforcementProceedingsInformationProgress');
            pa(EnforcementProceedingsInformationAuction::all()->toArray(), 5, 'EnforcementProceedingsInformationAuction');
            pa(EnforcementProceedingsDateVisitBailiff::all()->toArray(), 5, 'EnforcementProceedingsDateVisitBailiff');
            
        }else
        if($_REQUEST['tab'] == $view = 'bankruptcy'){
            pa(Bankruptcy::all()->toArray(), 5, 'Bankruptcy');

            pa(BankruptcyStrategyMany::all()->toArray(), 5, 'BankruptcyStrategyMany');
            pa(BankruptcyInformationCourt::all()->toArray(), 5, 'BankruptcyInformationCourt');
            pa(BankruptcyPaymentsMany::all()->toArray(), 5, 'BankruptcyPaymentsMany');
            pa(BankruptcyPayments::all()->toArray(), 5, 'BankruptcyPayments');
            pa(BankruptcyStrategy::all()->toArray(), 5, 'BankruptcyStrategy');
            pa(BankruptcyStage::all()->toArray(), 5, 'BankruptcyStage');
            pa(BankruptcyStageMany::all()->toArray(), 5, 'BankruptcyStageMany');
            pa(BankruptcyInformationCourtMany::all()->toArray(), 5, 'BankruptcyInformationCourtMany');
            
        }else
        if($_REQUEST['tab'] == $view = 'mediation'){
            pa(Mediation::all()->toArray(), 5, 'Mediation');

            pa(MediationStrategy::all()->toArray(), 5, 'MediationStrategy');
            pa(MediationStrategyMany::all()->toArray(), 5, 'MediationStrategyMany');
            pa(MediationTypeDebt::all()->toArray(), 5, 'MediationTypeDebt');
            pa(MediationDiscountCalculation::all()->toArray(), 5, 'MediationDiscountCalculation');
            pa(MediationDiscountCalculationMany::all()->toArray(), 5, 'MediationDiscountCalculationMany');
            pa(MediationSecondOfferDebtor::all()->toArray(), 5, 'MediationSecondOfferDebtor');
            pa(MediationSecondOfferDebtorMany::all()->toArray(), 5, 'MediationSecondOfferDebtorMany');
            
        }else
        if($_REQUEST['tab'] == $view = 'courts_resumption'){
            pa(CourtsResumption::all()->toArray(), 5, 'CourtsResumption');
 
            pa(CourtsResumptionStrategy::all()->toArray(), 5, 'CourtsResumptionStrategy');
            pa(CourtsResumptionStrategyMany::all()->toArray(), 5, 'CourtsResumptionStrategyMany');
                
        }else{
            pa('Выберите вкладку');
        }
        
        pa($_REQUEST, 5, '');
        //pa($_POST);
        //pa(CRest::call('profile'));
        //pa(FirstInstance::all()->first());
        ///*/ pa(CRest::call('crm.deal.list')); ///*/
        
        
        return view('front.'.$view, [
            'tab' => $_REQUEST['tab'],
        ]);
        
        
    }
}
