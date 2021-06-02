
<div class="ml-3 float-left">
    <button style="border:none" id="btn">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </button>
</div>


<script>
    $(function() {
        $('#btn').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Klanten Handleiding',
                html: '<p>Het aanmaken van de klanten wordt gedaan door op de toevoegen knop te drukken. Hierna kan de informatie van de klant ingevuld worden.</p>,' +
                    '<p>Naast het aanmaken kun je klanten ook bewerken en verwijderen. Doe dit door op een klant te drukken in de lijst.</p>' +
                    '<p>Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief,' +
                    ' hier kun je verwijderde klanten terughalen of alle verwijderde klanten definitief verwijderen',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
