<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function create()
    {
        return view('admin.list.create');
    }

    public function edit($id)
    {
        $list = ListModel::find($id);
        $values = $list->values()->get();
        return view('admin.list.edit', ['list'=>$list, 'values'=>$values, 'id'=>$id]);
    }
}
