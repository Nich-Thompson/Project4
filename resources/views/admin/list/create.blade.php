@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe lijst maken</h1>
                    <p class="mb-5"></p>
                    <hr/>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Er waren wat problemen met uw data</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('postListCreate') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label class="ml-1">Lijstnaam*</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{old('name')}}" placeholder="Vul de lijstnaam in">
                                </div>
                                <div class="form-group ml-3">
                                    <label class="ml-1">Sublijst van</label>
                                    <select name="list_model_id" class="col-xs-12 col-sm-12 col-md-12 form-control"
                                            title="Sublijst van">
                                        <option value="">
                                            Geen
                                        </option>
                                        @foreach($lists as $list)
                                            <option value="{{ $list->id }}">
                                                {{ $list->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                        <br>
                        <a href="{{URL::to('/list')}}" class="btn btn-default"
                           title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
