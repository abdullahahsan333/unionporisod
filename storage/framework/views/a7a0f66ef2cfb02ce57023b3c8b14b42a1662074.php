<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        <?php echo $__env->make('chairman.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>চেয়ারম্যান ও সচিব যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.chairman.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                </div>
                            </div>

                            <?php if($userInfo->privilege != 'user'): ?>
                            
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" >
                                        <option value="" selected> জেলা নির্বাচন করুন</option>
                                        <option value="39">সুনামগঞ্জ</option>
                                        <option value="45">কিশোরগঞ্জ</option>
                                        <option value="62">ময়মনসিংহ</option>
                                        <option value="64">নেত্রকোণা</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" >
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" >
                                        <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <?php else: ?>
                                <div class="col-md-6"></div>
                                <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                            
                            <?php endif; ?>
                            
                            <div class="col-md-6">
                                <label>চেয়ারম্যানের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="chairman" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>চেয়ারম্যানের ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="chairman_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>সচিবের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="minister" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>সচিবের ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="minister_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group text-right">
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
<style>
    .hr_style {
        display: block;
        width: 100%;
        border-top: 1px solid #0B499D !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script>
        $('#divisionId').selectpicker();
        
        // get distric list
        function getDistrictFn() {
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.district-list')); ?>",
                data: {id: _divisionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }
        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: {id: _districtId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }
        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: {id: _upazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/chairman/create.blade.php ENDPATH**/ ?>