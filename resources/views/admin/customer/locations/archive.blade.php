@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Archiveer locatie</h1>

        Weet je zeker dat je de locatie '{{$location->name}}' wilt archiveren?
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-2 text-left">
                <a href="{{ route('getLocationEdit', [$customer_id, $location->id]) }}" class="btn btn-default"
                   title="Terug naar vorige pagina">Terug</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                <form action="{{ route('postLocationArchive', [$customer_id, $location->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Archiveren</button>
                </form>
                {{--<a href="{{ route('postCustomerDelete', $id) }}" class="btn btn-primary">Archiveren</a>--}}
            </div>
        </div>
    </div>
@endsection
