@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="tradeLicenseController" ng-cloak>
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>নতুন ট্রেড লাইসেন্স যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.trade_license.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" >
                            <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" >
                            <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" >
                            <input type="hidden" name="business_name" value="{{ $info->business_name }}" >
                            <input type="hidden" name="license_owner" value="{{ $info->holder_name }}" >
                            <input type="hidden" name="father_name" value="{{ $info->father_name }}" >
                            <input type="hidden" name="mother_name" value="{{ $info->mother_name }}" >
                            <input type="hidden" name="business_name_en" value="{{ $info->business_name_en }}" >
                            <input type="hidden" name="license_owner_en" value="{{ $info->holder_name_en }}" >
                            <input type="hidden" name="father_name_en" value="{{ $info->father_name_en }}" >
                            <input type="hidden" name="mother_name_en" value="{{ $info->mother_name_en }}" >
                            <input type="hidden" name="mobile" value="{{ $info->mobile_no }}" >

                            <input type="hidden" name="pre_district_id" value="{{ $info->pre_district_id }}" >
                            <input type="hidden" name="pre_upazila_id" value="{{ $info->pre_upazila_id }}" >
                            <input type="hidden" name="pre_union_id" value="{{ $info->pre_union_id }}" >
                            <input type="hidden" name="pre_ward_id" value="{{ $info->pre_ward_id }}" >
                            <input type="hidden" name="pre_holding_no" value="{{ $info->pre_holding_no }}" >
                            <input type="hidden" name="pre_road_no" value="{{ $info->pre_road_no }}" >
                            <input type="hidden" name="pre_village" value="{{ $info->pre_village }}" >
                            <input type="hidden" name="pre_post_office" value="{{ $info->pre_post_office }}" >
                            <input type="hidden" name="pre_post_code" value="{{ $info->pre_post_code }}" >

                            <input type="hidden" name="par_district_id" value="{{ $info->par_district_id }}" >
                            <input type="hidden" name="par_upazila_id" value="{{ $info->par_upazila_id }}" >
                            <input type="hidden" name="par_union_id" value="{{ $info->par_union_id }}" >
                            <input type="hidden" name="par_ward_id" value="{{ $info->par_ward_id }}" >
                            <input type="hidden" name="par_holding_no" value="{{ $info->par_holding_no }}" >
                            <input type="hidden" name="par_road_no" value="{{ $info->par_road_no }}" >
                            <input type="hidden" name="par_village" value="{{ $info->par_village }}" >
                            <input type="hidden" name="par_post_office" value="{{ $info->par_post_office }}" >
                            <input type="hidden" name="par_post_code" value="{{ $info->par_post_code }}" >

                            <input type="hidden" name="pre_village_en" value="{{ $info->pre_village_en }}" >
                            <input type="hidden" name="pre_post_office_en" value="{{ $info->pre_post_office_en }}" >
                            <input type="hidden" name="par_village_en" value="{{ $info->par_village_en }}" >
                            <input type="hidden" name="par_post_office_en" value="{{ $info->par_post_office_en }}" >
                            <input type="hidden" name="bazar_id" value="{{ $info->id }}" >
                            <input type="hidden" name="bazar_member" value="yes" >

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ইস্যু তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="{{ $info->created }}" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>লাইসেন্স নং <span class="text-danger">*</span></label>
                                    @php($licenseNo = get_code($get_id+1,6))
                                    <input type="text" name="license_no" value="{{ $licenseNo }}" class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> অর্থ বছর </label>
                                    <select name="finance_year" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y')+1; $i >= (date('Y')-3); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}">{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> অত্র ট্রেড লাইসেন্স এর মেয়াদ <span class="text-danger"></span></label>
                                    <?php $year = date('Y') + 5; $period = date($year . '-06-30'); ?>
                                    <input type="text" name="validity_period" value="{{ $period }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <fieldset>
                                    <legend>বাংলায়</legend>
                                    <div class="form-group">
                                        <label>স্পাউজের নাম (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>ব্যবসার প্রকৃতি <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach(config('custom.businessNatureBn') as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসার/পেশার ধরণ <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসা প্রতিষ্ঠানের ঠিকানা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> অঞ্চল (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">

                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group">
                                        <label>Spouse Name (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Nature of Business <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature_en" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected>Select Business Nature</option>
                                            @foreach(config('custom.businessNatureEn') as $value)
                                                <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> Business Type <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Business Organisation Address <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address_en" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Zone (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone_en" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ব্যবসা শুরুর তারিখ <span class="text-danger"></span></label>
                                    <input type="text" name="business_start" value="{{ date('Y-m-d') }}" class="form-control datepicker" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> জন্ম নিবন্ধন/এনআইডি/পাসপোর্ট নং  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="nid" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> টিআইএন  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="tin" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> বিআইএন  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="bin" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> ই-মেইল <span class="text-danger">&nbsp;</span></label>
                                    <input type="email" name="email" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> আদর্শ কর তফসিল , ২০১৬ এর ক্রমিক নং  <span class="text-danger">*</span></label>
                                    <input type="text" name="tax_serial_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> লাইসেন্স ফি <span class="text-danger"></span></label>
                                    <input type="number" name="license_fee" ng-model="licenseFee"  ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> বকেয়া (অর্থ বছর থেকে…. অর্থ বছর)  </label>
                                    <select name="due_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y')+1; $i >= (date('Y')-3); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}">{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> বকেয়া টাকা <span class="text-danger"></span></label>
                                    <input type="number" name="due_charge" ng-model="dueCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> সারচার্জ <span class="text-danger"></span></label>
                                    <input type="number" name="sur_charge" ng-model="surCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> সংশোধন ফি <span class="text-danger"></span></label>
                                    <input type="number" name="amendment_charge" ng-model="amendmentCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> সাইন বোর্ড (পরিচিতি মূলক) <span class="text-danger"></span></label>
                                    <input type="number" name="signboard_charge" ng-model="signboardCharge" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> আয়কর/উৎস কর <span class="text-danger"></span></label>
                                    <input type="number" name="income_tax" ng-model="incomeTax" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> ভ্যাট <span class="text-danger"></span></label>
                                    <input type="number" name="vat" ng-model="vat" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> মোট <span class="text-danger"></span></label>
                                    <input type="number" name="total" ng-model="totalAmount" id="numberInput" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ছবি (৩০০ X ৩০০)</label>
                                    <input type="file" name="profile" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save">সেইভ করুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
@endsection

@push('footer-style')
<style>
    fieldset {border: solid 1px #DDD !important;padding: 0 10px 10px 10px;border-bottom: none;margin-bottom: 15px;}
    legend {width: auto !important;border: none;font-size: 18px;}
    .hr_style {display: block;width: 100%;border-top: 1px solid #0B499D !important;}
    .no {border-color: red !important;}
    .yes {border-color: green !important;}
</style>
@endpush

@push('footer-script')
<script>
    app.controller('tradeLicenseController',function($scope){
        $scope.licenseFee       = 0;
        $scope.vat              = 0;
        $scope.service_charge   = 0;
        $scope.tax_2            = 0;
        $scope.dueCharge        = 0;
        $scope.surCharge        = 0;
        $scope.amendmentCharge  = 0;
        $scope.signboardCharge  = 0;
        $scope.incomeTax        = 0;

        $scope.getTotalFeeFn = function () {
            var total           = 0;
            var licenseFee      = (!isNaN(parseFloat($scope.licenseFee)) ? parseFloat($scope.licenseFee) : 0);
            var vat             = (!isNaN(parseFloat($scope.vat)) ? parseFloat($scope.vat) : 0);
            var service_charge  = (!isNaN(parseFloat($scope.service_charge)) ? parseFloat($scope.service_charge) : 0);
            var tax_2           = (!isNaN(parseFloat($scope.tax_2)) ? parseFloat($scope.tax_2) : 0);
            var dueCharge       = (!isNaN(parseFloat($scope.dueCharge)) ? parseFloat($scope.dueCharge) : 0);
            var surCharge       = (!isNaN(parseFloat($scope.surCharge)) ? parseFloat($scope.surCharge) : 0);
            var amendmentCharge = (!isNaN(parseFloat($scope.amendmentCharge)) ? parseFloat($scope.amendmentCharge) : 0);
            var signboardCharge = (!isNaN(parseFloat($scope.signboardCharge)) ? parseFloat($scope.signboardCharge) : 0);
            var incomeTax       = (!isNaN(parseFloat($scope.incomeTax)) ? parseFloat($scope.incomeTax) : 0);

            total = licenseFee  + vat + service_charge +  tax_2 + dueCharge + surCharge + amendmentCharge + signboardCharge + incomeTax;
            $scope.totalAmount  = Math.ceil(total);
        }
    });
</script>
@endpush

