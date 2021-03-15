@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <span class="float-left h2">Nieuwe klant aanmaken</span>
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


                    <form action="{{ route('postCustomerCreate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Naam*">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Straatnaam">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="1234AA">
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="Telefoonnummer">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Huisnummer">
                                </div>
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Plaatsnaam">
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="ml-3">Contactpersoon</p>
                        <div class="row">
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contactpersoon naam">
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="form-group ml-3">
                                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contactpersoon e-mail">
                                </div>
                            </div>
                        </div>
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
