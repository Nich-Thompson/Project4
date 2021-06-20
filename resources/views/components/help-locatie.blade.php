<div class="ml-3 float-left">
    @if(Auth::user()->hasRole('inspecteur'))
        <a href="#" id="btnlocation">
            <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
        </a>
    @endif
</div>

<script>
    $(function() {
        $('#btnlocation').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Locatie Handleiding',
                html: '<p>Op het locatie overzicht krijgt u de locatie gegevens te zien met hun adresgegevens.</p>' +
                    '<p>Als de klant nog geen locatie heeft, krijgt u de optie om een locatie toe te voegen via de "+ Toevoegen" knop. ' +
                    'Dat zorgt ervoor dat de inspectiegegevens bij de betreffende locatie opgeslagen staan.</p>'+
                    '<p> Via de "ga naar inspecties" knop, komt u bij de lijst terecht van inspectieformulieren die is uitgevoerd van de geselecteerde locatie.' +
                    'Bij het maken van een nieuwe inspectie word de "+ Maak inspectie aan"</p>' +
                    '<p> Via het bekijken knop kunt u de locatie gegevens zien en heeft u ook de mogelijkheid het aan te passen, als de locatie gegevens toch niet kloppen</p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'
            })
        })
    })
</script>
