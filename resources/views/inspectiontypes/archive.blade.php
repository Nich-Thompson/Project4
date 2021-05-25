@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Archiveer inspectietype</h1>

        Weet je zeker dat je dit type wilt archiveren?
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 text-left">
                <a href="{{ route('getInspectionTypeEdit', $id) }}" class="btn btn-default" title="Terug">Terug</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                <form action="{{ route('postInspectionTypeDelete', $id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary" title="Archiveren">Archiveren</button>
                </form>
            </div>
        </div>
    </div>
@endsection
