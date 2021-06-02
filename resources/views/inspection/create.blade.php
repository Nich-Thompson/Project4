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
                        <p>Aangemaakt op: {{date("d-m-Y",strtotime($inspection->created_at))}}
                            door: {{$user->first_name}} {{$user->last_name}}</p>
                        <hr>

                        <div class="alert alert-danger" role="alert" id="offline">
                            De internet connectie is verloren, je werkt nu offline!
                        </div>

                        <form id="form" name="form" action="post" class="mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row" id='input-field-box'>

                                    </div>

                                    <div class="row">
                                        <div class="form-group ml-3">
                                            <input type="checkbox" id="approved" name="approved"
                                                   checked>
                                            <label for="approved">Goedgekeurd</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{URL::to('/inspection/exit/'.$inspection->id.'/'.$inspection->customer_id)}}"
                               class="btn btn-outline-secondary"
                               title="Uitchecken">Uitchecken</a>
                            <button type="submit" class="float-right btn btn-primary text-light">Invoeren
                            </button>
                        </form>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Positie</th>
                                @foreach($template->json as $input)
                                    @if($input->type == "select" && $input->isCommentsList != true)
                                        <th>{{$input -> label}}</th>
                                        @if(count($lists->{$input->list_id}->values) !== 0 && count($lists->{$input->list_id}->values[0]) > 1)
                                            @for($x =1; $x < count($lists->{$input->list_id}->values[0]); $x++)
                                                <th>{{$lists->{$input->list_id}->values[0][$x]->name}}</th>
                                            @endfor
                                        @endif
                                    @elseif($input->type != "select")
                                        <th>{{$input -> label}}</th>
                                    @endif
                                @endforeach
                                <th>Opmerkingen</th>
                                <th>Goedgekeurd</th>
                                <th></th>
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
    <script defer>
        window.myArray = @json([$inspection, $template->json, $lists])
    </script>

    <script src="{{ asset('js/inspection.js') }}"></script>
@endsection
