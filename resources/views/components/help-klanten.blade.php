<div class="ml-3 float-left">
    @if(Auth::user()->hasRole('admin'))
    <a href="#" id="btncustomer">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </a>
        @elseif(Auth::user()->hasRole('inspecteur'))
        <a href="#" id="btncustomerInspector">
            <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
        </a>
    @endif
</div>


<script>
    $(function() {
        $('#btncustomer').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Klanten Handleiding',
                html: '<p>Het aanmaken van de klanten wordt gedaan door op de toevoegen knop te drukken. Hierna kan de informatie van de klant ingevuld worden.</p>' +
                    '<p>Naast het aanmaken kunt u klanten ook bewerken en archiveren. Doe dit door op een klant te klikken in de lijst.</p>' +
                    '<p>Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief,' +
                    ' hier kunt u gearchiveerde klanten terughalen of alle gearchiveerde klanten definitief verwijderen',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'
            })
        })
    })

    $(function() {
        $('#btncustomerInspector').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Klanten Handleiding',
                html: '<p> U bevind zich nu in de klanten overzicht. Hier vind u klantnaam en telefoonnumer per klant. ' +
                    'Door gebruik te maken van de zoekfunctie kun u de klant opzoeken die door u geinspecteerd moet worden.</p>'+
                    '<p>Door middel van het selecteren van een klant, komt u op de klant detail pagina terecht met de locatieoverzicht. ' +
                    'Dat brengt u verder in het inspecterings process.</p> ',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'
            })
        })
    })
</script>
