@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
    @include('member.nav')

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>খানা সদস্য পরিবর্তন করুন</h4>
                </div>

                <div class="panel_body">
                    <form action="{{route('admin.member.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <!--<div class="row">-->

                            <!--<div class="col-md-6">-->
                                <fieldset>
                                    <legend>খানা সদস্যর তথ্য</legend>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানা প্রধানের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="householder" value="{{ $info->householder }}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানা প্রধানের স্ত্রীর নাম</label>
                                                <input type="text" name="householder_wife" value="{{ $info->householder_wife }}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="father_name" value="{{ $info->father_name }}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>মাতার নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="mother_name" value="{{ $info->mother_name }}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        
                                        @if($userInfo->privilege != 'user')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="39" {{ ($info->district_id=='39' ? "selected" : " ") }} > সুনামগঞ্জ </option>
                                                    <option value="45" {{ ($info->district_id=='45' ? "selected" : " ") }} > কিশোরগঞ্জ </option>
                                                    <option value="62" {{ ($info->district_id=='62' ? "selected" : " ") }} > ময়মনসিংহ </option>
                                                    <option value="64" {{ ($info->district_id=='64' ? "selected" : " ") }} > নেত্রকোণা </option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        </div>
                                        @else
                                            <input type="hidden" name="district_id" value="{{ $info->district_id }}" id="districtId">
                                            <input type="hidden" name="upazila_id" value="{{ $info->upazila_id }}" id="upazilaId">
                                            <input type="hidden" name="union_id" value="{{ $info->union_id }}" id="unionId">
                                        @endif
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="ward_id" id="wardNo" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}" {{ ($info->ward_id == $value->id ? 'selected' : '') }}>{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>হোল্ডিং নং <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="holding_no" ng-model="holdingNo" ng-init="holdingNo='{{$info->holding_no}}'" value="{{$info->holding_no}}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="village" value="{{$info->village}}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>এন.আই.ডি নং <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="nid_no" value="{{$info->nid_no}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="religion" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected>নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->religion == $value ? "selected" : "") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                                <input type="tel" placeholder="Without +88" name="mobile_no" value="{{$info->mobile_no}}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>পেশা <span class="text-danger">*</span></label>
                                                <select name="profession" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected>নির্বাচন করুন</option>
                                                    @foreach(config('custom.professionBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->profession == $value ? "selected" : " ") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>লিঙ্গ <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="পুরুষ" {{ ($info->gender=="পুরুষ" ? "selected" : "") }}>পুরুষ</option>
                                                    <option value="মহিলা" {{ ($info->gender=="মহিলা" ? "selected" : "") }}>মহিলা</option>
                                                    <option value="অন্যান্য" {{ ($info->gender=="অন্যান্য" ? "selected" : "") }}>অন্যান্য</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার সদস্য সংখ্যা <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_male" value="{{$info->member_male}}" class="form-control" placeholder="পুরুষ" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_female" value="{{$info->member_female}}" class="form-control" placeholder="মহিলা" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>বসতের মেঝের পরিমান (ফুট) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number"" name="floor_size" value="{{$info->floor_size}}" class="form-control" required>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>আবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="cultivable_land" value="{{$info->cultivable_land}}" class="form-control" required>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>অনাবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="uncultivated_land" value="{{$info->uncultivated_land}}" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>বসতের ধরন <span class="text-danger">*</span></label>
                                                <select name="settlement_type" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.settlementTypeBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->settlement_type == $value ? "selected" : "") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>বসত ভিটার জমির মালিকানার ধরন <span class="text-danger">*</span></label>
                                                <select name="ownership_type" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.ownershipTypeBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->ownership_type == $value ? "selected" : "") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য বর্তমানে সামাজিক নিরাপত্তা বেষ্টনী কোন কর্মসূচীর আওতায় আছে কিনা ? <span class="text-danger">*</span></label>
                                                <select name="social_security_act" id="socialSecurityAct" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ" {{ ($info->social_security_act == "হ্যাঁ" ? "selected" : "") }}> হ্যাঁ </option>
                                                    <option value="না" {{ ($info->social_security_act == "না" ? "selected" : "") }}> না </option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="securityAct">
                                            <div class="form-group">
                                                <label>সামাজিক নিরাপত্তা বেষ্টনী কর্মসূচীর নাম</label>
                                                <select name="social_act_name" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.socialActBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->social_act_name == $value ? "selected" : "") }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য প্রতিবন্ধী কিনা ? <span class="text-danger">*</span></label>
                                                <select name="handicapped" id="handicapped" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ" {{ ($info->handicapped == "হ্যাঁ" ? "selected" : "") }}>হ্যাঁ</option>
                                                    <option value="না" {{ ($info->handicapped == "না" ? "selected" : "") }}>না</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="handicappedName">
                                            <div class="form-group" tabindex="23">
                                                <label>প্রতিবন্ধী খানার নাম<span class="text-danger">*</span></label>
                                                <input type="text" name="handicapped_name" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা ? <span class="text-danger">*</span></label>
                                                <select name="freedom_fighters" id="freedomFighters" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ" {{ ($info->freedom_fighters == "হ্যাঁ" ? "selected" : "") }}> হ্যাঁ </option>
                                                    <option value="না" {{ ($info->freedom_fighters == "না" ? "selected" : "") }}> না </option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="fighterName">
                                            <div class="form-group">
                                                <label>মুক্তিযোদ্ধার নাম</label>
                                                <input type="text" name="fighter_name" value="{{$info->fighter_name}}" class="form-control">
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="fighterReletion">
                                            <div class="form-group">
                                                <label>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক</label>
                                                <input type="text" name="fighter_reletion" value="{{$info->fighter_reletion}}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>দারিদ্রসীমা <span class="text-danger">*</span></label>
                                                <select name="poverty_line" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.povertyLineBn') as $value)
                                                    <option value="{{ $value }}" {{ ($info->poverty_line == $value ? "selected" : "" ) }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            <!--</div>-->

                            <?php /* <div class="col-md-6">
                                <fieldset>
                                    <legend>English</legend>

                                    <div class="form-group" tabindex="6">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="districtIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="upazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="unionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="6">
                                        <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="holdingNoEn" ng-value="holdingNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group" tabindex="10">
                                        <label>Village <span class="text-danger">*</span></label>
                                        <input type="text" name="village_en" class="form-control" required>
                                    </div>

                                    <div class="form-group" tabindex="1">
                                        <label>House Holder Name <span class="text-danger">*</span></label>
                                        <input type="text" name="householder_en" class="form-control" required>
                                    </div>

                                    <div class="form-group" tabindex="2">
                                        <label>House Holder's Wife Name <span class="text-danger">*</span></label>
                                        <input type="text" name="householder_wife_en" class="form-control" required>
                                    </div>

                                    <div class="form-group" tabindex="4">
                                        <label>Father / Husband Name <span class="text-danger">*</span></label>
                                        <input type="text" name="father_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group" tabindex="5">
                                        <label>Mother Name<span class="text-danger">*</span></label>
                                        <input type="text" name="mother_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group" tabindex="12">
                                        <label>Religion <span class="text-danger">*</span></label>
                                        <select name="religion_en" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected> Select Religion </option>
                                            @foreach(config('custom.religionEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" tabindex="14">
                                        <label>Profession <span class="text-danger">*</span></label>
                                        <select name="profession_en" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected> Select Profession</option>
                                            @foreach(config('custom.professionEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" tabindex="15">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Gender </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group" tabindex="21">
                                        <label>Type of Settlement <span class="text-danger">*</span></label>
                                        <select name="settlement_type_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Settlement </option>
                                            @foreach(config('custom.settlementTypeEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" tabindex="22">
                                        <label>Type of Land Ownership <span class="text-danger">*</span></label>
                                        <select name="ownership_type_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Ownership </option>
                                            @foreach(config('custom.ownershipTypeEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" tabindex="23">
                                        <label>Have you any Handicapped Member ? <span class="text-danger">*</span></label>
                                        <select name="handicapped_en" id="handicappedEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="handicappedNameEn">
                                        <div class="form-group" tabindex="23">
                                            <label>Name of Handicapped Member<span class="text-danger">*</span></label>
                                            <input type="text" name="handicapped_name_en" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group" tabindex="24">
                                        <label>Have you recently been a member of the Social Security Program ? <span class="text-danger">*</span></label>
                                        <select name="social_security_act_en" id="socialSecurityActEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="securityActEn">
                                        <div class="form-group" tabindex="25">
                                            <label>Social Security Program Name <span class="text-danger">*</span></label>
                                            <select name="social_act_name_en" class="form-control selectpicker" data-live-search="true">
                                                <option value="" selected> Select Program </option>
                                                @foreach(config('custom.socialActEn') as $value)
                                                <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" tabindex="26">
                                        <label>Have you any Freedom Fighter member ? <span class="text-danger">*</span></label>
                                        <select name="freedom_fighters_en" id="freedomFightersEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="fighterNameEn">
                                        <div class="form-group" tabindex="27">
                                            <label> Freedom Fighter Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fighter_name_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div id="fighterReletionEn">
                                        <div class="form-group" tabindex="28">
                                            <label>Relation with Freedom Fighter <span class="text-danger">*</span></label>
                                            <input type="text" name="fighter_reletion_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group" tabindex="29">
                                        <label>Poverty Line <span class="text-danger">*</span></label>
                                        <select name="poverty_line_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Poverty Line </option>
                                            @foreach(config('custom.povertyLineEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                            </div> */ ?>
                        <!--</div>-->

                        <div class="row">
                            


                            <div class="col-md-6" > <!-- id="tubewell" -->
                                <label>টিউবওয়েল আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="tubewell" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->tubewell == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->tubewell == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6" > <!-- id="latrine" -->
                                <label>স্যানিটারী ল্যাট্রিন আছে কিনা ? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="latrine" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ" {{ ($info->latrine == "হ্যাঁ" ? "selected" : "") }}>
                                            হ্যাঁ
                                        </option>
                                        <option value="না" {{ ($info->latrine == "না" ? "selected" : "") }}>
                                            না
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>খানা প্রধানের বাৎসরিক আয় <span class="text-danger">&nbsp;</span></label>
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="annual_income" value="{{ (!empty($info->annual_income) ? $info->annual_income : 0) }}" class="form-control" autocomplete="off" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="taxes" ng-init="taxes={{ $info->taxes }}" ng-model="taxes" class="form-control" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group">
                                    <input type="text" name="estimated_value" ng-value="getEstimatedValue()" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group">
                                    <input type="text" name="annual_assessment" ng-value="getAnnualAsset()" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @if(!empty($info->path))
                                    <img class="img-thumbnail" src="{{asset($info->path)}}" style="width: 120px;" alt=""> <br/>
                                @endif
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group">
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>

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

            if ("<?php echo $info->handicapped; ?>" === "হ্যাঁ") {
                $('#handicappedName').show();
            } else {
                $('#handicappedName').hide();
            }

            $('#handicapped').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "হ্যাঁ"){
                    $('#handicappedName').show();
                }else{
                    $('#handicappedName').hide();
                }
            });

            if ("<?php echo $info->handicapped_en; ?>" === "Yes") {
                $('#handicappedNameEn').show();
            } else {
                $('#handicappedNameEn').hide();
            }
            $('#handicappedEn').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "Yes"){
                    $('#handicappedNameEn').show();
                }else{
                    $('#handicappedNameEn').hide();
                }
            });


            if ("<?php echo $info->freedom_fighters; ?>" === "হ্যাঁ") {
                $('#fighterName').show();
                $('#fighterReletion').show();
            } else {
                $('#fighterName').hide();
                $('#fighterReletion').hide();
            }

            $('#freedomFighters').on('change', function () {
                var _freedomFighters = $(this).val();
                if (_freedomFighters === "হ্যাঁ") {
                    $('#fighterName').show();
                    $('#fighterReletion').show();
                } else {
                    $('#fighterName').hide();
                    $('#fighterReletion').hide();
                }
            });

            if ("<?php echo $info->freedom_fighters_en; ?>" === "Yes") {
                $('#fighterNameEn').show();
                $('#fighterReletionEn').show();
            } else {
                $('#fighterNameEn').hide();
                $('#fighterReletionEn').hide();
            }

            $('#freedomFightersEn').on('change', function () {
                var _freedomFighters = $(this).val();
                if (_freedomFighters === "Yes") {
                    $('#fighterNameEn').show();
                    $('#fighterReletionEn').show();
                } else {
                    $('#fighterNameEn').hide();
                    $('#fighterReletionEn').hide();
                }
            });

            if ("<?php echo $info->social_security_act; ?>" === "হ্যাঁ") {
                $('#securityAct').show();
            } else {
                $('#securityAct').hide();
            }

            $('#socialSecurityAct').on('change', function () {
                var _socialSecurityAct = $(this).val();
                if (_socialSecurityAct === "হ্যাঁ") {
                    $('#securityAct').show();
                } else {
                    $('#securityAct').hide();
                }
            });
            if ("<?php echo $info->social_security_act_en; ?>" === "Yes") {
                $('#securityActEn').show();
            } else {
                $('#securityActEn').hide();
            }
            $('#socialSecurityActEn').on('change', function () {
                var _socialSecurityAct = $(this).val();
                if (_socialSecurityAct === "Yes") {
                    $('#securityActEn').show();
                } else {
                    $('#securityActEn').hide();
                }
            });
        });

        $('#divisionId').selectpicker();
        $('#districtId').selectpicker();

        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = ($('#districtId').val()) ? $('#districtId').val() : '{{$info->district_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _districtId, select_id: "{{$info->upazila_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        getUpazilaFn();

        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : '{{$info->upazila_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _upazilaId, select_id: "{{$info->union_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }

        getUnionFn();

        // get district English Name list
        function getDistrictEnName() {
            $('#districtIdEn').empty();
            var _districtId = ($('#districtId').val()) ? $('#districtId').val() : "{{$info->district_id}}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.zilla-name')}}",
                data: {id: _districtId, select_id: "{{$info->district_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#districtIdEn').val(response);
            });
        }
        getDistrictEnName();

        // get Upzilla English Name list
        function getUpZillaEnName() {
            $('#upazilaIdEn').empty();
            var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : "{{$info->upazila_id}}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _upazilaId, select_id: "{{$info->upazila_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#upazilaIdEn').val(response);
            });
        }
        getUpZillaEnName();

        // get Union English Name list
        function getUnionEnName() {
            $('#unionIdEn').empty();
            var _unionId = ($('#unionId').val()) ? $('#unionId').val() : "{{$info->union_id}}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-name')}}",
                data: {id: _unionId, select_id: "{{$info->union_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionIdEn').val(response);
            });
        }
        getUnionEnName()

        // get Union English Name list
        function getWardEnName() {
            $('#wardNoEn').empty();
            var _wardNo = ($('#wardNo').val()) ? $('#wardNo').val() : "{{$info->ward_id}}";
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _wardNo, select_id: "{{$info->ward_id}}", _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#wardNoEn').val(response);
            });
        }
        getWardEnName()

        app.controller('appController', function ($scope) {
            $scope.getAnnualAsset = function () {
                var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
                var amount = Math.ceil((taxes * 14.28));
                return amount;
            };
            $scope.getEstimatedValue = function () {
                var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
                var amount = Math.ceil((taxes * 284.78));
                return amount;
            };
        });
    </script>
@endpush







