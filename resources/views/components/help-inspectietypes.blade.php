
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
            title: 'InspectieTypes Handleiding',
            text: '<p>Bij de inspectieTypes overzicht word er de aangemaakt inspectietypes weergeven</p>,'+
                '<p>Bij het Toevoegen van een inspectietype, kun je de naam, beschrijving, kleur en icon vaan een inspectietype aanmaken</p>'+
                '<p>Door een inspectietype aan te passen, moet u het blauwe pijl klikken om bij de detail pagina te komen vaan een inspectietype,'+
                'hieruit kun je via het "Bewerken" button de inspectietype aanpassen',
            showCloseButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

        })
    })
</script>
