@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">INSPECTIE OP {{$location->name}}</h1>
                    <br><br>
                    <hr>
                    <h2>KIES EEN TEMPLATE</h2>
                    <div class="col-md-6">
                        @foreach($templates as $template)
                            <a href="{{URL::to('/inspection/'.$customer_id.'/'.$location->id.'/'.$template->id.'/create')}}" class="row w-75 h-10em vertical-center nounderline mb-3" style="background-color: {{$template->inspection_type()->color}}; border-color: {{$template->inspection_type()->color}}; color: #fff;"><h2 class="fw-bold"> <i class="fa fa-{{ $template->inspection_type()->icon()->name }}" style="font-size:32px;}}"></i>
                                    {{$template->inspection_type()->name}} ></h2></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
