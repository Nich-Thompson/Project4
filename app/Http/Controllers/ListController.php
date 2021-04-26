<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ListController extends Controller
{
    public function create()
    {
        $headlists = ListModel::query()->whereNotNull('list_model_id')->pluck('list_model_id')->all();
        $listsWithNoSublist = ListModel::query()->whereNotIn('id', $headlists)->get();
        return view('admin.list.create', ['lists'=>$listsWithNoSublist]);
    }

    public function store(Request $request)
    {
        ListModel::create([
            'name' => $request->input('name'),
            'list_model_id' => $request->input('list_model_id'),
        ]);

        return redirect()->route('getCustomerIndex');
    }

    public function edit($id)
    {
        $list = ListModel::find($id);
        $values = $list->values()->get();
        return view('admin.list.edit', ['list'=>$list, 'values'=>$values, 'id'=>$id]);
    }

    public function createValue($id){
        $list = ListModel::find($id);
        $sublists = [];
        $sublistvalues = [];
        $sublist = $list -> sublist() -> first();
        while(!is_null($sublist)){
            array_push($sublists, $sublist ->toArray());
            array_push($sublistvalues, $sublist -> values() -> get() ->toArray());
            $sublist = $sublist -> sublist() -> first();
        }
        return view('admin.list.createValue', [
            'list'=>$list,
            'sublists'=>$sublists,
            'sublistvalues' => $sublistvalues
        ]);
    }
}
