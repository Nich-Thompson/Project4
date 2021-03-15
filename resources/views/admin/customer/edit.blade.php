@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <span class="float-left h2 ml-3">Klant bewerken</span>
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


                        <form action="{{ route('postCustomerEdit', $customer->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col text-center">
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Naam*"
                                               @if(old('name') != null)
                                               value="{{ old('name') }}"
                                               @else
                                               value="{{ $customer->name }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="street" name="street" placeholder="Straatnaam"
                                               @if(old('street') != null)
                                               value="{{ old('street') }}"
                                               @else
                                               value="{{ $customer->street }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="1234AA"
                                               @if(old('postal_code') != null)
                                               value="{{ old('postal_code') }}"
                                               @else
                                               value="{{ $customer->postal_code }}"
                                            @endif>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="Telefoonnummer"
                                               @if(old('contact_phone_number') != null)
                                               value="{{ old('contact_phone_number') }}"
                                               @else
                                               value="{{ $customer->contact_phone_number }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <input type="number" class="form-control" id="number" name="number" placeholder="Huisnummer"
                                               @if(old('number') != null)
                                               value="{{ old('number') }}"
                                               @else
                                               value="{{ $customer->number }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Plaatsnaam"
                                               @if(old('city') != null)
                                               value="{{ old('city') }}"
                                               @else
                                               value="{{ $customer->city }}"
                                            @endif>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p class="ml-3">Contactpersoon</p>
                            <div class="row text-center">
                                <div class="col text-center">
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contactpersoon naam"
                                               @if(old('contact_name') != null)
                                               value="{{ old('contact_name') }}"
                                               @else
                                               value="{{ $customer->contact_name }}"
                                            @endif>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="form-group ml-3">
                                        <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contactpersoon e-mail"
                                               @if(old('contact_email') != null)
                                               value="{{ old('contact_email') }}"
                                               @else
                                               value="{{ $customer->contact_email }}"
                                            @endif>
                                    </div>
                                </div>
                            </div>
                            <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                            <br>
                            <a href="{{URL::to('/customer')}}" class="btn">Terug</a>
                            <button type="submit" class="float-right btn btn-secondary text-light">Opslaan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
