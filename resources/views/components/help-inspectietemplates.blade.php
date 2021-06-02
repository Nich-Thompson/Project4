<div class="ml-3 float-left">
    <a href="#" id="btn">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </a>
</div>

<script>
    $(function() {
        $('#btn').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'InspectieTemplates Handleiding',
                html: '<p>Bij de Templates overzicht wordt er templates weergeven van inspectieformulieren die gebruikt worden voor inspecties.</p> ' +
                    '<p>Door het "+ Toevoegen" knop, kan er een inspctieformulier template aangemaakt worden met diverse input velden.' +
                    ' Via het aanmaken van een inspectie template kan de type namen van lijsten toegevoegd worden via de "+Dynamische lijst" knop.</p>' +
                    '<p> Nadat een inspectieformulier template is aangemaakt, word het voor de inspecteur getoond als keuze om een inspectie uit te voeren op locatie voor een klant.<p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
