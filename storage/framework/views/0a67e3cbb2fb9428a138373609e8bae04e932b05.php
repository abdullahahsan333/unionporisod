<script>
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(Session::get('success')); ?>", "Success");
    <?php elseif(Session::has('update')): ?>
        toastr.success("<?php echo e(Session::get('update')); ?>", "Update");
    <?php elseif(Session::has('warning')): ?>
        toastr.warning("<?php echo e(Session::get('warning')); ?>", "Warning");
    <?php elseif(Session::has('delete')): ?>
        toastr.error("<?php echo e(Session::get('delete')); ?>", "Delete");
    <?php elseif(Session::has('error')): ?>
        toastr.error("<?php echo e(Session::get('error')); ?>", "Delete");
    <?php endif; ?>

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
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/components/toastr.blade.php ENDPATH**/ ?>