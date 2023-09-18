<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        <?php echo $__env->make('tax-collection.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="<?php echo e(route('admin.tax-collection.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
						<div class="row">
						    <input type="hidden" name="type" value="member" class="form-control" readonly>
						    
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="<?php echo e(date('Y-m-d')); ?>" class="form-control datepicker" required>
                                </div>
    						</div>
						    
                            <div class="col-md-6">
                                <label>রসিদ নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="receipt_no" class="form-control" required>
                                </div>
    						</div>
    						
    						<?php if($userInfo->privilege != 'user'): ?>
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> জেলা নির্বাচন করুন</option>
                                        <option value="39">সুনামগঞ্জ</option>
                                        <option value="45">কিশোরগঞ্জ</option>
                                        <option value="62">ময়মনসিংহ</option>
                                        <option value="64">নেত্রকোণা</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                        <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            <?php else: ?>
                                <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                            <?php endif; ?>
    						
    						<div class="col-md-6">
                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    <select name="ward_id" id="wardNo" onchange="getWardWiseFn()" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name_bn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
    						
                            <div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="member_id" id="memberId" class="form-control" data-live-search="true" required>
                                        <option value="" selected>সদস্য নির্বাচন করুন </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং </label>
                                <div class="form-group">
                                    <input type="text" id="holdingNo" value="" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম </label>
                                <div class="form-group">
                                    <input type="text" id="fatherName" value="" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং </label>
                                <div class="form-group">
                                    <input type="text" id="mobileNo" class="form-control" value="" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>খানা প্রধানের বাৎসরিক আয় <span class="text-danger">&nbsp;</span></label>
                                    <input inputmode="numeric" id="annualIncome" pattern="[0-9]*" type="number" name="annual_income" class="form-control" readonly >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ </label>
                                <div class="form-group">
                                    <input type="text" id="taxes" name="taxes" class="form-control" value="" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ </label>
                                <div class="form-group">
                                    <input type="text" id="annualAssessment" name="annual_assessment" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য </label>
                                <div class="form-group">
                                    <input type="text" id="estimatedValue" name="estimated_value" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পূর্বের জমাকৃত ট্যাক্স </label>
                                <div class="form-group">
                                    <input type="text" id="previousPaid" class="form-control" value="" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> অর্থ বছর </label>
                                <div class="form-group">
                                    <select name="finence_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <?php for($i = date('Y'); $i >= (date('Y')-4); $i--): ?>
                                        <?php ($finenceYear = ($i . '-' . ($i+1))); ?>
                                            <option value="<?php echo e($finenceYear); ?>"><?php echo e($finenceYear); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ট্যাক্স জমা </label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-model="paid" pattern="[0-9]*" type="number" name="paid" class="form-control" value="" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>জরিমানা </label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-model="fine" pattern="[0-9]*" type="number" name="fine" class="form-control" value="" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মোট টাকা </label>
                                <div class="form-group">
                                    <input type="text" name="total" id="totalAmount" class="form-control" ng-value="paid + fine" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save"> সেইভ করুন </button>
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

<?php $__env->startPush('footer-script'); ?>
<script>
    app.controller('appController', function($scope) {
       $scope.getAnnualAsset = function(){
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*14.28));
           return amount;
       };
       $scope.getEstimatedValue = function(){
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*284.78));
           return amount;
       };
    });
    
    // get Ward Wise Member Info
    function getWardWiseFn() {
        $('#memberId').empty();
        var _wardNo = $('#wardNo').val();
        var _unionId = $('#unionId').val();
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('admin.tax-collection.ward-wise-member')); ?>",
            data: {ward_id: _wardNo, union_id: _unionId, _token: "<?php echo e(csrf_token()); ?>"}
        }).then(function (response) {
            $('#memberId').append(response);
            $('#memberId').selectpicker('refresh');
        });
    }

    // get Member Info
    $('#memberId').on('change', function(){
        var holdingNo         = "";
        var fatherInfo        = "";
        var mobileNo          = "";
        var annualIncome      = "";
        var taxes             = "";
        var previousPaid      = "";
        var annualAssessment  = "";
        var estimatedValue    = "";

        var _memberId = $(this).val();
        //console.log(_memberId);
        $.ajax({
            method : "POST",
            url    : "<?php echo e(route('admin.tax-collection.member-info')); ?>",
            data   : { id: _memberId, _token: "<?php echo e(csrf_token()); ?>" }
        }).then(function(response){

            console.log(response);

            fatherInfo      = response.father_name;
            holdingNo       = response.holding_no;
            mobileNo        = response.mobile_no;
            annual_income   = response.annual_income
            taxes           = response.taxes
            annualAssessment= response.annual_assessment
            estimatedValue  = response.estimated_value
            previousPaid    = response.previous_paid

            $('#holdingNo').val(holdingNo);
            $('#fatherName').val(fatherInfo);
            $('#mobileNo').val(mobileNo);
            $('#annualIncome').val(annualIncome);
            $('#taxes').val(taxes);
            $('#annualAssessment').val(annualAssessment);
            $('#estimatedValue').val(estimatedValue);
            $('#previousPaid').val(previousPaid);
            //console.log(response);
        });
    });
    
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

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/tax-collection/create.blade.php ENDPATH**/ ?>