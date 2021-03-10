<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\UpdateInspectorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Project;

class InspectorController extends Controller
{
    public function index()
    {
        $inspectors = User::whereHas(
            'roles', function($q){
            $q->where('name', 'inspecteur');
        }
        )->get();
        return view('inspectors.index', [
            'inspectors' => $inspectors
        ]);
    }

    public function create()
    {
        return view('inspectors.create');
    }

    public function store(StoreInspectorRequest $request)
    {
        $inspecteur = User::create([
            'name' => "inspecteur",
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'password' => Hash::make($request->input('password')),
        ]);

        $inspecteur->assignRole('inspecteur');

        return redirect()->route('getInspectorIndex');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('inspectors.edit', ['user'=>$user, 'id'=>$id]);
    }

    public function update($id, UpdateInspectorRequest $request)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if($request->password != null)
        {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('getInspectorIndex');
    }

    public function delete($id)
    {
        $user = User::find($id);
        return view('inspectors.archive', ['user'=>$user, 'id'=>$id]);
    }

    public function destroy($id, Request $request)
    {
        // TODO: archive the user
        error_log("archived");

        return redirect()->route('getInspectorIndex');
    }
}
