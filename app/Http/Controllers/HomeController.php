<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->hasRole('admin')){
            return redirect('customer');
        }else if($user->hasRole('inspecteur')){
            return redirect('customer');
        }
    }
}
