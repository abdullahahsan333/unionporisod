<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('affidavit.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>উত্তরাধিকার সনদ যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.affidavit.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="summernote" name="all_data"><?php echo e((!empty($inheritData[0]->all_data) ? $inheritData[0]->all_data : "")); ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                            <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                            <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">

                            <?php if(!empty($inheritData)): ?>
                            <input type="hidden" name="id" value="<?php echo e($inheritData[0]->id); ?>" >
                            <?php endif; ?>

                            <?php ($affidavitNo = get_code($get_id+1,5)); ?>
                            <input type="hidden" name="affidavit_no" value="<?php echo e($affidavitNo); ?>" >
                            <input type="hidden" name="affidavit_type" value="inheritance_certificate" >

                            <div class="col-md-12">
                                <div class="form-group text-right mt-3">
                                    <button type="submit" class="btn submit_btn" name="save">সেইভ করুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-style'); ?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<style>
    .hr_style {
        display: block;
        width: 100%;
        border-top: 1px solid #0B499D !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('footer-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'উত্তরাধিকার সনদ যোগ করুন',
                tabsize: 2,
                height: 450
            });
        });
        // get Union English Name list
        function getAllData() {
            $('#summernote').empty();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.affidavit.all-data')); ?>",
                data: {id: 1, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                console.log(response);
                //$('#summernote').val(response);
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/affidavit/inheritance.blade.php ENDPATH**/ ?>