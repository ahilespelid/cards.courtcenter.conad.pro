<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\FirstInstance;

use \Crest;

class HomeController extends Controller{    
    public function index(int $page = 1){
        
        pa($_REQUEST);
        pa($_POST);
        //pa(CRest::call('profile'));
        pa(FirstInstance::all()->first());
        ///*/ pa(CRest::call('crm.deal.list')); ///*/
        
        
        return view('front.home');
        
        
    }
}
