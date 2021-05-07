@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1>Nieuw inspectietype aanmaken</h1>
                    <hr>

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
                    <form action="{{ route('postInspectionTypeCreate') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Naam van het insspectietype:</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value = "{{old('name')}}" placeholder="Naam type" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Beschrijving:</label>
                                <div class="form-group">
                                    <input type="text" name="description" class="form-control" value = "{{old('description')}}" placeholder="Beschrijving" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Kleur:</label>
                                <div class="form-group">
                                    <input type="color" name="color" class="form-control" value = "{{old('color')}}" required oninvalid="this.setCustomValidity('Dit veld mag niet leeg zijn.')" oninput="this.setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Icoon:</label>
                                <div class="form-group">
                                    <select name="icon_id" class="col-xs-12 col-sm-12 col-md-12 form-control">
                                        @foreach($icons as $icon)
                                            <option value="{{ $icon->id }}">
                                                {{--<i class="fa fa-{{ $icon->name }}" style="font-size:32px;"></i>--}}{{ ucfirst(preg_replace("/[\W]/", ' ',$icon->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <a href="{{URL::to('/inspectiontype')}}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-primary float-right">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
