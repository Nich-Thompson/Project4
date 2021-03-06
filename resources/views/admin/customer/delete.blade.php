@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Verwijder alle klanten</h1>

        <B>Weet je zeker dat je alle gearchiveerde klanten wilt verwijderen</B>?
        <br>
        (Bijbehorende locaties en inspecties van de klanten worden ook verwijdert)
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-2 text-left">
                <a href="{{ route('getCustomerArchives')}}" class="btn btn-default" title="Terug naar vorige pagina">Terug</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                <form action="{{ route('postDeleteArchive') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary" title="Alles verwijderen">Alles verwijderen</button>
                </form>
                {{--<a href="{{ route('postCustomerDelete', $id) }}" class="btn btn-primary">Archiveren</a>--}}
            </div>
        </div>
    </div>
@endsection
