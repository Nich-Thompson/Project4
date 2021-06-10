<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\UpdateInspectorRequest;
use App\Mail\InspectorAccountEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Project;

class InspectorController extends Controller
{
    public function index()
    {
        $inspectors = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'inspecteur');
        }
        )->orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();
        return view('admin.inspector.index', [
            'inspectors' => $inspectors
        ]);
    }

    public function create()
    {
        return view('admin.inspector.create');
    }

    public function store(StoreInspectorRequest $request)
    {
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('phone_number'));
        $inspecteur = User::create([
            'name' => "inspecteur",
            'email' => $request->input('email'),
            'phone_number' => $phoneNumbersOnly,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'password' => Hash::make($request->input('password')),
        ]);

        $inspecteur->assignRole('inspecteur');

        $data = ["firstname" => $request->input('first_name'), "lastname" => $request->input('last_name'),
            "email" => $request->input('email'), "password" => $request->input('password')];

        Mail::to($request->input('email'))->send(new InspectorAccountEmail($data));

        return redirect()->route('getInspectorIndex');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.inspector.edit', ['user' => $user, 'id' => $id]);
    }

    public function update($id, UpdateInspectorRequest $request)
    {
        $user = User::find($id);
        $user->email = $request->input('email');
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('phone_number'));
        $user->phone_number = $phoneNumbersOnly;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($request->password != null) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('getInspectorIndex');
    }

    public function remove($id)
    {
        $inspector = User::find($id);
        if ($inspector === null) {
            abort(404, 'inspector with that ID does not exist');
        }
        return view('admin.inspector.archive', [
            'inspector' => $inspector,
            'id' => $id
        ]);
    }

    public function archive($id)
    {
        $inspector = User::find($id);
        $inspector->delete();
        return redirect(route('getInspectorIndex'));
    }

    public function archives()
    {
        $inspectors = User::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        return view('admin.inspector.archives', [
            'inspectors' => $inspectors,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        return view('admin.inspector.archive', ['user' => $user, 'id' => $id]);
    }
}
