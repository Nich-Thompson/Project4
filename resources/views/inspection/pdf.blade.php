<!DOCTYPE html>
<html >
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{public_path('css/pdf.css')}}">
    <title>Onderhoudsrapport</title>
</head>
<style>
    .headerWrapper {
        background-color: {{$inspection_type->color}};
        border-radius: 10px 75px 68px 10px;
    }
</style>
<body>
<div class="headerWrapper">
    <div class="row">
        <div class="header">
            <div class="col">
                <h1>Onderhoudsrapport</h1>
            </div>
            <div class="col">
                <h2>Rapportage controle {{$inspection_type->name}}</h2>
            </div>
        </div>
        <div class="col">
            <a class="round"alt="type">{!! $icon->unicode !!}</a>
        </div>
    </div>
</div>
<div class="row m-10">
    <div class="Logos">
        <p>In opdracht van:</p>
        {{$customer->name}}

    </div>
    <div class="CompanyInfo">
        <h3>{{$customer->name}}</h3>
        <br>

        <br>
        <p>Uitvoerdatum:            {{$inspection->created_at}}</p>
        <p>Uitgevoerd door:         {{$user->first_name}} {{$user->last_name}}</p>
        <p>Aantal gecontroleerd:    {{count(array($lists))}}</p>
        <p>Aantal afgekeurd:        {{count(array($lists))}}</p>
    </div>
    <hr class="mt-20">
    <span></span>
    <div class="next-page">

        <table class="table">
            <thead>
            <tr>
                <th>Positie</th>
                @foreach($template->json as $input)
                    @if($input->type == "select" && $input->isCommentsList != true)
                        @if(count($lists->{$input->list_id}->values) !== 0)
                            @for($x = 0; $x < count($lists->{$input->list_id}->values[0]); $x++)
                                <th>{{$lists->{$input->list_id}->values[0][$x]->name}}</th>
                            @endfor
                        @endif
                    @elseif($input->type != "select")
                        <th>{{$input -> label}}</th>
                    @endif
                @endforeach
                <th>Opmerkingen</th>
                <th>Goedgekeurd</th>
            </tr>
            </thead>
            <tbody id="inspections">

            </tbody>
        </table>
    </div>
</div>
<script>
    window.myArray = @json([$inspection])
</script>

<script src="{{ asset('js/view-inspection.js') }}"></script>
</body>
</html>
