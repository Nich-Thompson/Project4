<?php


namespace App\Http\Controllers;


use App\Models\ListModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
//        $list = ListModel::query()->find(1);
//        $listvalues = $list->values()->get()->toArray();
//        Log::debug($listvalues);
//        
        if($user->hasRole('admin')){
            return redirect('customer');
        }else if($user->hasRole('inspecteur')){
            return view('inspector.home');
        }
    }
}
