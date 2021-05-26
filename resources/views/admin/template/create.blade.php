@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe template aanmaken</h1>
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


                    <form action="{{ route('postTemplateCreate') }}" method="post">
                        @csrf
                        <div class="row">

                        </div>
                        <a href="{{URL::to('/template')}}" class="btn btn-default" title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light" title="Aanmaken">Aanmaken
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
