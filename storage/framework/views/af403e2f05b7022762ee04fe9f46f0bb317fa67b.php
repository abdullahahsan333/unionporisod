<?php $__env->startSection('content'); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($siteInfo = settings()); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <!-- body container start -->
    <div class="body_container">
        <?php echo $__env->make('chairman.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল চেয়ারম্যান ও সচিব </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <?php echo $__env->make('components.print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="<?php echo e(route('admin.chairman')); ?>" method="post" class="print_hide">
                        <?php echo csrf_field(); ?>
                        <div class="row">
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
                            <?php endif; ?>
                            
                            <div class="col-md-3">
                                <input type="text" name="chairman" placeholder="চেয়ারম্যানের নাম" class="form-control" >
                            </div>
                            
                            <div class="col-md-3" <?php if($userInfo->privilege != 'user') { echo "style='margin-top: 15px;'"; } ?> >
                                <input type="text" name="minister" placeholder="সচিবের নাম" class="form-control" >
                            </div>
                            
                            <div class="col-md-1" <?php if($userInfo->privilege != 'user') { echo "style='margin-top: 15px;'"; } ?> >
                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn" name="show">খুজুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mt-0 border-primary print_hide">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered list-table" id="DataTable">
                            <thead>
                            <tr>
                                <th style="width: 30px;">ক্র.নং</th>
                                <th>তারিখ</th>
                                <th>চেয়ারম্যানের নাম</th>
                                <th>চেয়ারম্যানের ছবি</th>
                                <th>সচিবের নাম</th>
                                <th>সচিবের ছবি</th>
                                <th>ঠিকানা</th>
                                <th style="width: 105px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($results)): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($row->created); ?></td>
                                        <td><?php echo e($row->chairman); ?></td>
                                        <td><img style="max-width: 50px; max-height: 50px;" src="<?php echo e(asset($row->chairman_image)); ?>" alt="Chairman Image"></td>
                                        <td><?php echo e($row->minister); ?></td>
                                        <td><img style="max-width: 50px; max-height: 50px;" src="<?php echo e(asset($row->minister_image)); ?>" alt="Minister Image"></td>
                                        <td>
                                            <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                            <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                            <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>

                                            <?php echo e((!empty($union) ? $union->bn_name : " ")); ?>,
                                            <?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?>,
                                            <?php echo e((!empty($district) ? $district->bn_name : " ")); ?>

                                        </td>
                                        <td class="operation_btn text-right print_hide">
                                            <?php //if(($privilege == 'super') ||  (!empty($accessList->chairman->submenu->action->edit) && $accessList->chairman->submenu->action->edit == "edit")) { ?>
                                            <a href="<?php echo e(route('admin.chairman.edit', $row->id)); ?>" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <?php //}
                                            //if(($privilege == 'super') ||  (!empty($accessList->chairman->submenu->action->delete) && $accessList->chairman->submenu->action->delete == "delete")) { ?>
                                            <a href="<?php echo e(route('admin.chairman.destroy', $row->id)); ?>" onclick="return confirm('Do you want to delete this data?')" class="delete" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                            <?php //} ?>
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
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/chairman/index.blade.php ENDPATH**/ ?>