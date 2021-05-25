@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Verwijder alle locaties</h1>

        <B>Weet je zeker dat je alle gearchiveerde locaties wilt verwijderen</B>?
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12 col-md-2 text-left">
                <a href="{{ route('getCustomerEdit', $customer_id)}}" class="btn btn-default"
                   title="Terug naar vorige pagina">Terug</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                <form action="{{ route('postDeleteArchiveLocation', $customer_id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Alles verwijderen</button>
                </form>
                {{--<a href="{{ route('postCustomerDelete', $id) }}" class="btn btn-primary">Archiveren</a>--}}
            </div>
        </div>
    </div>
@endsection
