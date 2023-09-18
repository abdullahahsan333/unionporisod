<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}", "Success");
    @elseif(Session::has('update'))
        toastr.success("{{ Session::get('update') }}", "Update");
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}", "Warning");
    @elseif(Session::has('delete'))
        toastr.error("{{ Session::get('delete') }}", "Delete");
    @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}", "Delete");
    @endif

    // option
    toastr.options = {
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "newestOnTop": false,
        "closeButton": true,
        "progressBar": true,
        "onclick": null,
        "debug": false,
        "timeOut": "1000",
        "showDuration": "300",
        "showEasing": "swing",
        "hideDuration": "1000",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "extendedTimeOut": "1000",
    }
</script>
