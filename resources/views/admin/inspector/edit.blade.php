@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Inspecteur bewerken</h1>
                    <button id="switchButton" onclick="enableInput()" class="btn btn-primary float-right ml-2">
                        Bewerken
                    </button>
                    <a href="{{ route('getInspectorArchive', $id) }}" id="archiveButton"
                       class="btn btn-primary float-right" hidden title="Archiveren">Archiveren</a>
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

                    <form action="{{ route('postInspectorEdit', $id ) }}" method="post">
                        @csrf
                        <input name="old_email" value="{{ $user->email }}" hidden>
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Voornaam*</label>
                                    <input type="text" name="first_name" placeholder="Vul voornaam in"
                                           class="form-control @error('first_name') is-invalid @enderror" disabled
                                           @if(old('first_name') != null)
                                           value="{{ old('first_name') }}"
                                           @else
                                           value="{{ $user->first_name }}"
                                        @endif>
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">E-mailadres*</label>
                                    <input type="text" name="email" placeholder="Vul e-mailadres in"
                                           class="form-control @error('email') is-invalid @enderror" disabled
                                           @if(old('email') != null)
                                           value="{{ old('email') }}"
                                           @else
                                           value="{{ $user->email }}"
                                        @endif>
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Wachtwoord*</label>
                                    <input type="password" name="password" value="" placeholder="Vul wachtwoord in"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Wachtwoord*" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Achternaam*</label>
                                    <input type="text" name="last_name" placeholder="Vul achternaam in"
                                           class="form-control @error('last_name') is-invalid @enderror" disabled
                                           @if(old('last_name') != null)
                                           value="{{ old('last_name') }}"
                                           @else
                                           value="{{ $user->last_name }}"
                                        @endif>
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Telefoonnummer*</label>
                                    <input type="text" name="phone_number" placeholder="Vul telefoonnummer in"
                                           class="form-control @error('phone_number') is-invalid @enderror" disabled
                                           @if(old('phone_number') != null)
                                           value="{{ old('phone_number') }}"
                                           @else
                                           value="{{ $user->phone_number }}"
                                        @endif>
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Herhaal wachtwoord*</label>
                                    <input type="password" name="password_confirmation" value=""
                                           placeholder="Herhaal wachtwoord @error('password') is-invalid @enderror"
                                           class="form-control" placeholder="Herhaal wachtwoord" disabled>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3 mt-3">Door de wachtwoorden leeg te laten worden deze niet veranderd.</p>
                        <br>
                        <a href="{{URL::to('/inspector')}}" class="btn btn-default" title="Terug">Terug</a>
                        <button type="submit" id="saveButton" class="float-right btn btn-primary text-light" hidden>
                            Opslaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/switchEditView.js') }}"></script>
