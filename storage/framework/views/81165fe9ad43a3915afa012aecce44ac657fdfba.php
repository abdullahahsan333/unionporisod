<?php $__env->startSection('content'); ?>
    <!-- body container start -->
    <?php ($siteInfo = settings()); ?>
    <?php ($privilege = Auth::user()->privilege); ?>
    <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
    <div class="body_container">
        <!-- body content start -->
        <div class="body_content">
            <div class="box_wrapper">

                <?php if($privilege != 'super' && !empty($chairman[0])): ?>
                    <div class="dash_box box_8" style="display: flex; padding: 15px;">
                        <div class="part2">
                            <img style="max-width: 100px; width: 100px;" src="<?php echo e((!empty($chairman[0]) ? asset($chairman[0]->chairman_image) : '')); ?>" alt="Image Not Found!">
                        </div>
                        <div class="part1">
                            <h2><?php echo e((!empty($chairman[0]) ? $chairman[0]->chairman : '')); ?></h2>
                            <h3>চেয়ারম্যান</h3>
                        </div>
                    </div>

                    <div class="dash_box box_12" style="display: flex; padding: 15px;">
                        <div class="part2">
                            <img style="max-width: 100px; width: 100px;" src="<?php echo e((!empty($chairman[0]) ? asset($chairman[0]->minister_image) : '')); ?>" alt="Image Not Found!">
                        </div>
                        <div class="part1">
                            <h2><?php echo e((!empty($chairman[0]) ? $chairman[0]->minister : '')); ?></h2>
                            <h3>সচিব</h3>
                        </div>
                    </div>
                    <div class="dash_box" >
                        &nbsp;
                    </div>
                    <div class="dash_box" >
                        &nbsp;
                    </div>
                <?php endif; ?>
            </div>
            <div class="box_wrapper">
                <?php if($privilege != 'user'): ?>
                    <?php if( ($privilege == 'super') || (!empty($accessList->dashboard->submenu->total_upazila) && $accessList->dashboard->submenu->total_upazila=="total_upazila")): ?>
                    <div class="dash_box box_1">
                        <h2>মোট উপজেলা</h2>
                        <h3><?php echo e(numberFilter($allUpazila,'bn')); ?></h3>
                    </div>
                    <?php endif; ?>
                    <?php if( ($privilege == 'super') || (!empty($accessList->dashboard->submenu->total_union) && $accessList->dashboard->submenu->total_union=="total_union")): ?>
                    <div class="dash_box box_2">
                        <h2>মোট ইউনিয়ন</h2>
                        <h3><?php echo e(numberFilter($allUnion,'bn')); ?></h3>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="dash_box box_3">
                    <h2>মোট খানা সদস্য</h2>
                    <h3><?php echo e(numberFilter($allMember,'bn')); ?> জন</h3>
                </div>

                <div class="dash_box box_4">
                    <h2>মোট ধার্য্যকৃত ট্যাক্সের পরিমাণ</h2>
                    <h3><?php echo e(numberFilter($totalTaxes,'bn')); ?> টাকা</h3>
                </div>

                <div class="dash_box box_5">
                    <h2>নিম্নবিত্ত পরিবার</h2>
                    <h3><?php echo e(numberFilter($lowerClass,'bn')); ?> টি</h3>
                </div>

                <div class="dash_box box_6">
                    <h2>মধ্যবিত্ত পরিবার</h2>
                    <h3><?php echo e(numberFilter($middleClass,'bn')); ?> টি</h3>
                </div>
                <div class="dash_box box_7">
                    <h2>উচ্চবিত্ত পরিবার</h2>
                    <h3><?php echo e(numberFilter($upplerClass,'bn')); ?> টি</h3>
                </div>
                <div class="dash_box box_8">
                    <h2>পুরুষের সংখ্যা</h2>
                    <h3><?php echo e(numberFilter($totalMale,'bn')); ?> জন</h3>
                </div>
                <div class="dash_box box_9">
                    <h2>মহিলার সংখ্যা</h2>
                    <h3><?php echo e(numberFilter($totalFemale,'bn')); ?> জন</h3>
                </div>
                <div class="dash_box box_10">
                    <h2>প্রতিষ্ঠানের সংখ্যা</h2>
                    <h3><?php echo e(numberFilter($allBazarMember,'bn')); ?> জন</h3>
                </div>
                <div class="dash_box box_12">
                    <h2>পেশা ভিত্তির উপর কর</h2>
                    <h3><?php echo e(numberFilter($allBazarMemberTax,'bn')); ?> টাকা</h3>
                </div>


                <?php if($privilege == 'user'): ?>
                    <?php if(!empty($wards)): ?>
                    <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.member', ['wno' => strEncode($value->ward_id)])); ?>" title="<?php echo e($value->name_bn); ?>">
                        <div class="dash_box box_<?php echo e($key+1); ?>">
                            <h2><?php echo e($value->name_bn); ?></h2>
                            <h3><?php echo e(numberFilter($value->total_member,'bn')); ?></h3>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>
                
            </div>
            
            <?php if($socialSecurityBGD->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityBGD[0]->social_act_name) ? $socialSecurityBGD[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesBGD = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityBGD; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesBGD += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesBGD,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityBGF->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityBGF[0]->social_act_name) ? $socialSecurityBGF[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesBGF = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityBGF; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesBGF += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesBGF,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityOld->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityOld[0]->social_act_name) ? $socialSecurityOld[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesOld = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityOld; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesOld += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesOld,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityMother->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityMother[0]->social_act_name) ? $socialSecurityMother[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesMother = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityMother; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesMother += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesMother,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityWidow->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityWidow[0]->social_act_name) ? $socialSecurityWidow[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesWidow = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityWidow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesWidow += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesWidow,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityDisability->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityDisability[0]->social_act_name) ? $socialSecurityDisability[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesDisability = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityDisability; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesDisability += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesDisability,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityFreedom->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityFreedom[0]->social_act_name) ? $socialSecurityFreedom[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesFreedom = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityFreedom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesFreedom += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesFreedom,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityPregnant->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityPregnant[0]->social_act_name) ? $socialSecurityPregnant[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesPregnant = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityPregnant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesPregnant += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesPregnant,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($socialSecurityOther->isNotEmpty()): ?>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center"><?php echo e((!empty($socialSecurityOther[0]->social_act_name) ? $socialSecurityOther[0]->social_act_name : "")); ?></h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesOther = 0.00; ?>
                        <?php $__currentLoopData = $socialSecurityOther; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalTaxesOther += $row->taxes; ?>
                        <tr>
                            <td><?php echo e(numberFilter($key+1,'bn')); ?></td>
                            <td><?php echo e(numberFilter($row->holding_no,'bn')); ?></td>
                            <td>
                                <?php echo e($row->householder); ?> - (<?php echo e(numberFilter($row->mobile_no,'bn')); ?>)
                            </td>
                            <td><?php echo e($row->father_name); ?></td>
                            <td> <?php echo e(numberFilter($row->taxes,'bn')); ?> টাকা</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th><?php echo e(numberFilter($totalTaxesOther,'bn')); ?> টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <!--<div class="footer_copy_right text-center">
                <p><?php echo e($siteInfo->copy_right); ?></p>
            </div>-->

        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-style'); ?>
<style>
    .footer_copy_right {background: #F5F7FA; position: fixed; bottom: 0; right: 0; width: 100%;}
    .footer_copy_right p {margin: 10px 0 !important; font-weight: bold;}
    .part1 {width: 75%; padding-top: 20px;}
    .part2 {width: 25%;}
</style>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/dashboard.blade.php ENDPATH**/ ?>