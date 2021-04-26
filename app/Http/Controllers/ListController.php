<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function create()
    {
//        $query = "SELECT * FROM inspectietool.list_models l1
//            WHERE NOT EXISTS (
//            SELECT * FROM inspectietool.list_models l2
//            WHERE l1.id = l2.list_model_id)";

//        $listsWithNoSublist = ListModel::query()->doesntHave('list_model_id')->get();

//        $listsWithNoSublist = ListModel::query()->whereNotExists(function ($query)
//            {
//                $query->select(DB::raw(1))
//                    ->from('list_models')
//                    ->whereRaw('list_models.id = list_models.list_model_id');
//            }
//        )->get();

        $lists = ListModel::query()->whereNotNull('list_model_id')->pluck('list_model_id')->all();
        $listsWithNoSublist = ListModel::query()->whereNotIn('id', $lists)->get();
        return view('admin.list.create', ['lists'=>$listsWithNoSublist]);
    }

    public function edit($id)
    {
        $list = ListModel::find($id);
        $values = $list->values()->get();
        return view('admin.list.edit', ['list'=>$list, 'values'=>$values, 'id'=>$id]);
    }
}
