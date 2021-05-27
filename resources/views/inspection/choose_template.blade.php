@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Inspectie op: {{$location->name}}</h1>
                    <br><br>
                    <hr>
                    <h2>Kies een template</h2>

                    @forelse($templates as $template)
                        <div class="col-md-6">
                            <a href="{{URL::to('/inspection/'.$customer_id.'/'.$location->id.'/'.$template->id.'/create')}}"
                               class="row w-75 h-10em vertical-center nounderline mb-3 rounded"
                               style="border: 15px solid {{$template->inspection_type()->color}}; color: #000000;">
                                <h2 class="fw-bold"><i
                                        class="fa fa-{{ $template->inspection_type()->icon()->name }}"></i>
                                    {{$template->inspection_type()->name}} ></h2></a>
                        </div>
                    @empty
                        <p>Er zijn nog geen templates aangemaakt, neem contact op met een administrator.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
