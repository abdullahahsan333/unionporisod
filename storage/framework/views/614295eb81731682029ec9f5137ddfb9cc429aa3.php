<?php if(accessPrivilege("affidavit","","")): ?>
<!-- body nav start -->
<div class="body_nav">
    <ul>
        <?php if(accessPrivilege("affidavit","new_affidavit","")): ?>
        <li><a class="newAffidavit" href="<?php echo e(route('admin.affidavit.new_affidavit')); ?>">১ম প্রত্যয়ন পত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","add_affidavit","")): ?>
        <li><a class="addAffidavit" href="<?php echo e(route('admin.affidavit.create')); ?>">২য় নাগরিকত্ব সনদপত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","inheritance_certificate","")): ?>
        <li><a class="inheritanceCertificate" href="<?php echo e(route('admin.affidavit.inheritance')); ?>">৩য় উত্তরাধিকার সনদপত্র</a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","family_certificate","")): ?>
        <li><a class="familyCertificate" href="<?php echo e(route('admin.affidavit.family')); ?>">৪র্থ পারিবারিক সনদপত্র</a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","unmarried_certificate","")): ?>
        <li><a class="unmarriedCertificate" href="<?php echo e(route('admin.affidavit.unmarried')); ?>">৫ম অবিবাহিত সনদপত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","married_certificate","")): ?>
        <li><a class="marriedCertificate" href="<?php echo e(route('admin.affidavit.married')); ?>">৬ষ্ঠ বিবাহিত সনদপত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","income_certificate","")): ?>
        <li><a class="incomeCertificate" href="<?php echo e(route('admin.affidavit.income')); ?>">৭ম বার্ষিক আয় সনদপত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","carecture_certificate","")): ?>
        <li><a class="carectureCertificate" href="<?php echo e(route('admin.affidavit.carecture')); ?>">৮ম চারিত্রিক সনদপত্র </a></li>
        <?php endif; ?>

        <?php if(accessPrivilege("affidavit","all_affidavit","")): ?>
        <li><a class="allAffidavit" href="<?php echo e(route('admin.affidavit')); ?>" >সকল সনদপত্র</a></li>
        <?php endif; ?>
    </ul>
</div>
<!-- body nav start -->
<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/affidavit/nav.blade.php ENDPATH**/ ?>