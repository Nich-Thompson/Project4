@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Archiveer inspecteur</h1>

        Weet je zeker dat je de inspecteur wilt archiveren?
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 text-left">
                <a href="{{ route('getInspectorEdit', $id) }}" class="btn btn-default">Terug</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 text-left">
                <a href="{{ route('postInspectorDelete', $id) }}" class="btn btn-primary">Archiveren</a>
            </div>
        </div>
    </div>
@endsection
