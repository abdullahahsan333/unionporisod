<?php $__env->startSection('content'); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($siteInfo = settings()); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('affidavit.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল সনদ পত্র</h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <?php echo $__env->make('components.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php
                        if (!empty($_GET['wno'])) {
                            $action = route('admin.affidavit', ['wno' => $_GET['wno']]);
                            $wno    = strDecode($_GET['wno']);
                        } else {
                            $action = route('admin.affidavit');
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
                                    <select name="affidavit_type" class="form-control" data-live-search="true">
                                        <option value="" selected>সনদপত্র নির্বাচন করুন</option>
                                        <option value="citizenship_certificate" >নাগরিকত্ব সনদপত্র</option>
                                        <option value="inheritance_certificate" >উত্তরাধিকার সনদপত্র</option>
                                        <option value="unmarried_certificate" >অবিবাহিত সনদপত্র</option>
                                        <option value="married_certificate" >বিবাহিত সনদপত্র</option>
                                        <option value="carecture_certificate" >চারিত্রিক সনদপত্র</option>
                                        <option value="income_certificate" >বাষির্ক আয় সনদপত্র</option>
                                        <option value="family_certificate" >পারিবারিক সনদপত্র</option>
                                        <option value="affidavit_certificate" >প্রত্যয়ন পত্র</option>
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
                                <th>তথ্য</th>
                                <th>খানা সদস্য</th>
                                <th>ধরন</th>
                                <th style="width: 75px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($results)): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e(numberFilter(++$key ,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->created,'bn')); ?></td>
                                        <td>
                                            <?php echo e((!empty($row->member_name) ? $row->member_name : "")); ?> (<?php echo e(numberFilter($row->affidavit_no,'bn')); ?>) -
                                            <?php ($division = $divisions->where('id', $row->division_id)->first()); ?>
                                            <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                            <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                            <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>
                                            <?php ($ward     = $wards->where('id', $row->ward_id)->first()); ?>

                                            <?php echo e((!empty($row->holding_no) ? numberFilter($row->holding_no,'bn') : "")); ?>,
                                            <?php echo e((!empty($row->village) ? $row->village : "")); ?>,
                                            <?php echo e((!empty($union) ? $union->bn_name : "")); ?> (<?php echo e((!empty($ward) ? $ward->name_bn : "")); ?>),
                                            <?php echo e((!empty($upazila) ? $upazila->bn_name : "")); ?>,
                                            <?php echo e((!empty($district) ? $district->bn_name : "")); ?>

                                        </td>
                                        <td><?php echo e((!empty($row->member_id) ? "হ্যাঁ" : "না")); ?></td>
                                        <td>
                                            <?php if($row->affidavit_type == "citizenship_certificate"): ?>
                                            নাগরিকত্ব সনদপত্র
                                            <?php elseif($row->affidavit_type == "inheritance_certificate"): ?>
                                            উত্তরাধিকার সনদপত্র
                                            <?php elseif($row->affidavit_type == "unmarried_certificate"): ?>
                                            অবিবাহিত সনদপত্র
                                            <?php elseif($row->affidavit_type == "married_certificate"): ?>
                                            বিবাহিত সনদপত্র
                                            <?php elseif($row->affidavit_type == "carecture_certificate"): ?>
                                            চারিত্রিক সনদপত্র
                                            <?php elseif($row->affidavit_type == "income_certificate"): ?>
                                            বাষির্ক আয় সনদপত্র
                                            <?php elseif($row->affidavit_type == "family_certificate"): ?>
                                            পারিবারিক সনদপত্র
                                            <?php elseif($row->affidavit_type == "affidavit_certificate"): ?>
                                            প্রত্যয়ন পত্র
                                            <?php endif; ?>
                                        </td>
                                        <td class="operation_btn text-right print_hide">

                                            <?php if($row->affidavit_type == "citizenship_certificate" ||
                                            $row->affidavit_type == 'unmarried_certificate' ||
                                            $row->affidavit_type == 'income_certificate' ||
                                            $row->affidavit_type == "carecture_certificate" ||
                                            $row->affidavit_type == "affidavit_certificate"): ?>

                                            <a href="<?php echo e(route('admin.affidavit.view', $row->id)); ?>" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <!-- <a href="<?php echo e(route('admin.affidavit.edit', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a> -->

                                            <?php elseif($row->affidavit_type == "inheritance_certificate"): ?>

                                            <a href="<?php echo e(route('admin.affidavit.view_inheritance', $row->id)); ?>" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <!-- <a href="<?php echo e(route('admin.affidavit.edit_inherit', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a> -->

                                            <?php elseif($row->affidavit_type == "family_certificate"): ?>

                                            <a href="<?php echo e(route('admin.affidavit.view_inheritance', $row->id)); ?>" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <!-- <a href="<?php echo e(route('admin.affidavit.edit_family', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a> -->

                                            <?php elseif($row->affidavit_type == "married_certificate"): ?>

                                            <a href="<?php echo e(route('admin.affidavit.view_married', $row->id)); ?>" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <!-- <a href="<?php echo e(route('admin.affidavit.edit_married', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a> -->

                                            <?php endif; ?>

                                            <a  href="<?php echo e(route('admin.affidavit.destroy', $row->id)); ?>" class="delete"
                                                onclick="return confirm('Do you want to delete this data?')" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
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

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/affidavit/index.blade.php ENDPATH**/ ?>