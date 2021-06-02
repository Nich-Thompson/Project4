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
                title: 'Lijsten Handleiding',
                html: '<p>Dit is de "{{ $list->name }}" lijst, ' +
                    '@if($headlist != null)' +
                    '                        het is de sublijst van: "{{ $headlist->name }}"</p>' +
                    '                    @else\n' +
                    '                        het word gezien als een hoofdlijst</p>\n' +
                    '                    @endif
                        <p>De menu-toets "Lijsten" word gebruikt om specifieke data te weergeven in de inspectie formulier om  aan te geven wat een klant gebruikt.' +
                    ' Het wordt dan bijvoorbeeld gebruikt om de merk "IP6" aan te geven bij een klant als merk voor brandblussers tijdens het uitvoeren van een inspectie</p>' +
                    '<p>Door de knop "+ Nieuwe lijst" te selecteren uit de "Lijsten" menu-toets, kunt u een nieuwe lijst aanmaken met naam. U ' +
                    'kunt ook aangeven of het de sublijst is van een bestaande lijst</p>' +
                    '<p>Wanneer de lijst is aangemaakt, komt het onder de "Lijsten" menu-toets terecht. Bij het selecteren van de ' +
                    'aangemaakte lijst wordt er een overzicht getoond van de lijst.</p>' + '' +
                    '<p> Vanuit de overzicht kunt u een typenaam aanmaken via het "+ Toevoegen" toets. ' +
                    'Voor bijvoorbeeld de lijst "Blus - Merken" kunt u via "+Toevoegen" merknaam "Ajax" aanmaken</p>',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
