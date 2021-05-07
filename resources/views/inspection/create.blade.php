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

                        <form id="form" name="form">
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
                                        {{--                                        <div class="form-group ml-3">--}}
                                        {{--                                            <label>Selecteer Inspectietype</label>--}}
                                        {{--                                            <br>--}}
                                        {{--                                            <select id="11" name="11">--}}
                                        {{--                                                @foreach($inspection_types as $inspection_type)--}}
                                        {{--                                                    <option class="form-select">{{$inspection_type->name}}</option>--}}
                                        {{--                                                @endforeach--}}
                                        {{--                                            </select>--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group ml-3">
                                            <input type="checkbox" id="12" name="12"
                                                   checked>
                                            <label for="approved">Goedgekeurd</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{URL::to('/inspection')}}" class="btn">Uitchecken</a>
                            <button type="submit" class="float-right btn btn-primary text-light">Invoeren
                            </button>
                        </form>

                        <div id="inspections">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let data = {!! json_encode($inspection, JSON_HEX_TAG) !!};

        if (data.json === "") {
            localStorage.setItem("inspections", JSON.stringify([]));
        } else {
            localStorage.setItem("inspections", data.json);
            renderData();
        }


        function renderData() {
            if (localStorage.getItem("inspections") !== null && localStorage.getItem("inspections") !== "") {
                let inspections = JSON.parse(localStorage.getItem("inspections"));
                let div = document.getElementById("inspections");

                div.innerHTML = "";

                if (!(inspections instanceof Array))
                    inspections = [inspections];

                inspections.forEach(element => {
                    let p = document.createElement("p");
                    p.textContent = "Positie: " + element.position + " merk: " + element.brand + " fabricagejaar: " + element.fabrication_year +
                        " opmerkingen: " + element.comments;

                    div.appendChild(p);
                })
            }
        }


        document.getElementById("form").addEventListener("submit", function (event) {
            event.preventDefault();

            let position = document.getElementById("1").value;
            let brand = document.getElementById("2").value;
            let fabrication_year = document.getElementById("3").value;
            let floor = document.getElementById("4").value;
            let blusstof = document.getElementById("5").value;
            let lastchecked = document.getElementById("6").value;
            let location = document.getElementById("7").value;
            let type = document.getElementById("8").value;
            let debiet = document.getElementById("9").value;
            let comments = document.getElementById("10").value;
            let approved = document.getElementById("12").checked;

            let object = {
                "position": position,
                "brand": brand,
                "fabrication_year": fabrication_year,
                "floor": floor,
                "blusstof": blusstof,
                "lastchecked": lastchecked,
                "location": location,
                "type": type,
                "debiet": debiet,
                "comments": comments,
                "approved": approved,
            };

            console.log(object);

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
            document.getElementById("internet").textContent = "Online";
            document.getElementById("internet").classList.remove('offline');
            syncData();
        });
        window.addEventListener('offline', () => {
            document.getElementById("internet").textContent = "Offline";
            document.getElementById("internet").classList.add('offline');
        });
    </script>
@endsection
