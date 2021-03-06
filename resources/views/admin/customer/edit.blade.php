@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasRole('admin'))
                        <h1 class="float-left h2">Klant bewerken</h1>
                        <button id="switchButton" onclick="enableInput()" class="btn btn-primary float-right ml-2"
                                title="Bewerken/bekijken inschakelen">
                            Bewerken
                        </button>
                        <a href="{{ route('getCustomerArchive', $id) }}" id="archiveButton"
                           class="btn btn-primary float-right" hidden title="Klant archiveren">Archiveren</a>
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
                            <a href="{{URL::to('/customer')}}" class="btn btn-default" title="Terug naar vorige pagina">Terug</a>
                            <button type="submit" id="saveButton" class="float-right btn btn-primary" hidden>Opslaan
                            </button>
                        </form>
                    @endif
                    <h1 class="d-inline-block">Klantnaam: {{$customer->name}}</h1>
                    <div class="py-12">
                        <div class="px-4">
                            <div class="bg-white overflow-hidden shadow-sm">
                                <div class="p-4 bg-white border-b border-gray-200">
                                    <h2 class="float-left h2">Locatie overzicht</h2>
                                    @include('components.help-locatie')
                                    <a href="{{URL::to('/customer/'.$id.'/location/create')}}"
                                       class="float-right btn border" title="Locatie toevoegen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        Toevoegen</a>
                                    @if(Auth::user()->hasRole('admin'))
                                        <a href="{{URL::to('/customer/'.$id.'/location/archives')}}"
                                           class="float-right btn border mr-2" title="Locatie archief">
                                            Archief</a>
                                    @endif
                                    <p class="mb-5"></p>
                                    <hr/>
                                    <div id="customers">
                                        @if(count($locations) === 0)
                                            <div class="mt-4 bg-white">
                                                <h2 class="float-left h3">Geen locaties gevonden</h2>
                                            </div>
                                        @else
                                            @foreach ($locations as $location)
                                                <div id='customer-field'
                                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                                    <div class="d-flex flex-column w-50">
                                                        <div id="name"
                                                             class="h5 m-0 fw-bold">{{ $location->name }}</div>
                                                        <p>
                                                            @if($location->street != null and $location->postal_code != null and $location->building_number == null and $location->number == null)
                                                                {{ $location->street }},
                                                            @else
                                                                {{ $location->street }}
                                                            @endif
                                                            @if($location->number != null and $location->postal_code != null and $location->building_number == null)
                                                                {{ $location->number }},
                                                            @else
                                                                {{ $location->number }}
                                                            @endif
                                                            @if($location->building_number != null and $location->postal_code != null)
                                                                {{ $location->building_number }},
                                                            @else
                                                                {{ $location->building_number }}
                                                            @endif
                                                            @if($location->postal_code != null)
                                                                {{ $location->postal_code }}
                                                            @endif
                                                            @if($location->city != null)
                                                                te {{ $location->city }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="w-50 text-right pb-2">
                                                        <a href="{{URL::to('/inspection/'.$customer->id.'/'.$location->id.'')}}"
                                                           class="btn ml-2 border border-1"
                                                           title="Ga naar inspecties">Ga naar
                                                            inspecties</a>
                                                        @if(Auth::user()->hasRole('inspecteur'))
                                                            <a id="{{$location->id}}"
                                                               href="{{route('getLocationEdit', [$customer->id, $location->id]) }}"
                                                               class="btn border ml-2" title="Locatie bekijken">
                                                                Bekijken
                                                            </a>
                                                        @else
                                                            <a href="{{route('getLocationEdit', [$customer->id, $location->id]) }}"
                                                               class="btn btn-primary ml-2" title="Locatie bekijken">
                                                                Bekijken
                                                            </a>
                                                        @endif
                                                        @if(Auth::user()->hasRole('inspecteur'))
                                                            <a href="{{URL::to('/inspection/'.$customer->id.'/'.$location->id.'/choose_template')}}"
                                                               class="btn btn-primary ml-2 float-right">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                     height="16" fill="currentColor" class="bi bi-plus"
                                                                     viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                </svg>
                                                                Maak inspectie aan</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                            <div class="mt-4 ml-2">
                                                {{$locations->links()}}
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/switchEditView.js') }}"></script>
