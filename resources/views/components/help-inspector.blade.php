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
            text: '<p>Als inspecteur is het jou de taak om bij het inspecteren van klanten een formulier in te vullen</p>,'+
                '<p>De inspecteur heeft daarom de mogelijkheid klant gegevens te bekijken en de bijbehorende locatie</p>'+
                '<p>Bij het selecteren op,'+
                'hieruit kun je via het "Bewerken" button de inspectietype aanpassen',
            showCloseButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

        })
    })
</script>
