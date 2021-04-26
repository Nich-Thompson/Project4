<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;

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
}
