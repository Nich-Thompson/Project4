<a href="#" class="dropdown-item" id="btnInspector">
        help <img src="{{URL::asset('/images/helpicon.png')}}" width='10' height='10' alt="HelpIcon">
</a>


<script>
    $(function() {
        $('#btnInspector').click(function () {

            Swal.fire({
                width: '60%',
                icon: 'info',
                title: 'Inspecteur Handleiding',
                html: '<p>Als inspecteur is het de taak om bij het inspecteren van klanten een inspectie formulier in te vullen</p>' +
                    '<p>De inspecteur heeft daarom de mogelijkheid om klant gegevens te bekijken met de bijbehorende locatie en inspecties</p>' +
                    '<p>Voor het aanmaken van een inspectie, krijg je de keuze uit een inspectie template.' +
                    ' Uit de inspectie template kun je een inspectie formulier invullen door de vakken in te vullen met benodigde gegevens</p>' +
                    '<p>Elke keer wanneer u de gegevens invoert, drukt u op de knop invoeren waarbij de formulier aangevuld wordt.</p>' +
                    '<p>Nadat u klaar bent met het aanvullen van de formulier met benodigde gegevens, kunt u het afronden door "Uitchecken" te selecteren</p>' +
                    '<p>Zo word het inspectie formulier toegevoegt aan de inspecties overzicht van de geinspecteerde klant.</p>' +
                    '<p>Om een inspectie te kunnen aanpassen kunt u via het inspectie overzicht op het blauwe pijl een inspectie aanpassen,' +
                    'de gegevens die u kunt aanpassen is de inspecteur die de inspectie heeft uitgevoerd. Voor het geval dat er een nieuwe +' +
                    'inspecteur er verantwoordelijk voor is, in verband met niet actieve inspecteur.</p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
