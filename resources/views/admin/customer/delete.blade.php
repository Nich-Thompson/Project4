@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <span class="float-left h2">Archive {{ $customer->name }}</span>
                    <a href="{{URL::to('/customer')}}" class="float-right btn btn-primary">Back</a>
                    <br><br>
                    Name: {{ $customer->name }}
                    <br>
                    City: {{ $customer->city }}
                    <br>
                    Address: {{ $customer->street }} {{ $customer->number }} {{ $customer->postal_code }}
                    <br>
                    Contact info:
                    {{ $customer->contact_name }}
                    {{ $customer->contact_phone_number }}
                    {{ $customer->contact_email }}
                    <br>
                    <br>
                    <form action="{{ route('postCustomerArchive', $id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Archive</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


