<?php $__env->startSection('content'); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($siteInfo = settings()); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <!-- body container start -->
    <div class="body_container">

    <?php echo $__env->make('user.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল ইউজার</h4>
                    <a href="#" id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <div class="table-responsive">
                        <table class="table table-bordered list-table">
                            <thead>
                            <tr>
                                <th width="30">ক্রঃ নং</th>
                                <th width="60">ছবি</th>
                                <th>নাম</th>
                                <th>মোবাইল</th>
                                <th>ঠিকানা</th>
                                
                                <th>জেলা</th>
                                <th>উপজেলা</th>
                                <th>ইউনিয়ন</th>
                                
                                <th>ব্যবহারকারী</th>
                                <th>ইউজারনেম</th>
                                <th>প্রিভিলেজ</th>
                                <th class="text-right print_hide" width="100">একশন</th>
                            </tr>
                            </thead>

                            <?php if(!empty($results) && $results->isNotEmpty()): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php ($district = $districts->where('id', $row->district_id)->first()); ?>
                                <?php ($upazila  = $upazilas->where('id', $row->upazila_id)->first()); ?>
                                <?php ($union    = $unions->where('id', $row->union_id)->first()); ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td class="img">
                                            <img src="<?php echo e(asset($row->avatar)); ?>" alt="">
                                        </td>
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->mobile); ?></td>
                                        <td><?php echo e($row->address); ?></td>
                                        
                                        <td><?php echo e((!empty($district) ? $district->bn_name : " ")); ?></td>
                                        <td><?php echo e((!empty($upazila) ? $upazila->bn_name : " ")); ?></td>
                                        <td><?php echo e((!empty($union) ? $union->bn_name : " ")); ?></td>
                                        
                                        <td><?php echo e((!empty($row->user_type) ? strFilter($row->user_type) : "")); ?></td>
                                        <td><?php echo e($row->username); ?></td>
                                        <td><?php echo e(strFilter($row->privilege)); ?></td>
                                        <td class="operation_btn text-right print_hide">
                                            <?php if( ($privilege == 'super') || (!empty($accessList->user->submenu->action->view) && $accessList->user->submenu->action->view == "view")): ?>
                                            <a href="<?php echo e(route('admin.user.show', strEncode($row->id))); ?>" class="view" title="দেখুন">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php if( ($privilege == 'super') || (!empty($accessList->user->submenu->action->delete) && $accessList->user->submenu->action->delete == "delete")): ?>
                                            <a href="<?php echo e(route('admin.user.destroy', $row->id)); ?>" onclick="return confirm('Do you want to delete this data?')" class="delete" title="ডিলিট করুন">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/style/profile.css">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/user/index.blade.php ENDPATH**/ ?>