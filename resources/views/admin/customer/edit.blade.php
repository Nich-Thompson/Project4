@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasRole('admin'))
                        <span class="float-left h2">Klant bewerken</span>
                        <button id="switchButton" onclick="enableInput()" class="btn btn-primary float-right ml-2">
                            Bewerken
                        </button>
                        <a href="{{ route('getCustomerArchive', $id) }}" id="archiveButton"
                           class="btn btn-primary float-right" hidden>Archiveren</a>
                        <br><br>
                        <hr>

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
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Klantnaam*</label>
                                        <input type="text" name="name" placeholder="Vul naam in"
                                               class="form-control @error('name') is-invalid @enderror" disabled
                                               @if(old('name') != null)
                                               value="{{ old('name') }}"
                                               @else
                                               value="{{ $customer->name }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Straatnaam</label>
                                        <input type="text" name="street" placeholder="Vul straatnaam in"
                                               class="form-control @error('street') is-invalid @enderror" disabled
                                               @if(old('street') != null)
                                               value="{{ old('street') }}"
                                               @else
                                               value="{{ $customer->street }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Postcode</label>
                                        <input type="text" name="postal_code" placeholder="1234AA"
                                               class="form-control @error('postal_code') is-invalid @enderror" disabled
                                               @if(old('postal_code') != null)
                                               value="{{ old('postal_code') }}"
                                               @else
                                               value="{{ $customer->postal_code }}"
                                            @endif>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Telefoonnummer</label>
                                        <input type="text" name="phone_number"
                                               placeholder="vul telefoonnummer in"
                                               class="form-control @error('phone_number') is-invalid @enderror"
                                               disabled
                                               @if(old('phone_number') != null)
                                               value="{{ old('phone_number') }}"
                                               @else
                                               value="{{ $customer->phone_number }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Huisnummer</label>
                                        <input type="text" name="number" placeholder="Vul huisnummer in"
                                               class="form-control @error('number') is-invalid @enderror" disabled
                                               @if(old('number') != null)
                                               value="{{ old('number') }}"
                                               @else
                                               value="{{ $customer->number }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Plaatsnaam</label>
                                        <input type="text" name="city" placeholder="Vul plaatsnaam in"
                                               class="form-control @error('city') is-invalid @enderror" disabled
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
                            <div class="row">
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Naam</label>
                                        <input type="text" name="contact_name" placeholder="Vul naam in"
                                               class="form-control @error('contact_name') is-invalid @enderror" disabled
                                               @if(old('contact_name') != null)
                                               value="{{ old('contact_name') }}"
                                               @else
                                               value="{{ $customer->contact_name }}"
                                            @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label class="ml-1">E-mail</label>
                                        <input type="text" name="contact_email" placeholder="Vul e-mail in"
                                               class="form-control @error('contact_email') is-invalid @enderror"
                                               disabled
                                               @if(old('contact_email') != null)
                                               value="{{ old('contact_email') }}"
                                               @else
                                               value="{{ $customer->contact_email }}"
                                            @endif>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label class="ml-1">Telefoonnummer</label>
                                        <input type="text" name="contact_phone_number"
                                               placeholder="vul telefoonnummer in"
                                               class="form-control @error('contact_phone_number') is-invalid @enderror"
                                               disabled
                                               @if(old('contact_phone_number') != null)
                                               value="{{ old('contact_phone_number') }}"
                                               @else
                                               value="{{ $customer->contact_phone_number }}"
                                            @endif>
                                    </div>
                                </div>
                            </div>
                            <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                            <br>
                            <a href="{{URL::to('/customer')}}" class="btn btn-default">Terug</a>
                            <button type="submit" id="saveButton" class="float-right btn btn-primary" hidden>Opslaan
                            </button>
                        </form>
                    @endif
                    <h1>Klantnaam: {{$customer->name}}</h1>
                        <a></a>
                    <div class="py-12">
                        <div class="px-4">
                            <div class="bg-white overflow-hidden shadow-sm">
                                <div class="p-4 bg-white border-b border-gray-200">
                                    <span class="float-left h2">Locatie overzicht</span>
                                    <a href="{{URL::to('/customer/'.$id.'/location/create')}}"
                                       class="float-right btn border">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        Toevoegen</a>
                                    <p class="mb-5"></p>
                                    <hr/>
                                    <div id="customers">
                                        @if(count($locations) === 0)
                                            <div class="mt-4 bg-white">
                                                <p class="float-left h3">Geen locaties gevonden</p>
                                            </div>
                                        @else
                                            @foreach ($locations as $location)
                                                <div id='customer-field'
                                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                                    <div class="d-flex flex-column w-50">
                                                        <div id="name"
                                                             class="h5 m-0 fw-bold">{{ $location->name }}</div>
                                                        <p>{{ $location->street }} {{ $location->number }} {{ $location->building_number }}
                                                            , {{ $location->postal_code }} te {{ $location->city }}</p>
                                                    </div>
                                                    <div class="w-50 text-right pb-2">
                                                        <a id="{{$location->id}}"
                                                           href="{{route('getLocationEdit', [$customer->id, $location->id]) }}"
                                                           class="btn btn-primary">
                                                            Bewerken
                                                        </a>
                                                        <a id="{{$location->id}}"
                                                           href="{{URL::to('/inspection/'.$customer->id.'/'.$location->id.'/create')}}"
                                                           class="btn border float-right ml-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16" fill="currentColor" class="bi bi-plus"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                            </svg>
                                                            Maak inspectie aan</a>
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
