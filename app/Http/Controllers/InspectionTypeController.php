<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use App\Models\InspectionType;
use Illuminate\Http\Request;

class InspectionTypeController extends Controller
{
    public function index()
    {
        /*$inspectors = InspectionType::all()->orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();

        return view('inspectors.index', [
            'inspectors' => $inspectors
        ]);*/
        $types = InspectionType::all();
        $icons = Icon::all();
        return view('inspectiontypes.index', [
            'types' => $types,
            'icons' => $icons
        ]);
    }
}
