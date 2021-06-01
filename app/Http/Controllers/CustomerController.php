<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Location;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::orderBy('name', 'ASC')->get();
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
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('phone_number'));
        $phone_number = $phoneNumbersOnly;
        $contact_name = $request->input('contact_name');
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('contact_phone_number'));
        $contact_phone_number = $phoneNumbersOnly;
        $contact_email = $request->input('contact_email');

        Customer::create([
            'name' => $name,
            'city' => $city,
            'street' => $street,
            'number' => $number,
            'postal_code' => $postal_code,
            'phone_number' => $phone_number,
            'contact_name' => $contact_name,
            'contact_phone_number' => $contact_phone_number,
            'contact_email' => $contact_email,
        ]);
        return redirect(route('getCustomerIndex'));
    }

    public function edit($id) {
        $customer = Customer::find($id);
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
        $customer = Customer::find($id);

        $customer->name = $request->input('name');
        $customer->city = $request->input('city');
        $customer->street = $request->input('street');
        $customer->number = $request->input('number');
        $customer->postal_code = $request->input('postal_code');
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('phone_number'));
        $customer -> phone_number = $phoneNumbersOnly;
        $customer->contact_name = $request->input('contact_name');
        $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $request->input('contact_phone_number'));
        $customer->contact_phone_number = $phoneNumbersOnly;
        $customer->contact_email = $request->input('contact_email');

        $customer->save();

        return redirect(route('getCustomerIndex', $id));
    }

    public function remove($id) {
        $customer = Customer::find($id);
        if($customer === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.customer.archive', [
            'customer' => $customer,
            'id' => $id
        ]);
    }

    public function archive($id) {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect(route('getCustomerIndex'));
    }

    public function archives() {
        $customers = Customer::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        return view('admin.customer.archives', [
            'customers' => $customers,
        ]);
    }

    public function restore($id) {
        $customer = Customer::withTrashed()->find($id);
        $customer->restore();
        return redirect(route('getCustomerArchives'));
    }

    public function deletes(){
        $customers = Customer::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        foreach($customers as $customer){
            $customer->forceDelete();
        }
        return redirect(route('getCustomerIndex'));
    }
    public function delete() {
        return view('admin.customer.delete');
    }
}
