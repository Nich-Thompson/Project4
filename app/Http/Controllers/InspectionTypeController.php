<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use App\Models\InspectionType;
use Illuminate\Http\Request;

class InspectionTypeController extends Controller
{
    public function index()
    {
        $types = InspectionType::all();
        $icons = Icon::all();
        return view('inspectiontypes.index', [
            'types' => $types,
            'icons' => $icons
        ]);
    }

    public function create()
    {
        $icons = Icon::all();
        return view('inspectiontypes.create', [
            'icons' => $icons
        ]);
    }

    public function store(Request $request)
    {
        $type = InspectionType::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'icon_id' => $request->input('icon_id'),
        ]);

        return redirect()->route('getInspectionTypeIndex');
    }
}
