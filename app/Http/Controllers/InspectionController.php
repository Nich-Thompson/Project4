<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\InspectionType;
use App\Models\Location;
use App\Models\Inspector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::all();
        $inspectionTypes = InspectionType::all();
        return view('inspection.index', [
            'inspections' => $inspections,
            'inspectionTypes' => $inspectionTypes,
        ]);
    }

    public function create()
    {
        $user_id = Auth::id();

        $inspection = Inspection::create([
            'user_id' => $user_id,
            "json" => "",
            "locked" => true,
        ]);

        return redirect()->to("inspection/inspect/" . $inspection->id);
    }

    public function inspect($id)
    {
        $inspection = Inspection::find($id);
        $inspection_types = InspectionType::all();
        $user = User::find($inspection->user_id);

        return view('inspection.create', [
            "id" => $id,
            "inspection" => $inspection,
            "username" => $user->name,
            'inspection_types' => $inspection_types,
        ]);
    }


//    public function store(request $request)
//    {
//        $name = $request->input('name');
//
//        Inspection::create([
//            'name' => $name,
//        ]);
//
//        return redirect(route('getCustomerIndex'));
//    }

    public function edit($id)
    {
        $inspection = Inspection::find($id);
        return view('admin.location.edit', [
            'id' => $id
        ]);
    }

    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = customer::find($id);

        $customer->user_id = $request->input('user_id');

        $customer->save();

        return redirect(route('getLocationIndex', $id));
    }


    public function remove($id)
    {
        $inspection = Inspection::find($id);
        if ($inspection === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.inspection.archive', [
            'inspection' => $inspection,
            'id' => $id
        ]);
    }

    public function archive($id)
    {
        $inspection = Inspection::find($id);
        $inspection->delete();
        return redirect(route('getLocationIndex'));
    }
}
