<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('reports.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>ইউনিয়ন রিপোর্ট</h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <div class="repot_header print_only">
                        <h4>ইউনিয়ন কর ধার্য্য রেজিস্টার</h4>
                        <?php if(!empty($unionId) && !empty($allMember)): ?>
                        <h2><?php echo e($unions->where('id', $userInfo->union_id)->first()->bn_name); ?> ইউনিয়ন পরিষদ।</h2>
                        <h4><?php echo e($upazilas->where('id', $userInfo->upazila_id)->first()->bn_name); ?>, <?php echo e($districts->where('id', $userInfo->district_id)->first()->bn_name); ?></h4>
                        <?php endif; ?>
                        <?php if(!empty(!empty($_POST['ward_id']))): ?>
                        <h4>ওয়ার্ড : <?php echo e($_POST['ward_id']); ?></h4>
                        <?php endif; ?>
                    </div>
                    
                    <form action="<?php echo e(route('admin.reports.union_report')); ?>" method="post" class="d-print-none">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <?php if(($userInfo->privilege != 'user')): ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()"
                                            class="form-control" data-live-search="true">
                                        <option value="" selected>জেলা নির্বাচন করুন</option>
                                        <option value="39">সুনামগঞ্জ</option>
                                        <option value="45">কিশোরগঞ্জ</option>
                                        <option value="62">ময়মনসিংহ</option>
                                        <option value="64">নেত্রকোণা</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()"
                                            class="form-control" data-live-search="true">
                                        <option value="" selected>উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control"
                                            data-live-search="true">
                                        <option value="" selected>ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            <?php else: ?>
                                <input type="hidden" name="district_id" value="<?php echo e($userInfo->district_id); ?>" id="districtId">
                                <input type="hidden" name="upazila_id" value="<?php echo e($userInfo->upazila_id); ?>" id="upazilaId">
                                <input type="hidden" name="union_id" value="<?php echo e($userInfo->union_id); ?>" id="unionId">
                            <?php endif; ?>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="ward_id" id="wardId" onchange="getMemberWardWiseFn()" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>ওয়ার্ড নির্বাচন করুন</option>
                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" ><?php echo e($value->name_bn); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            
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
                    
                    <hr class="mt-0 border-primary print_hide">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DataTable">
                            <thead>
                                <tr>
                                    <th>ক্র.নং</th>
                                    <th>বাড়ির মালিকের নাম</th>
                                    <th>পিতা/স্বামীর নাম</th>
                                    <th>ওয়ার্ড নং / হোল্ডিং নং</th>
                                    <th>গ্রামের নাম</th>
                                    <th>সম্পদের বিবরণ</th>
                                    <th>ঘরের বার্ষিক মূল্যায়ণ</th>
                                    <th>বার্ষিক করের পরিমাণ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php ($totalAmount = 0); ?>
                                <?php if(!empty($results) && $results->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php ($totalAmount += $row->taxes); ?>
                                    <?php ($ward = $wards->where('id', $row->ward_id)->first()); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e(++$key); ?></td>
                                        <td><?php echo e($row->householder); ?></td>
                                        <td><?php echo e($row->father_name); ?></td>
                                        <td><?php echo e($ward->name_bn); ?> / <?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                                        <td><?php echo e($row->village); ?></td>
                                        <td><?php echo e(numberFilter($row->estimated_value,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->annual_assessment,'bn')); ?></td>
                                        <td><?php echo e(numberFilter($row->taxes,'bn')); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right">মোট </th>
                                    <th><?php echo e(numberFilter($totalAmount,'bn')); ?> টাকা</th>
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

<?php $__env->startPush('header-style'); ?>
    <style>
        .repot_header h2, .repot_header h4,
        .repot_header p {margin: 0;}
        .repot_header {
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
<?php $__env->stopPush(); ?>

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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/reports/union_report.blade.php ENDPATH**/ ?>