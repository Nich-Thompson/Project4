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
        InspectionType::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'icon_id' => $request->input('icon_id'),
        ]);

        return redirect()->route('getInspectionTypeIndex')->with('success', "Het inspectietype is succesvol aangemaakt!");
    }

    public function edit($id)
    {
        $type = InspectionType::find($id);
        $icons = Icon::all();
        return view('inspectiontypes.edit', [
            'type' => $type,
            'icons' => $icons,
            'id' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $type = InspectionType::find($id);
        $type->name = $request->input('name');
        $type->description = $request->input('description');
        $type->color = $request->input('color');
        $type->icon_id = $request->input('icon_id');

        $type->save();

        return redirect()->route('getInspectionTypeIndex')->with('success', "Het inspectietype is succesvol bewerkt!");
    }

    public function delete($id)
    {
        $type = InspectionType::find($id);
        return view('inspectiontypes.archive', ['type' => $type, 'id' => $id]);
    }

    public function destroy($id, Request $request)
    {
        $type = InspectionType::find($id);
        $type->delete();

        return redirect()->route('getInspectionTypeIndex')->with('success', "Het inspectietype is succesvol verwijderd!");
    }
}
