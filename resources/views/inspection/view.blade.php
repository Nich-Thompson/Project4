@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-body">
                        <h1 class="float-left h2">Inspectie uitvoeren</h1>
                        <br>
                        <br>
                        <p>Aangemaakt op: {{date("d-m-Y",strtotime($inspection->created_at))}} door {{$username}}</p>
                        <hr>

                        <div class="alert alert-info" role="alert">
                            Op dit moment is {{$locked_username}} bezig met deze inspectie, je kan dus alleen bekijken
                        </div>

                        <a href="{{URL::to('/inspection/'.$inspection->customer_id)}}"
                           class="btn btn-outline-secondary"
                           title="Terug naar inspecties">Terug</a>
                        <br/>
                        <br/>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Positie</th>
                                <th>Merk</th>
                                <th>Fabricatie jaar</th>
                                <th>Etage</th>
                                <th>Blusstof</th>
                                <th>Laatst afgeperst</th>
                                <th>Locatie</th>
                                <th>Type</th>
                                <th>Debiet</th>
                                <th>Opmerkingen</th>
                                <th>Goedgekeurd</th>
                            </tr>
                            </thead>
                            <tbody id="inspections">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
