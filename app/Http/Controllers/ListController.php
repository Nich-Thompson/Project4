<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListValueRequest;
use App\Models\ListModel;
use App\Models\ListValue;
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

    public function storeValue(StoreListValueRequest $request, $id){
        $name = $request->input('name');
        $list_value_id = $request->input('sublist_value_0');
        ListValue::create([
            'name' => $name,
            'list_model_id' => $id,
            'list_value_id' => $list_value_id
        ]);

        return redirect(route('getListEdit', $id));
    }
}
