<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="marriedCertificateController" ng-cloak>
        <?php echo $__env->make('affidavit.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বিবাহিত সনদপত্র যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.affidavit.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>প্রত্যয়ন পত্র নং</label>
                                    <?php ($affidavitNo = get_code($get_id+1,5)); ?>
                                    <input inputmode="numeric" pattern="[0-9]*" type="text" name="affidavit_no" value="<?php echo e($affidavitNo); ?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>বিবাহ অনুষ্ঠিত হওয়ার তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="marriage_date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বরের বিবরণ (বাংলায়)</legend>

                                    <div class="form-group">
                                        <label>নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="member_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পিতা নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>মাতার নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>জাতীয় পরিচয়পত্র নম্বর <span class="text-danger">&nbsp;</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="nidNo" id="nidNo" name="nid_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>জন্ম তারিখ <span class="text-danger">*</span></label>
                                        <input type="text" name="dob" ng-model="dob" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                    </div>

                                <?php if($userInfo->privilege != 'user'): ?>
                                    <div class="form-group" >
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="district_id" id="districtId" onchange="getUpazilaFn(); getPourashavaFn(); getDistrictEnName();" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39">সুনামগঞ্জ</option>
                                            <option value="45">কিশোরগঞ্জ</option>
                                            <option value="62">ময়মনসিংহ</option>
                                            <option value="64">নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila_id" id="upazilaId" onchange="getUnionFn(); getUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="union_id" id="unionId" class="form-control" onchange="getUnionEnName()" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                    <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                    <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                                <?php endif; ?>

                                    <div class="form-group" >
                                        <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                        <select name="ward_id" id="wardNo" onchange="getWardEnName()" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="holdingNo" id="holdingNo" name="holding_no" class="form-control yes" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ডাকঘর <span class="text-danger">*</span></label>
                                        <input type="text" name="post_office" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম <span class="text-danger">*</span></label>
                                        <input type="text" name="village" class="form-control" required>
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Husband Info (English)</legend>

                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="member_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Father Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name_en" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name_en" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>NID No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="nidNoEn" ng-value="nidNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" id="dobEn" ng-value="dob" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="districtIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="upazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="unionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="holdingNoEn" ng-value="holdingNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Post Office <span class="text-danger">*</span></label>
                                        <input type="text" name="post_office_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Village <span class="text-danger">*</span></label>
                                        <input type="text" name="village_en" class="form-control" required>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>কনের বিবরণ (বাংলায়)</legend>

                                    <div class="form-group">
                                        <label>নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পিতা নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="wife_father_name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>মাতার নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="wife_mother_name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>জাতীয় পরিচয়পত্র নম্বর <span class="text-danger">&nbsp;</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="wifeNidNo" id="wifeNidNo" name="wife_nid_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>জন্ম তারিখ <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="wife_dob" ng-model="wifeDob" class="form-control" >
                                    </div>

                                <?php if($userInfo->privilege != 'user'): ?>
                                    <div class="form-group" >
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="wife_district_id" id="wifeDistrictId" onchange="getWifeUpazilaFn(); getWifeDistrictEnName();" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39">সুনামগঞ্জ</option>
                                            <option value="45">কিশোরগঞ্জ</option>
                                            <option value="62">ময়মনসিংহ</option>
                                            <option value="64">নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="wife_upazila_id" id="wifeUpazilaId" onchange="getWifeUnionFn(); getWifeUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="wife_union_id" id="wifeUnionId" class="form-control" onchange="getWifeUnionEnName()" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                <?php else: ?>
                                    <input type="hidden" name="wife_district_id" value="<?php echo e($userInfo->district_id); ?>" id="wifeDistrictId">
                                    <input type="hidden" name="wife_upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="wifeUpazilaId">
                                    <input type="hidden" name="wife_union_id" value="<?php echo e($userInfo->union_id); ?>" id="wifeUnionId">
                                <?php endif; ?>

                                    <div class="form-group" >
                                        <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                        <select name="wife_ward_id" id="wifeWardNo" onchange="getWifeWardEnName()" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="wifeHoldingNo" id="wifeHoldingNo" name="wife_holding_no" class="form-control yes" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ডাকঘর <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_post_office" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_village" class="form-control" required>
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Wife Info (English)</legend>

                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Father Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="wife_father_name_en" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="wife_mother_name_en" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>NID No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeNidNoEn" ng-value="wifeNidNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" id="wifeDobEn" ng-value="wifeDob" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wifeHoldingNoEn" ng-value="wifeHoldingNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Post Office <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_post_office_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Village <span class="text-danger">*</span></label>
                                        <input type="text" name="wife_village_en" class="form-control" required>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বিবাহ নিবন্ধনের তথ্য (বাংলায়)</legend>

                                    <div class="form-group">
                                        <label>নিবন্ধনের তারিখ <span class="text-danger">*</span></label>
                                        <input type="text" name="ragi_date" ng-model="regiDate" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                    </div>

                                    <div class="form-group">
                                        <label>সিরিয়াল নং <span class="text-danger">*</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" name="ragi_serial_no" ng-model="regiSerialNo" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পেইজ নং <span class="text-danger">*</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" name="ragi_page_no" ng-model="ragiPageNo" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>কলাম নং <span class="text-danger">*</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" name="ragi_column_no" ng-model="ragiColumnNo" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>বছর <span class="text-danger">*</span></label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" name="ragi_year" ng-model="ragiYear" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>অফিসের ঠিকানা <span class="text-danger">*</span></label>
                                        <textarea rows="4" name="regi_address" class="form-control" required></textarea>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Marriage Registration Info (English)</legend>

                                    <div class="form-group">
                                        <label>Registration Date <span class="text-danger">*</span></label>
                                        <input type="text" ng-value="regiDate" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Serial No. <span class="text-danger">*</span></label>
                                        <input type="text" ng-value="regiSerialNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Page No. <span class="text-danger">*</span></label>
                                        <input type="text" ng-value="ragiPageNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Column No. <span class="text-danger">*</span></label>
                                        <input type="text" ng-value="ragiColumnNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Year <span class="text-danger">*</span></label>
                                        <input type="text" ng-value="ragiYear" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Office Address <span class="text-danger">*</span></label>
                                        <textarea rows="4" name="regi_address_en" class="form-control" required></textarea>
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">

                            <input type="hidden" name="affidavit_type" value="married_certificate">

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
        fieldset {
            border: solid 1px #DDD !important;
            padding: 0 10px 10px 10px;
            border-bottom: none;
            margin-bottom: 15px;
        }
        legend {
            width: auto !important;
            border: none;
            font-size: 18px;
        }

        .hr_style {
            display: block;
            width: 100%;
            border-top: 1px solid #0B499D !important;
        }
        .no {
            border-color: red !important;
        }
        .yes {
            border-color: green !important;
        }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script>
        app.controller('marriedCertificateController', function($scope) {});

        // Uniqe Holding No
        function uniqeHoldingNo() {
            var _holdingNo = $('#holdingNo').val();
            var _wardNo = $('#wardNo').val();
            var _unionId = $('#unionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.get-holding-no')); ?>",
                data: {union_id : _unionId, holding_no : _holdingNo, ward_id : _wardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                if(response.union_id == _unionId && response.ward_id == _wardNo && response.holding_no == _holdingNo) {
                    $("#holdingNo").addClass("no");
                    $("#holdingNo").removeClass("yes");
                    $('#submitBtn').hide();
                }else{
                    $("#holdingNo").removeClass("no");
                    $("#holdingNo").addClass("yes");
                    $('#submitBtn').show();
                }
            });
        }

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
        function getWifeUpazilaFn() {
            $('#wifeUpazilaId').empty();
            var _wifeDistrictId = $('#wifeDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: {id: _wifeDistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeUpazilaId').append(response);
                $('#wifeUpazilaId').selectpicker('refresh');
            });
        }
        // get Upazila list
        function getPourashavaFn() {
            $('#pourashavaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.pourashava-list')); ?>",
                data: {id: _districtId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#pourashavaId').append(response);
                $('#pourashavaId').selectpicker('refresh');
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

        // get Upazila list
        function getWifeUnionFn() {
            $('#wifeUnionId').empty();
            var _wifeUpazilaId = $('#wifeUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: {id: _wifeUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeUnionId').append(response);
                $('#wifeUnionId').selectpicker('refresh');
            });
        }

        // get district English Name list
        function getDistrictEnName() {
            $('#districtIdEn').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.zilla-name')); ?>",
                data: {id: _districtId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#districtIdEn').val(response);
            });
        }

        // get district English Name list
        function getWifeDistrictEnName() {
            $('#wifeDistrictIdEn').empty();
            var _wifeDistrictId = $('#wifeDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.zilla-name')); ?>",
                data: {id: _wifeDistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeDistrictIdEn').val(response);
            });
        }

        // get Upzilla English Name list
        function getUpZillaEnName() {
            $('#upazilaIdEn').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upzilla-name')); ?>",
                data: {id: _upazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#upazilaIdEn').val(response);
            });
        }

        // get Upzilla English Name list
        function getWifeUpZillaEnName() {
            $('#wifeUpazilaIdEn').empty();
            var _wifeUpazilaId = $('#wifeUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upzilla-name')); ?>",
                data: {id: _wifeUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeUpazilaIdEn').val(response);
            });
        }

        // get Pourashava English Name list
        function getPourashavaEnName() {
            $('#pourashavaIdEn').empty();
            var _pourashavaId = $('#pourashavaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.pourashava-name')); ?>",
                data: {id: _pourashavaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#pourashavaIdEn').val(response);
            });
        }

        // get Union English Name list
        function getUnionEnName() {
            $('#unionIdEn').empty();
            var _unionId = $('#unionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-name')); ?>",
                data: {id: _unionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#unionIdEn').val(response);
            });
        }

        // get Union English Name list
        function getWifeUnionEnName() {
            $('#wifeUnionIdEn').empty();
            var _wifeUnionId = $('#wifeUnionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-name')); ?>",
                data: {id: _wifeUnionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeUnionIdEn').val(response);
            });
        }

        // get Union English Name list
        function getWardEnName() {
            $('#wardNoEn').empty();
            var _wardNo = $('#wardNo').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.ward-name')); ?>",
                data: {id: _wardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wardNoEn').val(response);
            });
        }

        // get Union English Name list
        function getWifeWardEnName() {
            $('#wifeWardNoEn').empty();
            var _wifeWardNo = $('#wifeWardNo').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.ward-name')); ?>",
                data: {id: _wifeWardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#wifeWardNoEn').val(response);
            });
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/affidavit/married.blade.php ENDPATH**/ ?>