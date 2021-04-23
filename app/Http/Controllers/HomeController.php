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

//        $list2 = ListModel::query()->find(2); // dont work
//        $headlist = $list2->sublistOf()->get();
//        Log::debug($headlist);
//
//        $list3 = ListModel::query()->where('id', '=', $list2->list_model_id)->get(); // do work
//        Log::debug($list3);

        if($user->hasRole('admin')){
            return redirect('customer');
        }else if($user->hasRole('inspecteur')){
            return view('inspector.home');
        }
    }
}
