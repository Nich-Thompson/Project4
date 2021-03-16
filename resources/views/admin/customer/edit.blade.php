@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12 text-left">
                <h1>
                    Klant bewerken
                </h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 text-right">
                <h1>
                    <a href="{{ route('getInspectorDelete', $id) }}" id="archiveButton" class="btn btn-primary" hidden>Archiveren</a>
                    <button id="switchButton" onclick="enableInput()" class="btn btn-primary">Bewerken</button>
                </h1>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" id="errors">
                <strong>Er waren wat problemen met uw data</strong><br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('postCustomerEdit', $id ) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Naam</p>
                        <input type="text" name="name" placeholder="Naam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('name') != null)
                                value="{{ old('name') }}"
                            @else
                                value="{{ $customer->name }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Telefoonnummer</p>
                        <input type="text" name="contact_phone_number" placeholder="Telefoonnummer*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('contact_phone_number') != null)
                                value="{{ old('contact_phone_number') }}"
                            @else
                                value="{{ $customer->contact_phone_number }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Straatnaam</p>
                        <input type="text" name="street" placeholder="Straatnaam" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('street') != null)
                                value="{{ old('street') }}"
                            @else
                                value="{{ $customer->street }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Huisnummer</p>
                        <input type="text" name="number" placeholder="Huisnummer*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('number') != null)
                                value="{{ old('number') }}"
                            @else
                                value="{{ $customer->number }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Plaatsnaam</p>
                        <input type="text" name="city" placeholder="Plaatsnaam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('city') != null)
                                value="{{ old('city') }}"
                            @else
                                value="{{ $customer->city }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">Naam Contactpersoon</p>
                        <input type="text" name="contact_name" placeholder="Naam Contactpersoon" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('contact_name') != null)
                                value="{{ old('contact_name') }}"
                            @else
                                value="{{ $customer->contact_name }}"
                            @endif>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <p class="mb-1">E-mail Contactpersoon</p>
                        <input type="text" name="contact_email" placeholder="E-mail Contactpersoon" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
                            @if(old('contact_email') != null)
                                value="{{ old('contact_email') }}"
                            @else
                                value="{{ $customer->contact_email }}"
                            @endif>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                    <a href="{{URL::to('/inspector')}}" class="btn btn-default">Terug</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                    <button type="submit" id="saveButton" class="btn btn-primary" hidden>Opslaan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>