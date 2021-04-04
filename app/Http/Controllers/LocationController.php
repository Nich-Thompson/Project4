<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\customer;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function create($id) {
        return view('admin.customer.locations.create', [
            'id' => $id
        ]);
    }

    public function store(Request $request, $id) {
        $name = $request->input('name');
        $city = $request->input('city');
        $street = $request->input('street');
        $number = $request->input('number');
        $postal_code = $request->input('postal_code');
        $building_number = $request->input('building_number');

        Location::create([
            'name' => $name,
            'city' => $city,
            'street' => $street,
            'number' => $number,
            'postal_code' => $postal_code,
            'building_number' => $building_number,
            'customer_id' => $id
        ]);
        return redirect(route('getCustomerEdit', $id));
    }

    public function edit($id, $location_id) {
        $location = Location::find($location_id);
        if($location === null) {
            abort(404, 'location with that ID does not exist');
        }
        return view('admin.customer.locations.edit', [
            'location' => $location,
            'customer_id' => $id,
        ]);
    }

    public function update($id, $location_id, Request $request) {
        $location = Location::find($location_id);

        $location->name = $request->input('name');
        $location->city = $request->input('city');
        $location->street = $request->input('street');
        $location->number = $request->input('number');
        $location->postal_code = $request->input('postal_code');
        $location->building_number = $request->input('building_number');
        $location->customer_id = $id;

        $location->save();

        return redirect(route('getCustomerEdit', $id));
    }


    public function remove($id, $location_id) {
        $location = Location::find($location_id);
        if($location === null) {
            abort(404, 'location with that ID does not exist');
        }
        return view('admin.customer.locations.archive', [
            'location' => $location,
            'customer_id' => $id
        ]);
    }

    public function archive($id, $location_id) {
        $location = Location::find($location_id);
        $location->delete();
        return redirect(route('getCustomerEdit', $id));
    }
}
