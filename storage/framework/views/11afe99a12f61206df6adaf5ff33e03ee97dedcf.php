<!-- body nav start -->

<div class="body_nav">
    <ul>
        <?php if(accessPrivilege("member", "new_member", "")): ?>
        <li><a class="addMember" href="<?php echo e(route('admin.member.create')); ?>">নতুন খানা সদস্য </a></li>
        <?php endif; ?>
        <?php if(accessPrivilege("member", "all_member", "")): ?>
        <li><a class="allMember" href="<?php echo e(route('admin.member')); ?>" >সকল খানা সদস্য </a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/member/nav.blade.php ENDPATH**/ ?>