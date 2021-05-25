@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe klant aanmaken</h1>
                    <br><br>
                    <hr>

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


                    <form action="{{ route('postCustomerCreate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Klantnaam*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" placeholder="Vul naam in" value="{{old('name')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Straatnaam</label>
                                    <input type="text" class="form-control @error('street') is-invalid @enderror"
                                           id="street" name="street" placeholder="Vul straatnaam in"
                                           value="{{old('street')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Postcode</label>
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                           id="postal_code" name="postal_code" placeholder="1234AA"
                                           value="{{old('postal_code')}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Telefoonnummer</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                           id="phone_number" name="phone_number" placeholder="Vul telefoonnummer in"
                                           value="{{old('phone_number')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Huisnummer</label>
                                    <input type="number" class="form-control @error('number') is-invalid @enderror"
                                           id="number" name="number" placeholder="Vul huisnummer in"
                                           value="{{old('number')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Plaatsnaam</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                           id="city" name="city" placeholder="Vul plaatsnaam in"
                                           value="{{old('city')}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3">Contactpersoon</p>
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Naam</label>
                                    <input type="text" class="form-control @error('contact_name') is-invalid @enderror"
                                           id="contact_name" name="contact_name" placeholder="Vul naam in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">E-mailadres</label>
                                    <input type="text" class="form-control @error('contact_email') is-invalid @enderror"
                                           id="contact_email" name="contact_email" placeholder="Vul e-mailadres in">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Telefoonnummer</label>
                                    <input type="text"
                                           class="form-control @error('contact_phone_number') is-invalid @enderror"
                                           id="contact_phone_number" name="contact_phone_number"
                                           placeholder="Vul telefoonnummer in" value="{{old('contact_phone_number')}}">
                                </div>
                            </div>
                        </div>
                        <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                        <br>
                        <a href="{{URL::to('/customer')}}" class="btn btn-default" title="Terug">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light" title="Aanmaken">Aanmaken
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
