<!-- body nav start -->
<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()->privilege); ?>
<div class="body_nav">
    <ul>
        <?php if(accessPrivilege("tax_collection","add_tax","")): ?>
        <li><a class="addTaxCollection" href="<?php echo e(route('admin.tax-collection.create')); ?>">খানা সদস্য কর-সংগ্রহ করুন</a></li>
        <?php endif; ?>
        
        <?php if(accessPrivilege("tax_collection","bazar_tax","")): ?>
        <li><a class="bazarTaxCollection" href="<?php echo e(route('admin.tax-collection.bazar')); ?>">বাজারের সদস্য কর-সংগ্রহ করুন</a></li>
        <?php endif; ?>
        
        <?php if(accessPrivilege("tax_collection","all_tax","")): ?>
        <li><a class="allTaxCollection" href="<?php echo e(route('admin.tax-collection')); ?>">সকল কর দেখুন</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/tax-collection/nav.blade.php ENDPATH**/ ?>