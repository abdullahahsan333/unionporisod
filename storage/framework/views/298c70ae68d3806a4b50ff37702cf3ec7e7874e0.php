<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="tradeLicenseController" ng-cloak>
        <?php echo $__env->make('trade_license.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>নতুন ট্রেড লাইসেন্স যোগ করুন</h4>
                </div>
                <div class="panel_body">

                    <form action="<?php echo e(route('admin.trade_license.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" >
                            <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" >
                            <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" >

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Issue Date <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> License No. <span class="text-danger">*</span></label>
                                    <?php ($licenseNo = get_code($get_id+1,6)); ?>
                                    <input type="text" name="license_no" value="<?php echo e($licenseNo); ?>" class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Finance Year </label>
                                    <select name="finance_year" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php for($i = date('Y')+1; $i >= (date('Y')-3); $i--): ?>
                                        <?php ($finenceYear = ($i . '-' . ($i+1))); ?>
                                            <option value="<?php echo e($finenceYear); ?>"><?php echo e($finenceYear); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> License Validity <span class="text-danger">&nbsp;</span></label>
                                    <?php $year = date('Y') + 5;
                                        $period = date($year . '-06-30');
                                    ?>
                                    <input type="text" name="validity_period" value="<?php echo e($period); ?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বাংলায়</legend>

                                    <div class="form-group">
                                        <label> ব্যবসা প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> স্বত্বাধিকারী/লাইসেন্সধারীর নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="license_owner" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> পিতা/স্বামী নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> মাতা নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>স্পাউজের নাম (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>ব্যবসার প্রকৃতি <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <?php $__currentLoopData = config('custom.businessNatureBn'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসার/পেশার ধরণ <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসা প্রতিষ্ঠানের ঠিকানা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> অঞ্চল (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group">
                                        <label> Business Organization Name <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> Owner Proprietor Name <span class="text-danger">*</span></label>
                                        <input type="text" name="license_owner_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> Father/Husband Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Mother Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Spouse Name (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Nature of Business <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature_en" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected>Select Business Nature</option>
                                            <?php $__currentLoopData = config('custom.businessNatureEn'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>"><?php echo e(strFilter($value)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> Business Type <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Business Organisation Address <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Zone (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone_en" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>
                        </div>

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
                                        <input type="text" name="pre_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_road_no" class="form-control" >
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
                                        <input type="text" name="pre_post_code" class="form-control" >
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
                                        <input type="text" name="par_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_road_no" class="form-control" >
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
                                        <input type="text" name="par_post_code" class="form-control" >
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
                                        <input type="text" name="pre_holding_no_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_road_no_en" class="form-control" >
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
                                        <input type="text" name="pre_post_code_en" class="form-control" >
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
                                        <input type="text" name="par_holding_no_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_road_no_en" class="form-control" >
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
                                        <input type="text" name="par_post_code_en" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Starting Date <span class="text-danger">&nbsp;</span></label>
                                    <input type="text" name="business_start" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Birth Certificate / NID / Passport No  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="nid" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> TIN  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="tin" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> BIN  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="bin" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Mobile No. <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="mobile" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> E-mail <span class="text-danger">&nbsp;</span></label>
                                    <input type="email" name="email" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Standard Tax Schedule, 2016 serial no. <span class="text-danger">*</span></label>
                                    <input type="text" name="tax_serial_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> License Fee <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="license_fee" ng-model="licenseFee"  ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Due Year <span class="text-danger">*</span> </label>
                                    <select name="due_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php for($i = date('Y')+1; $i >= (date('Y')-3); $i--): ?>
                                        <?php ($finenceYear = ($i . '-' . ($i+1))); ?>
                                            <option value="<?php echo e($finenceYear); ?>"><?php echo e($finenceYear); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Due Amount <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="due_charge" ng-model="dueCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Sur Charge <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="sur_charge" ng-model="surCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Rectification Fee <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="amendment_charge" ng-model="amendmentCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Signboard Charge <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="signboard_charge" ng-model="signboardCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Income Tax/Source Tax <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="income_tax" ng-model="incomeTax" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Vat <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="vat" ng-model="vat" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label> পেশা ব্যবসা ও বৃত্তির উপর কর-২ <span class="text-danger"></span></label>
                                    <input type="number" name="tax_2" ng-model="tax_2" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Total Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="total" ng-model="totalAmount" id="numberInput" class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" tabindex="35">
                                    <label> Photo (300 X 300) <span class="text-danger">*</span></label>
                                    <input type="file" name="profile" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
        app.controller('tradeLicenseController',function($scope){
            $scope.licenseFee = 0;
            $scope.vat = 0;
            $scope.service_charge = 0;
            $scope.tax_2 = 0;
            $scope.dueCharge = 0;
            $scope.surCharge = 0;
            $scope.amendmentCharge = 0;
            $scope.signboardCharge = 0;
            $scope.incomeTax = 0;

            $scope.getTotalFeeFn = function () {
                var total           = 0;
                var licenseFee      = (!isNaN(parseFloat($scope.licenseFee)) ? parseFloat($scope.licenseFee) : 0);
                var vat             = (!isNaN(parseFloat($scope.vat)) ? parseFloat($scope.vat) : 0);
                var service_charge  = (!isNaN(parseFloat($scope.service_charge)) ? parseFloat($scope.service_charge) : 0);
                var tax_2           = (!isNaN(parseFloat($scope.tax_2)) ? parseFloat($scope.tax_2) : 0);
                var dueCharge       = (!isNaN(parseFloat($scope.dueCharge)) ? parseFloat($scope.dueCharge) : 0);
                var surCharge       = (!isNaN(parseFloat($scope.surCharge)) ? parseFloat($scope.surCharge) : 0);
                var amendmentCharge = (!isNaN(parseFloat($scope.amendmentCharge)) ? parseFloat($scope.amendmentCharge) : 0);
                var signboardCharge = (!isNaN(parseFloat($scope.signboardCharge)) ? parseFloat($scope.signboardCharge) : 0);
                var incomeTax       = (!isNaN(parseFloat($scope.incomeTax)) ? parseFloat($scope.incomeTax) : 0);

                total = licenseFee  + vat + service_charge +  tax_2 + dueCharge + surCharge + amendmentCharge + signboardCharge + incomeTax;
                $scope.totalAmount = Math.ceil(total);
            }
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/trade_license/create.blade.php ENDPATH**/ ?>