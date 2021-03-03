@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Nieuwe inspecteur aanmaken</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                        <input type="text" name="first_name" class="form-control" placeholder="Voornaam*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Achternaam*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="phone_number" class="form-control" placeholder="Telefoonnummer*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-mailadres*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="password" class="form-control" placeholder="Wachtwoord*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="password_confirmation" class="form-control" placeholder="Herhaal wachtwoord*">
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
