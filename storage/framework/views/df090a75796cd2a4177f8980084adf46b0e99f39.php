<?php $__env->startSection('content'); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($siteInfo = settings()); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('notice.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল নোটিশ </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <?php echo $__env->make('components.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php
                        if (!empty($_GET['wno'])) {
                            $action = route('admin.notice', ['wno' => $_GET['wno']]);
                            $wno    = strDecode($_GET['wno']);
                        } else {
                            $action = route('admin.notice');
                            $wno    = '';
                        }
                    ?>
                    <form action="<?php echo e($action); ?>" method="post" class="d-print-none">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            
                            <?php if($userInfo->privilege != 'user'): ?>
                            <div class="col-md-3">
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
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" >
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" >
                                        <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            <?php else: ?>
                                <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                            <?php endif; ?>
                            
                            <?php if(empty($wno)): ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="ward_id" id="wardId" onchange="getMemberWardWiseFn()" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>ওয়ার্ড নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($wno == $value->id ? 'selected' : ''); ?>><?php echo e($value->name_bn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" id="wardId" value="<?php echo e($wards->where('id', $wno)->first()->name_bn); ?>" class="form-control" readonly>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="member_id" id="memberId" class="form-control" data-live-search="true">
                                        <option value="" selected>সদস্য নির্বাচন করুন</option>
                                        
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
    								<input type="text" name="date_from" value="" placeholder="From" class="form-control" id="startDate">
    							</div>
    						</div>
                            <div class="col-md-3">
        						<div class="form-group">
    								<input type="text" name="date_to" value="" placeholder="To" class="form-control" id="endDate">
    							</div>
    						</div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn" name="show">খুজুন</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr class="mt-0 border-primary d-print-none">

                    <div class="table-responsive">
                        <table class="table table-bordered list-table" id="DataTable">
                            <thead>
                            <tr>
                                <th style="width: 30px;">ক্র.নং</th>
                                <th>তারিখ</th>
                                <th>স্মারক নং</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                <th>বাৎসরিক করের পরিমাণ</th>
                                <th>সর্বমোট পরিশোধযোগ্য কর</th>
                                <th style="width: 105px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php ($totalBalance = $annualAssessment = 0); ?>
                            <?php if(!empty($results)): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $annualAssessment += (!empty($row->annual_assessment) ? $row->annual_assessment : "0"); ?>
                                <?php $totalBalance += $row->balance; ?>
                                    <tr>
                                        <td><?php echo e(numberFilter(++$key ,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->created,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->memorial_no,'bn')); ?></td>
                                        <td>
                                            (<?php echo e(numberFilter($row->holding_no,'bn')); ?>) - <?php echo e($row->name); ?> - ( <?php echo e(numberFilter($row->mobile_no,'bn')); ?> )
                                        </td>
                                        <td>
                                            <?php ($division = $divisions->where('id', $row->division_id)->first()); ?>
                                            <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                            <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                            <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>
                                            <?php ($ward     = $wards->where('id', $row->ward_id)->first()); ?>

                                            <?php echo e(numberFilter($row->holding_no,'bn')); ?>,
                                            <?php echo e($row->village); ?>,
                                            <?php echo e((!empty($union) ? $union->bn_name : " ")); ?> (<?php echo e((!empty($ward) ? $ward->name_bn : " ")); ?>),
                                            <?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?>,
                                            <?php echo e((!empty($district) ? $district->bn_name : " ")); ?>

                                        </td>
                                        <td> <?php echo e((!empty($row->annual_assessment) ? numberFilter($row->annual_assessment,'bn') : "0")); ?> টাকা</td>
                                        <td> <?php echo e(numberFilter($row->balance,'bn')); ?> টাকা</td>
                                        <td class="operation_btn text-right print_hide">
                                            <?php //if(($privilege == 'super') ||  (!empty($accessList->notice->submenu->action->view) && $accessList->notice->submenu->action->view == "view")) { ?>
                                                <a href="<?php echo e(route('admin.notice.view', $row->id)); ?>" class="view" title="View">
                                                    <i class="far fa-eye" aria-hidden="true"></i>
                                                </a>
                                            <?php //}
                                           //if(($privilege == 'super') ||  (!empty($accessList->notice->submenu->action->edit) && $accessList->notice->submenu->action->edit == "edit")) { ?>
                                            <a href="<?php echo e(route('admin.notice.edit', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <?php //}
                                            //if(($privilege == 'super') ||  (!empty($accessList->notice->submenu->action->delete) && $accessList->notice->submenu->action->delete == "delete")) { ?>
                                            <a href="<?php echo e(route('admin.notice.destroy', $row->id)); ?>"
                                                onclick="return confirm('Do you want to delete this data?')"
                                                class="delete" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                            <?php //} ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right">মোট</th>
                                    <th><?php echo e(numberFilter($annualAssessment,'bn')); ?> টাকা</th>
                                    <th><?php echo e(numberFilter($totalBalance,'bn')); ?> টাকা</th>
                                    <th class="print_hide"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#DataTable').DataTable({
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        });
    });

    $('#divisionId').selectpicker();

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
    
    // get Ward Wise Member list
    function getMemberWardWiseFn() {
        $('#memberId').empty();
        var _unionId = $('#unionId').val();
        var _wardId = $('#wardId').val();
        $.ajax({
            method: "POST",
            url: "<?php echo e(route('admin.member.ward-wise-mamber')); ?>",
            data: {ward_id : _wardId , union_id : _unionId, _token : "<?php echo e(csrf_token()); ?>"}
        }).then(function (response) {
            $('#memberId').append(response);
            $('#memberId').selectpicker('refresh');
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/notice/index.blade.php ENDPATH**/ ?>