@if (Session::has('success'))
<script>
    swal({
        text: "{{ Session::get('success') }}",
        icon: 'success',
        timer: 3000,
        button: false,
    });
</script>
@endif

@if (Session::has('delete'))
<script>
    swal({
        text: "{{ Session::get('delete') }}",
        icon: 'error',
        timer: 3000,
        button: false,
    });
</script>
@endif