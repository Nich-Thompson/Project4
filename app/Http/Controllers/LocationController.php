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

    public function edit($id) {
        $customer = customer::find($id);
        $locations = Location::query()->where('customer_id', '=', $id)->get();
        if($customer === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.customer.edit', [
            'locations' => $locations,
            'customer' => $customer,
            'id' => $id
        ]);
    }

    public function update($id, UpdateCustomerRequest $request) {
        $customer = customer::find($id);

        $customer->name = $request->input('name');
        $customer->city = $request->input('city');
        $customer->street = $request->input('street');
        $customer->number = $request->input('number');
        $customer->postal_code = $request->input('postal_code');
        $customer->contact_name = $request->input('contact_name');
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('contact_phone_number'));
        $customer->contact_phone_number = $phoneNumbersOnly;
        $customer->contact_email = $request->input('contact_email');

        $customer->save();

        return redirect(route('getCustomerIndex', $id));
    }


    public function remove($id) {
        $customer = customer::find($id);
        if($customer === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.customer.archive', [
            'customer' => $customer,
            'id' => $id
        ]);
    }

    public function archive($id) {
        $customer = customer::find($id);
        $customer->delete();
        return redirect(route('getCustomerIndex'));
    }
}
