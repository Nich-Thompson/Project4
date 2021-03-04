@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">Create new customer</span>
                    <br><br>
                    <form action="{{ route('postCustomerCreate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter customer name">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name">
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="Enter street name">
                        </div>
                        <div class="form-group">
                            <label for="number">House number</label>
                            <input type="number" class="form-control" id="number" name="number" placeholder="Enter house number">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="1234AA">
                        </div>
                        <div class="form-group">
                            <label for="contact_name">Contact name</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter contact name">
                        </div>
                        <div class="form-group">
                            <label for="contact_phone_number">Contact phone number</label>
                            <input type="text" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="06 12345678">
                        </div>
                        <div class="form-group">
                            <label for="contact_email">Contact email</label>
                            <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="name@provider.com">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                    <a href="{{URL::to('/customer')}}">
                        <button class="mt-3 btn btn-primary">Back</button>
                    </a>
                    <div>
                    </div>
                </div>
            </div>
        </div>
        @endsection