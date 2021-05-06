@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">Nieuwe inspectie uitvoeren</span>
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


                    <form action="{{ route('postInspectionCreate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Naam</p>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Naam">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Aanmaker</p>
                                        <input type="text" class="form-control" id="creator" name="creator" placeholder="Aanmaker">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Pos.</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Merk</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Fabricatie jaar</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Etage</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">InspectieType-specifiek-veld</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">InspectieType-specifiek-veld</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Locatie</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Type</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                    <div class="form-group ml-3 col">
                                        <p class="mb-0">Debiet</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group col">
                                        <p class="mb-0">Opmerkingen</p>
                                        <input type="text" class="form-control" id="testData" name="testData" placeholder="testData">
                                    </div>
                                </div>

                                <div class="form-group ml-3">
                                    <label>Selecteer InspectieType</label>
                                    <select>
                                        @foreach($inspectionTypes as $inspectionType)
                                            <option class="form-select">{{$inspectionType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                            <a href="{{URL::to('/customer')}}" class="btn">Uitchecken</a>
                            <button type="submit" class="float-right btn btn-secondary text-light">Invoeren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
