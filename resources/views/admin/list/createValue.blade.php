@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe {{ $list -> name }} maken</h1>
                    <p class="mb-5"></p>
                    <hr/>
                    @if ($errors->any())
                        <div class="alert alert-danger" id="errors">
                            <strong>Er waren wat problemen met uw data</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('postListValueCreate', $list  -> id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                @if(!empty($sublists))
                                    <div class="form-group">
                                        <label for="sublist_value"> {{$sublists[0]['name']}} </label>
                                        <select  class="form-select" name="sublist_value" id="sublist_value">
                                            @foreach($sublistvalues[0] as $value)
                                                @if(old('sublist_value') == $value['name'])
                                                    <option value="{{$value['id']}}"
                                                            selected>{{$value['name']}}</option>
                                                @else
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="text-danger">@error('sublist_value') {{$message}}@enderror</p>
                                    </div>
                                @endif
                            </div>
                            <div id="values-box">

                            </div>
                            <div class="form-group">
                                <label class="ml-1">Typenaam*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}" placeholder="Vul type naam in">
                            </div>
                        </div>
                        <p class="mt-3">Velden met een ster (*) zijn verplicht</p>
                        <a href="{{URL::to('/list/'.$list -> id.'/edit')}}" class="btn btn-default"
                           title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script> window.count = '<?php echo json_encode([$sublists, $sublistvalues]); ?>'; </script>
<script src="{{ asset('js/showListValues.js') }}"></script>

