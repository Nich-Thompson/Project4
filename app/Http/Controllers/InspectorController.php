<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'min:8'
        ]);

        $name = "inspecteur";
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = Hash::make($request->input('password'));

        $inspecteur = User::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'password' => $password,
        ]);

        $inspecteur->assignRole('inspecteur');

        return redirect()->route('getInspectorIndex');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('inspectors.edit', ['user'=>$user, 'id'=>$id]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            /*'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'min:8'*/
        ]);

        //$request->update($request->all());
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if($request->password != null)
        {
            $request->validate([
                'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
                'password_confirmation' => 'min:8'
            ]);
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('getInspectorIndex');
    }
}
