<?php $__env->startSection('content'); ?>

<!-- body container start -->
<div class="body_container">
    <!-- body content start -->
    <div class="body_content">
        <div class="panel_container">
            <div class="panel_heading">
                <h4>প্রিভিলেজ</h4>
            </div>
            <div class="panel_body privilege_content">
                <form action="<?php echo e(route('admin.privilege')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php ($privilege = Auth::user()->privilege); ?>
                    <div class="form-row print_hide">

                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="privilege" id="setPrivilege" class="form-control">
                                    <option value="" selected> প্রিভিলেজ নির্বাচন করুন </option>
                                    <?php if(($privilege == 'super')): ?>
                                    <option value="admin">এডমিন</option>
                                    <?php endif; ?>
                                    <option value="user">ইউজার</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="user_id" id="userList" class="form-control" data-live-search="true">
                                    <option value="" selected> ইউজার নির্বাচন করুন </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn submit_btn" name="save"> দেখুন </button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr style="margin-top: 0;">
                <div class="table-responsive">
                    <form action="<?php echo e(route('admin.privilege.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="privilege" value="<?php echo (!empty($_POST['privilege']) ? $_POST['privilege'] : ''); ?>" >
                        <input type="hidden" name="user_id" value="<?php echo (!empty($_POST['user_id']) ? $_POST['user_id'] : ''); ?>" >

                        <?php ($siteInfo = settings()); ?>
                        <?php ($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : '')); ?>

                        <?php if(!empty($_POST['privilege'])): ?>
                        <h4 class="text-center">
                            <strong>
                                ইউজারের নামঃ
                                <?php echo (!empty($userName[0]->name) ? $userName[0]->name : ''); ?> -
                                <?php echo (!empty($userName[0]->username) ? $userName[0]->username : ''); ?>
                                (<?php echo (!empty($_POST['privilege']) ? $_POST['privilege'] : ''); ?>)
                            </strong>
                        </h4>
                        <?php endif; ?>
                        <style>
                            .privilege_content .custom-control-input:checked~.custom-control-label::before {background: green !important;}
                        </style>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px;">ক্রনং</th>
                                    <th>মেইন মেনু</th>
                                    <th>সাবমেনু</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(accessPrivilege("dashboard","","")): ?>
                                <tr>
                                    <td class="text-center">০১</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[dashboard][mainmenu]" value="dashboard" <?php echo e((!empty($menuList->dashboard->mainmenu) ? ($menuList->dashboard->mainmenu=="dashboard" ? "checked" : "") : "")); ?>  id="dashboard_checked">
                                            <label class="custom-control-label" for="dashboard_checked">ড্যাশবোর্ড</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if($privilege != 'admin'): ?>
                                            <?php if(accessPrivilege("dashboard","total_upazila","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][total_upazila]" value="total_upazila" <?php echo e((!empty($menuList->dashboard->submenu->total_upazila) ? ($menuList->dashboard->submenu->total_upazila=="total_upazila" ? "checked" : "") : "")); ?> id="total_upazila_checked">
                                                <label class="custom-control-label" for="total_upazila_checked">মোট উপজেলা</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","total_union","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][total_union]" value="total_union" <?php echo e((!empty($menuList->dashboard->submenu->total_union) ? ($menuList->dashboard->submenu->total_union=="total_union" ? "checked" : "") : "")); ?> id="total_union_checked">
                                                <label class="custom-control-label" for="total_union_checked">মোট ইউনিয়ন</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if(accessPrivilege("dashboard","ward_no_1","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_1]" value="ward_no_1" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_1) ? ($menuList->dashboard->submenu->ward_no_1=="ward_no_1" ? "checked" : "") : "")); ?> id="ward_no_1">
                                                <label class="custom-control-label" for="ward_no_1">
                                                    ওয়ার্ড নং - ০১
                                                </label>
                                            </div>
                                            <?php endif; ?>

                                            <?php if(accessPrivilege("dashboard","ward_no_2","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_2]" value="ward_no_2" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_2) ? ($menuList->dashboard->submenu->ward_no_2=="ward_no_2" ? "checked" : "") : "")); ?> id="ward_no_2">
                                                <label class="custom-control-label" for="ward_no_2">
                                                    ওয়ার্ড নং - ০২
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_3","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_3]" value="ward_no_3" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_3) ? ($menuList->dashboard->submenu->ward_no_3=="ward_no_3" ? "checked" : "") : "")); ?> id="ward_no_3">
                                                <label class="custom-control-label" for="ward_no_3">
                                                    ওয়ার্ড নং - ০৩
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_4","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_4]" value="ward_no_4" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_4) ? ($menuList->dashboard->submenu->ward_no_4=="ward_no_4" ? "checked" : "") : "")); ?> id="ward_no_4">
                                                <label class="custom-control-label" for="ward_no_4">
                                                    ওয়ার্ড নং - ০৪
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_5","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_5]" value="ward_no_5" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_5) ? ($menuList->dashboard->submenu->ward_no_5=="ward_no_5" ? "checked" : "") : "")); ?> id="ward_no_5">
                                                <label class="custom-control-label" for="ward_no_5">
                                                    ওয়ার্ড নং - ০৫
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_6","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_6]" value="ward_no_6" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_6) ? ($menuList->dashboard->submenu->ward_no_6=="ward_no_6" ? "checked" : "") : "")); ?> id="ward_no_6">
                                                <label class="custom-control-label" for="ward_no_6">
                                                    ওয়ার্ড নং - ০৬
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_7","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_7]" value="ward_no_7" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_7) ? ($menuList->dashboard->submenu->ward_no_7=="ward_no_7" ? "checked" : "") : "")); ?> id="ward_no_7">
                                                <label class="custom-control-label" for="ward_no_7">
                                                    ওয়ার্ড নং - ০৭
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_8","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_8]" value="ward_no_8" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_8) ? ($menuList->dashboard->submenu->ward_no_8=="ward_no_8" ? "checked" : "") : "")); ?> id="ward_no_8">
                                                <label class="custom-control-label" for="ward_no_8">
                                                    ওয়ার্ড নং - ০৮
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("dashboard","ward_no_9","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[dashboard][submenu][ward_no_9]" value="ward_no_9" <?php echo e((!empty($menuList->dashboard->submenu->ward_no_9) ? ($menuList->dashboard->submenu->ward_no_9=="ward_no_9" ? "checked" : "") : "")); ?> id="ward_no_9">
                                                <label class="custom-control-label" for="ward_no_9">
                                                    ওয়ার্ড নং - ০৯
                                                </label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("member","","")): ?>
                                <tr>
                                    <td class="text-center">০২</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[member][mainmenu]" value="member" <?php echo e((!empty($menuList->member->mainmenu) ? ($menuList->member->mainmenu=="member" ? "checked" : "") : "")); ?> id="member_checked">
                                            <label class="custom-control-label" for="member_checked">সদস্য</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("member","new_member","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[member][submenu][new_member]" value="new_member" <?php echo e((!empty($menuList->member->submenu->new_member) ? ($menuList->member->submenu->new_member=="new_member" ? "checked" : "") : "")); ?> id="new_member_checked">
                                                <label class="custom-control-label" for="new_member_checked">নতুন সদস্য</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("member","all_member","")): ?>
                                            <div class="condition_group">

                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->member->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[member][submenu][all_member]" value="all_member" <?php echo e((!empty($menuList->member->submenu->all_member) ? ($menuList->member->submenu->all_member=="all_member" ? "checked" : "") : "")); ?> id="all_member_checked">
                                                    <label class="custom-control-label" for="all_member_checked">সকল সদস্য</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->member->submenu->action->view) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("member","all_member","view")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[member][submenu][action][view]" <?php echo e((!empty($menuList->member->submenu->action->view) ? ($menuList->member->submenu->action->view=="view" ? "checked" : "") : "")); ?> value="view" id="view_member_checked">
                                                        <label class="custom-control-label" for="view_member_checked">দেখুন</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("member","all_member","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[member][submenu][action][edit]" <?php echo e((!empty($menuList->member->submenu->action->edit) ? ($menuList->member->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> value="edit" id="edit_member_checked">
                                                        <label class="custom-control-label" for="edit_member_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("member","all_member","report")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[member][submenu][action][report]" <?php echo e((!empty($menuList->member->submenu->action->report) ? ($menuList->member->submenu->action->report=="report" ? "checked" : "") : "")); ?> value="report" id="report_member_checked">
                                                        <label class="custom-control-label" for="report_member_checked">ট্যাক্স রিপোট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("member","all_member","taxCollection")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[member][submenu][action][taxCollection]" <?php echo e((!empty($menuList->member->submenu->action->taxCollection) ? ($menuList->member->submenu->action->taxCollection=="taxCollection" ? "checked" : "") : "")); ?> value="taxCollection" id="taxCollection_member_checked">
                                                        <label class="custom-control-label" for="taxCollection_member_checked">কর-সংগ্রহ</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("member","all_member","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[member][submenu][action][delete]" <?php echo e((!empty($menuList->member->submenu->action->delete) ? ($menuList->member->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> value="delete" id="delete_member_checked">
                                                        <label class="custom-control-label" for="delete_member_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("bazar_member","","")): ?>
                                <tr>
                                    <td class="text-center">০৩</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[bazar_member][mainmenu]" value="bazar_member" <?php echo e((!empty($menuList->bazar_member->mainmenu) ? ($menuList->bazar_member->mainmenu=="bazar_member" ? "checked" : "") : "")); ?> id="bazar_member_checked">
                                            <label class="custom-control-label" for="bazar_member_checked">বাজারের সদস্য</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("bazar_member","new_member","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[bazar_member][submenu][new_member]" value="new_member" <?php echo e((!empty($menuList->bazar_member->submenu->new_member) ? ($menuList->bazar_member->submenu->new_member=="new_member" ? "checked" : "") : "")); ?> id="new_member_checked">
                                                <label class="custom-control-label" for="new_member_checked">নতুন সদস্য</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("bazar_member","all_member","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->bazar_member->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[bazar_member][submenu][all_member]" value="all_member" <?php echo e((!empty($menuList->bazar_member->submenu->all_member) ? ($menuList->bazar_member->submenu->all_member=="all_member" ? "checked" : "") : "")); ?> id="all_member_checked">
                                                    <label class="custom-control-label" for="all_member_checked">সকল সদস্য</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->bazar_member->submenu->action->view) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("bazar_member","all_member","view")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[bazar_member][submenu][action][view]" <?php echo e((!empty($menuList->bazar_member->submenu->action->view) ? ($menuList->bazar_member->submenu->action->view=="view" ? "checked" : "") : "")); ?> value="view" id="view_member_checked">
                                                        <label class="custom-control-label" for="view_member_checked">দেখুন</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("bazar_member","all_member","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[bazar_member][submenu][action][edit]" <?php echo e((!empty($menuList->bazar_member->submenu->action->edit) ? ($menuList->bazar_member->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> value="edit" id="edit_member_checked">
                                                        <label class="custom-control-label" for="edit_member_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("bazar_member","all_member","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[bazar_member][submenu][action][delete]" <?php echo e((!empty($menuList->bazar_member->submenu->action->delete) ? ($menuList->bazar_member->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> value="delete" id="delete_member_checked">
                                                        <label class="custom-control-label" for="delete_member_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("tax_collection","","")): ?>
                                <tr>
                                    <td class="text-center">০৪</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[tax_collection][mainmenu]"  value="tax_collection" <?php echo e((!empty($menuList->tax_collection->mainmenu) ? ($menuList->tax_collection->mainmenu=="tax_collection" ? "checked" : "") : "")); ?> id="tax_collection_checked">
                                            <label class="custom-control-label" for="tax_collection_checked">কর-সংগ্রহ</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("tax_collection","add_tax","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[tax_collection][submenu][add_tax]" value="add_tax" <?php echo e((!empty($menuList->tax_collection->submenu->add_tax) ? ($menuList->tax_collection->submenu->add_tax=="add_tax" ? "checked" : "") : "")); ?> id="add_tax_collection_checked">
                                                <label class="custom-control-label" for="add_tax_collection_checked">কর-সংগ্রহ যোগ করুন</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("tax_collection","all_tax","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->tax_collection->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[tax_collection][submenu][all_tax]" value="all_tax" <?php echo e((!empty($menuList->tax_collection->submenu->all_tax) ? ($menuList->tax_collection->submenu->all_tax=="all_tax" ? "checked" : "") : "")); ?> id="all_tax_collection_checked">
                                                    <label class="custom-control-label" for="all_tax_collection_checked">সকল কর-সংগ্রহ</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->tax_collection->submenu->action->edit) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("tax_collection","all_tax","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[tax_collection][submenu][action][edit]" value="edit" <?php echo e((!empty($menuList->tax_collection->submenu->action->edit) ? ($menuList->tax_collection->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> id="edit_tax_collection_checked">
                                                        <label class="custom-control-label" for="edit_tax_collection_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("tax_collection","all_tax","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[tax_collection][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->tax_collection->submenu->action->delete) ? ($menuList->tax_collection->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_tax_collection_checked">
                                                        <label class="custom-control-label" for="delete_tax_collection_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("notice","","")): ?>
                                <tr>
                                    <td class="text-center">০৫</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[notice][mainmenu]"  value="notice" <?php echo e((!empty($menuList->notice->mainmenu) ? ($menuList->notice->mainmenu=="notice" ? "checked" : "") : "")); ?> id="notice_checked">
                                            <label class="custom-control-label" for="notice_checked">ট্যাক্স নোটিশ</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("notice","add_notice","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[notice][submenu][add_notice]" value="add_notice" <?php echo e((!empty($menuList->notice->submenu->add_notice) ? ($menuList->notice->submenu->add_notice=="add_notice" ? "checked" : "") : "")); ?> id="add_notice_checked">
                                                <label class="custom-control-label" for="add_notice_checked">নতুন নোটিশ</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("notice","all_notice","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->notice->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[notice][submenu][all_notice]" value="all_notice" <?php echo e((!empty($menuList->notice->submenu->all_notice) ? ($menuList->notice->submenu->all_notice=="all_notice" ? "checked" : "") : "")); ?> id="all_notice_checked">
                                                    <label class="custom-control-label" for="all_notice_checked">সকল নোটিশ</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->notice->submenu->action->edit) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("notice","all_notice","view")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[notice][submenu][action][view]" value="view" <?php echo e((!empty($menuList->notice->submenu->action->view) ? ($menuList->notice->submenu->action->view=="view" ? "checked" : "") : "")); ?> id="view_notice_checked">
                                                        <label class="custom-control-label" for="view_notice_checked">দেখুন</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("notice","all_notice","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[notice][submenu][action][edit]" value="edit" <?php echo e((!empty($menuList->notice->submenu->action->edit) ? ($menuList->notice->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> id="edit_notice_checked">
                                                        <label class="custom-control-label" for="edit_notice_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("notice","all_notice","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[notice][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->notice->submenu->action->delete) ? ($menuList->notice->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_notice_checked">
                                                        <label class="custom-control-label" for="delete_notice_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("report","","")): ?>
                                <tr>
                                    <td class="text-center">০৬</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[report][mainmenu]" value="report" <?php echo e((!empty($menuList->report->mainmenu) ? ($menuList->report->mainmenu=="report" ? "checked" : "") : "")); ?> id="report_checked">
                                            <label class="custom-control-label" for="report_checked">রিপোর্ট</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("report","tax_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][tax_report]" value="tax_report" <?php echo e((!empty($menuList->report->submenu->tax_report) ? ($menuList->report->submenu->tax_report=="tax_report" ? "checked" : "") : "")); ?> id="tax_report_checked">
                                                <label class="custom-control-label" for="tax_report_checked">সকল ট্যাক্স রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("report","union_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][union_report]" value="union_report" <?php echo e((!empty($menuList->report->submenu->union_report) ? ($menuList->report->submenu->union_report=="union_report" ? "checked" : "") : "")); ?> id="union_report_checked">
                                                <label class="custom-control-label" for="union_report_checked">ইউনিয়ন রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("report","member_wise_tax_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][member_wise_tax_report]" value="member_wise_tax_report" <?php echo e((!empty($menuList->report->submenu->member_wise_tax_report) ? ($menuList->report->submenu->member_wise_tax_report=="member_wise_tax_report" ? "checked" : "") : "")); ?> id="member_wise_tax_report_checked">
                                                <label class="custom-control-label" for="member_wise_tax_report_checked">সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("report","bazar_member_wise_tax_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][bazar_member_wise_tax_report]" value="bazar_member_wise_tax_report" <?php echo e((!empty($menuList->report->submenu->bazar_member_wise_tax_report) ? ($menuList->report->submenu->bazar_member_wise_tax_report=="bazar_member_wise_tax_report" ? "checked" : "") : "")); ?> id="bazar_member_wise_tax_report_checked">
                                                <label class="custom-control-label" for="bazar_member_wise_tax_report_checked">বাজার সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("report","ward_wise_tax_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][ward_wise_tax_report]" value="ward_wise_tax_report" <?php echo e((!empty($menuList->report->submenu->ward_wise_tax_report) ? ($menuList->report->submenu->ward_wise_tax_report=="ward_wise_tax_report" ? "checked" : "") : "")); ?> id="ward_wise_tax_report_checked">
                                                <label class="custom-control-label" for="ward_wise_tax_report_checked">ওয়ার্ড ওয়াইজ ট্যাক্স রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("report","daily_tax_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[report][submenu][daily_tax_report]" value="daily_tax_report" <?php echo e((!empty($menuList->report->submenu->daily_tax_report) ? ($menuList->report->submenu->daily_tax_report=="daily_tax_report" ? "checked" : "") : "")); ?> id="daily_tax_report_checked">
                                                <label class="custom-control-label" for="daily_tax_report_checked">দৈনিক ট্যাক্স সংগ্রহ রিপোর্ট</label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("trade_license","","")): ?>
                                <tr>
                                    <td class="text-center">০৭</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[trade_license][mainmenu]"  value="trade_license" <?php echo e((!empty($menuList->trade_license->mainmenu) ? ($menuList->trade_license->mainmenu=="trade_license" ? "checked" : "") : "")); ?> id="trade_license_checked">
                                            <label class="custom-control-label" for="trade_license_checked"> ট্রেড লাইসেন্স </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("trade_license","add_trade","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[trade_license][submenu][add_trade]" value="add_trade" <?php echo e((!empty($menuList->trade_license->submenu->add_trade) ? ($menuList->trade_license->submenu->add_trade=="add_trade" ? "checked" : "") : "")); ?> id="add_trade_checked">
                                                <label class="custom-control-label" for="add_trade_checked">নতুন ট্রেড লাইসেন্স</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("trade_license","all_trade","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->trade_license->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[trade_license][submenu][all_trade]" value="all_trade" <?php echo e((!empty($menuList->trade_license->submenu->all_trade) ? ($menuList->trade_license->submenu->all_trade=="all_trade" ? "checked" : "") : "")); ?> id="all_trade_checked">
                                                    <label class="custom-control-label" for="all_trade_checked">সকল ট্রেড লাইসেন্স</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->trade_license->submenu->action->edit) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("trade_license","all_trade","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[trade_license][submenu][action][edit]" value="edit" <?php echo e((!empty($menuList->trade_license->submenu->action->edit) ? ($menuList->trade_license->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> id="edit_trade_checked">
                                                        <label class="custom-control-label" for="edit_trade_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("trade_license","all_trade","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[trade_license][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->trade_license->submenu->action->delete) ? ($menuList->trade_license->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_trade_checked">
                                                        <label class="custom-control-label" for="delete_trade_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("affidavit","","")): ?>
                                <tr>
                                    <td class="text-center">০৫</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[affidavit][mainmenu]"  value="affidavit" <?php echo e((!empty($menuList->affidavit->mainmenu) ? ($menuList->affidavit->mainmenu=="affidavit" ? "checked" : "") : "")); ?> id="affidavit_checked">
                                            <label class="custom-control-label" for="affidavit_checked">প্রত্যয়ন পত্র</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">

                                            <?php if(accessPrivilege("affidavit","add_affidavit","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][add_affidavit]" value="add_affidavit" <?php echo e((!empty($menuList->notice->submenu->add_affidavit) ? ($menuList->notice->submenu->add_affidavit=="add_affidavit" ? "checked" : "") : "")); ?> id="add_affidavit_checked">
                                                <label class="custom-control-label" for="add_affidavit_checked"> নাগরিকত্ব সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","inheritance_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][inheritance_certificate]" value="inheritance_certificate" <?php echo e((!empty($menuList->notice->submenu->inheritance_certificate) ? ($menuList->notice->submenu->inheritance_certificate=="inheritance_certificate" ? "checked" : "") : "")); ?> id="inheritance_certificate_checked">
                                                <label class="custom-control-label" for="inheritance_certificate_checked"> উত্তরাধিকার সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","family_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][family_certificate]" value="family_certificate" <?php echo e((!empty($menuList->notice->submenu->family_certificate) ? ($menuList->notice->submenu->family_certificate=="family_certificate" ? "checked" : "") : "")); ?> id="family_certificate_checked">
                                                <label class="custom-control-label" for="family_certificate_checked"> পারিবারিক সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","unmarried_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][unmarried_certificate]" value="unmarried_certificate" <?php echo e((!empty($menuList->notice->submenu->unmarried_certificate) ? ($menuList->notice->submenu->unmarried_certificate=="unmarried_certificate" ? "checked" : "") : "")); ?> id="unmarried_certificate_checked">
                                                <label class="custom-control-label" for="unmarried_certificate_checked"> অবিবাহিত সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","married_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][married_certificate]" value="married_certificate" <?php echo e((!empty($menuList->notice->submenu->married_certificate) ? ($menuList->notice->submenu->married_certificate=="married_certificate" ? "checked" : "") : "")); ?> id="married_certificate_checked">
                                                <label class="custom-control-label" for="married_certificate_checked"> বিবাহিত সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","income_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][income_certificate]" value="income_certificate" <?php echo e((!empty($menuList->notice->submenu->income_certificate) ? ($menuList->notice->submenu->income_certificate=="income_certificate" ? "checked" : "") : "")); ?> id="income_certificate_checked">
                                                <label class="custom-control-label" for="income_certificate_checked"> বাষির্ক আয় সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("affidavit","carecture_certificate","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][carecture_certificate]" value="carecture_certificate" <?php echo e((!empty($menuList->notice->submenu->carecture_certificate) ? ($menuList->notice->submenu->carecture_certificate=="carecture_certificate" ? "checked" : "") : "")); ?> id="carecture_certificate_checked">
                                                <label class="custom-control-label" for="carecture_certificate_checked"> চারিত্রিক সনদপত্র </label>
                                            </div>
                                            <?php endif; ?>

                                            <?php if(accessPrivilege("affidavit","all_affidavit","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->affidavit->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][all_affidavit]" value="all_affidavit" <?php echo e((!empty($menuList->affidavit->submenu->all_affidavit) ? ($menuList->affidavit->submenu->all_affidavit=="all_affidavit" ? "checked" : "") : "")); ?> id="all_affidavit_checked">
                                                    <label class="custom-control-label" for="all_affidavit_checked">সকল সনদ পত্র</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->affidavit->submenu->action->edit) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("affidavit","all_affidavit","view")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][action][view]" value="view" <?php echo e((!empty($menuList->affidavit->submenu->action->view) ? ($menuList->affidavit->submenu->action->view=="view" ? "checked" : "") : "")); ?> id="view_affidavit_checked">
                                                        <label class="custom-control-label" for="view_affidavit_checked">দেখুন</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("affidavit","all_affidavit","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][action][edit]" value="edit" <?php echo e((!empty($menuList->affidavit->submenu->action->edit) ? ($menuList->affidavit->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> id="edit_affidavit_checked">
                                                        <label class="custom-control-label" for="edit_affidavit_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("affidavit","all_affidavit","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[affidavit][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->affidavit->submenu->action->delete) ? ($menuList->affidavit->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_affidavit_checked">
                                                        <label class="custom-control-label" for="delete_affidavit_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("sms","","")): ?>
                                <tr>
                                    <td class="text-center">০৮</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[sms][mainmenu]"  value="sms" <?php echo e((!empty($menuList->sms->mainmenu) ? ($menuList->sms->mainmenu=="sms" ? "checked" : "") : "")); ?> id="sms_checked">
                                            <label class="custom-control-label" for="sms_checked">এসএমএস</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("sms","custom_sms","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[sms][submenu][custom_sms]" value="custom_sms" <?php echo e((!empty($menuList->sms->submenu->custom_sms) ? ($menuList->sms->submenu->custom_sms=="custom_sms" ? "checked" : "") : "")); ?> id="custom_sms_checked">
                                                <label class="custom-control-label" for="custom_sms_checked">কাস্টম এসএমএস</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("sms","send_sms","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[sms][submenu][send_sms]" value="send_sms" <?php echo e((!empty($menuList->sms->submenu->send_sms) ? ($menuList->sms->submenu->send_sms=="send_sms" ? "checked" : "") : "")); ?> id="send_sms_checked">
                                                <label class="custom-control-label" for="send_sms_checked">সেন্ড এসএমএস</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("sms","sms_report","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[sms][submenu][sms_report]" value="sms_report" <?php echo e((!empty($menuList->sms->submenu->sms_report) ? ($menuList->sms->submenu->sms_report=="sms_report" ? "checked" : "") : "")); ?> id="sms_report_checked">
                                                <label class="custom-control-label" for="sms_report_checked">সেন্ড এসএমএস</label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if(accessPrivilege("chairman","","")): ?>
                                <tr>
                                    <td class="text-center">০৯</td>
                                    <td>
                                        <div class="custom-control custom-switch main_menu">
                                            <input type="checkbox" class="custom-control-input" name="menu[chairman][mainmenu]"  value="chairman" <?php echo e((!empty($menuList->chairman->mainmenu) ? ($menuList->chairman->mainmenu=="chairman" ? "checked" : "") : "")); ?> id="chairman_checked">
                                            <label class="custom-control-label" for="chairman_checked">চেয়ারম্যান ও সচিব</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="group_menu">
                                            <?php if(accessPrivilege("chairman","add_chairman","")): ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="menu[chairman][submenu][add_chairman]" value="add_chairman" <?php echo e((!empty($menuList->chairman->submenu->add_chairman) ? ($menuList->chairman->submenu->add_chairman=="add_chairman" ? "checked" : "") : "")); ?> id="add_chairman_checked">
                                                <label class="custom-control-label" for="add_chairman_checked">নতুন যোগ করুন</label>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(accessPrivilege("chairman","all_chairman","")): ?>
                                            <div class="condition_group">
                                                <div class="custom-control custom-switch <?php echo e((!empty($menuList->chairman->submenu->action->view) ? 'open' : '')); ?>">
                                                    <input type="checkbox" class="custom-control-input" name="menu[chairman][submenu][all_chairman]" value="all_chairman" <?php echo e((!empty($menuList->chairman->submenu->all_chairman) ? ($menuList->chairman->submenu->all_chairman=="all_chairman" ? "checked" : "") : "")); ?> id="all_chairman_checked">
                                                    <label class="custom-control-label" for="all_chairman_checked">সব দেখুন</label>
                                                </div>
                                                <div class="condition_btn <?php echo e((!empty($menuList->chairman->submenu->action->edit) ? 'open' : '')); ?>">
                                                    <?php if(accessPrivilege("chairman","all_chairman","edit")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[chairman][submenu][action][edit]" value="edit" <?php echo e((!empty($menuList->chairman->submenu->action->edit) ? ($menuList->chairman->submenu->action->edit=="edit" ? "checked" : "") : "")); ?> id="edit_chairman_checked">
                                                        <label class="custom-control-label" for="edit_chairman_checked">এডিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(accessPrivilege("chairman","all_chairman","delete")): ?>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="menu[chairman][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->chairman->submenu->action->delete) ? ($menuList->chairman->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_chairman_checked">
                                                        <label class="custom-control-label" for="delete_chairman_checked">ডিলিট</label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if($privilege != 'user'): ?>
                                    <?php if(accessPrivilege("user","","")): ?>
                                    <tr>
                                        <td class="text-center">১০</td>
                                        <td>
                                            <div class="custom-control custom-switch main_menu">
                                                <input type="checkbox" class="custom-control-input" name="menu[user][mainmenu]" value="user" <?php echo e((!empty($menuList->user->mainmenu) ? ($menuList->user->mainmenu=="user" ? "checked" : "") : "")); ?> id="user_checked">
                                                <label class="custom-control-label" for="user_checked">ইউজার</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="group_menu">
                                                <?php if(accessPrivilege("user","add_user","")): ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="menu[user][submenu][add_user]" value="add_user" <?php echo e((!empty($menuList->user->submenu->add_user) ? ($menuList->user->submenu->add_user=="add_user" ? "checked" : "") : "")); ?> id="add_user_checked">
                                                    <label class="custom-control-label" for="add_user_checked"> নতুন ইউজার </label>
                                                </div>
                                                <?php endif; ?>
                                                <?php if(accessPrivilege("user","all_user","")): ?>
                                                <div class="condition_group">
                                                    <div class="custom-control custom-switch <?php echo e((!empty($menuList->user->submenu->action->view) ? 'open' : '')); ?>">
                                                        <input type="checkbox" class="custom-control-input" name="menu[user][submenu][all_user]" value="all_user" <?php echo e((!empty($menuList->user->submenu->all_user) ? ($menuList->user->submenu->all_user=="all_user" ? "checked" : "") : "")); ?> id="all_user_checked">
                                                    <label class="custom-control-label" for="all_user_checked"> সকল ইউজার </label>
                                                    </div>
                                                    <div class="condition_btn <?php echo e((!empty($menuList->user->submenu->action->view) ? 'open' : '')); ?>">
                                                        <?php if(accessPrivilege("user","all_user","view")): ?>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="menu[user][submenu][action][view]" value="view" <?php echo e((!empty($menuList->user->submenu->action->view) ? ($menuList->user->submenu->action->view=="view" ? "checked" : "") : "")); ?> id="view_user_checked">
                                                            <label class="custom-control-label" for="view_user_checked">দেখুন</label>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(accessPrivilege("user","all_user","delete")): ?>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="menu[user][submenu][action][delete]" value="delete" <?php echo e((!empty($menuList->user->submenu->action->delete) ? ($menuList->user->submenu->action->delete=="delete" ? "checked" : "") : "")); ?> id="delete_user_checked">
                                                            <label class="custom-control-label" for="delete_user_checked">ডিলিট</label>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php if(accessPrivilege("privilege","","")): ?>
                                    <tr>
                                        <td class="text-center">১১</td>
                                        <td>
                                            <div class="custom-control custom-switch main_menu">
                                                <input type="checkbox" class="custom-control-input" name="menu[privilege][mainmenu]" value="privilege" <?php echo e((!empty($menuList->privilege->mainmenu) ? ($menuList->privilege->mainmenu=="privilege" ? "checked" : "") : "")); ?> id="privilege_checked">
                                                <label class="custom-control-label" for="privilege_checked">প্রিভিলেজ</label>
                                            </div>
                                        </td>
                                        <td> </td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php if(accessPrivilege("settings","","")): ?>
                                    <tr>
                                        <td class="text-center">১২</td>
                                        <td>
                                            <div class="custom-control custom-switch main_menu">
                                                <input type="checkbox" class="custom-control-input" name="menu[settings][mainmenu]" value="settings" <?php echo e((!empty($menuList->settings->mainmenu) ? ($menuList->settings->mainmenu=="settings" ? "checked" : "") : "")); ?> id="settings_checked">
                                                <label class="custom-control-label" for="settings_checked">সেটিংস</label>
                                            </div>
                                        </td>
                                        <td> </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="3">
                                        <div class="text-right">
                                            <button type="submit" class="btn submit_btn" name="save">সেইভ করুন</button>
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel_footer"></div>
        </div>
    </div>
    <!-- body content end -->
</div>
<!-- body container end -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('header-style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/style/privilege.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script>
        // get All User
        $('#setPrivilege').on('change', function(){
            $('#userList').empty();

            var _setPrivilege = $(this).val();
            $.ajax({
                method : "POST",
                url    : "<?php echo e(route('admin.privilege.user-list')); ?>",
                data   : { privilege: _setPrivilege, _token: "<?php echo e(csrf_token()); ?>" }
            }).then(function(response){
                $('#userList').append(response);
                $('#userList').selectpicker('refresh');
                //console.log(response);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\unionprisod\resources\views/privilege.blade.php ENDPATH**/ ?>