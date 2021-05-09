@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">{{ $list -> name }} aanpassen</span>
                    <button id="switchButton" onclick="enableInput()" class="btn btn-primary float-right ml-2">
                        Bewerken
                    </button>
                    <a href="#" id="archiveButton"
                       class="btn btn-primary float-right" hidden>Archiveren</a>
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
                    <form action="{{ route('postListValueEdit', [
                                            'id' => $listValue->id,
                                            'list_id' => $list -> id
                                        ]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                @if(!empty($sublists))
                                    <div class="form-group">
                                        <label for="sublist_value"> {{$sublists[0]['name']}} </label>
                                        <select  class="form-control" name="sublist_value" id="sublist_value" disabled>
                                            @foreach($sublistvalues[0] as $value)
                                                @if(old('sublist_value') != null)
                                                    <option value="{{$value['id']}}" {{old('sublist_value') == $value['name'] ? 'selected' : ''}}>{{$value['name']}}</option>
                                                @else
                                                    <option value="{{$value['id']}}" {{$listValue -> list_value_id == $value['id'] ? 'selected' : ''}}>{{$value['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="text-danger">@error('sublist_value') {{$message}}@enderror</p>
                                    </div>
                                @endif
                            </div>
                            <div id = "values-box">

                            </div>
                            <div class="form-group">
                                <label class="ml-1">Typenaam*</label>
                                <input type="text" name="name" placeholder="Vul type naam in"
                                       class="form-control @error('name') is-invalid @enderror" disabled
                                       @if(old('name') != null)
                                       value="{{ old('name') }}"
                                       @else
                                       value="{{ $listValue->name }}"
                                    @endif>
                            </div>
                        </div>
                        <p class="mt-3">Velden met een ster (*) zijn verplicht</p>
                        <a href="{{URL::to('/list/'.$list -> id.'/edit')}}" class="btn btn-default">Terug</a>
                        <button type="submit" id="saveButton" class="float-right btn btn-primary text-light">Aanpassen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script> window.count = '<?php echo  json_encode([$sublists, $sublistvalues]); ?>'; </script>
<script src="{{ asset('js/showListValues.js') }}"></script>

<script src="{{ asset('js/switchEditView.js') }}"></script>
