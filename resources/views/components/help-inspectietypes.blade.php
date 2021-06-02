
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
                title: 'InspectieTypes Handleiding',
                html: '<p>Bij het inspectietypes overzicht worden de aangemaakt inspectietypes weergegeven.</p>,' +
                    '<p>Bij het Toevoegen van een inspectietype kunt u de naam, beschrijving, kleur en icoon van een inspectietype instellen.</p>' +
                    '<p>Om een inspectietype aan te passen kunt u op de blauwe pijl klikken om bij de detail pagina te komen van een inspectietype,' +
                    'hieruit kunt u via de "Bewerken" knop het inspectietype aanpassen.',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
