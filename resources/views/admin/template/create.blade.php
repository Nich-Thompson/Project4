@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="float-left h2">Nieuwe template aanmaken</h1>
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

                    <button class="btn btn-primary" id="addText" title="Voeg tekst input toe">+Tekst input</button>
                    <button class="btn btn-primary" id="addNumber" title="Voeg getal input toe">+Getal input</button>
                    <button class="btn btn-primary" id="addDateTime" title="Voeg datum input toe">+Datum input</button>
                    <button class="btn btn-primary" id="addCheckbox" title="Voeg checkbox toe">+Checkbox</button>
                    <button class="btn btn-primary" id="addList" title="Voeg lijst toe">+Dynamische Lijst</button>
                    <button class="btn btn-primary" id="addComments" title="Voeg lijst toe">+Opmerkingen lijst</button>

                    <form action="{{ route('postTemplateCreate') }}" method="post">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row" id="inputs">
                                    {{-- inputs are generated here --}}
                                </div>
                                <div id="hiddenInputs"></div>
                            </div>
                        </div>
                        <a href="{{URL::to('/template')}}" class="btn btn-default" title="Terug naar vorige pagina">Terug</a>
                        <button type="submit" class="float-right btn btn-primary text-light" title="Aanmaken">Aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    window.myArray= @json($lists)
</script>


<script src="{{ asset('js/createTemplate.js') }}"></script>
