@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-12 text-left border-bottom mb-2">
                            <h1>
                                {{ $type->name }}
                            </h1>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-12 text-right">
                            <h1>
                            <!--          <a href="{{ route('getInspectionTypeDelete', $id) }}" id="archiveButton"
                                   class="btn btn-primary" hidden title="Archiveren">Archiveren</a> -->

                                <button id="switchButton" onclick="enableInput()" class="btn btn-primary"
                                        title="Bewerken/bekijken inschakelen">Bewerken
                                </button>
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

                    <form action="{{ route('postInspectionTypeEdit', $id ) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Naam van het insspectietype:</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" disabled required
                                           oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')"
                                           oninput="this.setCustomValidity('')"
                                           @if(old('name') != null)
                                           value="{{ old('name') }}"
                                           @else
                                           value="{{ $type->name }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Beschrijving:</label>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control" disabled required
                                           oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')"
                                           oninput="this.setCustomValidity('')"
                                           @if(old('description') != null)
                                           value="{{ old('description') }}"
                                           @else
                                           value="{{ $type->description }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Kleur:</label>
                                <div class="form-group">
                                    <input type="color" name="color" class="form-control" title="Kleur selecteren"
                                           disabled required
                                           oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')"
                                           oninput="this.setCustomValidity('')"
                                           @if(old('color') != null)
                                           value="{{ old('color') }}"
                                           @else
                                           value="{{ $type->color }}"
                                        @endif>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Icoon:</label>
                                <div class="form-group">
                                    <select name="icon_id"
                                            class="fontawesomeselect col-xs-12 col-sm-12 col-md-12 form-select"
                                            title="Icoon selecteren" disabled>

                                        @foreach($icons as $icon)
                                            @if($type->icon()->id == $icon->id)
                                                <option value="{{ $icon->id }}" selected>
                                                    &#x{{ $icon->unicode }};
                                                    {{ ucfirst(preg_replace("/[\W]/", ' ',$icon->name)) }}
                                                </option>
                                            @else
                                                <option value="{{ $icon->id }}">
                                                    &#x{{ $icon->unicode }};
                                                    {{ ucfirst(preg_replace("/[\W]/", ' ',$icon->name)) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/inspectiontype')}}" class="btn btn-default"
                           title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" id="saveButton" class="btn btn-primary float-right" hidden>Opslaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>
