
<div class="ml-3 float-left">
    <a href="#" id="btncustomer">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </a>
</div>


<script>
    $(function() {
        $('#btncustomer').click(function () {

            Swal.fire({
                icon: 'info',
                title: 'Klanten Handleiding',
                html: '<p>Het aanmaken van de klanten wordt gedaan door op de toevoegen knop te drukken. Hierna kan de informatie van de klant ingevuld worden.</p>,' +
                    '<p>Naast het aanmaken kunt u klanten ook bewerken en archiveren. Doe dit door op een klant te klikken in de lijst.</p>' +
                    '<p>Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief,' +
                    ' hier kunt u gearchiveerde klanten terughalen of alle gearchiveerde klanten definitief verwijderen',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
