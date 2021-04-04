@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">Nieuwe locatie aanmaken</span>
                    <br><br>
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


                    <form action="{{ route('postLocationCreate', $id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Naam*" value="{{old('name')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Straatnaam*" value="{{old('street')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="1234AA*" value="{{old('postal_code')}}">
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Plaatsnaam*" value="{{old('city')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Huisnummer*" value="{{old('number')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="building_number" name="building_number" placeholder="Gebouwnummer" value="{{old('building_number')}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                        <br>
                            <a href="{{URL::to('/customer')}}" class="btn">Terug</a>
                            <button type="submit" class="float-right btn btn-secondary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
