@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">Nieuwe {{ $list -> name }} maken</span>
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
                                <?php$count = 0?>
                                @while(count($sublists) > 0)
                                    <?php$count += 1?>
                                    <div class="form-group">
                                        <label for="sublist"> {{$sublists[count($sublists)-1]['name']}} </label>
                                        <select  class="form-control" name="sublist" id="sublist">
                                            @foreach($sublistvalues[count($sublistvalues)-1] as $value)
                                                @if(old('sublist_value_') == $value['name'])
                                                    <option value="{{$value['name']}}" selected>{{$value['name']}}</option>
                                                @else
                                                    <option value="{{$value['name']}}">{{$value['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="text-danger">@error('sublist') {{$message}}@enderror</p>
                                    </div>
                                    <?php
                                        array_splice($sublists, count($sublists)-1, 1);
                                        array_splice($sublistvalues, count($sublistvalues)-1, 1);
                                    ?>
                                @endwhile
                            </div>
                            <div class="form-group">
                                <label class="ml-1">Typenaam*</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value = "{{old('name')}}" placeholder="Vul type naam in">
                            </div>
                        </div>
                        <p class="mt-3">Velden met een ster (*) zijn verplicht</p>
                        <a href="{{URL::to('/list/'.$list -> id.'/edit')}}" class="btn btn-default">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
