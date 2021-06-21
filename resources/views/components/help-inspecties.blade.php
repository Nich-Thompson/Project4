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
                title: 'Inspectie Handleiding',
                html: '<p>Dit is de Inspecties overzicht, hierin kunt u zien welke inspecties al gedaan zijn.</p>' +
                    '<p>Als de inspectie nog niet afgerond ziet, komt er met rode letters een melding bij de inspectie te staan dat het nog niet uitgecheckt is ' +
                    'Dat laat zien door wie het nog niet uitgecheckt is en dat het nog uitgechekt moet worden.</p>'+
                    '<p>Wanneer u een inspectie selecteert, komt u bij inspectieformulier terecht. Daarin kunt u de inspectieformulier verder uitwerken.</p>' +
                    '<p> Bij een bestaande inspectie kunt u nog de inspecteur aanpassen van een inspectie formulier om een andere inspecteur verantwoordelijk te maken.</p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'
            })
        })
    })
</script>
