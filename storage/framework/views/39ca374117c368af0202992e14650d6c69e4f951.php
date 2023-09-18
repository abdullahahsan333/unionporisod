<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>
<div class="body_nav">
    <ul>
        <?php if( ($privilege == 'super') || (!empty($accessList->trade_license->submenu->add_trade) && $accessList->trade_license->submenu->add_trade == "add_trade")): ?>
        <li><a class="add_trade" href="<?php echo e(route('admin.trade_license.create')); ?>">নতুন ট্রেড লাইসেন্স যোগ করুন</a></li>
        <?php endif; ?>
        <?php if( ($privilege == 'super') || ( !empty($accessList->trade_license->submenu->all_trade) && $accessList->trade_license->submenu->all_trade == "all_trade")): ?>
        <li><a class="all_trade" href="<?php echo e(route('admin.trade_license')); ?>" >সকল ট্রেড লাইসেন্স</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start --><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/trade_license/nav.blade.php ENDPATH**/ ?>