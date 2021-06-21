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
                html: '<p>Bij het Templates overzicht worden de templates weergegeven van inspectieformulieren die gebruikt worden voor inspecties.</p> ' +
                    '<p>Door op de "+ Toevoegen" knop te klikken kunt u een inspectieformulier template aanmaken met diverse input velden.' +
                    ' Bij het aanmaken van een inspectietemplate kunt u een lijst toevoegen via de "+Dynamische lijst" knop. De inspecteur zal hiermee een waarde kunnen kiezen van de geselecteerde lijst.</p>' +
                    '<p>Nadat er een inspectieformulier template is aangemaakt wordt deze voor de inspecteur getoond als keuze om een inspectie uit te voeren.<p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
