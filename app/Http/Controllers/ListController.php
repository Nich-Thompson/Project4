<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListValueRequest;
use App\Http\Requests\ListRequest;
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

    public function store(ListRequest $request)
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
        $sublistOf = ListModel::find($list->list_model_id);
        $values = $list->values()->get();
        return view('admin.list.edit', ['list'=>$list, 'headlist'=>$sublistOf, 'values'=>$values, 'id'=>$id]);
    }

    public function update($id, ListRequest $request)
    {
        $list = ListModel::find($id);
        $list->name = $request->input('name');
        $list->save();

        return redirect()->route('getListEdit', $id);
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
        $list_value_id = $request->input('sublist_value');
        ListValue::create([
            'name' => $name,
            'list_model_id' => $id,
            'list_value_id' => $list_value_id
        ]);

        return redirect(route('getListEdit', $id));
    }

    public function editValue($list_id, $id){
        $listValue = ListValue::find($id);
        $list = ListModel::find($list_id);
        $sublists = [];
        $sublistvalues = [];
        $sublist = $list -> sublist() -> first();
        while(!is_null($sublist)){
            array_push($sublists, $sublist ->toArray());
            array_push($sublistvalues, $sublist -> values() -> get() ->toArray());
            $sublist = $sublist -> sublist() -> first();
        }
        Log::debug($listValue);
        Log::debug($sublistvalues);
        return view('admin.list.editValue', [
            'list'=>$list,
            'sublists'=>$sublists,
            'sublistvalues' => $sublistvalues,
            'listValue' => $listValue
        ]);
    }

    public function updateValue(StoreListValueRequest $request, $list_id, $id){
        $name = $request->input('name');
        $list_value_id = $request->input('sublist_value');

        $listValue = ListValue::find($id);
        $listValue -> list_value_id = $list_value_id;
        $listValue -> name = $name;

        $listValue->save();

        return redirect(route('getListEdit', $list_id));
    }
}
