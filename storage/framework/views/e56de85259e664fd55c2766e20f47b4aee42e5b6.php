<?php $__env->startSection('content'); ?>
<!-- body container start -->
<div class="body_container">
    <?php echo $__env->make('sms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- body content start -->
    <div class="body_content" ng-controller="customSMSCtrl">
        <div class="panel_container">
            <div class="panel_heading">
                <h4>সেন্ড এসএমএস</h4>
            </div>
            <div class="panel_body">
                <form action="<?php echo e(route('admin.sms.send_sms')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-row print_hide">
                        
                        <?php if($userInfo->privilege != 'user'): ?>
                        <div class="col-md-3">
                            <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" >
                                <option value="" selected> জেলা নির্বাচন করুন</option>
                                <option value="39">সুনামগঞ্জ</option>
                                <option value="45">কিশোরগঞ্জ</option>
                                <option value="62">ময়মনসিংহ</option>
                                <option value="64">নেত্রকোণা</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" >
                                <option value="" selected> উপজেলা নির্বাচন করুন</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <select name="union_id" id="unionId" class="form-control" data-live-search="true" >
                                <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                            </select>
                        </div>
                        <?php else: ?>
                            <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                            <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                            <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                        <?php endif; ?>
                            
						<div class="col-md-3">
                            <div class="form-group">
								<select class="form-control selectpicker" name="type" data-live-search="true">
									<option value="" selected> নির্বাচন করুন </option>
                                    <option value="member">সদস্য</option>
                                    <option value="bazar_member">বাজারের সদস্য</option>
                                    <option value="user">ইউজার</option>
								</select>
							</div>
						</div>
                        <div class="col-md-2">
                            <div class="form-group">
								<button type="submit" class="btn submit_btn" name="show">দেখুন</button>
							</div>
						</div>
                    </div>
                </form>
                <hr class="mt-0 print_hide">
                <blockquote class="form_head">
                    <p>মোট এসএমএসঃ <strong><?php echo e(smsLimit()); ?></strong><br />
                        মোট সেন্ড এসএমএসঃ
                        <strong><?php echo e(totalSendSms()); ?></strong><br />
                        মোট বাকি এসএমএসঃ
                        <strong><?php echo e(smsLimit() - totalSendSms()); ?></strong>
                    </p>
                </blockquote>
                <hr class="mt-0 print_hide">
                 <?php if(!empty($memberList)): ?>
                <form action="<?php echo e(route('admin.sms.agentUserSendSms')); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                    <div class="form-row print_hide">
						<div class="col-md-12">
							<div class="form_table">
							    <table class="table table-bordered">
							        <tr>
							            <th>নাম</th>
							            <th><input type="checkbox" id="allCheck" checked=""> &nbsp; মোবাইল</th>
							            <th>ঠিকানা</th>
							        </tr>
							        <?php $__currentLoopData = $memberList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							        
						                <?php ($division = $divisions->where('id', $row->division_id)->first()); ?>
                                        <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                        <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                        <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>
                                        <?php ($ward     = $wards->where('id', $row->ward_id)->first()); ?>
                                            
							        <tr>
							            <?php if($_POST['type'] == 'user') { ?>
							            <td><?php echo e($row->username); ?></td>
							            <?php } else { ?>
							            <td><?php echo e($row->name); ?></td>
							            <?php } ?>
							            <td>
							                <div class="form-group form-check">
                                                <input type="checkbox" name="mobile[]" value="<?php echo e($row->mobile); ?>" class="form-check-input" id="check_<?php echo e($key+1); ?>" checked>
                                                <label class="form-check-label" for="check_<?php echo e($key+1); ?>">
                                                    <?php if($_POST['type'] == 'user') { ?>
                                                    <?php echo e($row->mobile); ?>

                                                    <?php } else { ?>
                                                    <?php echo e($row->mobile_no); ?>

                                                    <?php } ?>
                                                </label>
                                            </div>
						                </td>
							            <td>
							                <?php if($_POST['type'] == 'user') { ?>
                                            <?php echo e($row->address); ?>

                                            <?php } else { ?>
                                                <?php echo e(numberFilter($row->holding_no,'bn')); ?>,
                                                <?php echo e($row->village); ?>,
                                                <?php echo e((!empty($union) ? $union->bn_name : " ")); ?>

                                                (<?php echo e((!empty($ward) ? $ward->name_bn : " ")); ?>),
                                                <?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?>,
                                                <?php echo e((!empty($district) ? $district->bn_name : " ")); ?>.
                                            <?php } ?>
							                
							            </td>
							        </tr>
							        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							    </table>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group">
							    <textarea ng-model="msgContant" class="form-control" name="message"
							    placeholder="আপনার মেসেজ লিখুন। সর্বোচ্চ ১০৮০ অক্ষর লিখুন..." rows="6" required></textarea>
							</div>
						</div>
						<div class="col-md-12">
						    <div class="form-row">
						        <div class="col-md-6">
                                    <div class="total_msg">
                                        <strong>মোট অক্ষরঃ</strong>
                                        <input type="number" value="{{ totalChar }}" name="characters" readonly>
                                        <strong>মোট মেসেজঃ</strong>
                                        <input type="number" name="message_length" readonly value="{{msgSize}}">
                                    </div>
                                </div>
						        <div class="col-md-6">
                                    <div class="form-group text-right">
        								<button type="submit" class="btn submit_btn" name="send_msg">সেন্ড</button>
        							</div>
    							</div>
						    </div>
						</div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
            <div class="panel_footer"></div>
        </div>
    </div>
    <!-- body content end -->
</div>
<!-- body container end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('header-style'); ?>
<style>
    .form_head {border-left: 4px solid #303F9F;padding: 7px 0 7px 12px;margin-bottom: 15px;}
    .form_head p {font-size: 16px;margin: 0;}
    .form_head strong {font-size: 15px;}
    .form_table .table {margin: 0;}
    .form_table .table td {font-size: 14px;}
    .form_table .form-group {user-select: none;margin: 0;}
    .form_table .form-group input {margin-top: 3px;}
    .form_table {
        border-bottom: 1px solid #d4d9de;
        border-top: 1px solid #d4d9de;
        margin-bottom: 20px;
        max-height: 220px;
        overflow: auto;
    }
    .total_msg {justify-content: flex-end;display: flex;}
    .total_msg strong {margin-left: 15px;}
    .total_msg input {
        box-shadow: none;
        border: none;
        width: 40px;
        padding: 0;
        outline: none;
        margin-left: 12px;
        text-align: right;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script>
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
        getUpazilaFn()
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
        getUnionFn()
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/sms/send_sms.blade.php ENDPATH**/ ?>