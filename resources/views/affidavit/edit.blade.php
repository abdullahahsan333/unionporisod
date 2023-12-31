@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>নাগরিকত্ব সনদ পত্র পরিবর্তন করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.affidavit.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}" >
                        <div class="row">
                            <div class="col-md-6">
                                <label>তারিখ</label>
                                <div class="form-group">
                                    <input type="text" name="created" value="{{ (!empty($info) ? $info->created : date('Y-m-d')) }}" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>প্রত্যয়ন পত্র নং</label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="text" name="affidavit_no" value="{{ (!empty($info) ? $info->affidavit_no : "") }}" class="form-control" readonly>
                                </div>
                            </div>

                            @if($userInfo->privilege != 'user')
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="39" {{ ($info->district_id=='39' ? "selected" : " ") }} >
                                            সুনামগঞ্জ
                                        </option>
                                        <option value="45" {{ ($info->district_id=='45' ? "selected" : " ") }} >
                                            কিশোরগঞ্জ
                                        </option>
                                        <option value="62" {{ ($info->district_id=='62' ? "selected" : " ") }} >
                                            ময়মনসিংহ
                                        </option>
                                        <option value="64" {{ ($info->district_id=='64' ? "selected" : " ") }} >
                                            নেত্রকোণা
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>উপজেলা <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ইউনিয়ন <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
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
                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    <select name="ward_id" id="wardNo" onchange="getMemberWardWiseFn()" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @foreach($wards as $key => $value)
                                            <option value="{{ $value->id }}" {{(($info->ward_id==$value->id) ? 'selected' : '')}}>{{$value->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!--<div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="member_id" id="memberId" class="form-control" data-live-search="true" required>
                                        <option value="" selected>সদস্য নির্বাচন করুন </option>
                                    </select>
                                </div>
                            </div>-->

                            <div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="member_name" value="{{ (!empty($info) ? $info->member_name : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>হোল্ডিং নং</label>
                                <div class="form-group">
                                    <input type="text" name="holding_no" value="{{ (!empty($info) ? $info->holding_no : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ঠিকানা</label>
                                <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="আপনার ঠিকানা">{{ (!empty($info) ? $info->address : "") }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম</label>
                                <div class="form-group">
                                    <input type="text" name="father_name" value="{{ (!empty($info) ? $info->father_name : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>মোবাইল নং</label>
                                <div class="form-group">
                                    <input type="text" name="mobile_no" class="form-control" value="{{ (!empty($info) ? $info->mobile_no : "") }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                <div class="form-group">
                                    <input type="text" name="nid" class="form-control" value="" required>
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

                            <input type="hidden" name="affidavit_type" value="citizenship_certificate">

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
        app.controller('appController', function($scope) {
            /*$scope.getBalance = function(){
                var annualAssessment = (!isNaN(parseFloat($scope.annualAssessment)) ? parseFloat($scope.annualAssessment) : 0);
                var amount = Math.ceil((annualAssessment/(14.28)));
                return amount;
            };*/
        });

        $('#memberId').on('change', function(){
            //console.log(5);
            var holdingNo   = "";
            var fatherInfo  = "";
            var mobileNo    = "";

            var _memberId = $(this).val();
            $.ajax({
                method : "POST",
                url    : "{{route('admin.notice.member-info')}}",
                data   : { id: _memberId, select_id: {{ $info->member_id }}, _token: "{{ csrf_token() }}" }
            }).then(function(response){
                fatherInfo  = response.father_name;
                holdingNo   = response.holding_no;
                mobileNo    = response.mobile_no;

                $('#holdingNo').val(holdingNo);
                $('#fatherName').val(fatherInfo);
                $('#mobileNo').val(mobileNo);
            });
        });



        // get Ward Wise Member Info
        function getMemberWardWiseFn() {
            $('#memberId').empty();
            var _unionId = $('#unionId').val();
            var _wardId = $('#wardNo').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-wise-mamber')}}",
                data: {ward_id : _wardId , union_id : _unionId, select_id: "{{$info->id}}", _token : "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#memberId').append(response);
                $('#memberId').selectpicker('refresh');
            });
        }

        getMemberWardWiseFn();

        $('#divisionId').selectpicker();
        $('#districtId').selectpicker();

        // get Upazila list
        function getUpazilaFn (){
            $('#upazilaId').empty();
            var _districtId = ($('#districtId').val()) ? $('#districtId').val() : '{{$info->district_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: { id: _districtId, select_id: "{{$info->upazila_id}}", _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }
        getUpazilaFn();
        // get Upazila list
        function getUnionFn (){
            $('#unionId').empty();
            var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : '{{$info->upazila_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: { id: _upazilaId, select_id: "{{$info->union_id}}", _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }
        getUnionFn();

    </script>
@endpush
