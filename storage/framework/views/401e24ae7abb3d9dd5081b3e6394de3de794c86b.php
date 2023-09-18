<?php $__env->startPush('header-style'); ?>
<style>
    .print_header {
        border-bottom: 1px solid #ccc;
        align-items: flex-start;
        display: flex;
        margin-bottom: 15px;
        padding-bottom: 10px;
    }
    .print_header .header_logo {margin-right: 20px;}
    .print_header .header_logo img {width: 110px;}
    .print_header .wordLogo_box h2 {
        font-weight: bold;
        font-size: 42px;
        margin: 0;
        text-transform: uppercase;
    }
    .print_header .wordLogo_box {
        border-bottom: 8px solid red;
        border-right: 8px solid #000;
        border-left: 8px solid #000;
        border-top: 8px solid red;
        height: calc(100% - 12px);
        width: auto;
        display: flex;
        margin-top: 5px;
        padding: 10px 5px;
        text-align: center;
        align-items: center;
    }
    .print_header_info {
        padding-right: 110px;
        text-align: center;
        width: 100%;
    }
    .print_header_info h3 {
        font-weight: bold;
        font-size: 42px;
        margin-top: 0;
    }
    .print_header_info p strong {
        display: inline-block;
        min-width: 70px;
        font-weight: 600;
    }
    .print_header_info p {
        font-size: 16px;
        margin: 3px 0;
        color: #000;
    }
    .print_header img {
        max-width: 220px;
        width: auto;
    }
</style>
<?php $__env->stopPush(); ?>

<?php ($siteInfo = settings()); ?>
<?php ($privilege = Auth::user()); ?>
<?php ($district = $districts->where('id', $privilege->district_id)->first()); ?>
<?php ($upazila  = $upazilas->where('id', $privilege->upazila_id)->first()); ?>
<?php ($union    = $unions->where('id', $privilege->union_id)->first()); ?>

<div class="print_header print_flex_only">
    <div class="header_logo">
        <?php if(!empty($siteInfo->logo)): ?>
        <img src="<?php echo e(asset($siteInfo->logo)); ?>" alt="Logo">
        <?php else: ?>
        <div class="wordLogo_box">
            <h2 id="wordLogo"></h2>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="print_header_info">
        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
        <h2><?php echo e($union->bn_name); ?> ইউনিয়ন পরিষদ কার্যালয়</h2>
        <h4><?php echo e($upazila->bn_name); ?>, <?php echo e($district->bn_name); ?>।</h4>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/components/print.blade.php ENDPATH**/ ?>