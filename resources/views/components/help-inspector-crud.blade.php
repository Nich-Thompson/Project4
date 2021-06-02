
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
                title: 'Inspecteurs CRUD Handleiding',
                html: '<p>Het aanmaken van de inspecteurs wordt gedaan door op de toevoegen knop te drukken. Hierna kan de informatie van de inspecteur ingevuld worden.</p>,' +
                    '<p>Naast het aanmaken kun je inspecteurs ook bewerken en verwijderen. Doe dit door op een inspecteur te drukken in de lijst.</p>' +
                    '<p>Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief,' +
                    ' hier kun je verwijderde inspecteurs terughalen of alle verwijderde inspecteurs definitief verwijderen',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
