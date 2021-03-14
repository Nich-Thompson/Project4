<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index() {
        $customers = customer::all();
        return view('admin.customer.index', [
            'customers' => $customers,
        ]);
    }

    public function create() {
        return view('admin.customer.create');
    }

    public function store(StoreCustomerRequest $request) {
        $name = $request->input('name');
        $city = $request->input('city');
        $street = $request->input('street');
        $number = $request->input('number');
        $postal_code = $request->input('postal_code');
        $contact_name = $request->input('contact_name');
        $contact_phone_number = $request->input('contact_phone_number');
        $contact_email = $request->input('contact_email');

        customer::create([
            'name' => $name,
            'city' => $city,
            'street' => $street,
            'number' => $number,
            'postal_code' => $postal_code,
            'contact_name' => $contact_name,
            'contact_phone_number' => $contact_phone_number,
            'contact_email' => $contact_email,
        ]);
        return redirect(route('getCustomerIndex'));
    }

    public function edit($id) {
        $customer = customer::find($id);
        if($customer === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.customer.edit', [
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
        $customer->contact_phone_number = $request->input('contact_phone_number');
        $customer->contact_email = $request->input('contact_email');

        $customer->save();

        return redirect(route('getCustomerIndex', $id));
    }


    public function remove($id) {
        $customer = customer::find($id);
        if($customer === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.customer.delete', [
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
