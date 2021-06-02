<a href="#" class="dropdown-item" id="btnInspector">
        help <img src="{{URL::asset('/images/helpicon.png')}}" width='15' height='15' alt="HelpIcon">
</a>


<script>
    $(function() {
        $('#btnInspector').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Inspecteur Handleiding',
                html: '<p>Als inspecteur is het uw taak om bij het inspecteren van klanten een inspectie formulier in te vullen.</p>' +
                    '<p>U heeft daarom de mogelijkheid om klantgegevens te bekijken met de bijbehorende locatie en inspecties.</p>' +
                    '<p>Voor het aanmaken van een inspectie krijgt u de keuze uit meerdere inspectietemplates.' +
                    ' Via het inspectietemplate kunt u een inspectieformulier invullen door de vakken in te vullen met de juiste gegevens.</p>' +
                    '<p>Elke keer wanneer u de gegevens invoert, kunt u op de knop "Invoeren" drukken om het formulier aan te vullen.</p>' +
                    '<p>Nadat u klaar bent met het aanvullen van de formulier met de benodigde gegevens kunt u het afronden door op "Uitchecken" te klikken.</p>' +
                    '<p>Zo wordt het inspectie formulier toegevoegd aan het inspecties overzicht van de geïnspecteerde klant.</p>' +
                    '<p>Om een inspectie aan te kunnen passen kunt u via het inspectie overzicht op de blauwe pijl een inspectie aanpassen, ' +
                    'u kunt hier de inspecteur die de inspectie heeft uitgevoerd aanpassen voor in het geval dat er een nieuwe ' +
                    'inspecteur verantwoordelijk voor is.</p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
