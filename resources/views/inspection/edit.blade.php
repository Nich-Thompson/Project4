@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-body">
                        <h1 class="float-left h2">Inspectie aanpassen</h1>
                        <br>
                        <br>

                        <form
                            action="{{ route('postInspectionEditInspector', $inspection->id) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <p>Aangemaakt op: {{date("d-m-Y",strtotime($inspection->created_at))}}
                                    door: {{$user->first_name}} {{$user->last_name}}</p>
                                <select class="form-select w-25" name="inspector" id="inspector">
                                    @foreach($inspectors as $inspector)
                                        @if(old('inspector') && in_array($inspector->id,old('inspector')))
                                            <option value="{{$inspector->id}}"
                                                    selected>{{$inspector->first_name}} {{$inspector->last_name}}</option>
                                        @elseif($inspection->user()->id == $inspector->id)
                                            <option value="{{$inspector->id}}"
                                                    selected>{{$inspector->first_name}} {{$inspector->last_name}}</option>
                                        @else
                                            <option
                                                value="{{$inspector->id}}">{{$inspector->first_name}} {{$inspector->last_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <p class="text-danger">@error('inspector') {{$message}}@enderror</p>
                            </div>
                            <button type="submit" class="btn btn-primary text-light">Inspecteur aanpassen</button>
                        </form>
                        <hr>

                        <div class="alert alert-danger" role="alert" id="offline">
                            De internet connectie is verloren, je werkt nu offline!
                        </div>

                        <form id="form" name="form" action="post" class="mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row" id='input-field-box'>

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
                        <div class="vh-40 overflow-scroll">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Positie</th>
                                    @foreach($template->json as $input)
                                        @if($input->type == "select" && $input->isCommentsList != true)
                                            <th>{{$input -> label}}</th>
                                            @if(count($lists->{$input->list_id}->values) != 0 && count($lists->{$input->list_id}->values[0]) > 1)
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
    </div>
    <script defer>
        window.myArray = @json([$inspection, $template->json, $lists])
    </script>

    <script src="{{ asset('js/inspection.js') }}"></script>
@endsection
