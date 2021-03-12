@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <span class="float-left h2">Edit customer</span>
                    <a href="{{URL::to('/customer')}}" class="float-right btn btn-primary">Back</a>
                    <br><br>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Er waren wat problemen met uw data</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('postCustomerEdit', $id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter customer name" value="{{ $customer->name }}">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   placeholder="Enter city name" value="{{ $customer->city }}">
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street"
                                   placeholder="Enter street name" value="{{ $customer->street }}">
                        </div>
                        <div class="form-group">
                            <label for="number">House number</label>
                            <input type="number" class="form-control" id="number" name="number"
                                   placeholder="Enter house number" value="{{ $customer->number }}">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                   placeholder="1234AA" value="{{ $customer->postal_code }}">
                        </div>
                        <div class="form-group">
                            <label for="contact_name">Contact name</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name"
                                   placeholder="Enter contact name" value="{{ $customer->contact_name }}">
                        </div>
                        <div class="form-group">
                            <label for="contact_phone_number">Contact phone number</label>
                            <input type="text" class="form-control" id="contact_phone_number" name="contact_phone_number"
                                   placeholder="06 12345678" value="{{ $customer->contact_phone_number }}">
                        </div>
                        <div class="form-group">
                            <label for="contact_email">Contact email</label>
                            <input type="text" class="form-control" id="contact_email" name="contact_email"
                                   placeholder="name@provider.com" value="{{ $customer->contact_email }}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

