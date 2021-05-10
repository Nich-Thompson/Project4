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

                        <form action="{{ route('postInspectionEditInspector', $inspection->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <p>Aangemaakt op: {{date("d-m-Y",strtotime($inspection->created_at))}} door {{$user->first_name." ".$user->last_name}}</p>
                                <select class="form-control w-25" name="inspector" id="inspector">
                                    @foreach($inspectors as $inspector)
                                        @if(old('inspector') && in_array($inspector->id,old('inspector')))
                                            <option value="{{$inspector->id}}" selected>{{$inspector->first_name." ".$inspector->last_name}}</option>
                                        @elseif($inspection->user()->id == $inspector->id)
                                            <option value="{{$inspector->id}}" selected>{{$inspector->first_name." ".$inspector->last_name}}</option>
                                        @else
                                            <option value="{{$inspector->id}}">{{$inspector->first_name." ".$inspector->last_name}}</option>
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
                                    <div class="row">
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Pos.</p>
                                            <input type="text" class="form-control" name="1" id="1"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Merk</p>
                                            <input type="text" class="form-control" name="2" id="2"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Fabricatie jaar</p>
                                            <input type="text" class="form-control" name="3" id="3"
                                                   placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Etage</p>
                                            <input type="text" class="form-control" name="4" id="4"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Blusstof</p>
                                            <input type="text" class="form-control" name="5" id="5"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Laatst afgeperst in</p>
                                            <input type="text" class="form-control" id="6" name="6"
                                                   placeholder="-">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Locatie</p>
                                            <input type="text" class="form-control" id="7" name="7"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Type</p>
                                            <input type="text" class="form-control" id="8" name="8"
                                                   placeholder="-">
                                        </div>
                                        <div class="form-group ml-3 col">
                                            <p class="mb-0">Debiet</p>
                                            <input type="text" class="form-control" id="9" name="9"
                                                   placeholder="(L/min)">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group col">
                                            <p class="mb-0">Opmerkingen</p>
                                            <input type="text" class="form-control" id="10" name="10"
                                                   placeholder="-">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group ml-3">
                                            <input type="checkbox" id="12" name="12"
                                                   checked>
                                            <label for="approved">Goedgekeurd</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{URL::to('/inspection/'.$inspection->customer_id.'')}}" class="btn">Uitchecken</a>
                            <button type="submit" class="float-right btn btn-primary text-light">Invoeren
                            </button>
                        </form>

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
    <script>
        let data = {!! json_encode($inspection, JSON_HEX_TAG) !!};
        document.getElementById("offline").style.display = "none";

        if (data.json === "") {
            localStorage.setItem("inspections", JSON.stringify([]));
            document.getElementById("1").value = 1;
        } else {
            localStorage.setItem("inspections", data.json);
            renderData();
        }


        function renderData() {
            if (localStorage.getItem("inspections") !== null && localStorage.getItem("inspections") !== "") {
                let inspections = JSON.parse(localStorage.getItem("inspections"));
                document.getElementById("1").value = inspections.length + 1;
                let div = document.getElementById("inspections");

                div.innerHTML = "";

                if (!(inspections instanceof Array))
                    inspections = [inspections];

                inspections.forEach(element => {
                    let tr = document.createElement("tr");
                    let position = document.createElement("td");
                    let brand = document.createElement("td");
                    let fabrication_year = document.createElement("td");
                    let floor = document.createElement("td");
                    let blusstof = document.createElement("td");
                    let lastchecked = document.createElement("td");
                    let location = document.createElement("td");
                    let type = document.createElement("td");
                    let debiet = document.createElement("td");
                    let comments = document.createElement("td");
                    let approved = document.createElement("td");

                    position.textContent = element.position;
                    brand.textContent = element.brand;
                    fabrication_year.textContent = element.fabrication_year;
                    floor.textContent = element.floor;
                    blusstof.textContent = element.blusstof;
                    lastchecked.textContent = element.lastchecked;
                    location.textContent = element.location;
                    type.textContent = element.type;
                    debiet.textContent = element.debiet;
                    comments.textContent = element.comments;

                    if (element.approved === true) {
                        approved.textContent = "Ja";
                        approved.className = "text-success font-weight-bold";
                    } else {
                        approved.textContent = "Nee";
                        approved.className = "text-danger font-weight-bold";
                    }

                    tr.append(position, brand, fabrication_year, floor, blusstof, lastchecked, location, type,
                        debiet, comments, approved);

                    div.appendChild(tr);
                })
            }
        }


        document.getElementById("form").addEventListener("submit", function (event) {
            event.preventDefault();

            let position = document.getElementById("1");
            let brand = document.getElementById("2");
            let fabrication_year = document.getElementById("3");
            let floor = document.getElementById("4");
            let blusstof = document.getElementById("5");
            let lastchecked = document.getElementById("6");
            let location = document.getElementById("7");
            let type = document.getElementById("8");
            let debiet = document.getElementById("9");
            let comments = document.getElementById("10");
            let approved = document.getElementById("12");

            let object = {
                "position": position.value,
                "brand": brand.value,
                "fabrication_year": fabrication_year.value,
                "floor": floor.value,
                "blusstof": blusstof.value,
                "lastchecked": lastchecked.value,
                "location": location.value,
                "type": type.value,
                "debiet": debiet.value,
                "comments": comments.value,
                "approved": approved.checked,
            };

            position.value = "";
            brand.value = "";
            fabrication_year.value = "";
            floor.value = "";
            blusstof.value = "";
            lastchecked.value = "";
            location.value = "";
            type.value = "";
            debiet.value = "";
            comments.value = "";
            approved.checked = true;

            saveNewObject(object);
            renderData();
        });

        function saveNewObject(object) {
            let storage = JSON.parse(localStorage.getItem("inspections"));

            if (!(storage instanceof Array))
                storage = [storage];
            storage.push(object);

            localStorage.setItem("inspections", JSON.stringify(storage));

            syncData();
        }

        function syncData() {
            fetch("/inspection/save/" + data.id, {
                method: "POST",
                "Content-type": "application/json",
                body: JSON.stringify({json: localStorage.getItem("inspections")})
            }).then(res => {
                console.log("Request complete! Data saved in database!");
            }).catch(err => console.log(err))
        }

        window.addEventListener('online', () => {
            document.getElementById("offline").style.display = "none";
            syncData();
        });
        window.addEventListener('offline', () => {
            document.getElementById("offline").style.display = "block";
        });
    </script>
@endsection
