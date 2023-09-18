<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <!--<?php if(Auth::user()->privilege == 'super'): ?>
        <li><a class="addMember" href="<?php echo e(route('admin.member.create')); ?>">Add Member</a></li>
        <?php endif; ?>-->
        
        <?php if( ($privilege == 'super') || (!empty($accessList->notice->submenu->add_notice) && $accessList->notice->submenu->add_notice == "add_notice")): ?>
        <li><a class="addNotice" href="<?php echo e(route('admin.notice.create')); ?>">নতুন নোটিশ</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || ( !empty($accessList->notice->submenu->all_notice) && $accessList->notice->submenu->all_notice == "all_notice")): ?>
        <li><a class="allNotice" href="<?php echo e(route('admin.notice')); ?>" >সকল নোটিশ</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/notice/nav.blade.php ENDPATH**/ ?>