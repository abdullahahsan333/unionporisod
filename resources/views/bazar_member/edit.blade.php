@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="editBazarMemberController" ng-cloak>
    @include('bazar_member.nav')

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বাজারের সদস্য পরিবর্তন করুন</h4>
                </div>

                <div class="panel_body">
                    <form action="{{route('admin.bazar_member.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <div class="row">
                            <input type="hidden" name="district_id" value="{{ $userInfo->district_id }}" >
                            <input type="hidden" name="upazila_id" value="{{ $userInfo->upazila_id }}" >
                            <input type="hidden" name="union_id" value="{{ $userInfo->union_id }}" >

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ইস্যু তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="{{ $info->created }}" class="form-control datepicker" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বাংলায়</legend>

                                    <div class="form-group">
                                        <label>দোকান / কারখানার মালিকের নাম<span class="text-danger">*</span></label>
                                        <input type="text" name="holder_name" value="{{ $info->holder_name }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="father_name" value="{{ $info->father_name }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>মাতার নাম <span class="text-danger"></span></label>
                                        <input type="text" name="mother_name" value="{{ $info->mother_name }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>ব্যবসার নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name" value="{{ $info->business_name }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ভাড়াটিয়া আছে কিনা ? <span class="text-danger">*</span></label>
                                        <select name="tenant" id="tenant" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> নির্বাচন করুন</option>
                                            <option value="হ্যাঁ" {{ ($info->tenant == "হ্যাঁ") ? "selected" : "" }}>হ্যাঁ</option>
                                            <option value="না" {{ ($info->tenant == "না") ? "selected" : "" }}>না</option>
                                        </select>
                                    </div>

                                    <div id="tenantName">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার নাম <span class="text-danger"></span></label>
                                            <input type="text" name="tenant_name" value="{{ $info->tenant_name }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div id="tenantFatherName">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার পিতার নাম <span class="text-danger"></span></label>
                                            <input type="text" name="tenant_father_name" value="{{ $info->tenant_father_name }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div id="tenantBusinessAssets">
                                        <div class="form-group">
                                            <label>ভাড়াটিয়ার ব্যবসার মোট পুঁজি<span class="text-danger"></span></label>
                                            @if(!empty($info->tenant_business_assets))
                                            <input ng-model="tenantBusinessAssets" ng-init="tenantBusinessAssets={{ $info->tenant_business_assets }}" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->tenant_business_assets }}" name="tenant_business_assets" class="form-control" >
                                            @else
                                            <input ng-model="tenantBusinessAssets" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->tenant_business_assets }}" name="tenant_business_assets" class="form-control" >
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>কারখানা/দোকান ঘর সহ মোট জমি কত শতাংশ<span class="text-danger">*</span></label>
                                        <input ng-model="totalLand" ng-init="totalLand={{ $info->total_land }}" inputmode="numeric" pattern="[0-9]*" type="number" name="total_land" value="{{ $info->total_land }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>বাজারের নাম<span class="text-danger"></span></label>
                                        <input type="text" name="bazar_name" value="{{ $info->bazar_name }}" class="form-control" >
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group">
                                        <label>Shop/Factory Owner Name<span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="holder_name_en" value="{{ $info->holder_name_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Father/Husband Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name_en" value="{{ $info->father_name_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name_en" value="{{ $info->mother_name_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Business Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_name_en" value="{{ $info->business_name_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Do you have any renter? <span class="text-danger">&nbsp;</span></label>
                                        <select name="tenant_en" id="tenantEn" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected> Select Any One</option>
                                            <option value="yes" {{ ($info->tenant_en == "yes") ? "selected" : "" }}>Yes</option>
                                            <option value="no" {{ ($info->tenant_en == "no") ? "selected" : "" }}>No</option>
                                        </select>
                                    </div>

                                    <div class="" id="tenantNameEn">
                                        <div class="form-group">
                                            <label>Renter Name<span class="text-danger">&nbsp;</span></label>
                                            <input type="text" name="tenant_name_en" value="{{ $info->tenant_name_en }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantFatherNameEn">
                                        <div class="form-group">
                                            <label>Renter Father Name <span class="text-danger">&nbsp;</span></label>
                                            <input type="text" name="tenant_father_name_en" value="{{ $info->tenant_father_name_en }}" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="" id="tenantBusinessAssetsEn">
                                        <div class="form-group">
                                            <label>Total Capital of Renter Business<span class="text-danger">&nbsp;</span></label>
                                            <input ng-value="tenantBusinessAssets" type="text" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Factory/Shop Total Land<span class="text-danger">&nbsp;</span></label>
                                        <input ng-value="totalLand" type="number" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Bazar Name<span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="bazar_name_en" value="{{ $info->bazar_name_en }}" class="form-control" >
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <!-- Address Separetly Start -->
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বতর্মান ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="pre_district_id" id="preDistrictId" onchange="getUpazilaFn(); getDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39" {{ ($info->pre_district_id == 39) ? "selected" : "" }}>সুনামগঞ্জ</option>
                                            <option value="45" {{ ($info->pre_district_id == 45) ? "selected" : "" }}>কিশোরগঞ্জ</option>
                                            <option value="62" {{ ($info->pre_district_id == 62) ? "selected" : "" }}>ময়মনসিংহ</option>
                                            <option value="64" {{ ($info->pre_district_id == 64) ? "selected" : "" }}>নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="pre_upazila_id" id="preUpazilaId" onchange="getUnionFn(); getUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="pre_union_id" id="preUnionId" class="form-control" onchange="getUnionEnName()" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ওয়ার্ড নং <span class="text-danger">&nbsp;</span></label>
                                        <select name="pre_ward_id" id="preWardNo" class="form-control selectpicker" onchange="getWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach($wards as $key => $value)
                                                <option value="{{ $value->id }}" {{ ($info->pre_ward_id == $value->id) ? "selected" : "" }}>{{$value->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="preHolding" ng-init="preHolding={{ $info->pre_holding_no }}" value="{{ $info->pre_holding_no }}" inputmode="numeric" pattern="[0-9]*" type="number" name="pre_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="preRoad" ng-init="preRoad={{ $info->pre_road_no }}" value="{{ $info->pre_road_no }}" inputmode="numeric" pattern="[0-9]*" type="number" name="pre_road_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village" value="{{ $info->pre_village }}"  class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office" value="{{ $info->pre_post_office }}"  class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="prePostCode" ng-init="prePostCode={{ $info->pre_post_code }}" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->pre_post_code }}" name="pre_post_code" class="form-control" >
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>স্থায়ী ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="par_district_id" id="parDistrictId" onchange="getParUpazilaFn(); getParDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39" {{ ($info->par_district_id == 39) ? "selected" : "" }}>সুনামগঞ্জ</option>
                                            <option value="45" {{ ($info->par_district_id == 45) ? "selected" : "" }}>কিশোরগঞ্জ</option>
                                            <option value="62" {{ ($info->par_district_id == 62) ? "selected" : "" }}>ময়মনসিংহ</option>
                                            <option value="64" {{ ($info->par_district_id == 64) ? "selected" : "" }}>নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="par_upazila_id" id="parUpazilaId" onchange="getParUnionFn(); getParUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="par_union_id" id="parUnionId" class="form-control" onchange="getParUnionEnName();" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ওয়ার্ড নং <span class="text-danger">&nbsp;</span></label>
                                        <select name="par_ward_id" id="parWardNo" class="form-control selectpicker" onchange="getParWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach($wards as $key => $value)
                                                <option value="{{ $value->id }}" {{ ($info->par_ward_id == $value->id) ? "selected" : "" }}>{{$value->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parHolding" ng-init="parHolding={{ $info->par_holding_no }}" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->par_holding_no }}" name="par_holding_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parRoad" ng-init="parRoad={{ $info->par_road_no }}" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->par_road_no }}" name="par_road_no" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village" value="{{ $info->par_village }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office" value="{{ $info->par_post_office }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input ng-model="parPostCode" ng-init="parPostCode={{ $info->par_post_code }}" inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->par_post_code }}" name="par_post_code" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Present Address</legend>

                                    <div class="form-group" >
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="preDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="preWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preHolding" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preRoad" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village_en" value="{{ $info->pre_village_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office_en" value="{{ $info->pre_post_office_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="prePostCode" class="form-control" readonly>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>Permanent Address</legend>

                                    <div class="form-group" >
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="parDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" >
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="parWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preHolding" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="preRoad" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village_en" value="{{ $info->par_village_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office_en" value="{{ $info->par_post_office_en }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" ng-value="prePostCode" class="form-control" readonly>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                        <!-- Address Separetly End -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="tel" value="{{ $info->mobile_no }}" name="mobile_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ঘর নির্মাণ সহ ব্যবসার মোট পুঁজি<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->total_assets }}" name="total_assets" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক ব্যবসার আয়<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->business_income }}" name="business_income" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->annual_assessment }}" name="annual_assessment" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক করের পরিমাণ<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $info->total_taxes }}" name="total_taxes" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="update">আপডেট করুন</button>
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
        fieldset {
            border: solid 1px #DDD !important;
            padding: 0 10px 10px 10px;
            border-bottom: none;
            margin-bottom: 15px;
        }
        legend {
            width: auto !important;
            border: none;
            font-size: 18px;
        }

        .hr_style {
            display: block;
            width: 100%;
            border-top: 1px solid #0B499D !important;
        }
        .no {
            border-color: red !important;
        }
        .yes {
            border-color: green !important;
        }
    </style>
@endpush
@push('footer-script')
    <script>
        $(document).ready(function () {
            $('#tenantName').hide();
            $('#tenantFatherName').hide();
            $('#tenantBusinessAssets').hide();

            $('#tenant').on('change', function () {
                var _tenant = $(this).val();
                if (_tenant === "হ্যাঁ") {
                    $('#tenantName').show();
                    $('#tenantFatherName').show();
                    $('#tenantBusinessAssets').show();
                } else {
                    $('#tenantName').hide();
                    $('#tenantFatherName').hide();
                    $('#tenantBusinessAssets').hide();
                }
            });
        });

        $(document).ready(function () {
            $('#tenantNameEn').hide();
            $('#tenantFatherNameEn').hide();
            $('#tenantBusinessAssetsEn').hide();

            $('#tenantEn').on('change', function () {
                var _tenant = $(this).val();
                if (_tenant === "yes") {
                    $('#tenantNameEn').show();
                    $('#tenantFatherNameEn').show();
                    $('#tenantBusinessAssetsEn').show();
                } else {
                    $('#tenantNameEn').hide();
                    $('#tenantFatherNameEn').hide();
                    $('#tenantBusinessAssetsEn').hide();
                }
            });
        });

        $('#divisionId').selectpicker();

        // get distric list
        function getDistrictFn() {
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.district-list')}}",
                data: {id: _divisionId, select_id: "{{ $info->pre_district_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }
        getDistrictFn();

        // get Upazila list
        function getUpazilaFn() {
            $('#preUpazilaId').empty();
            var _predistrictId = $('#preDistrictId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _predistrictId, select_id: "{{ $info->pre_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                console.log(response);
                $('#preUpazilaId').append(response);
                $('#preUpazilaId').selectpicker('refresh');
            });
        }
        getUpazilaFn();

        // get Upazila list
        function getUnionFn() {
            $('#preUnionId').empty();
            var _preUpazilaId = ('{{ $info->pre_upazila_id }}') ? '{{ $info->pre_upazila_id }}' : $('#preUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _preUpazilaId, select_id: "{{ $info->pre_union_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUnionId').append(response);
                $('#preUnionId').selectpicker('refresh');
            });
        }
        getUnionFn();

        // get Upazila list
        function getParUpazilaFn() {
            $('#parUpazilaId').empty();
            var _parDistrictId = $('#parDistrictId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _parDistrictId, select_id: "{{ $info->par_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUpazilaId').append(response);
                $('#parUpazilaId').selectpicker('refresh');
            });
        }
        getParUpazilaFn();

        // get Upazila list
        function getParUnionFn() {
            $('#parUnionId').empty();
            var _parUpazilaId = ('{{ $info->par_upazila_id }}') ? '{{ $info->par_upazila_id }}' : $('#parUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _parUpazilaId, select_id: "{{ $info->par_union_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUnionId').append(response);
                $('#parUnionId').selectpicker('refresh');
            });
        }
        getParUnionFn();

        // get district English Name list
        function getDistrictEnName() {
            $('#preDistrictIdEn').empty();
            var _preDistrictId = ('{{ $info->pre_district_id }}') ? '{{ $info->pre_district_id }}' : $('#preDistrictId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.zilla-name')}}",
                data: {id: _preDistrictId, select_id: "{{ $info->pre_district_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preDistrictIdEn').val(response);
            });
        }
        getDistrictEnName();

        // get Upzilla English Name list
        function getUpZillaEnName() {
            $('#preUpazilaIdEn').empty();
            var _preUpazilaId = ('{{ $info->pre_upazila_id }}') ? '{{ $info->pre_upazila_id }}' : $('#preUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _preUpazilaId, select_id: "{{ $info->pre_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUpazilaIdEn').val(response);
            });
        }
        getUpZillaEnName();

        // get Union English Name list
        function getUnionEnName() {
            $('#preUnionIdEn').empty();
            var _preUnionId = ('{{ $info->pre_union_id }}') ? '{{ $info->pre_union_id }}' : $('#preUnionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-name')}}",
                data: {id: _preUnionId, select_id: "{{ $info->pre_union_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUnionIdEn').val(response);
            });
        }
        getUnionEnName();

        // get Union English Name list
        function getWardEnName() {
            $('#preWardNoEn').empty();
            var _preWardNo = ('{{ $info->pre_ward_id }}') ? '{{ $info->pre_ward_id }}' : $('#preWardNo').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _preWardNo, select_id: "{{ $info->pre_ward_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preWardNoEn').val(response);
            });
        }
        getWardEnName();

        // get district English Name list
        function getParDistrictEnName() {
            $('#parDistrictIdEn').empty();
            var _parDistrictId = ('{{ $info->par_district_id }}') ? '{{ $info->par_district_id }}' : $('#parDistrictId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.zilla-name')}}",
                data: {id: _parDistrictId, select_id: "{{ $info->par_district_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parDistrictIdEn').val(response);
            });
        }
        getParDistrictEnName();

        // get Upzilla English Name list
        function getParUpZillaEnName() {
            $('#parUpazilaIdEn').empty();
            var _parUpazilaId = ('{{ $info->par_upazila_id }}') ? '{{ $info->par_upazila_id }}' : $('#parUpazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _parUpazilaId, select_id: "{{ $info->par_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUpazilaIdEn').val(response);
            });
        }
        getParUpZillaEnName();

        // get Union English Name list
        function getParUnionEnName() {
            $('#parUnionIdEn').empty();
            var _parUnionId = ('{{ $info->par_union_id }}') ? '{{ $info->par_union_id }}' : $('#parUnionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-name')}}",
                data: {id: _parUnionId, select_id: "{{ $info->par_union_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUnionIdEn').val(response);
            });
        }
        getParUnionEnName();

        // get Union English Name list
        function getParWardEnName() {
            $('#parWardNoEn').empty();
            var _parWardNo = ('{{ $info->par_ward_id }}') ? '{{ $info->par_ward_id }}' : $('#parWardNo').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _parWardNo, select_id: "{{ $info->par_ward_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parWardNoEn').val(response);
            });
        }
        getParWardEnName();

        /* angular script */
        app.controller('editBazarMemberController', function ($scope) {

        });
    </script>
@endpush
