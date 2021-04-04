@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12 text-left">
            <h1>
                Klant inzien
            </h1>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-12 text-right">
            <h1>
                <a href="{{ route('getCustomerDelete', $id) }}" id="archiveButton" class="btn btn-primary">Archiveren</a>
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
                    <input type="text" name="name" placeholder="Naam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('name') !=null) value="{{ old('name') }}" @else value="{{ $customer->name }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">Telefoonnummer</p>
                    <input type="text" name="contact_phone_number" placeholder="Telefoonnummer*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('contact_phone_number') !=null) value="{{ old('contact_phone_number') }}" @else value="{{ $customer->contact_phone_number }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">Straatnaam</p>
                    <input type="text" name="street" placeholder="Straatnaam" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('street') !=null) value="{{ old('street') }}" @else value="{{ $customer->street }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">Huisnummer</p>
                    <input type="text" name="number" placeholder="Huisnummer*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('number') !=null) value="{{ old('number') }}" @else value="{{ $customer->number }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">Plaatsnaam</p>
                    <input type="text" name="city" placeholder="Plaatsnaam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('city') !=null) value="{{ old('city') }}" @else value="{{ $customer->city }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">Naam Contactpersoon</p>
                    <input type="text" name="contact_name" placeholder="Naam Contactpersoon" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('contact_name') !=null) value="{{ old('contact_name') }}" @else value="{{ $customer->contact_name }}" @endif>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p class="mb-1">E-mail Contactpersoon</p>
                    <input type="text" name="contact_email" placeholder="E-mail Contactpersoon" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')" @if(old('contact_email') !=null) value="{{ old('contact_email') }}" @else value="{{ $customer->contact_email }}" @endif>
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
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <span class="float-left h2">Locatie overzicht</span>
                    <a href="{{URL::to('/customer/'.$id.'/location/create')}}" class="float-right btn border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>Toevoegen</a>
                    <p class="mb-5"></p>
                    <hr/>
                    <div id = "customers">
                        @if(count($locations) === 0)
                            <div class="mt-4 bg-white">
                                <p class="float-left h3">Geen klanten gevonden</p>
                            </div>
                        @else
                            @foreach ($locations as $location)
                                <div id = 'customer-field' class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div id="name"
                                             class="h5 m-0 fw-bold">{{ $location->name }}</div>
                                        <p>{{ $location->street }} {{ $location->number }} {{ $location->building_number }}, {{ $location->postal_code }} te {{ $location->city }}</p>
                                    </div>
                                    <div class="w-50 text-right pb-2">
                                        <a id="{{$location->id}}" href="{{route('getLocationEdit', [$customer->id, $location->id]) }}" class="btn btn-primary">
                                            Bewerken
                                        </a>
                                        <a id="{{$location->id}}" href="{{URL::to('/inspection/create')}}" class="btn border float-right ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                 class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                            </svg>Maak inspectie aan</a>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>
