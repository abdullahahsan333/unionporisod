<!DOCTYPE html>
<html lang="en">
<head>
    <?php ($siteInfo = settings()); ?>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Panel</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.png">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- include style -->
    <link rel="stylesheet" href="<?php echo e(asset('backend')); ?>/style/credential.css">
    <style>
        .mt-15 {margin-top: 15px;}
    </style>
</head>

<body>
<section class="credential_section">
    <div class="section_cover">
        <div class="credential_div">
            <div class="form_box">
                <?php if(Session::has('warning')): ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Warning!</h4>
                        <p><?php echo e(Session::get('warning')); ?></p>
                    </div>

                <?php endif; ?>

                <h2>Login <span></span></h2>
                <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form_group">
                        <input type="text" name="username" class="form_control" placeholder="Username" autocomplete="off" autofocus>
                    </div>
                    <div class="form_group">
                        <input type="password" name="password" class="form_control" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form_group form-remeber">
                        <div class="form-check">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#">Forgot password</a>
                    </div>
                    <button type="submit" class="submit_btn">Login</button>
                </form>
                <a style="width: 100%;" href="<?php echo e(asset('backend')); ?>/app/amaruptax.apk" class="btn btn-danger" download>Download Mobile App ! Click Here</a>
            </div>
        </div>
        
        <div class="company_title">
            <div class="container_box">
                <div class="company_brand">
                    <img src="<?php echo e(asset($siteInfo->logo)); ?>" alt="">
                    <h3><?php echo e($siteInfo->site_name); ?></h3>
                </div>
                <div class="company_info">
                    <div class="info" style="border-bottom: none;">
                        <!--<h5>Mymensingh Office</h5>-->
                        <h6 style="color: #fff;"><strong>সফটওয়্যারের </strong> মাধ্যমে ডিজিটাল এসেসমেন্ট ও হোল্ডিং ট্যাক্স আদায় করা হয় । </h6>
                        <p>ঠিকানাঃ <?php echo e($siteInfo->address); ?></p>
                        <p>মোবাইলঃ <?php echo e($siteInfo->mobile); ?></p>
                        <p>ই-মেইলঃ <?php echo e($siteInfo->email); ?></p>
                        <!--<?php echo e($siteInfo->youtube); ?> <?php echo e($siteInfo->facebook); ?> <?php echo e($siteInfo->twitter); ?>-->
                    </div>
                    
                    <!--<div class="info">-->
                    <!--    <h5>Khulna Office</h5>-->
                    <!--    <p>219, Maheswar Pasha Main Road, KUET, Khulna</p>-->
                    <!--    <p>Mobile : 01937476716</p>-->
                    <!--</div>-->
                </div>
                <!--<div class="payment_method">-->
                <!--    <div class="payment_info">-->
                <!--        <h4><img src="images/icon/bkash.png" alt=""> Bkash</h4>-->
                <!--        <p><i class="icon ion-ios-arrow-dropright-circle"></i> 01839 973100 (Personal)</p>-->
                <!--        <p><i class="icon ion-ios-arrow-dropright-circle"></i> 01937 476716 (Personal)</p>-->
                <!--    </div>-->
                <!--    <div class="payment_info">-->
                <!--        <h4><img src="images/icon/rocket.png" alt=""> Rocket</h4>-->
                <!--        <p><i class="icon ion-ios-arrow-dropright-circle"></i> 01937 476716 (Personal)</p>-->
                <!--    </div>-->
                <!--    <div class="payment_info">-->
                <!--        <h4><img src="images/icon/dbbl.png" alt=""> DBBL Bank</h4>-->
                <!--        <p><i class="icon ion-ios-arrow-dropright-circle"></i> A/C Name : Freelance IT Lab</p>-->
                <!--        <p><i class="icon ion-ios-arrow-dropright-circle"></i> A/C No : 156. 110. 10965</p>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/login.blade.php ENDPATH**/ ?>