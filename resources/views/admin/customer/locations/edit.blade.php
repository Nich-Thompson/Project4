@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Locatie bewerken</h1>
                    <br><br>
                    <hr>
                    <div class="text-right">
                        <h1>
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('getLocationArchive', [$customer_id, $location->id]) }}"
                                   id="archiveButton"
                                   class="btn btn-primary" hidden title="Archiveren">Archiveren</a>
                            @endif
                            <button id="switchButton" onclick="enableInput()" class="btn btn-primary">Bewerken</button>
                        </h1>
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

                    <form action="{{ route('postLocationEdit', [$customer_id, $location->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label>Locatie naam*</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Naam*" disabled
                                               @if(old('name') !=null) value="{{ old('name') }}"
                                               @else value="{{ $location->name }}" @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label>Straat naam</label>
                                        <input type="text" class="form-control" id="street" name="street"
                                               placeholder="Straatnaam" disabled
                                               @if(old('street') !=null) value="{{ old('street') }}"
                                               @else value="{{ $location->street }}" @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label>Postcode</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                                               placeholder="1234AA" disabled
                                               @if(old('postal_code') !=null) value="{{ old('postal_code') }}"
                                               @else value="{{ $location->postal_code }}" @endif>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ml-3">
                                        <label>Plaatsnaam</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                               placeholder="Plaatsnaam" disabled
                                               @if(old('city') !=null) value="{{ old('city') }}"
                                               @else value="{{ $location->city }}" @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label>Huisnummer</label>
                                        <input type="number" class="form-control" id="number" name="number"
                                               placeholder="Huisnummer" disabled
                                               @if(old('number') !=null) value="{{ old('number') }}"
                                               @else value="{{ $location->number }}" @endif>
                                    </div>
                                    <div class="form-group ml-3">
                                        <label>Gebouwnummer</label>
                                        <input type="text" class="form-control" id="building_number"
                                               name="building_number" placeholder="Gebouwnummer" disabled
                                               @if(old('building_number') !='') value="{{ old('building_number') }}"
                                               @else value="{{ $location->building_number }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                                <a href="{{URL::to('/customer/'.$customer_id.'/edit')}}"
                                   class="btn btn-default" title="Terug naar vorige pagina">Terug</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                                <button type="submit" id="saveButton" class="btn btn-primary" hidden>Opslaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>
