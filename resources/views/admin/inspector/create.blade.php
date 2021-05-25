@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe inspecteur aanmaken</h1>
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

                    <form action="{{ route('postInspectorCreate') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Voornaam*</label>
                                    <input type="text" name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{old('first_name')}}" placeholder="Vul voornaam in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">E-mailadres*</label>
                                    <input type="text" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{old('email')}}" placeholder="Vul e-mailadres in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Wachtwoord*</label>
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{old('password')}}" placeholder="Vul wachtwoord in">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Achternaam*</label>
                                    <input type="text" name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{old('last_name')}}" placeholder="Vul achternaam in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Telefoonnummer*</label>
                                    <input type="text" name="phone_number"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           value="{{old('phone_number')}}" placeholder="Vul telefoonnummer in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Herhaal wachtwoord*</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Herhaal wachtwoord">
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                        <br>
                        <a href="{{URL::to('/inspector')}}" class="btn btn-default" title="Terug">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
