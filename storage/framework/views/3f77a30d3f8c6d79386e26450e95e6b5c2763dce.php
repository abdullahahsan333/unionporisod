<?php $__env->startSection('content'); ?>
<!-- body container start -->
<div class="body_container">

    <!-- body content start -->
    <div class="body_content">
        <div class="panel_container">
            <div class="panel_heading">
                <h4>General Settings</h4>
            </div>
            <div class="panel_body">
                <form action="<?php echo e(route('admin.settings.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Site Name <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[site_name]" value="<?php echo e((!empty($site_name) ? $site_name : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Mobile <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[mobile]" value="<?php echo e((!empty($mobile) ? $mobile : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Email <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[email]" value="<?php echo e((!empty($email) ? $email : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Youtube <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[youtube]" value="<?php echo e((!empty($youtube) ? $youtube : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Facebook <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[facebook]" value="<?php echo e((!empty($facebook) ? $facebook : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Twitter <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[twitter]" value="<?php echo e((!empty($twitter) ? $twitter : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>Address <span class="text-danger"></span></label>
                            <div class="form-group">
                                <textarea name="setting[address]" class="form-control"><?php echo e((!empty($address) ? $address : '')); ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Logo <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="file" name="logo" class="form-control">
                                <?php if(!empty($logo)): ?>
                                    <img src="<?php echo e(asset($logo)); ?>" style="height: 80px; width: auto; max-width: 200px;" class="mt-1" alt="">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Favicon <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="file" name="favicon" class="form-control">
                                <?php if(!empty($favicon)): ?>
                                    <img src="<?php echo e(asset($favicon)); ?>" style="height: 80px; width: auto; max-width: 200px;" class="mt-1" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label>Copy Right <span class="text-danger"></span></label>
                            <div class="form-group">
                                <input type="text" name="setting[copy_right]" value="<?php echo e((!empty($copy_right) ? $copy_right : '')); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn submit_btn" name="save">Save</button>
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

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/settings/index.blade.php ENDPATH**/ ?>