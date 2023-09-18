<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('admin.login');
});

Auth::routes();

Route::get('login', function () {
    return redirect()->route('admin.login');
});
Route::any('admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::any('register', function () {
    return redirect()->route('admin.login');
});
Route::any('password/confirm', function () {
    return redirect()->route('admin.login');
});
Route::post('password/email', function () {
    return redirect()->route('admin.login');
});
Route::any('password/reset', function () {
    return redirect()->route('admin.login');
});

Route::get('admin/login', [App\Http\Controllers\AccessController::class, 'index'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\AccessController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [App\Http\Controllers\AccessController::class, 'logout'])->name('admin.logout');

Route::prefix('admin/dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
});

// Member route
Route::prefix('admin/member')->group(function () {
    Route::any('/', [App\Http\Controllers\MemberController::class, 'index'])->name('admin.member');
    Route::get('/create', [App\Http\Controllers\MemberController::class, 'create'])->name('admin.member.create');
    Route::post('/store', [App\Http\Controllers\MemberController::class, 'store'])->name('admin.member.store');
    Route::get('/view/{id}', [App\Http\Controllers\MemberController::class, 'view'])->name('admin.member.view');
    Route::get('/view-en/{id}', [App\Http\Controllers\MemberController::class, 'viewEn'])->name('admin.member.view-en');
    Route::get('/edit/{id}', [App\Http\Controllers\MemberController::class, 'edit'])->name('admin.member.edit');
    Route::post('/update', [App\Http\Controllers\MemberController::class, 'update'])->name('admin.member.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\MemberController::class, 'destroy'])->name('admin.member.destroy');

    Route::post('/zilla-name', [App\Http\Controllers\MemberController::class, 'getZillaEn'])->name('admin.member.zilla-name');
    Route::post('/upzilla-name', [App\Http\Controllers\MemberController::class, 'getUpZillaEn'])->name('admin.member.upzilla-name');
    Route::post('/pourashava-name', [App\Http\Controllers\MemberController::class, 'getPourashavaEn'])->name('admin.member.pourashava-name');
    Route::post('/union-name', [App\Http\Controllers\MemberController::class, 'getUnionEn'])->name('admin.member.union-name');
    Route::post('/ward-name', [App\Http\Controllers\MemberController::class, 'getWardEn'])->name('admin.member.ward-name');

    Route::post('/district-list', [App\Http\Controllers\MemberController::class, 'districtList'])->name('admin.member.district-list');
    Route::post('/upazila-list', [App\Http\Controllers\MemberController::class, 'upazilaList'])->name('admin.member.upazila-list');
    Route::post('/union-list', [App\Http\Controllers\MemberController::class, 'unionList'])->name('admin.member.union-list');
    Route::post('/ward-wise-mamber', [App\Http\Controllers\MemberController::class, 'wardWiseMembers'])->name('admin.member.ward-wise-mamber');
    Route::post('/pourashava-list', [App\Http\Controllers\MemberController::class, 'pourashavaList'])->name('admin.member.pourashava-list');

    Route::post('/get-holding-no', [App\Http\Controllers\MemberController::class, 'getHoldingNo'])->name('admin.member.get-holding-no');
    Route::get('/report/{id}', [App\Http\Controllers\MemberController::class, 'report'])->name('admin.member.report');
    Route::get('/affidavit/{id}', [App\Http\Controllers\MemberController::class, 'affidavit'])->name('admin.member.affidavit');
});

// Bazar Member route
Route::prefix('admin/bazar_member')->group(function () {
    Route::any('/', [App\Http\Controllers\BazarMemberController::class, 'index'])->name('admin.bazar_member');
    Route::get('/create', [App\Http\Controllers\BazarMemberController::class, 'create'])->name('admin.bazar_member.create');
    Route::post('/store', [App\Http\Controllers\BazarMemberController::class, 'store'])->name('admin.bazar_member.store');
    Route::get('/view/{id}', [App\Http\Controllers\BazarMemberController::class, 'view'])->name('admin.bazar_member.view');
    Route::get('/edit/{id}', [App\Http\Controllers\BazarMemberController::class, 'edit'])->name('admin.bazar_member.edit');
    Route::post('/update', [App\Http\Controllers\BazarMemberController::class, 'update'])->name('admin.bazar_member.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\BazarMemberController::class, 'destroy'])->name('admin.bazar_member.destroy');
    Route::get('/trade_license/{id}', [App\Http\Controllers\BazarMemberController::class, 'tradeLicense'])->name('admin.bazar_member.trade_license');


    Route::any('/ward-wise-mamber', [App\Http\Controllers\BazarMemberController::class, 'wardWiseMembers'])->name('admin.bazar_member.ward-wise-mamber');
    Route::post('/union-wise-mamber', [App\Http\Controllers\BazarMemberController::class, 'unionWiseMembers'])->name('admin.bazar_member.union-wise-mamber');
});

// Tax Collection route
Route::prefix('admin/tax-collection')->group(function () {
    Route::any('/', [App\Http\Controllers\TaxCollectionController::class, 'index'])->name('admin.tax-collection');
    Route::get('/create/{id?}', [App\Http\Controllers\TaxCollectionController::class, 'create'])->name('admin.tax-collection.create');
    Route::get('/bazar/{id?}', [App\Http\Controllers\TaxCollectionController::class, 'bazar'])->name('admin.tax-collection.bazar');
    Route::post('/store', [App\Http\Controllers\TaxCollectionController::class, 'store'])->name('admin.tax-collection.store');
    Route::get('/view/{id}', [App\Http\Controllers\TaxCollectionController::class, 'view'])->name('admin.tax-collection.view');
    Route::get('/edit/{id}', [App\Http\Controllers\TaxCollectionController::class, 'edit'])->name('admin.tax-collection.edit');
    Route::post('/update', [App\Http\Controllers\TaxCollectionController::class, 'update'])->name('admin.tax-collection.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\TaxCollectionController::class, 'destroy'])->name('admin.tax-collection.destroy');

    Route::post('/find-info/', [App\Http\Controllers\TaxCollectionController::class, 'findInfo'])->name('admin.tax-collection.find-info');
    Route::post('/member-info/', [App\Http\Controllers\TaxCollectionController::class, 'memberInfo'])->name('admin.tax-collection.member-info');
    Route::post('/ward-wise-member/', [App\Http\Controllers\TaxCollectionController::class, 'wardWiseMember'])->name('admin.tax-collection.ward-wise-member');
});


// Sms route
Route::prefix('admin/sms')->group(function () {
	Route::any('/', [App\Http\Controllers\SmsController::class, 'index'])->name('admin.sms');
	Route::any('/send_sms', [App\Http\Controllers\SmsController::class, 'send_sms'])->name('admin.sms.send_sms');
	Route::any('/custom_sms', [App\Http\Controllers\SmsController::class, 'custom_sms'])->name('admin.sms.custom_sms');
	Route::post('/submit-send-sms', [App\Http\Controllers\SmsController::class, 'submitSendSMS'])->name('admin.sms.submit_send_sms');
	Route::post('/agent-user-send-sms', [App\Http\Controllers\SmsController::class, 'agentUserSendSms'])->name('admin.sms.agentUserSendSms');
});

// Affidavit route
Route::prefix('admin/affidavit')->group(function () {
    Route::any('/', [App\Http\Controllers\AffidavitController::class, 'index'])->name('admin.affidavit');

    Route::get('/create', [App\Http\Controllers\AffidavitController::class, 'create'])->name('admin.affidavit.create');
    Route::get('/new_affidavit', [App\Http\Controllers\AffidavitController::class, 'new_affidavit'])->name('admin.affidavit.new_affidavit');
    Route::get('/unmarried', [App\Http\Controllers\AffidavitController::class, 'unmarried'])->name('admin.affidavit.unmarried');
    Route::get('/married', [App\Http\Controllers\AffidavitController::class, 'married'])->name('admin.affidavit.married');
    Route::get('/carecture', [App\Http\Controllers\AffidavitController::class, 'carecture'])->name('admin.affidavit.carecture');
    Route::get('/inheritance', [App\Http\Controllers\AffidavitController::class, 'inheritance'])->name('admin.affidavit.inheritance');
    Route::get('/family', [App\Http\Controllers\AffidavitController::class, 'family'])->name('admin.affidavit.family');
    Route::get('/income', [App\Http\Controllers\AffidavitController::class, 'income'])->name('admin.affidavit.income');

    Route::post('/store', [App\Http\Controllers\AffidavitController::class, 'store'])->name('admin.affidavit.store');
    Route::get('/view/{id}', [App\Http\Controllers\AffidavitController::class, 'view'])->name('admin.affidavit.view');
    Route::get('/view-en/{id}', [App\Http\Controllers\AffidavitController::class, 'viewEn'])->name('admin.affidavit.view-en');
    Route::get('/all-data', [App\Http\Controllers\AffidavitController::class, 'getAllData'])->name('admin.affidavit.all-data');
    Route::get('/edit/{id}', [App\Http\Controllers\AffidavitController::class, 'edit'])->name('admin.affidavit.edit');
    Route::get('/view_inheritance/{id}', [App\Http\Controllers\AffidavitController::class, 'view_inheritance'])->name('admin.affidavit.view_inheritance');
    Route::get('/edit_inherit/{id}', [App\Http\Controllers\AffidavitController::class, 'edit_inherit'])->name('admin.affidavit.edit_inherit');
    Route::get('/edit_family/{id}', [App\Http\Controllers\AffidavitController::class, 'editFamily'])->name('admin.affidavit.edit_family');
    Route::get('/view_married/{id}', [App\Http\Controllers\AffidavitController::class, 'viewMarried'])->name('admin.affidavit.view_married');
    Route::get('/edit_married/{id}', [App\Http\Controllers\AffidavitController::class, 'editMarried'])->name('admin.affidavit.edit_married');
    Route::get('/view_married_en/{id}', [App\Http\Controllers\AffidavitController::class, 'viewMarriedEn'])->name('admin.affidavit.view_married_en');
    Route::post('/update', [App\Http\Controllers\AffidavitController::class, 'update'])->name('admin.affidavit.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\AffidavitController::class, 'destroy'])->name('admin.affidavit.destroy');

    Route::post('/member-info/', [App\Http\Controllers\AffidavitController::class, 'memberInfo'])->name('admin.affidavit.member-info');
    Route::post('/ward-wise-member/', [App\Http\Controllers\AffidavitController::class, 'wardWiseMember'])->name('admin.affidavit.ward-wise-member');
});

// Notice route
Route::prefix('admin/notice')->group(function () {
    Route::match(['GET','POST'], '/', [App\Http\Controllers\NoticeController::class, 'index'])->name('admin.notice');
    Route::get('/create', [App\Http\Controllers\NoticeController::class, 'create'])->name('admin.notice.create');
    Route::post('/store', [App\Http\Controllers\NoticeController::class, 'store'])->name('admin.notice.store');
    Route::get('/view/{id}', [App\Http\Controllers\NoticeController::class, 'view'])->name('admin.notice.view');
    Route::get('/edit/{id}', [App\Http\Controllers\NoticeController::class, 'edit'])->name('admin.notice.edit');
    Route::post('/update', [App\Http\Controllers\NoticeController::class, 'update'])->name('admin.notice.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\NoticeController::class, 'destroy'])->name('admin.notice.destroy');

    Route::post('/member-info/', [App\Http\Controllers\NoticeController::class, 'memberInfo'])->name('admin.notice.member-info');
    Route::post('/ward-wise-member/', [App\Http\Controllers\NoticeController::class, 'wardWiseMember'])->name('admin.notice.ward-wise-member');
});

// Chairman route
Route::prefix('admin/chairman')->group(function () {
    Route::any('/', [App\Http\Controllers\ChairmanController::class, 'index'])->name('admin.chairman');
    Route::get('/create', [App\Http\Controllers\ChairmanController::class, 'create'])->name('admin.chairman.create');
    Route::post('/store', [App\Http\Controllers\ChairmanController::class, 'store'])->name('admin.chairman.store');
    Route::get('/edit/{id}', [App\Http\Controllers\ChairmanController::class, 'edit'])->name('admin.chairman.edit');
    Route::post('/update', [App\Http\Controllers\ChairmanController::class, 'update'])->name('admin.chairman.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\ChairmanController::class, 'destroy'])->name('admin.chairman.destroy');

    Route::post('/member-info/', [App\Http\Controllers\ChairmanController::class, 'memberInfo'])->name('admin.chairman.member-info');
});

// Report route
Route::prefix('admin/report')->group(function () {
    Route::any('/tax', [App\Http\Controllers\ReportController::class, 'tax'])->name('admin.reports.tax');
    Route::any('/union_report', [App\Http\Controllers\ReportController::class, 'union_report'])->name('admin.reports.union_report');
    Route::any('/member', [App\Http\Controllers\ReportController::class, 'member'])->name('admin.reports.member');
    Route::any('/bazar_member', [App\Http\Controllers\ReportController::class, 'bazar_member'])->name('admin.reports.bazar_member');
    Route::any('/ward', [App\Http\Controllers\ReportController::class, 'ward'])->name('admin.reports.ward');
    Route::any('/collection', [App\Http\Controllers\ReportController::class, 'collection'])->name('admin.reports.collection');
});

// Trade License route
Route::prefix('admin/trade_license')->group(function () {
    Route::any('/', [App\Http\Controllers\TradeLicenseController::class, 'index'])->name('admin.trade_license');
    Route::get('/create', [App\Http\Controllers\TradeLicenseController::class, 'create'])->name('admin.trade_license.create');
    Route::post('/store', [App\Http\Controllers\TradeLicenseController::class, 'store'])->name('admin.trade_license.store');
    Route::get('/view/{id}', [App\Http\Controllers\TradeLicenseController::class, 'view'])->name('admin.trade_license.view');
    Route::get('/view-en/{id}', [App\Http\Controllers\TradeLicenseController::class, 'viewEn'])->name('admin.trade_license.view-en');
    Route::get('/edit/{id}', [App\Http\Controllers\TradeLicenseController::class, 'edit'])->name('admin.trade_license.edit');
    Route::post('/update', [App\Http\Controllers\TradeLicenseController::class, 'update'])->name('admin.trade_license.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\TradeLicenseController::class, 'destroy'])->name('admin.trade_license.destroy');

    Route::post('/member-info/', [App\Http\Controllers\TradeLicenseController::class, 'memberInfo'])->name('admin.trade_license.member-info');
    Route::post('/ward-wise-mamber', [App\Http\Controllers\MemberController::class, 'wardWiseMembers'])->name('admin.trade_license.ward-wise-mamber');
});

// user route
Route::prefix('admin/user')->group(function () {
    Route::any('/', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.user.create');
    Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('admin.user.change-password');
    Route::get('/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.user.show');
    Route::get('/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.user.destroy');
});

// Settings route
Route::prefix('admin/settings')->group(function () {
    Route::get('/', [App\Http\Controllers\SettingsController::class, 'index'])->name('admin.settings');
    Route::Post('/store', [App\Http\Controllers\SettingsController::class, 'store'])->name('admin.settings.store');
});

// Privilege Route
Route::prefix('admin/privilege')->group(function () {
    Route::any('/', [App\Http\Controllers\PrivilegeController::class, 'index'])->name('admin.privilege');

    Route::any('/user-list/', [App\Http\Controllers\PrivilegeController::class, 'userList'])->name('admin.privilege.user-list');
    Route::any('/store/', [App\Http\Controllers\PrivilegeController::class, 'store'])->name('admin.privilege.store');
});


