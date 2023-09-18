<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <!--<?php if(Auth::user()->privilege == 'super'): ?>
        <li><a class="addMember" href="<?php echo e(route('admin.bazar_member.create')); ?>">Add Member</a></li>
        <?php endif; ?>-->
        
        <?php if( ($privilege == 'super') || (!empty($accessList->bazar_member->submenu->new_member) && $accessList->bazar_member->submenu->new_member == "new_member")): ?>
        <li><a class="addMember" href="<?php echo e(route('admin.bazar_member.create')); ?>">নতুন সদস্য</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || ( !empty($accessList->bazar_member->submenu->all_member) && $accessList->bazar_member->submenu->all_member == "all_member")): ?>
        <li><a class="allMember" href="<?php echo e(route('admin.bazar_member')); ?>" >সকল সদস্য</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/bazar_member/nav.blade.php ENDPATH**/ ?>