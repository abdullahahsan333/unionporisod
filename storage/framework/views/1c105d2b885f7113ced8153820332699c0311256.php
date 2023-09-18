<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container">
    <?php echo $__env->make('user.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>নতুন ইউজার তৈরি করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.user.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="user_profile">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="profile_info">
                                        <div class="header_info">
                                            <span class="profile_img">
                                                <img class="file-upload-image" src="<?php echo e(asset('public/backend')); ?>/images/user/01.png" alt="">
                                                <span class="cover">
                                                    <i class="fas fa-images"></i>
                                                </span>
                                                <input class="file-upload-input" type="file" name="avatar" accept="image/*">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="password_form">
                                        <h4>আপনার তথ্য</h4>
                                        <form action="#" method="POST">
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right required col-md-3">
                                                    নাম
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" name="name" placeholder="আপনার নাম" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3">মোবাইল</label>
                                                <div class="col-md-9">
                                                    <input type="tel" name="mobile" placeholder="আপনার মোবাইল" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3">ইমেইল</label>
                                                <div class="col-md-9">
                                                    <input type="email" name="email" placeholder="আপনার ইমেইল" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3">ঠিকানা</label>
                                                <div class="col-md-9">
                                                    <textarea name="address" class="form-control" placeholder="আপনার ঠিকানা"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3"> জেলা <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                                        <option value="" selected> জেলা নির্বাচন করুন </option>
                                                        <option value="39">সুনামগঞ্জ</option>
                                                        <option value="45">কিশোরগঞ্জ</option>
                                                        <option value="62">ময়মনসিংহ</option>
                                                        <option value="64">নেত্রকোণা</option>
                                                    </select>
                                                </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3"> উপজেলা <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                                        <option value="" selected> উপজেলা নির্বাচন করুন </option>
                                                    </select>
                                                </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3">ইউনিয়ন <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                                        <option value="" selected> ইউনিয়ন নির্বাচন করুন </option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right required col-md-3 ">ইউজারনেম</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="username" placeholder="In English lower Case & No Space" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right required col-md-3">পাসওয়ার্ড</label>
                                                <div class="col-md-9">
                                                    <input type="password" name="password" placeholder="********" autocomplete="off" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right required col-md-3">পুনরায় পাসওয়ার্ড দিন</label>
                                                <div class="col-md-9">
                                                    <input type="password" name="password_confirmation" placeholder="********" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right col-md-3">ব্যবহারকারী</label>
                                                <div class="col-md-9">
                                                    <select name="user_type" class="form-control">
                                                        <option value="" selected>ব্যবহারকারী নির্বাচন করুন</option>
                                                        <option value="চেয়ারম্যান">চেয়ারম্যান</option>
                                                        <option value="সচিব">সচিব</option>
                                                        <option value="উদ্দোক্তা">উদ্দোক্তা</option>
                                                        <option value="আমার ইউপি">আমার ইউপি</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-form-label text-md-right required col-md-3">প্রিভিলেজ</label>
                                                <div class="col-md-9">
                                                    <select name="privilege" class="form-control" required>
                                                        <option value="" selected>প্রিভিলেজ নির্বাচন করুন</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn submit_btn">সেইভ</button>
                                                    <button type="reset" class="btn reset_btn">রিসেট করুন</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
<?php $__env->startPush('header-style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/style/profile.css">
    <style>
        .user_profile .header_info {
            justify-content: center;
        }

        .user_profile .profile_img {
            max-width: 185px;
            width: 100%;
            height: 185px;
            margin-right: 0px;
        }

        .user_profile h4 {
            border-bottom: 1px solid #303F9F85;
            padding-bottom: 10px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script>
        /* image upload script start */
        function cl(x){
            return document.getElementsByClassName(x);
        }
        
        /* image upload script start */
        var file_upload_input  = document.getElementsByClassName('file-upload-input'),
        file_upload_inputL = file_upload_input.length,
        i = 0;

        for(i; i<file_upload_inputL; i++){
            file_upload_input[i].setAttribute('onchange', "set_for_upload("+i+",this)");
        }
        
        function set_for_upload(index,e){
            var file = URL.createObjectURL(e.files[0]);
            cl('file-upload-image')[index].src = file;
        }
        
        $('#divisionId').selectpicker();
        $('#districtId').selectpicker();

        // get distric list
        function getDistrictFn (){
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.district-list')); ?>",
                data: { id: _divisionId, _token: "<?php echo e(csrf_token()); ?>" }
            }).then(function(response){
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }
        
        // get Upazila list
        function getUpazilaFn (){
            $('#upazilaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: { id: _districtId, _token: "<?php echo e(csrf_token()); ?>" }
            }).then(function(response){
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUnionFn (){
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: { id: _upazilaId, _token: "<?php echo e(csrf_token()); ?>" }
            }).then(function(response){
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/user/create.blade.php ENDPATH**/ ?>