@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Nieuwe inspecteur aanmaken</h1>

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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="Voornaam*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Achternaam*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="phone_number" class="form-control" placeholder="Telefoonnummer*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-mailadres*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Wachtwoord*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Herhaal wachtwoord*" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    Velden met een ster(*) zijn verplicht.
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-leftf">
                    <a href="{{ url()->previous() }}" class="btn btn-default">Terug</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                </div>
            </div>
        </form>
    </div>
@endsection
