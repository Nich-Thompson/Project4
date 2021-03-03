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
            
        </form>
    </div>
@endsection
