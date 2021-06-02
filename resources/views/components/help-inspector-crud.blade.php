
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
                html: '<p>Het aanmaken van de inspecteurs wordt gedaan door op de toevoegen knop te drukken. Hierna kunt u de informatie van de inspecteur invullen.</p>,' +
                    '<p>Naast het aanmaken kunt u inspecteurs ook bewerken en archiveren. Doe dit door op een inspecteur te klikken in de lijst.</p>' +
                    '<p>Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief,' +
                    ' hier kunt u gearchiveerde inspecteurs terughalen of alle gearchiveerde inspecteurs definitief verwijderen',
                showCloseButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

            })
        })
    })
</script>
