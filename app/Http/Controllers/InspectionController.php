<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Inspector;
use Illuminate\Http\Request;

class inspectionController extends Controller
{
    public function index() {
        $inspections = Inspection::all();
        return view('admin.customer.index', [
            'inspections' => $inspections,
        ]);
    }

    public function create() {
        return view('admin.inspection.create');
    }

    public function store(StoreCustomerRequest $request) {
        $name = $request->input('name');
        $creator = $request->input('creator');

        customer::create([
            'name' => $name,
            'creator' => $creator
        ]);
        return redirect(route('getInspectionIndex'));
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
