<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function create()
    {
        return view('admin.list.create');
    }
}
