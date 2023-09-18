@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="affidavitCertificateController" ng-cloak>
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>প্রত্যয়ন পত্র যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.affidavit.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>তারিখ <span class="text-danger">*</span></label>
                                    <input type="text" name="created" value="{{ date('Y-m-d') }}" class="form-control datepicker" required>
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

                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>বাংলায়</legend>

                                    <div class="form-group">
                                        <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                        <input type="text" name="member_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>পিতা/স্বামীর নাম</label>
                                        <input type="text" name="father_name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>মাতার নাম</label>
                                        <input type="text" name="mother_name" value="" class="form-control" required>
                                    </div>

                                @if($userInfo->privilege != 'user')
                                    <div class="form-group" >
                                        <label>জেলা <span class="text-danger">*</span></label>
                                        <select name="district_id" id="districtId" onchange="getUpazilaFn(); getDistrictEnName();" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> জেলা নির্বাচন করুন</option>
                                            <option value="39">সুনামগঞ্জ</option>
                                            <option value="45">কিশোরগঞ্জ</option>
                                            <option value="62">ময়মনসিংহ</option>
                                            <option value="64">নেত্রকোণা</option>
                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila_id" id="upazilaId" onchange="getUnionFn(); getUpZillaEnName();" class="form-control" data-live-search="true" required>
                                            <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                        <select name="union_id" id="unionId" class="form-control" onchange="getUnionEnName()" data-live-search="true" required>
                                            <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                                    <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                                    <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                                @endif

                                    <div class="form-group" >
                                        <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                        <select name="ward_id" id="wardNo" onchange="getWardEnName()" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> নির্বাচন করুন</option>
                                            @foreach($wards as $key => $value)
                                                <option value="{{ $value->id }}">{{$value->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>হোল্ডিং নং</label>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*" ng-model="holdingNo" id="holdingNo" name="holding_no" onkeyup="uniqeHoldingNo()" class="form-control yes" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ডাকঘর <span class="text-danger">*</span></label>
                                        <input type="text" name="post_office" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label> গ্রাম <span class="text-danger">*</span></label>
                                        <input type="text" name="village" class="form-control" required>
                                    </div>

                                    <div class="form-group" >
                                        <label>বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                                        <select name="marital_status" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> বৈবাহিক অবস্থা নির্বাচন করুন</option>
                                            @foreach(config('custom.maritalStatusBn') as $value)
                                                <option value="{{ $value }}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>ধর্ম <span class="text-danger">*</span></label>
                                        <select name="religion" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> ধর্ম নির্বাচন করুন</option>
                                            @foreach(config('custom.religionBn') as $value)
                                                <option value="{{ $value }}">{{$value}}</option>
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
                                        <input type="text" name="member_name_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Father / Husband Name</label>
                                        <input type="text" name="father_name_en" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Mother Name</label>
                                        <input type="text" name="mother_name_en" value="" class="form-control" required>
                                    </div>

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
                                        <label>Post Office <span class="text-danger">*</span></label>
                                        <input type="text" name="post_office_en" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Village <span class="text-danger">*</span></label>
                                        <input type="text" name="village_en" class="form-control" required>
                                    </div>


                                    <div class="form-group" >
                                        <label>Marital Status <span class="text-danger">*</span></label>
                                        <select name="marital_status_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Marital Status</option>
                                            @foreach(config('custom.maritalStatusEn') as $value)
                                                <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>Religion <span class="text-danger">*</span></label>
                                        <select name="religion_en" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="" selected> Select Religion</option>
                                            @foreach(config('custom.religionEn') as $value)
                                                <option value="{{ $value }}">{{ strFilter($value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="nid_no" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>মোবাইল নং</label>
                                    <input inputmode="numeric" pattern="[0-9]*" type="number" name="mobile_no" class="form-control" >
                                </div>
                            </div>

                            <input type="hidden" name="affidavit_type" value="affidavit_certificate">

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
        app.controller('affidavitCertificateController', function($scope) {

           /*$scope.getBalance = function(){
               var annualAssessment = (!isNaN(parseFloat($scope.annualAssessment)) ? parseFloat($scope.annualAssessment) : 0);
               var amount = Math.ceil((annualAssessment/(14.28)));
               return amount;
           };*/

        });

        // get Ward Wise Member list
        function getMemberWardWiseFn() {
            $('#memberId').empty();
            var _unionId = $('#unionId').val();
            var _wardId = $('#wardNo').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-wise-mamber')}}",
                data: {ward_id : _wardId , union_id : _unionId, _token : "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#memberId').append(response);
                $('#memberId').selectpicker('refresh');
            });
        }

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

    </script>
@endpush
