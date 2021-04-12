@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12 text-left">
                <h1>
                    {{ $type->name }}
                </h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 text-right">
                <h1>
                    <a href="{{ route('getInspectionTypeDelete', $id) }}" id="archiveButton" class="btn btn-primary" hidden>Archiveren</a>
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

        <form action="{{ route('postInspectionTypeEdit', $id ) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label>Naam van het insspectietype:</label>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
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
                        <input type="text" name="description" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
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
                        <input type="color" name="color" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')"
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
                        <select name="icon_id" class="col-xs-12 col-sm-12 col-md-12 form-control" disabled>
                            @foreach($icons as $icon)
                                <option value="{{ $icon->id }}">
                                    {{--<i class="fa fa-{{ $icon->name }}" style="font-size:32px;"></i>--}}
                                    {{ ucfirst(preg_replace("/[\W]/", ' ',$icon->name)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 text-left">
                    <a href="{{URL::to('/inspectiontype')}}" class="btn btn-default">Terug</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                    <button type="submit" id="saveButton" class="btn btn-primary" hidden>Opslaan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>
