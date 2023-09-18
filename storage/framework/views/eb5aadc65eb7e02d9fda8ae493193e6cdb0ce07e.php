<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="bazarMemberController" ng-cloak>

        <?php echo $__env->make('bazar_member.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বাজারের সদস্য যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.bazar_member.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" >
                            <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" >
                            <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" >

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ইস্যু তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বাংলায়</legend>

                                    <div class="form-group">
                                        <label>দোকান / কারখানার মালিকের নাম<span class="text-danger">*</span></label>
                                        <input type="text" name="holder_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="father_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>মাতার নাম <span class="text-danger"></span></label>
                                        <input type="text" name="mother_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>ব্যবসার নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ভাড়াটিয়া আছে কিনা ? <span class="text-danger">*</span></label>
                                        <select name="tenant" id="tenant" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <option value="হ্যাঁ">হ্যাঁ</option>
                                            <option value="না">না</option>
                                        </select>
                                    </div>

                                    <div class="" id="tenantName">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার নাম <span class="text-danger"></span></label>
                                            <input type="text" name="tenant_name" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantFatherName">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার পিতার নাম <span class="text-danger"></span></label>
                                            <input type="text" name="tenant_father_name" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantBusinessAssets">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার ব্যবসার মোট পুঁজি<span class="text-danger"></span></label>
                                            <input ng-model="tenantBusinessAssets" inputmode="numeric" pattern="[0-9]*" type="number" name="tenant_business_assets" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>কারখানা/দোকান ঘর সহ মোট জমি কত শতাংশ<span class="text-danger">*</span></label>
                                        <input ng-model="totalLand" inputmode="numeric" pattern="[0-9]*" type="number" name="total_land" class="form-control" placeholder="" required>
                                    </div>

                                    <div class="form-group">
                                        <label>বাজারের নাম<span class="text-danger"></span></label>
                                        <input type="text" name="bazar_name" class="form-control" >
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group">
                                        <label>Shop/Factory Owner Name<span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="holder_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Father/Husband Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name <span class="text-danger"></span></label>
                                        <input type="text" name="mother_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Business Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Do you have any renter? <span class="text-danger">&nbsp;</span></label>
                                        <select name="tenant_en" id="tenantEn" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected> Select Any One</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="" id="tenantNameEn">
                                        <div class="form-group">
                                            <label>Renter Name<span class="text-danger"></span></label>
                                            <input type="text" name="tenant_name_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantFatherNameEn">
                                        <div class="form-group">
                                            <label>Renter Father Name <span class="text-danger"></span></label>
                                            <input type="text" name="tenant_father_name_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantBusinessAssetsEn">
                                        <div class="form-group">
                                            <label>Total Capital of Renter Business<span class="text-danger"></span></label>
                                            <input type="text" ng-value="tenantBusinessAssets" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Factory/Shop Total Land<span class="text-danger">&nbsp;</span></label>
                                        <input ng-value="totalLand" type="number" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Bazar Name<span class="text-danger"></span></label>
                                        <input type="text" name="bazar_name_en" class="form-control" >
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <!-- Address Separetly Start -->
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বতর্মান ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="pre_district_id" id="preDistrictId" onchange="getUpazilaFn(); getDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39">সুনামগঞ্জ</option>
                                            <option value="45">কিশোরগঞ্জ</option>
                                            <option value="62">ময়মনসিংহ</option>
                                            <option value="64">নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="pre_upazila_id" id="preUpazilaId" onchange="getUnionFn(); getUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="pre_union_id" id="preUnionId" class="form-control" onchange="getUnionEnName()" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ওয়ার্ড নং <span class="text-danger">&nbsp;</span></label>
                                        <select name="pre_ward_id" id="preWardNo" class="form-control selectpicker" onchange="getWardEnName(); getWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="preHolding" inputmode="numeric" pattern="[0-9]*" type="number" name="pre_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="preRoad" inputmode="numeric" pattern="[0-9]*" type="number" name="pre_road_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="prePostCode" inputmode="numeric" pattern="[0-9]*" type="number" name="pre_post_code" class="form-control" >
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>স্থায়ী ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="par_district_id" id="parDistrictId" onchange="getParUpazilaFn(); getParDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39">সুনামগঞ্জ</option>
                                            <option value="45">কিশোরগঞ্জ</option>
                                            <option value="62">ময়মনসিংহ</option>
                                            <option value="64">নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="par_upazila_id" id="parUpazilaId" onchange="getParUnionFn(); getParUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="par_union_id" id="parUnionId" class="form-control" onchange="getParUnionEnName();" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ওয়ার্ড নং <span class="text-danger">&nbsp;</span></label>
                                        <select name="par_ward_id" id="parWardNo" class="form-control selectpicker" onchange="getWardEnName(); getParWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parHolding" inputmode="numeric" pattern="[0-9]*" type="number" name="par_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parRoad" inputmode="numeric" pattern="[0-9]*" type="number" name="par_road_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parPostCode" inputmode="numeric" pattern="[0-9]*" type="number" name="par_post_code" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Present Address</legend>

                                    <div class="form-group" tabindex="6">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="preDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="preWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preHolding" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preRoad" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="prePostCode" class="form-control" readonly>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>Permanent Address</legend>

                                    <div class="form-group" tabindex="6">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="parDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="parWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="parHolding" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="parRoad" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="parPostCode" class="form-control" readonly>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                        <!-- Address Separetly End -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="tel" placeholder="" name="mobile_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ঘর নির্মাণ সহ ব্যবসার মোট পুঁজি<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_assets" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক ব্যবসার আয়<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="business_income" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="annual_assessment" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক করের পরিমাণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="total_taxes" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="member_image" class="form-control">
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

        $(document).ready(function () {
            $('#tenantName').hide();
            $('#tenantFatherName').hide();
            $('#tenantBusinessAssets').hide();

            $('#tenant').on('change', function () {
                var _tenant = $(this).val();
                if (_tenant === "হ্যাঁ") {
                    $('#tenantName').show();
                    $('#tenantFatherName').show();
                    $('#tenantBusinessAssets').show();
                } else {
                    $('#tenantName').hide();
                    $('#tenantFatherName').hide();
                    $('#tenantBusinessAssets').hide();
                }
            });
        });

        $(document).ready(function () {
            $('#tenantNameEn').hide();
            $('#tenantFatherNameEn').hide();
            $('#tenantBusinessAssetsEn').hide();

            $('#tenantEn').on('change', function () {
                var _tenant = $(this).val();
                if (_tenant === "yes") {
                    $('#tenantNameEn').show();
                    $('#tenantFatherNameEn').show();
                    $('#tenantBusinessAssetsEn').show();
                } else {
                    $('#tenantNameEn').hide();
                    $('#tenantFatherNameEn').hide();
                    $('#tenantBusinessAssetsEn').hide();
                }
            });
        });

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
            $('#preUpazilaId').empty();
            var _predistrictId = $('#preDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: {id: _predistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preUpazilaId').append(response);
                $('#preUpazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUnionFn() {
            $('#preUnionId').empty();
            var _preUpazilaId = $('#preUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: {id: _preUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preUnionId').append(response);
                $('#preUnionId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getParUpazilaFn() {
            $('#parUpazilaId').empty();
            var _parDistrictId = $('#parDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upazila-list')); ?>",
                data: {id: _parDistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parUpazilaId').append(response);
                $('#parUpazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getParUnionFn() {
            $('#parUnionId').empty();
            var _parUpazilaId = $('#parUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-list')); ?>",
                data: {id: _parUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parUnionId').append(response);
                $('#parUnionId').selectpicker('refresh');
            });
        }

        // get district English Name list
        function getDistrictEnName() {
            $('#preDistrictIdEn').empty();
            var _preDistrictId = $('#preDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.zilla-name')); ?>",
                data: {id: _preDistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preDistrictIdEn').val(response);
            });
        }

        // get Upzilla English Name list
        function getUpZillaEnName() {
            $('#preUpazilaIdEn').empty();
            var _preUpazilaId = $('#preUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upzilla-name')); ?>",
                data: {id: _preUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preUpazilaIdEn').val(response);
            });
        }

        // get Union English Name list
        function getUnionEnName() {
            $('#preUnionIdEn').empty();
            var _preUnionId = $('#preUnionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-name')); ?>",
                data: {id: _preUnionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preUnionIdEn').val(response);
            });
        }

        // get Union English Name list
        function getWardEnName() {
            $('#preWardNoEn').empty();
            var _preWardNo = $('#preWardNo').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.ward-name')); ?>",
                data: {id: _preWardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#preWardNoEn').val(response);
            });
        }

        // get district English Name list
        function getParDistrictEnName() {
            $('#parDistrictIdEn').empty();
            var _parDistrictId = $('#parDistrictId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.zilla-name')); ?>",
                data: {id: _parDistrictId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parDistrictIdEn').val(response);
            });
        }

        // get Upzilla English Name list
        function getParUpZillaEnName() {
            $('#parUpazilaIdEn').empty();
            var _parUpazilaId = $('#parUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.upzilla-name')); ?>",
                data: {id: _parUpazilaId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parUpazilaIdEn').val(response);
            });
        }

        // get Union English Name list
        function getParUnionEnName() {
            $('#parUnionIdEn').empty();
            var _parUnionId = $('#parUnionId').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.union-name')); ?>",
                data: {id: _parUnionId, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parUnionIdEn').val(response);
            });
        }

        // get Union English Name list
        function getParWardEnName() {
            $('#parWardNoEn').empty();
            var _parWardNo = $('#parWardNo').val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.member.ward-name')); ?>",
                data: {id: _parWardNo, _token: "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#parWardNoEn').val(response);
            });
        }
        /* angular script */
        app.controller('bazarMemberController', function ($scope) {

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/bazar_member/create.blade.php ENDPATH**/ ?>