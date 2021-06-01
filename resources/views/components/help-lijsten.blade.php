<div class="ml-3 float-left">
    <button style="border:none" id="btn">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </button>
</div>

<script src="jquery-3.4.1.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script>
    $('#btn').click(function(e) {

        Swal.fire({
            icon: 'info',
            title: 'Inspecteur Handleiding',
            text: '<p>Als inspecteur is het jou de taak om bij het inspecteren van klanten een formulier in te vullen</p>,' +
                '<p>De inspecteur heeft daarom de mogelijkheid klant gegevens te bekijken en de bijbehorende locatie met inspecties inzien</p>' +
                '<p>Voor het aanmaken van een inspectie, krijg je de keuze uit een inspectie template</p>,'+
                '<p>uit de inspectie template kun je een inspectie formulier invullen door de vakken in te vullen met benodigde gegevens</p>'+
                '<p>Elke keer wanneer u de gegevens invoert, drukt u op de knop invoeren waarbij de formulier aangevuld wordt.</p>' +
                '<p>Nadat u klaar bent met het aanvullen van de formulier met benodigde gegevens, kunt u het afronden door via het "Uitchecken" knop te klikken</p>'+
                '<p>Zo word het inspectie formulier toegevoegt aan de inspecties overzicht van de geinspecteerde klant.</p>'+
                '<p>Om een inspectie te kunnen aanpassen kunt u via het inspectie overzicht op het blauwe pijl een inspectie aanpassen,'+
                'de gegevens die u kunt aanpassen is de inspecteur die de inspectie heeft uitgevoerd. Voor het geval dat er een nieuwe +' +
                'inspecteur er verantwoordelijk voor is, in verband met niet actieve inspecteur.</p>',
            showCloseButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

        })
    })
</script>
