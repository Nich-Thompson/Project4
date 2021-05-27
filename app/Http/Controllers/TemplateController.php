<?php

namespace App\Http\Controllers;

use App\Models\InspectionType;
use App\Models\ListModel;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();

        return view('admin.template.index', [
            'templates' => $templates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inspection_types = InspectionType::all();
        $lists = ListModel::all();

        foreach ($lists as $list){
            $list->is_main_list = $list->sublistOf()->first() == null;
        }

        return view('admin.template.create', [
            'inspection_types' => $inspection_types,
            'lists' => $lists
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $labels = $request->input('labels');
        $types = $request->input('types');
        $selects = $request->input('selects');

        $json = [];
        for($i = 0; $i < count($labels); $i++) {
            $newItem = (object) array('label' => $labels[$i], 'type' => $types[$i]);
            array_push($json, $newItem);
        }
        foreach ($selects as $select){
            if(ListModel::find($select) !== null){
                array_push($json, (object) array('list_id' => $select, 'label' => ListModel::find($select)->name, 'type' => 'select'));
            }
        }

        Template::create([
            'inspection_type_id' => '1',
            'json' => json_encode($json)
        ]);
        return redirect(route('getTemplateIndex'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}