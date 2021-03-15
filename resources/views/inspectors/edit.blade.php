@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12 text-left">
                <h1>
                    Inspecteur bewerken
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
            <div class="alert alert-danger">
                <strong>Er waren wat problemen met uw data</strong><br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('postInspectorEdit', $id ) }}" method="post">
            @csrf
            <input name="old_email" value="{{ $user->email }}" hidden>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="first_name" value="{{ $user->first_name }}" placeholder="Voornaam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Achternaam*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="email" value="{{ $user->email }}" placeholder="E-mailadres*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" placeholder="Telefoonnummer*" class="form-control" disabled required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="password" name="password" value="" placeholder="Wachtwoord*"  class="form-control" placeholder="Wachtwoord*" disabled>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" value="" placeholder="Herhaal wachtwoord*" class="form-control" placeholder="Herhaal wachtwoord*" disabled>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    Door de wachtwoorden leeg te laten worden deze niet veranderd.
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
