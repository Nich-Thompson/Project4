@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>ye</h1>

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

        <form action="{{ route('postInspectorEdit', $id ) }}" method="post">
            @csrf
            {{--@method('PUT')--}}

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="password" value="" class="form-control" placeholder="Wachtwoord*">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="text" name="password_confirmation" value="" class="form-control" placeholder="Herhaal wachtwoord*">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    Door de wachtwoorden leeg te laten worden deze niet veranderd.
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-leftf">
                    <a href="{{ url()->previous() }}" class="btn btn-default">Terug</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
