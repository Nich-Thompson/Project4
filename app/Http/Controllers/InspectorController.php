<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    public function index()
    {
        $inspectors = User::whereHas(
            'roles', function($q){
            $q->where('name', 'inspecteur');
        }
        )->get();
        return view('inspectors.index', [
            'inspectors' => $inspectors
        ]);
    }
}
