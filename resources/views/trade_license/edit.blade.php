@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="editTradeLicenseController" ng-cloak>
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4> ট্রেড লাইসেন্স পরিবর্তন করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.trade_license.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{$info->id}}" >
                        <input type="hidden" name="district_id" value="{{$info->district_id}}" >
                        <input type="hidden" name="upazila_id" value="{{$info->upazila_id}}" >
                        <input type="hidden" name="union_id" value="{{$info->union_id}}" >

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Issue Date <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="{{ (!empty($info->created) ? $info->created : date('Y-m-d')) }}" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> License No. <span class="text-danger">*</span></label>
                                    @php($licenseNo = get_code($get_id+1,6))
                                    <input type="text" name="license_no" value="{{ (!empty($info->license_no) ? $info->license_no : $licenseNo) }}" class="form-control" readonly required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Finance Year <span class="text-danger">*</span></label>
                                    <select name="finance_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y')+1; $i >= (date('Y')-3); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}" {{ (($info->finance_year==$finenceYear) ? 'selected' : '') }}>{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> License Validity <span class="text-danger">&nbsp;</span></label>
                                    <?php $year = date('Y') + 5;
                                        $period = date($year . '-06-30');
                                    ?>
                                    <input type="text" name="validity_period" value="{{ (!empty($info->validity_period) ? $info->validity_period : $period) }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বাংলায়</legend>

                                    <div class="form-group">
                                        <label> ব্যবসা প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name" value="{{ (!empty($info->business_name) ? $info->business_name : '') }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> স্বত্বাধিকারী/লাইসেন্সধারীর নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="license_owner" value="{{ (!empty($info->license_owner) ? $info->license_owner : '') }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> পিতা/স্বামী নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name" value="{{ (!empty($info->father_name) ? $info->father_name : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> মাতা নাম <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name" value="{{ (!empty($info->mother_name) ? $info->mother_name : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>স্পাউজের নাম (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name" value="{{ (!empty($info->spouse_name) ? $info->spouse_name : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>ব্যবসার প্রকৃতি <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach(config('custom.businessNatureBn') as $value)
                                                <option value="{{ $value }}" {{ (($info->business_nature==$value) ? "selected" : "") }} > {{ $value }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসার/পেশার ধরণ <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type" value="{{ (!empty($info->business_type) ? $info->business_type : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ব্যবসা প্রতিষ্ঠানের ঠিকানা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address" value="{{ (!empty($info->business_address) ? $info->business_address : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> অঞ্চল (প্রযোজ্য ক্ষেত্রে) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone" value="{{ (!empty($info->zone) ? $info->zone : '') }}" class="form-control" >
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group">
                                        <label> Business Organization Name <span class="text-danger">*</span></label>
                                        <input type="text" name="business_name_en" value="{{ (!empty($info->business_name_en) ? $info->business_name_en : '') }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> Owner Proprietor Name <span class="text-danger">*</span></label>
                                        <input type="text" name="license_owner_en" value="{{ (!empty($info->license_owner_en) ? $info->license_owner_en : '') }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> Father/Husband Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="father_name_en" value="{{ (!empty($info->father_name_en) ? $info->father_name_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Mother Name <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="mother_name_en" value="{{ (!empty($info->mother_name_en) ? $info->mother_name_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Spouse Name (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="spouse_name_en" value="{{ (!empty($info->spouse_name_en) ? $info->spouse_name_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>Nature of Business <span class="text-danger">&nbsp;</span></label>
                                        <select name="business_nature_en" class="form-control selectpicker" data-live-search="true" >
                                            <option value="" selected>Select Business Nature</option>
                                            @foreach(config('custom.businessNatureEn') as $value)
                                                <option value="{{ $value }}" {{ (($info->business_nature_en==$value) ? "selected" : "") }} >{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> Business Type <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_type_en" value="{{ (!empty($info->business_type_en) ? $info->business_type_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Business Organisation Address <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="business_address_en" value="{{ (!empty($info->business_address_en) ? $info->business_address_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Zone (If Applicable) <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="zone_en" value="{{ (!empty($info->zone_en) ? $info->zone_en : '') }}" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বতর্মান ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="pre_district_id" id="preDistrictId" onchange="getUpazilaFn(); getDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39" {{ ($info->pre_district_id=='39') ? "selected" : "" }}>সুনামগঞ্জ</option>
                                            <option value="45" {{ ($info->pre_district_id=='45') ? "selected" : "" }}>কিশোরগঞ্জ</option>
                                            <option value="62" {{ ($info->pre_district_id=='62') ? "selected" : "" }}>ময়মনসিংহ</option>
                                            <option value="64" {{ ($info->pre_district_id=='64') ? "selected" : "" }}>নেত্রকোণা</option>
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
                                        <select name="pre_ward_id" id="preWardNo" class="form-control selectpicker" onchange="getWardEnName(); getWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach($wards as $key => $value)
                                                <option value="{{ $value->id }}" {{ ($info->pre_ward_id==$value->id) ? "selected" : "" }} >{{$value->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_holding_no" value="{{ (!empty($info->pre_holding_no) ? $info->pre_holding_no : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_road_no" value="{{ (!empty($info->pre_road_no) ? $info->pre_road_no : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village" value="{{ (!empty($info->pre_village) ? $info->pre_village : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office" value="{{ (!empty($info->pre_post_office) ? $info->pre_post_office : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_code" value="{{ (!empty($info->pre_post_code) ? $info->pre_post_code : '') }}" class="form-control" >
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>স্থায়ী ঠিকানা</legend>

                                    <div class="form-group">
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="par_district_id" id="parDistrictId" onchange="getParUpazilaFn(); getParDistrictEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39" {{ ($info->par_district_id=='39') ? "selected" : "" }}>সুনামগঞ্জ</option>
                                            <option value="45" {{ ($info->par_district_id=='45') ? "selected" : "" }}>কিশোরগঞ্জ</option>
                                            <option value="62" {{ ($info->par_district_id=='62') ? "selected" : "" }}>ময়মনসিংহ</option>
                                            <option value="64" {{ ($info->par_district_id=='64') ? "selected" : "" }}>নেত্রকোণা</option>
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
                                        <select name="par_ward_id" id="parWardNo" class="form-control selectpicker" onchange="getWardEnName(); getParWardEnName();" data-live-search="true" >
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach($wards as $key => $value)
                                                <option value="{{ $value->id }}" {{ ($info->par_ward_id==$value->id) ? "selected" : "" }} >{{$value->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label> হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_holding_no" value="{{ (!empty($info->par_holding_no) ? $info->par_holding_no : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> রোড নং <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_road_no" value="{{ (!empty($info->par_road_no) ? $info->par_road_no : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম বা মহল্লা <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village" value="{{ (!empty($info->par_village) ? $info->par_village : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> ডাকঘর <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office" value="{{ (!empty($info->par_post_office) ? $info->par_post_office : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> পোস্ট কোড <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_code" value="{{ (!empty($info->par_post_code) ? $info->par_post_code : '') }}" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Present Address</legend>

                                    <div class="form-group" tabindex="6">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="preDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="preUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="preWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_holding_no_en" value="{{ (!empty($info->pre_holding_no_en) ? $info->pre_holding_no_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_road_no_en" value="{{ (!empty($info->pre_road_no_en) ? $info->pre_road_no_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_village_en" value="{{ (!empty($info->pre_village_en) ? $info->pre_village_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_office_en" value="{{ (!empty($info->pre_post_office_en) ? $info->pre_post_office_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="pre_post_code_en" value="{{ (!empty($info->pre_post_code_en) ? $info->pre_post_code_en : '') }}" class="form-control" >
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>Permanent Address</legend>

                                    <div class="form-group" tabindex="6">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="parDistrictIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUpazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Union <span class="text-danger">&nbsp;</span></label>
                                        <input id="parUnionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="parWardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label> Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_holding_no_en" value="{{ (!empty($info->par_holding_no_en) ? $info->par_holding_no_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Road No. <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_road_no_en" value="{{ (!empty($info->par_road_no_en) ? $info->par_road_no_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Village <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_village_en" value="{{ (!empty($info->par_village_en) ? $info->par_village_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Office <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_office_en" value="{{ (!empty($info->par_post_office_en) ? $info->par_post_office_en : '') }}" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label> Post Code <span class="text-danger">&nbsp;</span></label>
                                        <input type="text" name="par_post_code_en" value="{{ (!empty($info->par_post_code_en) ? $info->par_post_code_en : '') }}" class="form-control" >
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Starting Date <span class="text-danger">&nbsp;</span></label>
                                    <input type="text" name="business_start" value="{{ (!empty($info->business_start) ? $info->business_start : date('Y-m-d')) }}" class="form-control datepicker" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Birth Certificate / NID / Passport No  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="nid" value="{{ (!empty($info->nid) ? $info->nid : '') }}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> TIN  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="tin" value="{{ (!empty($info->tin) ? $info->tin : '') }}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> BIN  <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="bin" value="{{ (!empty($info->bin) ? $info->bin : '') }}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label> Mobile No. <span class="text-danger">&nbsp;</span></label>
                                <div class="form-group">
                                    <input type="number" inputmode="numeric" pattern="[0-9]*" name="mobile" value="{{ (!empty($info->mobile) ? $info->mobile : '') }}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> E-mail <span class="text-danger">&nbsp;</span></label>
                                    <input type="email" name="email" value="{{ (!empty($info->email) ? $info->email : '') }}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Standard Tax Schedule, 2016 serial no. <span class="text-danger">*</span></label>
                                    <input type="text" name="tax_serial_no" value="{{ (!empty($info->tax_serial_no) ? $info->tax_serial_no : '') }}"  class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label> License Fee <span class="text-danger">&nbsp;</span></label>
                                <div class="form-group">
                                    <input type="number" name="license_fee" ng-model="licenseFee" ng-init="licenseFee={{ (!empty($info->license_fee) ? $info->license_fee : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Due Year <span class="text-danger">*</span> </label>
                                    <select name="due_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y')+1; $i >= (date('Y')-3); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}" {{ ($info->due_year==$finenceYear) ? "selected" : "" }} >{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Due Amount <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="due_charge" ng-model="dueCharge" ng-init="dueCharge={{ (!empty($info->due_charge) ? $info->due_charge : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Sur Charge <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="sur_charge" ng-model="surCharge" ng-init="surCharge={{ (!empty($info->sur_charge) ? $info->sur_charge : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Rectification Fee <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="amendment_charge" ng-model="amendmentCharge" ng-init="amendmentCharge={{ (!empty($info->amendment_charge) ? $info->amendment_charge : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Signboard Charge <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="signboard_charge" ng-model="signboardCharge" ng-init="signboardCharge={{ (!empty($info->signboard_charge) ? $info->signboard_charge : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Income Tax/Source Tax <span class="text-danger">&nbsp;</span></label>
                                    <input type="number" name="income_tax" ng-model="incomeTax" ng-init="incomeTax={{ (!empty($info->income_tax) ? $info->income_tax : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label> Vat <span class="text-danger">&nbsp;</span></label>
                                <div class="form-group">
                                    <input type="number" name="vat" ng-model="vat" ng-init="vat={{ (!empty($info->vat) ? $info->vat : '') }}" ng-change="getTotalFeeFn()" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label> Total Amount <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="number" name="total" ng-model="totalAmount" ng-init="totalAmount={{ (!empty($info->total) ? $info->total : '') }}" class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" tabindex="35">
                                    <label> Photo (300 X 300) <span class="text-danger">*</span></label>
                                    @if(!empty($info->profile))
                                    <img src="{{ asset($info->profile) }}" class="img-thumbnail" alt="Profile Photo Not Found!" required>
                                    @endif
                                    <input type="file" name="profile" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save">আপডেট করুন</button>
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


@push('footer-script')
    <script>
        app.controller('editTradeLicenseController',function($scope){
            $scope.licenseFee = 0;
            $scope.vat = 0;
            $scope.service_charge = 0;
            $scope.tax_2 = 0;
            $scope.dueCharge = 0;
            $scope.surCharge = 0;
            $scope.amendmentCharge = 0;
            $scope.signboardCharge = 0;
            $scope.incomeTax = 0;

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
                $scope.totalAmount = Math.ceil(total);
            }
        });



        $('#divisionId').selectpicker();
        $('#preDistrictId').selectpicker();

        // get Upazila list
        function getUpazilaFn() {
            $('#preUpazilaId').empty();
            var _preDistrictId = ($('#preDistrictId').val()) ? $('#preDistrictId').val() : '{{$info->pre_district_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _preDistrictId, select_id: "{{ $info->pre_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUpazilaId').append(response);
                $('#preUpazilaId').selectpicker('refresh');
            });
        }

        getUpazilaFn();

        // get Upazila list
        function getUnionFn() {
            $('#preUnionId').empty();
            var _preUpazilaId = ($('#preUpazilaId').val()) ? $('#preUpazilaId').val() : '{{$info->pre_upazila_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _preUpazilaId, select_id: "{{$info->pre_union_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUnionId').append(response);
                $('#preUnionId').selectpicker('refresh');
            });
        }

        getUnionFn();

        // get Upazila list
        function getParUpazilaFn() {
            $('#parUpazilaId').empty();
            var _parDistrictId = ($('#parDistrictId').val()) ? $('#parDistrictId').val() : {{ $info->par_district_id }};
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _parDistrictId, select_id : "{{ $info->par_upazila_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUpazilaId').append(response);
                $('#parUpazilaId').selectpicker('refresh');
            });
        }
        getParUpazilaFn();

        // get Upazila list
        function getParUnionFn() {
            $('#parUnionId').empty();
            var _parUpazilaId = ($('#parUpazilaId').val()) ? $('#parUpazilaId').val() : {{ $info->par_upazila_id }};;
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _parUpazilaId, select_id : "{{ $info->par_union_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parUnionId').append(response);
                $('#parUnionId').selectpicker('refresh');
            });
        }

        getParUnionFn();


        // get district English Name list
        function getDistrictEnName() {
            $('#preDistrictIdEn').empty();
            var _preDistrictId = ($('#preDistrictId').val()) ? $('#preDistrictId').val() : {{ $info->pre_district_id }};
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
            var _preUpazilaId = ($('#preUpazilaId').val()) ? $('#preUpazilaId').val() : "{{$info->pre_upazila_id}}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _preUpazilaId, select_id: "{{$info->pre_upazila_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#preUpazilaIdEn').val(response);
            });
        }
        getUpZillaEnName();

        // get Union English Name list
        function getUnionEnName() {
            $('#preUnionIdEn').empty();
            var _preUnionId = ($('#preUnionId').val()) ? $('#preUnionId').val() : "{{ $info->pre_union_id }}";
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
            var _preWardNo = ($('#preWardNo').val()) ? $('#preWardNo').val() : "{{ $info->pre_ward_id }}";
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
            var _parDistrictId = ($('#parDistrictId').val()) ? $('#parDistrictId').val() : "{{ $info->par_district_id }}";
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
            var _parUpazilaId = ($('#parUpazilaId').val()) ? $('#parUpazilaId').val() : "{{ $info->par_upazila_id }}";
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
            var _parUnionId = ($('#parUnionId').val()) ? $('#parUnionId').val() : "{{ $info->par_union_id }}";
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
            var _parWardNo = ($('#parWardNo').val()) ? $('#parWardNo').val() : "{{ $info->par_ward_id }}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _parWardNo, select_id: "{{ $info->par_ward_id }}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#parWardNoEn').val(response);
            });
        }
        getParWardEnName();

    </script>
@endpush
