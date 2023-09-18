@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container" ngController="appController">

        @include('member.nav')
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>খানা সদস্য যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{ route('admin.affidavit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="member_affidavit" value="member_affidavit">
                        <input type="hidden" name="member_id" value="{{ $memberInfo->id }}">
                        
                        <input type="hidden" name="member_district_id" value="{{ $memberInfo->district_id }}">
                        <input type="hidden" name="member_upazila_id" value="{{ $memberInfo->upazila_id }}">
                        <input type="hidden" name="member_union_id" value="{{ $memberInfo->union_id }}">
                        <input type="hidden" name="member_ward_id" value="{{ $memberInfo->ward_id }}">
                        <input type="hidden" name="member_holding_no" value="{{ $memberInfo->holding_no }}">

                        <input type="hidden" name="member_householder_wife" value="{{ $memberInfo->householder_wife }}">
                        <input type="hidden" name="member_profession" value="{{ $memberInfo->profession }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="{{ date('Y-m-d') }}" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>প্রত্যয়ন পত্রের ধরন <span class="text-danger">*</span></label>
                                    <select name="affidavit_type" ng-init="affidavitType=''" ng-model="affidavitType" class="form-control" required>
                                        <option value="" selected>প্রত্যয়ন পত্রের ধরন নির্বাচন করুন</option>
                                        <option value="affidavit_certificate">প্রত্যয়ন পত্র</option>
                                        <option value="citizenship_certificate">নাগরিকত্ব সনদ পত্র</option>
                                        <option value="unmarried_certificate">অবিবাহিত সনদপত্র</option>
                                        <option value="married_certificate">বিবাহিত সনদপত্র</option>
                                        <option value="income_certificate">বাষির্ক আয় সনদপত্র</option>
                                        <option value="carecture_certificate">চারিত্রিক সনদপত্র</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>প্রত্যয়ন পত্র নং</label>
                                    @php($affidavitNo = get_code($get_id+1,5))
                                    <input inputmode="numeric" pattern="[0-9]*" type="text" name="affidavit_no" value="{{ $affidavitNo }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div id="containInfo">

                            <div ng-show="affidavitType=='affidavit_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বাংলায়</legend>
        
                                            <div class="form-group">
                                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="member_name" value="{{ (!empty($memberInfo->name) ? $memberInfo->name : "") }}" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম</label>
                                                <input type="text" name="father_name" value="{{ (!empty($memberInfo->father_name) ? $memberInfo->father_name : "") }}" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম</label>
                                                <input type="text" name="mother_name" value="{{ (!empty($memberInfo->mother_name) ? $memberInfo->mother_name : "") }}" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="district_id" id="districtId" onchange="getUpazilaFn('districtId','upazilaId'); getDistrictEnName('districtId','districtIdEn');" class="form-control" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39" {{ (($memberInfo->district_id == "39") ? "selected" : "") }}>সুনামগঞ্জ</option>
                                                    <option value="45" {{ (($memberInfo->district_id == "45") ? "selected" : "") }}>কিশোরগঞ্জ</option>
                                                    <option value="62" {{ (($memberInfo->district_id == "62") ? "selected" : "") }}>ময়মনসিংহ</option>
                                                    <option value="64" {{ (($memberInfo->district_id == "64") ? "selected" : "") }}>নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="upazila_id" id="upazilaId" onchange="getUnionFn('upazilaId','unionId'); getUpZillaEnName('upazilaId','upazilaIdEn');" class="form-control" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="union_id" id="unionId" class="form-control" onchange="getUnionEnName('unionId','unionIdEn');" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="district_id" value="{{ $userInfo->district_id }}" id="districtId">
                                            <input type="hidden" name="upazila_id" value="{{ $userInfo->upazila_id }}" id="upazilaId">
                                            <input type="hidden" name="union_id" value="{{ $userInfo->union_id }}" id="unionId">
                                        @endif
                                        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="ward_id" id="wardNo" onchange="getWardEnName('wardNo','wardNoEn');" class="form-control" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @if(!empty($wards))
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ (($memberInfo->ward_id == $value->id) ? "selected" : "") }} >{{ $value->name_bn }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং</label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="holdingNo" ng-init="holdingNo={{ $memberInfo->holding_no }}" 
                                                    id="holdingNo" name="holding_no" onkeyup="uniqeHoldingNo('holdingNo','wardNo','unionId');" class="form-control yes" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="post_office" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="village" class="form-control" value="{{ $memberInfo->village }}" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group" >
                                                <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                                <select name="marital_status" id="maritalStatus" onchange="maritalStatusFn('maritalStatus','maritalStatusEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                                    @foreach(config('custom.maritalStatusBn') as $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="religion" id="religion" onchange="religionFn('religion','religionEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="affidavitCertificateRequired">
                                                    <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                        <option value="{{ $value }}" {{ (($memberInfo->religion == $value) ? "selected" : "") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>English</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="member_name_en" value="{{ $memberInfo->name_en }}"  class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father / Husband Name</label>
                                                <input type="text" name="father_name_en" value="{{ $memberInfo->father_name_en }}" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="mother_name_en" value="{{ $memberInfo->mother_name_en }}" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="districtIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="upazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Union <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="unionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="wardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="holdingNoEn" ng-value="holdingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="post_office_en" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="village_en" class="form-control" ng-required="affidavitCertificateRequired">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="maritalStatusEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="religionEn" class="form-control" readonly>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->nid_no }}" name="nid_no" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>মোবাইল নং</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->mobile_no }}" name="mobile_no" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div ng-show="affidavitType=='citizenship_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বাংলায়</legend>
        
                                            <div class="form-group">
                                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_member_name" value="{{ (!empty($memberInfo->name) ? $memberInfo->name : "") }}"  class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম</label>
                                                <input type="text" name="citizen_father_name" value="{{ (!empty($memberInfo->father_name) ? $memberInfo->father_name : "") }}" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম</label>
                                                <input type="text" name="citizen_mother_name" value="{{ (!empty($memberInfo->mother_name) ? $memberInfo->mother_name : "") }}" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="citizen_district_id" id="citizenDistrictId" onchange="getUpazilaFn('citizenDistrictId','citizenUpazilaId'); getDistrictEnName('citizenDistrictId','citizenDistrictIdEn');" class="form-control" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39" {{ (($memberInfo->district_id == "39") ? "selected" : "") }} >সুনামগঞ্জ</option>
                                                    <option value="45" {{ (($memberInfo->district_id == "45") ? "selected" : "") }} >কিশোরগঞ্জ</option>
                                                    <option value="62" {{ (($memberInfo->district_id == "62") ? "selected" : "") }} >ময়মনসিংহ</option>
                                                    <option value="64" {{ (($memberInfo->district_id == "64") ? "selected" : "") }} >নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="citizen_upazila_id" id="citizenUpazilaId" onchange="getUnionFn('citizenUpazilaId','citizenUnionId'); getUpZillaEnName('citizenUpazilaId','citizenUpazilaIdEn');" class="form-control" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="citizen_union_id" id="citizenUnionId" class="form-control" onchange="getUnionEnName('citizenUnionId','citizenUnionIdEn')" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="citizen_district_id" value="{{$userInfo->district_id}}" id="citizenDistrictId">
                                            <input type="hidden" name="citizen_upazila_id" value="{{$userInfo->upazila_id}}" id="citizenUpazilaId">
                                            <input type="hidden" name="citizen_union_id" value="{{$userInfo->union_id}}" id="citizenUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="citizen_ward_id" id="citizenWardNo" onchange="getWardEnName('citizenWardNo','citizenWardNoEn')" class="form-control selectpicker" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ (($memberInfo->ward_id == $value->id) ? "selected" : "") }}>{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং</label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="citizenHoldingNo" ng-init="citizenHoldingNo={{ $memberInfo->holding_no }}"
                                                    onkeyup="uniqeHoldingNo('citizenHoldingNo','citizenWardNo','citizenUnionId')" id="citizenHoldingNo" name="citizen_holding_no" class="form-control yes" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_post_office" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group" >
                                                <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                                <select name="citizen_marital_status" id="citizenMaritalStatus" onchange="maritalStatusFn('citizenMaritalStatus','citizenMaritalStatusEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                                    @foreach(config('custom.maritalStatusBn') as $value)
                                                        <option value="{{ $value }}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="citizen_religion" id="citizenReligion" onchange="religionFn('citizenReligion','citizenReligionEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="citizenshipCertificateRequired">
                                                    <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                        <option value="{{ $value }}" {{ (($memberInfo->religion == $value) ? "selected" : "") }}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>English</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_member_name_en" value="{{ $memberInfo->name_en }}"  class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father / Husband Name</label>
                                                <input type="text" name="citizen_father_name_en" value="{{ $memberInfo->father_name_en }}" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="citizen_mother_name_en" value="{{ $memberInfo->mother_name_en }}" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="citizenDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="citizenUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Union <span class="text-danger">&nbsp;</span></label>
                                                <input id="citizenUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="citizenWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="citizenHoldingNoEn" ng-value="citizenHoldingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_post_office_en" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="citizen_village_en" class="form-control" ng-required="citizenshipCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="citizenMaritalStatusEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="citizenReligionEn" class="form-control" readonly>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->nid_no }}" name="citizen_nid_no" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>মোবাইল নং</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->mobile_no }}" name="citizen_mobile_no" class="form-control" >
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group" tabindex="35">
                                            <label>ছবি (৩০০ X ৩০০)</label>
                                            
                                            @if(!empty($memberInfo->path))
                                            <br />
                                            <img src="{{ asset($memberInfo->path) }}" style="max-width: 100px;" class="img-thumbnail img" alt="Member Photo!">
                                            <input type="hidden" name="citizen_member_path" value="{{ $memberInfo->path }}" >
                                            @endif
                                            
                                            <input type="file" name="citizen_member_image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div ng-show="affidavitType=='unmarried_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বাংলায়</legend>
        
                                            <div class="form-group">
                                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_member_name" value="{{ (!empty($memberInfo->name) ? $memberInfo->name : '') }}"  class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম</label>
                                                <input type="text" name="unmarried_father_name" value="{{ (!empty($memberInfo->father_name) ? $memberInfo->father_name : '') }}" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম</label>
                                                <input type="text" name="unmarried_mother_name" value="{{ (!empty($memberInfo->mother_name) ? $memberInfo->mother_name : '') }}" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="unmarried_district_id" id="unmarriedDistrictId" class="form-control" data-live-search="true"
                                                    onchange="getUpazilaFn('unmarriedDistrictId','unmarriedUpazilaId'); getDistrictEnName('unmarriedDistrictId','unmarriedDistrictIdEn');" 
                                                    ng-required="unmarriedCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39" {{ (($memberInfo->district_id == "39") ? "selected" : "") }} >সুনামগঞ্জ</option>
                                                    <option value="45" {{ (($memberInfo->district_id == "45") ? "selected" : "") }} >কিশোরগঞ্জ</option>
                                                    <option value="62" {{ (($memberInfo->district_id == "62") ? "selected" : "") }} >ময়মনসিংহ</option>
                                                    <option value="64" {{ (($memberInfo->district_id == "64") ? "selected" : "") }} >নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="unmarried_upazila_id" id="unmarriedUpazilaId" class="form-control" data-live-search="true"
                                                    onchange="getUnionFn('unmarriedUpazilaId','unmarriedUnionId'); getUpZillaEnName('unmarriedUpazilaId','unmarriedUpazilaIdEn');" 
                                                    ng-required="unmarriedCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="unmarried_union_id" id="unmarriedUnionId" class="form-control" data-live-search="true"
                                                    onchange="getUnionEnName('unmarriedUnionId','unmarriedUnionIdEn')" ng-required="unmarriedCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="unmarried_district_id" value="{{$userInfo->district_id}}" id="unmarriedDistrictId">
                                            <input type="hidden" name="unmarried_upazila_id" value="{{$userInfo->upazila_id}}" id="unmarriedUpazilaId">
                                            <input type="hidden" name="unmarried_union_id" value="{{$userInfo->union_id}}" id="unmarriedUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="unmarried_ward_id" id="unmarriedWardNo" data-live-search="true" ng-required="unmarriedCertificateRequired"
                                                    onchange="getWardEnName('unmarriedWardNo','unmarriedWardNoEn')" class="form-control selectpicker" >
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ (($memberInfo->ward_id == $value->id) ? "selected" : "") }}>{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং</label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="unmarriedHoldingNo" id="unmarriedHoldingNo" ng-init="unmarriedHoldingNo={{ $memberInfo->holding_no }}" name="unmarried_holding_no" 
                                                    onkeyup="uniqeHoldingNo('unmarriedHoldingNo','unmarriedWardNo','unmarriedUnionId')" class="form-control yes" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_post_office" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group" >
                                                <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                                <select name="unmarried_marital_status" id="unmarriedMaritalStatus" onchange="maritalStatusFn('unmarriedMaritalStatus','unmarriedMaritalStatusEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="unmarriedCertificateRequired">
                                                    <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                                    @foreach(config('custom.maritalStatusBn') as $value)
                                                        <option value="{{ $value }}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="unmarried_religion" id="unmarriedReligion" onchange="religionFn('unmarriedReligion','unmarriedReligionEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="unmarriedCertificateRequired">
                                                    <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                        <option value="{{ $value }}" {{ (($memberInfo->religion == $value) ? "selected" : "") }}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>English</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_member_name_en" value="{{ $memberInfo->name_en }}"  class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father / Husband Name</label>
                                                <input type="text" name="unmarried_father_name_en" value="{{ $memberInfo->father_name_en }}" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="unmarried_mother_name_en" value="{{ $memberInfo->mother_name_en }}" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="unmarriedDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="unmarriedUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="unmarriedUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="unmarriedWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="unmarriedHoldingNoEn" ng-value="unmarriedHoldingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_post_office_en" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="unmarried_village_en" class="form-control" ng-required="unmarriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="unmarriedMaritalStatusEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="unmarriedReligionEn" class="form-control" readonly>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->nid_no }}" name="unmarried_nid_no" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>মোবাইল নং</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->mobile_no }}" name="unmarried_mobile_no" class="form-control" >
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group" tabindex="35">
                                            <label>ছবি (৩০০ X ৩০০)</label>
                                            
                                            @if(!empty($memberInfo->path))
                                            <br />
                                            <img src="{{ asset($memberInfo->path) }}" style="max-width: 100px;" class="img-thumbnail img" alt="Member Photo!">
                                            <input type="hidden" name="unmarried_member_path" value="{{ $memberInfo->path }}" >
                                            @endif
                                            
                                            <input type="file" name="unmarried_member_image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div ng-show="affidavitType=='married_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বরের বিবরণ (বাংলায়)</legend>
        
                                            <div class="form-group">
                                                <label>নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="married_member_name" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা নাম <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_father_name" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_mother_name" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>জাতীয় পরিচয়পত্র নম্বর <span class="text-danger">&nbsp;</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="nidNo" id="marriedNidNo" 
                                                    name="married_nid_no" class="form-control" >
                                            </div>
        
                                            <div class="form-group">
                                                <label>জন্ম তারিখ <span class="text-danger">*</span></label>
                                                <input type="text" name="married_dob" ng-model="dob" class="form-control datepicker" ng-required="marriedCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="married_district_id" id="marriedDistrictId" class="form-control" data-live-search="true"
                                                    onchange="getUpazilaFn('marriedDistrictId','marriedUpazilaId'); getDistrictEnName('marriedDistrictId','marriedDistrictIdEn');" 
                                                    ng-required="marriedCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39">সুনামগঞ্জ</option>
                                                    <option value="45">কিশোরগঞ্জ</option>
                                                    <option value="62">ময়মনসিংহ</option>
                                                    <option value="64">নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="married_upazila_id" id="marriedUpazilaId" class="form-control" data-live-search="true"
                                                    onchange="getUnionFn('marriedUpazilaId','marriedUnionId'); getUpZillaEnName('marriedUpazilaId','marriedUpazilaIdEn');" 
                                                    ng-required="marriedCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="married_union_id" id="marriedUnionId" class="form-control" data-live-search="true" 
                                                    onchange="getUnionEnName('marriedUnionId','marriedUnionIdEn')" ng-required="marriedCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="married_district_id" value="{{$userInfo->district_id}}" id="marriedDistrictId">
                                            <input type="hidden" name="married_upazila_id" value="{{$userInfo->upazila_id}}" id="marriedUpazilaId">
                                            <input type="hidden" name="married_union_id" value="{{$userInfo->union_id}}" id="marriedUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="married_ward_id" id="marriedWardNo" class="form-control selectpicker" 
                                                    onchange="getWardEnName('marriedWardNo','marriedWardNoEn')" data-live-search="true" ng-required="marriedCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}">{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="marriedHoldingNo" id="marriedHoldingNo" name="married_holding_no" 
                                                    class="form-control yes" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="married_post_office" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="married_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="marriedCertificateRequired">
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>Husband Info (English)</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="married_member_name_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father Name <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_father_name_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_mother_name_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>NID No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedNidNoEn" ng-value="nidNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Date of Birth <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="marriedDobEn" ng-value="dob" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="marriedHoldingNoEn" ng-value="marriedHoldingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="married_post_office_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="married_village_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>কনের বিবরণ (বাংলায়)</legend>
        
                                            <div class="form-group">
                                                <label>নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_name" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা নাম <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_wife_father_name" value="" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_wife_mother_name" value="" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>জাতীয় পরিচয়পত্র নম্বর <span class="text-danger">&nbsp;</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="wifeNidNo" id="marriedWifeNidNo" name="married_wife_nid_no" class="form-control" >
                                            </div>
        
                                            <div class="form-group">
                                                <label>জন্ম তারিখ <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_wife_dob" ng-model="wifeDob" class="form-control datepicker" >
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="married_wife_district_id" id="wifeDistrictId" class="form-control" data-live-search="true"
                                                    onchange="getWifeUpazilaFn('wifeDistrictId','wifeUpazilaId'); getWifeDistrictEnName('wifeDistrictId','wifeDistrictIdEn');" 
                                                    ng-required="marriedCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39">সুনামগঞ্জ</option>
                                                    <option value="45">কিশোরগঞ্জ</option>
                                                    <option value="62">ময়মনসিংহ</option>
                                                    <option value="64">নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="married_wife_upazila_id" id="wifeUpazilaId" class="form-control" data-live-search="true"
                                                    onchange="getWifeUnionFn('wifeUpazilaId','wifeUnionId'); getWifeUpZillaEnName('wifeUpazilaId','wifeUpazilaIdEn');" ng-required="marriedCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="married_wife_union_id" id="wifeUnionId" class="form-control" 
                                                    onchange="getWifeUnionEnName('wifeUnionId','wifeUnionIdEn')" data-live-search="true" ng-required="marriedCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                        @else
                                            <input type="hidden" name="married_wife_district_id" value="{{$userInfo->district_id}}" id="wifeDistrictId">
                                            <input type="hidden" name="married_wife_upazila_id" value="{{$userInfo->upazila_id}}" id="wifeUpazilaId">
                                            <input type="hidden" name="married_wife_union_id" value="{{$userInfo->union_id}}" id="wifeUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="married_wife_ward_id" id="wifeWardNo" onchange="getWifeWardEnName('wifeWardNo','wifeWardNoEn')" class="form-control selectpicker" data-live-search="true" ng-required="marriedCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}">{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং <span class="text-danger">&nbsp;</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="wifeHoldingNo" id="wifeHoldingNo" name="wife_holding_no" class="form-control yes" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_post_office" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="marriedCertificateRequired">
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>Wife Info (English)</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_name_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father Name <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_wife_father_name_en" value="" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" name="married_wife_mother_name_en" value="" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>NID No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeNidNoEn" ng-value="wifeNidNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Date of Birth <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="wifeDobEn" ng-value="wifeDob" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="wifeHoldingNoEn" ng-value="wifeHoldingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_post_office_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="married_wife_village_en" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বিবাহ নিবন্ধনের তথ্য (বাংলায়)</legend>
        
                                            <div class="form-group">
                                                <label>নিবন্ধনের তারিখ <span class="text-danger">*</span></label>
                                                <input type="text" name="married_ragi_date" ng-model="regiDate" class="form-control datepicker" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>সিরিয়াল নং <span class="text-danger">*</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" name="married_ragi_serial_no" ng-model="regiSerialNo" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পেইজ নং <span class="text-danger">*</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" name="married_ragi_page_no" ng-model="ragiPageNo" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>কলাম নং <span class="text-danger">*</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" name="married_ragi_column_no" ng-model="ragiColumnNo" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>বছর <span class="text-danger">*</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" name="married_ragi_year" ng-model="ragiYear" class="form-control" ng-required="marriedCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>অফিসের ঠিকানা <span class="text-danger">*</span></label>
                                                <textarea rows="4" name="married_regi_address" class="form-control" ng-required="marriedCertificateRequired"></textarea>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>Marriage Registration Info (English)</legend>
        
                                            <div class="form-group">
                                                <label>Registration Date <span class="text-danger">*</span></label>
                                                <input type="text" ng-value="regiDate" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Serial No. <span class="text-danger">*</span></label>
                                                <input type="text" ng-value="regiSerialNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Page No. <span class="text-danger">*</span></label>
                                                <input type="text" ng-value="ragiPageNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Column No. <span class="text-danger">*</span></label>
                                                <input type="text" ng-value="ragiColumnNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Year <span class="text-danger">*</span></label>
                                                <input type="text" ng-value="ragiYear" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Office Address <span class="text-danger">*</span></label>
                                                <textarea rows="4" name="married_regi_address_en" class="form-control" ng-required="marriedCertificateRequired"></textarea>
                                            </div>
        
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div ng-show="affidavitType=='income_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বাংলায়</legend>
        
                                            <div class="form-group">
                                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="income_member_name" value="{{ (!empty($memberInfo->name) ? $memberInfo->name : "") }}"  class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম</label>
                                                <input type="text" name="income_father_name" value="{{ (!empty($memberInfo->father_name) ? $memberInfo->father_name : "") }}" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম</label>
                                                <input type="text" name="income_mother_name" value="{{ (!empty($memberInfo->mother_name) ? $memberInfo->mother_name : "") }}" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="income_district_id" id="incomeDistrictId" class="form-control" data-live-search="true"
                                                    onchange="getUpazilaFn('incomeDistrictId','incomeUpazilaId'); getDistrictEnName('incomeDistrictId','incomeDistrictIdEn');" 
                                                    ng-required="incomeCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39" {{ (($memberInfo->district_id == "39") ? "selected" : "") }} >সুনামগঞ্জ</option>
                                                    <option value="45" {{ (($memberInfo->district_id == "45") ? "selected" : "") }} >কিশোরগঞ্জ</option>
                                                    <option value="62" {{ (($memberInfo->district_id == "62") ? "selected" : "") }} >ময়মনসিংহ</option>
                                                    <option value="64" {{ (($memberInfo->district_id == "64") ? "selected" : "") }} >নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="income_upazila_id" id="incomeUpazilaId" class="form-control" data-live-search="true"
                                                    onchange="getUnionFn('incomeUpazilaId','incomeUnionId'); getUpZillaEnName('incomeUpazilaId','incomeUpazilaIdEn');" 
                                                    ng-required="incomeCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="income_union_id" id="incomeUnionId" class="form-control" 
                                                    onchange="getUnionEnName('incomeUnionId','incomeUnionIdEn')" data-live-search="true" ng-required="incomeCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="income_district_id" value="{{$userInfo->district_id}}" id="incomeDistrictId">
                                            <input type="hidden" name="income_upazila_id" value="{{$userInfo->upazila_id}}" id="incomeUpazilaId">
                                            <input type="hidden" name="income_union_id" value="{{$userInfo->union_id}}" id="incomeUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="income_ward_id" id="incomeWardNo" onchange="getWardEnName('incomeWardNo','incomeWardNoEn')" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="incomeCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ (($memberInfo->ward_id == $value->id) ? "selected" : "") }} >{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং</label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="incomeHoldingNo" ng-init="incomeHoldingNo={{ $memberInfo->holding_no }}" id="incomeHoldingNo" name="income_holding_no" 
                                                    onkeyup="uniqeHoldingNo('incomeHoldingNo','incomeWardNo','incomeUnionId')" class="form-control yes" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="income_post_office" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="income_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group" >
                                                <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                                <select name="income_marital_status" id="incomeMaritalStatus" onchange="maritalStatusFn('incomeMaritalStatus','incomeMaritalStatusEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="incomeCertificateRequired">
                                                    <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                                    @foreach(config('custom.maritalStatusBn') as $value)
                                                        <option value="{{ $value }}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="income_religion" id="incomeReligion" onchange="religionFn('incomeReligion','incomeReligionEn');" 
                                                    class="form-control selectpicker" data-live-search="true" ng-required="incomeCertificateRequired">
                                                    <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                        <option value="{{ $value }}" {{ (($memberInfo->religion == $value) ? "selected" : "") }} >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>English</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="income_member_name_en" value="{{ $memberInfo->name_en }}"  class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father / Husband Name</label>
                                                <input type="text" name="income_father_name_en" value="{{ $memberInfo->father_name_en }}" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="income_mother_name_en" value="{{ $memberInfo->mother_name_en }}" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="incomeDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="incomeUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="incomeUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="incomeWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="incomeHoldingNoEn" ng-value="holdingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="income_post_office_en" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="income_village_en" class="form-control" ng-required="incomeCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="incomeMaritalStatusEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="incomeReligionEn" class="form-control" readonly>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->nid_no }}" name="income_nid_no" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>মোবাইল নং</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->mobile_no }}" name="income_mobile_no" class="form-control" >
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>পিতার মাসিক আয়</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" ng-model="monthlyIncome" name="income_monthly_income" class="form-control" >
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>বার্ষিক আয়</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" name="income_yearly_income" ng-value="monthlyIncome*12" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div ng-show="affidavitType=='carecture_certificate'">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>বাংলায়</legend>
        
                                            <div class="form-group">
                                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_member_name" value="{{ (!empty($memberInfo->name) ? $memberInfo->name : "") }}"  class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম</label>
                                                <input type="text" name="carecture_father_name" value="{{ (!empty($memberInfo->father_name) ? $memberInfo->father_name : "") }}" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>মাতার নাম</label>
                                                <input type="text" name="carecture_mother_name" value="{{ (!empty($memberInfo->mother_name) ? $memberInfo->mother_name : "") }}" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                        @if($userInfo->privilege != 'user')
                                            <div class="form-group" >
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="carecture_district_id" id="carectureDistrictId" class="form-control" data-live-search="true"
                                                    onchange="getUpazilaFn('carectureDistrictId','carectureUpazilaId'); getDistrictEnName('carectureDistrictId','carectureDistrictIdEn');" 
                                                    ng-required="carectureCertificateRequired">
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39" {{ (($memberInfo->district_id == "39") ? "selected" : "") }}>সুনামগঞ্জ</option>
                                                    <option value="45" {{ (($memberInfo->district_id == "45") ? "selected" : "") }}>কিশোরগঞ্জ</option>
                                                    <option value="62" {{ (($memberInfo->district_id == "62") ? "selected" : "") }}>ময়মনসিংহ</option>
                                                    <option value="64" {{ (($memberInfo->district_id == "64") ? "selected" : "") }}>নেত্রকোণা</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="carecture_upazila_id" id="carectureUpazilaId" class="form-control" data-live-search="true"
                                                    onchange="getUnionFn('carectureUpazilaId','carectureUnionId'); getUpZillaEnName('carectureUpazilaId','carectureUpazilaIdEn');" 
                                                    ng-required="carectureCertificateRequired">
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="carecture_union_id" id="carectureUnionId" class="form-control" 
                                                    onchange="getUnionEnName('carectureUnionId','carectureUnionIdEn')" data-live-search="true" ng-required="carectureCertificateRequired">
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="carecture_district_id" value="{{$userInfo->district_id}}" id="carectureDistrictId">
                                            <input type="hidden" name="carecture_upazila_id" value="{{$userInfo->upazila_id}}" id="carectureUpazilaId">
                                            <input type="hidden" name="carecture_union_id" value="{{$userInfo->union_id}}" id="carectureUnionId">
                                        @endif
        
                                            <div class="form-group" >
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="carecture_ward_id" id="carectureWardNo" class="form-control selectpicker"
                                                    onchange="getWardEnName('carectureWardNo','carectureWardNoEn')" data-live-search="true" ng-required="carectureCertificateRequired">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ (($memberInfo->ward_id == $value->id) ? "selected" : "") }}>{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label>হোল্ডিং নং</label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="carectureHoldingNo" ng-init="carectureHoldingNo={{ $memberInfo->holding_no }}" id="carectureHoldingNo"  name="carecture_holding_no"
                                                    onkeyup="uniqeHoldingNo('carectureHoldingNo','carectureWardNo','carectureUnionId')" class="form-control yes" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>ডাকঘর <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_post_office" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label> গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_village" class="form-control" value="{{ $memberInfo->village }}" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group" >
                                                <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                                <select name="carecture_marital_status" id="carectureMaritalStatus" class="form-control selectpicker" 
                                                    onchange="maritalStatusFn('carectureMaritalStatus','carectureMaritalStatusEn');" data-live-search="true" ng-required="carectureCertificateRequired">
                                                    <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                                    @foreach(config('custom.maritalStatusBn') as $value)
                                                        <option value="{{ $value }}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                            <div class="form-group" >
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="carecture_religion" id="carectureReligion" class="form-control selectpicker"
                                                    onchange="religionFn('carectureReligion','carectureReligionEn');" data-live-search="true" ng-required="carectureCertificateRequired">
                                                    <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                        <option value="{{ $value }}" {{ (($memberInfo->religion == $value) ? "selected" : "") }} >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>English</legend>
        
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_member_name_en" value="{{ $memberInfo->name_en }}"  class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Father / Husband Name</label>
                                                <input type="text" name="carecture_father_name_en" value="{{ $memberInfo->father_name_en }}" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="carecture_mother_name_en" value="{{ $memberInfo->mother_name_en }}" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>District <span class="text-danger">&nbsp;</span></label>
                                                <input id="carectureDistrictIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="carectureUpazilaIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                                <input id="carectureUnionIdEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="carectureWardNoEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                                <input id="carectureHoldingNoEn" ng-value="carectureHoldingNo" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Post Office <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_post_office_en" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>
        
                                            <div class="form-group">
                                                <label>Village <span class="text-danger">*</span></label>
                                                <input type="text" name="carecture_village_en" class="form-control" ng-required="carectureCertificateRequired">
                                            </div>

                                            <div class="form-group">
                                                <label>Marital Status <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="carectureMaritalStatusEn" class="form-control" readonly>
                                            </div>
        
                                            <div class="form-group">
                                                <label>Religion <span class="text-danger">&nbsp;</span></label>
                                                <input type="text" id="carectureReligionEn" class="form-control" readonly>
                                            </div>
        
                                        </fieldset>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->nid_no }}" name="carecture_nid_no" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>মোবাইল নং</label>
                                            <input inputmode="numeric" pattern="[0-9]*" type="number" value="{{ $memberInfo->mobile_no }}" name="carecture_mobile_no" class="form-control" >
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group" tabindex="35">
                                            <label>ছবি (৩০০ X ৩০০)</label>
                                            
                                            @if(!empty($memberInfo->path))
                                            <br />
                                            <img src="{{ asset($memberInfo->path) }}" style="max-width: 100px;" class="img-thumbnail img" alt="Member Photo!">
                                            <input type="hidden" name="carecture_member_path" value="{{ $memberInfo->path }}" >
                                            @endif
                                            
                                            <input type="file" name="carecture_member_image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-md-12" id="submitBtn">
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
        fieldset {border: solid 1px #DDD !important; padding: 0 10px 10px 10px; border-bottom: none; margin-bottom: 15px; }
        legend {width: auto !important; border: none; font-size: 18px;}
        .hr_style {display: block; width: 100%; border-top: 1px solid #0B499D !important;}
        .no {border-color: red !important;}
        .yes {border-color: green !important;}
    </style>
@endpush
@push('footer-script')
    <script>
        $('#divisionId').selectpicker('refresh');
        $('#districtId').selectpicker('refresh');
        $('#wardNo').selectpicker('refresh');

        // get Upazila list 
        function getUpazilaFn(disId,upId) {
            var disSelector = '#' + disId;
            var upSelector = '#' + upId;
            
            $(upSelector).empty();
            var _districtId = ($(disSelector).val()) ? $(disSelector).val() : '{{ $memberInfo->district_id }}';
            var _upazilaId = ($(upSelector).val()) ? $(upSelector).val() : '{{ $memberInfo->upazila_id }}';
            $.ajax({
                method: "POST",
                url: "{{ route('admin.member.upazila-list') }}",
                data: {id: _districtId, select_id: _upazilaId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $(upSelector).append(response);
                $(upSelector).selectpicker('refresh');
            });
        }
        getUpazilaFn("districtId","upazilaId");
        getUpazilaFn("citizenDistrictId","citizenUpazilaId");
        getUpazilaFn("unmarriedDistrictId","unmarriedUpazilaId");
        getUpazilaFn("incomeDistrictId","incomeUpazilaId");
        getUpazilaFn("carectureDistrictId","carectureUpazilaId");


        // get Upazila list
        function getUnionFn(upId,unionId){
            var upSelector = '#' + upId;
            var unionSelector = '#' + unionId;
            
            $(unionSelector).empty();
            var _upazilaId = ($(upSelector).val()) ? $(upSelector).val() : '{{$memberInfo->upazila_id}}';
            var _unionId = ($(unionSelector).val()) ? $(unionSelector).val() : '{{$memberInfo->union_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: { id: _upazilaId, select_id: _unionId, _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $(unionSelector).append(response);
                $(unionSelector).selectpicker('refresh');
            });
        }
        getUnionFn("upazilaId","unionId");
        getUnionFn("citizenUpazilaId","citizenUnionId");
        getUnionFn("unmarriedUpazilaId","unmarriedUnionId");
        getUnionFn("incomeUpazilaId","incomeUnionId");
        getUnionFn("carectureUpazilaId","carectureUnionId");
        
        // Uniqe Holding No
        function uniqeHoldingNo(holdingNo,wardNo,unionId) {
            var holding_no = '#' + holdingNo;
            var ward_no = '#' + wardNo;
            var union = '#' + unionId;
            
            var _holdingNo = $(holding_no).val();
            var _wardNo = $(ward_no).val();
            var _unionId = $(union).val();
            
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.get-holding-no')}}",
                data: {union_id : _unionId, holding_no : _holdingNo, ward_id : _wardNo, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                if(response.union_id == _unionId && response.ward_id == _wardNo && response.holding_no == _holdingNo) {
                    $("#holdingNo").addClass("no");
                    $("#holdingNo").removeClass("yes");
                    $('#submitBtn').hide();
                }else{
                    $("#holdingNo").removeClass("no");
                    $("#holdingNo").addClass("yes");
                    $('#submitBtn').show();
                }
            });
        }


        // get district English Name list
        function getDistrictEnName(disId,disIdEn) {
            var disSelector = '#' + disId;
            var disEnSelector = '#' + disIdEn;
            
            $(disEnSelector).empty();
            var _districtId = ($(disSelector).val()) ? $(disSelector).val() : '{{ $memberInfo->district_id }}';
            $.ajax({
                method: "POST",
                url: "{{ route('admin.member.zilla-name') }}",
                data: { id: _districtId, select_id: _districtId, _token: "{{ csrf_token() }}" }
            }).then(function (response) {
                $(disEnSelector).val(response);
            });
        }
        
        getDistrictEnName('districtId','districtIdEn');
        getDistrictEnName('citizenDistrictId','citizenDistrictIdEn');
        getDistrictEnName('unmarriedDistrictId','unmarriedDistrictIdEn');
        getDistrictEnName('incomeDistrictId','incomeDistrictIdEn');
        getDistrictEnName('carectureDistrictId','carectureDistrictIdEn');

        // get Upzilla English Name list
        function getUpZillaEnName(upId,upIdEn) {
            var upSelector = '#' + upId;
            var upEnSelector = '#' + upIdEn;
            
            $(upEnSelector).empty();
            var _upazilaId = ($(upSelector).val()) ? $(upSelector).val() : '{{ $memberInfo->upazila_id }}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _upazilaId, select_id: _upazilaId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $(upEnSelector).val(response);
            });
        }
        getUpZillaEnName('upazilaId','upazilaIdEn');
        getUpZillaEnName("citizenUpazilaId","citizenUpazilaIdEn");
        getUpZillaEnName("unmarriedUpazilaId","unmarriedUpazilaIdEn");
        getUpZillaEnName("incomeUpazilaId","incomeUpazilaIdEn");
        getUpZillaEnName("carectureUpazilaId","carectureUpazilaIdEn");

        // get Union English Name list
        function getUnionEnName(unionId,unionIdEn) {
            var unionSelector = '#' + unionId;
            var unionEnSelector = '#' + unionIdEn;
            
            $(unionEnSelector).empty();
            var _unionId = ($(unionSelector).val()) ? $(unionSelector).val() : '{{$memberInfo->union_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-name')}}",
                data: {id: _unionId, select_id: _unionId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $(unionEnSelector).val(response);
            });
        }
        getUnionEnName("unionId","unionIdEn");
        getUnionEnName("citizenUnionId","citizenUnionIdEn");
        getUnionEnName("unmarriedUnionId","unmarriedUnionIdEn");
        getUnionEnName("incomeUnionId","incomeUnionIdEn");
        getUnionEnName("carectureUnionId","carectureUnionIdEn");

        // get Union English Name list
        function getWardEnName(wardNo,wardNoEn) {
            var wardSelector = '#' + wardNo;
            var wardEnSelector = '#' + wardNoEn;
            
            $(wardEnSelector).empty();
            var _wardNo = ($(wardSelector).val()) ? $(wardSelector).val() : '{{$memberInfo->ward_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _wardNo,  select_id: _wardNo, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $(wardEnSelector).val(response);
            });
        }
        getWardEnName("wardNo","wardNoEn");
        getWardEnName("citizenWardNo","citizenWardNoEn");
        getWardEnName("unmarriedWardNo","unmarriedWardNoEn");
        getWardEnName("incomeWardNo","incomeWardNoEn");
        getWardEnName("carectureWardNo","carectureWardNoEn");

        // get Marital Status English Name list
        function maritalStatusFn(maritalStatus,maritalStatusEn) {
            var maritalStatusSelector = '#' + maritalStatus;
            var maritalStatusEnSelector = '#' + maritalStatusEn;
            
            $(maritalStatusEnSelector).empty();
            var _maritalStatus = ($(maritalStatusSelector).val() ? $(maritalStatusSelector).val() : '{{ $memberInfo->marital_status }}');
            
            if(_maritalStatus == "অবিবাহিত"){
                $(maritalStatusEnSelector).val("Unmarried");
            }else if(_maritalStatus == "বিবাহিত"){
                $(maritalStatusEnSelector).val("Married");
            }else if(_maritalStatus == "তালাকপ্রাপ্ত"){
                $(maritalStatusEnSelector).val("Divorced");
            }else if(_maritalStatus == "বিচ্ছিন্ন বা বিধবা"){
                $(maritalStatusEnSelector).val("Separated or Widowed");
            }
        }
        
        // get Religion English Name list
        function religionFn(religion,religionEn) {
            var religionSelector = '#' + religion;
            var religionEnSelector = '#' + religionEn;
            
            $(religionEnSelector).empty();
            var _religion = ($(religionSelector).val()) ? $(religionSelector).val() : '{{$memberInfo->religion}}';
            
            if(_religion == "মুসলিম"){
                $(religionEnSelector).val("Muslim");
            }else if(_religion == "হিন্দু"){
                $(religionEnSelector).val("Hindu");
            }else if(_religion == "খ্রীষ্টান"){
                $(religionEnSelector).val("Christian");
            }else if(_religion == "বৌদ্ধ"){
                $(religionEnSelector).val("Buddhist");
            }else if(_religion == "অন্যান্য"){
                $(religionEnSelector).val("Other");
            }
        }
        religionFn('religion','religionEn');
        religionFn('citizenReligion','citizenReligionEn');
        religionFn('unmarriedReligion','unmarriedReligionEn');
        religionFn('incomeReligion','incomeReligionEn');
        religionFn('carectureReligion','carectureReligionEn');
        
        /* angular script */
        app.controller('appController', function ($scope) {

            $scope.affidavitCertificateRequired   = 'false';
            $scope.citizenshipCertificateRequired = 'false';
            $scope.unmarriedCertificateRequired   = 'false';
            $scope.marriedCertificateRequired     = 'false';
            $scope.incomeCertificateRequired      = 'false';
            $scope.carectureCertificateRequired   = 'false';
            
            $scope.$watch('affidavitType',function(affidavitType){
                
                $scope.affidavitCertificateRequired   = 'false';
                $scope.citizenshipCertificateRequired = 'false';
                $scope.unmarriedCertificateRequired   = 'false';
                $scope.marriedCertificateRequired     = 'false';
                $scope.incomeCertificateRequired      = 'false';
                $scope.carectureCertificateRequired   = 'false';
                
                if(typeof affidavitType !== "undefined" && affidavitType != ""){
                    if(affidavitType == 'affidavit_certificate'){
                        $scope.affidavitCertificateRequired = 'true';
                    }
                    if(affidavitType == 'citizenship_certificate'){
                        $scope.citizenshipCertificateRequired = 'true';
                    }
                    if(affidavitType == 'unmarried_certificate'){
                        $scope.unmarriedCertificateRequired = 'true';
                    }
                    if(affidavitType == 'married_certificate'){
                        $scope.marriedCertificateRequired = 'true';
                    }
                    if(affidavitType == 'income_certificate'){
                        $scope.incomeCertificateRequired = 'true';
                    }
                    if(affidavitType == 'carecture_certificate'){
                        $scope.carectureCertificateRequired = 'true';
                    }
                }
            });
        });
    </script>
@endpush
