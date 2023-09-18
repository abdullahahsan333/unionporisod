@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>

        @include('member.nav')
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>খানা সদস্য যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.member.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!--<div class="row">-->
                            <!--<div class="col-md-6">-->
                                <fieldset>
                                    <legend>খানা সদস্যর তথ্য</legend>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানা প্রধানের নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="householder" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানা প্রধানের স্ত্রীর নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="householder_wife" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>পিতা/স্বামীর নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="father_name" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>মাতার নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="mother_name" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        
                                        @if($userInfo->privilege != 'user')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>জেলা <span class="text-danger">*</span></label>
                                                <select name="district_id" id="districtId" onchange="getUpazilaFn(); getDistrictEnName();" class="form-control" data-live-search="true" required>
                                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                                    <option value="39">সুনামগঞ্জ</option>
                                                    <option value="45">কিশোরগঞ্জ</option>
                                                    <option value="62">ময়মনসিংহ</option>
                                                    <option value="64">নেত্রকোণা</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>উপজেলা <span class="text-danger">*</span></label>
                                                <select name="upazila_id" id="upazilaId" onchange="getUnionFn(); getUpZillaEnName();" class="form-control" data-live-search="true" required>
                                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                                <select name="union_id" id="unionId" class="form-control" onchange="getUnionEnName()" data-live-search="true" required>
                                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        @else
                                            <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                                            <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                                            <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                                        @endif
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                                <select name="ward_id" id="wardNo" class="form-control selectpicker" onchange="getWardEnName()" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach($wards as $key => $value)
                                                        <option value="{{ $value->id }}">{{$value->name_bn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>হোল্ডিং নং <span class="text-danger">*</span></label>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="holdingNo" id="holdingNo" name="holding_no" onkeyup="uniqeHoldingNo()" class="form-control yes" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>গ্রাম <span class="text-danger">*</span></label>
                                                <input type="text" name="village" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>এন আই ডি নং<span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="nid_no" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ধর্ম <span class="text-danger">*</span></label>
                                                <select name="religion" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected>নির্বাচন করুন</option>
                                                    @foreach(config('custom.religionBn') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>মোবাইল নং <span class="text-danger">*</span></label>
                                                <input type="tel" placeholder="" name="mobile_no" class="form-control" required>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>পেশা <span class="text-danger">*</span></label>
                                                <select name="profession" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected>নির্বাচন করুন</option>
                                                    @foreach(config('custom.professionBn') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>লিঙ্গ <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="পুরুষ">পুরুষ</option>
                                                    <option value="মহিলা">মহিলা</option>
                                                    <option value="অন্যান্য">অন্যান্য</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার সদস্য সংখ্যা <span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_male" class="form-control" placeholder="পুরুষ" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input inputmode="numeric" pattern="[0-9]*" type="number" name="member_female" class="form-control" placeholder="মহিলা" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> বসত জমির পরিমান (স্কয়ার ফিট) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="floor_size" class="form-control" required>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> আবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="cultivable_land" class="form-control" required>
                                            </div>
                                        </div>
            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> অনাবাদী জমির পরিমান (শতাংশ) <span class="text-danger">*</span></label>
                                                <input inputmode="numeric" pattern="[0-9]*" type="number" name="uncultivated_land" class="form-control" required>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>বসতের ধরন <span class="text-danger">*</span></label>
                                                <select name="settlement_type" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.settlementTypeBn') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
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
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য প্রতিবন্ধী কিনা ? <span class="text-danger">*</span></label>
                                                <select name="handicapped" id="handicapped" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ">হ্যাঁ</option>
                                                    <option value="না">না</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="handicappedName">
                                            <div class="form-group">
                                                <label>প্রতিবন্ধী খানার নাম<span class="text-danger">*</span></label>
                                                <input type="text" name="handicapped_name" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য বর্তমানে সামাজিক নিরাপত্তা বেষ্টনী কোন কর্মসূচীর আওতায় আছে কিনা ? <span class="text-danger">*</span></label>
                                                <select name="social_security_act" id="socialSecurityAct" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ">হ্যাঁ</option>
                                                    <option value="না">না</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6" id="securityAct">
                                            <div class="form-group">
                                                <label>সামাজিক নিরাপত্তা বেষ্টনী কর্মসূচীর নাম <span class="text-danger">*</span></label>
                                                <select name="social_act_name" class="form-control selectpicker" data-live-search="true">
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.socialActBn') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা ? <span class="text-danger">*</span></label>
                                                <select name="freedom_fighters" id="freedomFighters" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    <option value="হ্যাঁ">হ্যাঁ</option>
                                                    <option value="না">না</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="fighterName">
                                            <div class="form-group">
                                                <label>মুক্তিযোদ্ধার নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="fighter_name" class="form-control" >
                                            </div>
                                        </div>
    
                                        <div class="col-md-6" id="fighterReletion">
                                            <div class="form-group">
                                                <label>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক <span class="text-danger">*</span></label>
                                                <input type="text" name="fighter_reletion" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>দারিদ্রসীমা <span class="text-danger">*</span></label>
                                                <select name="poverty_line" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="" selected> নির্বাচন করুন</option>
                                                    @foreach(config('custom.povertyLineBn') as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
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

                                    <div class="form-group">
                                        <label>District <span class="text-danger">&nbsp;</span></label>
                                        <input id="districtIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="upazilaIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Upzilla <span class="text-danger">&nbsp;</span></label>
                                        <input id="unionIdEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Ward No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="wardNoEn" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Holding No. <span class="text-danger">&nbsp;</span></label>
                                        <input id="holdingNoEn" ng-value="holdingNo" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Village <span class="text-danger">*</span></label>
                                        <input type="text" name="village_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>House Holder Name <span class="text-danger">*</span></label>
                                        <input type="text" name="householder_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>House Holder's Wife Name <span class="text-danger">*</span></label>
                                        <input type="text" name="householder_wife_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Father / Husband Name <span class="text-danger">*</span></label>
                                        <input type="text" name="father_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name<span class="text-danger">*</span></label>
                                        <input type="text" name="mother_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Religion <span class="text-danger">*</span></label>
                                        <select name="religion_en" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected> Select Religion </option>
                                            @foreach(config('custom.religionEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Profession <span class="text-danger">*</span></label>
                                        <select name="profession_en" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected> Select Profession</option>
                                            @foreach(config('custom.professionEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Gender </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Type of Settlement <span class="text-danger">*</span></label>
                                        <select name="settlement_type_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Settlement </option>
                                            @foreach(config('custom.settlementTypeEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Type of Land Ownership <span class="text-danger">*</span></label>
                                        <select name="ownership_type_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Ownership </option>
                                            @foreach(config('custom.ownershipTypeEn') as $value)
                                            <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Have you any Handicapped Member ? <span class="text-danger">*</span></label>
                                        <select name="handicapped_en" id="handicappedEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="handicappedNameEn">
                                        <div class="form-group">
                                            <label>Name of Handicapped Member<span class="text-danger">*</span></label>
                                            <input type="text" name="handicapped_name_en" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Have you recently been a member of the Social Security Program ? <span class="text-danger">*</span></label>
                                        <select name="social_security_act_en" id="socialSecurityActEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="securityActEn">
                                        <div class="form-group">
                                            <label>Social Security Program Name <span class="text-danger">*</span></label>
                                            <select name="social_act_name_en" class="form-control selectpicker" data-live-search="true">
                                                <option value="" selected> Select Program </option>
                                                @foreach(config('custom.socialActEn') as $value)
                                                <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Have you any Freedom Fighter member ? <span class="text-danger">*</span></label>
                                        <select name="freedom_fighters_en" id="freedomFightersEn" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select </option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div id="fighterNameEn">
                                        <div class="form-group">
                                            <label> Freedom Fighter Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fighter_name_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div id="fighterReletionEn">
                                        <div class="form-group">
                                            <label>Relation with Freedom Fighter <span class="text-danger">*</span></label>
                                            <input type="text" name="fighter_reletion_en" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group">
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

                            <div class="col-md-6"> <!--id="tubewell"-->
                                <div class="form-group">
                                    <label> আপনার কি টিউবওয়েল আছে? <span class="text-danger"></span></label>
                                    <select name="tubewell" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">  <!--id="latrine"-->
                                <label>আপনার কি স্যানিটারি ল্যাট্রিন আছে? <span class="text-danger"></span></label>
                                <div class="form-group">
                                    <select name="latrine" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>খানা প্রধানের বাৎসরিক আয় <span class="text-danger">&nbsp;</span></label>
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="annual_income" class="form-control" autocomplete="off" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>বার্ষিক কর/ করের পরিমাণ <span class="text-danger">*</span></label>
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="taxes" ng-model="taxes" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> বসতবাড়ির আনুমানিক মূল্য </label>
                                    <input type="text" name="estimated_value" ng-value="getEstimatedValue()" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> বার্ষিক মূল্যায়ন </label>
                                    <input type="text" name="annual_assessment" ng-value="getAnnualAsset()" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ছবি (৩০০ X ৩০০)</label>
                                    <input type="file" name="member_image" class="form-control">
                                </div>
                            </div>

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

            $('#handicappedName').hide();
            $('#handicapped').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "হ্যাঁ"){
                    $('#handicappedName').show();
                }else{
                    $('#handicappedName').hide();
                }
            });

            $('#handicappedNameEn').hide();
            $('#handicappedEn').on('change', function(){
                var _handicapped = $(this).val();
                if(_handicapped === "Yes"){
                    $('#handicappedNameEn').show();
                }else{
                    $('#handicappedNameEn').hide();
                }
            });


            $('#fighterName').hide();
            $('#fighterReletion').hide();

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

            $('#fighterNameEn').hide();
            $('#fighterReletionEn').hide();

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

            $('#securityAct').hide();
            $('#socialSecurityAct').on('change', function () {
                var _socialSecurityAct = $(this).val();
                if (_socialSecurityAct === "হ্যাঁ") {
                    $('#securityAct').show();
                } else {
                    $('#securityAct').hide();
                }
            });

            $('#securityActEn').hide();
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

        // get distric list
        function getDistrictFn() {
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.district-list')}}",
                data: {id: _divisionId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _districtId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                console.log(response);
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _upazilaId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }

        // Uniqe Holding No
        function uniqeHoldingNo() {
            var _holdingNo = $('#holdingNo').val();
            var _wardNo = $('#wardNo').val();
            var _unionId = $('#unionId').val();
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
        function getDistrictEnName() {
            $('#districtIdEn').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.zilla-name')}}",
                data: {id: _districtId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#districtIdEn').val(response);
            });
        }

        // get Upzilla English Name list
        function getUpZillaEnName() {
            $('#upazilaIdEn').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upzilla-name')}}",
                data: {id: _upazilaId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#upazilaIdEn').val(response);
            });
        }

        // get Union English Name list
        function getUnionEnName() {
            $('#unionIdEn').empty();
            var _unionId = $('#unionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-name')}}",
                data: {id: _unionId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionIdEn').val(response);
            });
        }

        // get Union English Name list
        function getWardEnName() {
            $('#wardNoEn').empty();
            var _wardNo = $('#wardNo').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-name')}}",
                data: {id: _wardNo, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#wardNoEn').val(response);
            });
        }

        /* angular script */
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
