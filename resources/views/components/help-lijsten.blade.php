<div class="ml-3 float-left">
    <button style="border:none" id="btn">
        <img src="{{URL::asset('/images/helpicon.png')}}" width='30' height='30' alt="HelpIcon">
    </button>
</div>

<script>
    $('#btn').click(function(e) {

        Swal.fire({
            icon: 'info',
            title: 'Lijsten Handleiding',
            text: '',
            showCloseButton: true,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ik begrijp het'

        })
    })
</script>
