<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\InspectionType;
use App\Models\Location;
use App\Models\Inspector;
use Illuminate\Http\Request;

class inspectionController extends Controller
{
    public function index() {
        $inspections = Inspection::all();
        $inspectionTypes = InspectionType::all();
        return view('inspection.index', [
            'inspections' => $inspections,
            'inspectionTypes' => $inspectionTypes,
        ]);
    }

    public function create() {
        $inspectionTypes = InspectionType::all();
        return view('inspection.create', [
            'inspectionTypes' => $inspectionTypes,
        ]);
    }

    public function store(request $request) {
        $name = $request->input('name');
        $creator = $request->input('creator');

        inspection::create([
            'name' => $name,
            'creator' => $creator
        ]);
        return redirect(route('getCustomerIndex'));
    }

    public function edit($id) {
        $inspection = Inspection::find($id);
        return view('admin.location.edit', [
            'id' => $id
        ]);
    }

    public function update($id, UpdateCustomerRequest $request) {
        $customer = customer::find($id);

        $customer->name = $request->input('name');
        $customer->city = $request->input('creator');

        $customer->save();

        return redirect(route('getLocationIndex', $id));
    }


    public function remove($id) {
        $inspection = Inspection::find($id);
        if($inspection === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.inspection.archive', [
            'inspection' => $inspection,
            'id' => $id
        ]);
    }

    public function archive($id) {
        $inspection = Inspection::find($id);
        $inspection->delete();
        return redirect(route('getLocationIndex'));
    }
}
