@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe locatie aanmaken</h1>
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
                    <form action="{{ route('postLocationCreate', $customer_id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label>Locatie naam*</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="vul naam in" value="{{old('name')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label>Straat naam</label>
                                    <input type="text" class="form-control" id="street" name="street"
                                           placeholder="Vul straatnaam in" value="{{old('street')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label>Postcode</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                           placeholder="1234AA" value="{{old('postal_code')}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ml-3">
                                    <label>Plaatsnaam</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="Vul plaatsnaam in" value="{{old('city')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label>Huisnummer</label>
                                    <input type="number" class="form-control" id="number" name="number"
                                           placeholder="Vul huisnummer in" value="{{old('number')}}">
                                </div>
                                <div class="form-group ml-3">
                                    <label>Gebouwnummer</label>
                                    <input type="text" class="form-control" id="building_number" name="building_number"
                                           placeholder="Vul gebouwnummer in" value="{{old('building_number')}}">
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3 mt-3">Velden met een ster (*) zijn verplicht</p>
                        <br>
                        <a href="{{URL::to('/customer/'.$customer_id.'/edit')}}" class="btn"
                           title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
