<?php $__env->startSection('content'); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($siteInfo = settings()); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('bazar_member.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল সদস্য </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <?php echo $__env->make('components.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php
                        if (!empty($_GET['wno'])) {
                            $action = route('admin.bazar_member', ['wno' => $_GET['wno']]);
                            $wno    = strDecode($_GET['wno']);
                        } else {
                            $action = route('admin.bazar_member');
                            $wno    = '';
                        }
                    ?>
                    <form action="<?php echo e($action); ?>" method="post" class="d-print-none">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="member_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>সদস্য নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $allMember; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($value->holder_name)): ?>
                                        <option value="<?php echo e($value->id); ?>">(<?php echo e(numberFilter($value->holding_no,'bn')); ?>) - <?php echo e($value->holder_name); ?> - (<?php echo e(numberFilter($value->mobile_no,'bn')); ?>)</option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
                                <th>হোল্ডিং নং</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>পিতা/স্বামীর নাম</th>
                                <th>ব্যবসার নাম</th>
                                <th>ঠিকানা</th>
                                <th>বার্ষিক কর</th>
                                <th style="width: 70px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php ($totalTaxes = 0); ?>
                            <?php if(!empty($results)): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php ($division = $divisions->where('id', $row->division_id)->first()); ?>
                                    <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                    <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                    <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>
                                    <?php ($ward     = $wards->where('id', $row->ward_id)->first()); ?>
                                    <?php ($totalTaxes += $row->total_taxes); ?>
                                    <tr>
                                        <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                                        <td><img src="<?php echo e(asset($row->path)); ?>" alt=""></td>
                                        <td>
                                            <?php echo e($row->holder_name); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                                        </td>
                                        <td><?php echo e($row->father_name); ?></td>
                                        <td> <?php echo e(numberFilter($row->business_name,'bn')); ?> </td>
                                        <td>
                                            <?php echo e(numberFilter($row->holding_no,'bn')); ?>,
                                            <?php echo e((!empty($union) ? $union->bn_name : " ")); ?>

                                            (<?php echo e((!empty($ward) ? $ward->name_bn : " ")); ?>),
                                            <?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?>,
                                            <?php echo e((!empty($district) ? $district->bn_name : " ")); ?>.
                                        </td>
                                        <td><?php echo e(numberFilter($row->total_taxes, 'bn')); ?></td>
                                        <td class="operation_btn text-right print_hide">
                                            <a href="<?php echo e(route('admin.bazar_member.view', $row->id)); ?>" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="<?php echo e(route('admin.bazar_member.edit', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <?php if($row->bazar_license != 'yes'): ?>
                                            <a href="<?php echo e(route('admin.bazar_member.trade_license', $row->id)); ?>" class="report" title="Trade License">
                                                <i class="fab fa-trade-federation" aria-hidden="true"></i>
                                            </a>
                                            <?php endif; ?>
                                            
                                            <a target="_blank" href="<?php echo e(route('admin.tax-collection.bazar', strEncode($row->id))); ?>" class="tax_collection" title="Tax Collection">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </a>

                                            <a href="<?php echo e(route('admin.bazar_member.destroy', $row->id)); ?>" onclick="return confirm('Do you want to delete this data?')" class="delete" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right">মোট টাকা</th>
                                    <th><?php echo e(numberFilter($totalTaxes,'bn')); ?></th>
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
<?php $__env->startPush('footer-style'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    <style>
        .report {
            background: #00897B !important;
            color: #fff !important;
            font-size: 14px !important;
        }
        .tax_collection {
            background: #5E35B1 !important;
            color: #fff !important;
            font-size: 14px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
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

        // get Ward Wise Member list
        function getMemberWardWiseFn() {
            $('#memberId').empty();
            var _unionId = $('#unionId').val();
            var _wardId = $('#wardId').val();
            console.log(_unionId);
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('admin.bazar_member.ward-wise-mamber')); ?>",
                data: {ward_id : _wardId , union_id : _unionId, _token : "<?php echo e(csrf_token()); ?>"}
            }).then(function (response) {
                $('#memberId').append(response);
                $('#memberId').selectpicker('refresh');
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/bazar_member/index.blade.php ENDPATH**/ ?>