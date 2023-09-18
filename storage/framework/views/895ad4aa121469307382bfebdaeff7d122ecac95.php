<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <?php if( ($privilege == 'super') || (!empty($accessList->chairman->submenu->add_chairman) && $accessList->chairman->submenu->add_chairman == "add_chairman")): ?>
        <li><a class="addChairman" href="<?php echo e(route('admin.chairman.create')); ?>">নতুন চেয়ারম্যান</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || ( !empty($accessList->chairman->submenu->all_chairman) && $accessList->chairman->submenu->all_chairman == "all_chairman")): ?>
        <li><a class="allChairman" href="<?php echo e(route('admin.chairman')); ?>" >সব দেখুন</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/chairman/nav.blade.php ENDPATH**/ ?>