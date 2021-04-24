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

        return view('admin.list.edit', ['list'=>$list, 'id'=>$id]);
    }
}
