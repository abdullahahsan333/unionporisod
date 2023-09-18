@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>উত্তরাধিকার সনদ পরিবর্তন করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.affidavit.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $info->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="{{ (!empty($info->created) ? $info->created : date('Y-m-d')) }}" class="form-control datepicker" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>প্রত্যয়ন পত্র নং</label>
                                <div class="form-group">
                                    <input inputmode="numeric" pattern="[0-9]*" type="text" name="affidavit_no" value="{{ (!empty($info->affidavit_no) ? $info->affidavit_no : "") }}" class="form-control" readonly>
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
                                            <option value="{{ $value->id }}" {{ (($value->id == $info->ward_id) ? "selected" : "") }}>{{$value->name_bn}}</option>
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
                                <label> নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="member_name" value="{{ (!empty($info->member_name) ? $info->member_name : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>হোল্ডিং নং</label>
                                <div class="form-group">
                                    <input type="text" name="holding_no" value="{{ (!empty($info->holding_no) ? $info->holding_no : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>ঠিকানা</label>
                                <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="আপনার ঠিকানা">{{ (!empty($info->address) ? $info->address : "") }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম</label>
                                <div class="form-group">
                                    <input type="text" name="father_name" value="{{ (!empty($info->father_name) ? $info->father_name : "") }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>মোবাইল নং</label>
                                <div class="form-group">
                                    <input type="text" name="mobile_no" value="{{ (!empty($info->mobile_no) ? $info->mobile_no : "") }}" class="form-control" value="" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>জাতীয় পরিচয়পত্র নম্বর</label>
                                <div class="form-group">
                                    <input type="text" name="nid" value="{{ (!empty($info->nid) ? $info->nid : "") }}" class="form-control" value="" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @if(!empty($info->path))
                                    <img class="img-thumbnail" src="{{asset($info->path)}}" style="width: 120px;" alt=""> <br/>
                                @endif
                                <label>ছবি (৩০০ X ৩০০)</label>
                                <div class="form-group" tabindex="35">
                                    <input type="file" name="affidavit_image" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="font-size: 1.2rem !important;" colspan="6">উত্তরাধিকারদের নাম</th>
                                        </tr>
                                        <tr>
                                            <tr>
                                                <th style="width: 30%;">নাম</th>
                                                <th style="width: 18%;">জন্ম তারিখ</th>
                                                <th style="width: 10%;">বয়স</th>
                                                <th style="width: 18%;">সম্পর্ক</th>
                                                <th style="width: 18%;">মন্তব্য</th>
                                                <th style="width: 6%;">একশন</th>
                                            </tr>
                                        </tr>
                                    </thead>

                                    <tbody id="addRow">
                                        @php($inherits = $inherit->where('affidavit_id', $info->id))
                                        @foreach($inherits as $key => $value)
                                        <tr id="{{ $key+999 }}">
                                            <td>
                                                <input type="hidden" name="inherit_id[]" value="{{ $value->id }}">
                                                <input type="text" name="inherit_name[]" class="form-control" value="{{ $value->inherit_name }}" required>
                                            </td>
                                            <td>
                                                <input type="date" name="inherit_dob[]" value="{{ (!empty($value->inherit_dob) ? $value->inherit_dob : date('Y-m-d')) }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="inherit_year[]" class="form-control" value="{{ $value->inherit_year }}" >
                                            </td>
                                            <td>
                                                <input type="text" name="inherit_relation[]" class="form-control" value="{{ $value->inherit_relation }}" >
                                            </td>
                                            <td>
                                                <input type="text" name="inherit_remarks[]" class="form-control" value="{{ $value->inherit_remarks }}" >
                                            </td>
                                            <td class="operation_btn text-right">
                                                <a class="delete" title="Delete" style="margin: 10px 0;" onclick="deleteItemFn({{ $key+999 }})">
                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td><input type="text" name="inherit_name[]" class="form-control"></td>
                                            <td><input type="date" name="inherit_dob[]" value="{{ date('Y-m-d') }}" class="form-control"></td>
                                            <td><input type="text" name="inherit_year[]" class="form-control"></td>
                                            <td><input type="text" name="inherit_relation[]" class="form-control"></td>
                                            <td><input type="text" name="inherit_remarks[]" class="form-control"></td>
                                            <td class="operation_btn text-center" style="vertical-align: middle;">-</td>
                                        </tr>
                                    </tbody>


                                    <tfoot>
                                        <caption class="operation_btn text-right">
                                            <a onclick="addNewRowFn()" class="view" title="view" style="margin: 10px 0;">
                                                <i class="fas fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </caption>
                                    </tfoot>
                                </table>
                            </div>

                            <input type="hidden" name="affidavit_type" value="inheritance_certificate">

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
    .hr_style {
        display: block;
        width: 100%;
        border-top: 1px solid #0B499D !important;
    }
</style>
@endpush
@push('footer-script')
    <script>

    function addNewRowFn(){

        let randomId = Math.floor(Math.random() * 1000000000);

        let createRow = `
                <tr id="`+ randomId +`">
                    <td><input type="text" name="inherit_name[]" class="form-control" required></td>
                    <td><input type="date" name="inherit_dob[]" value="{{ date('Y-m-d') }}" class="form-control" ></td>
                    <td><input type="text" name="inherit_year[]" class="form-control" ></td>
                    <td><input type="text" name="inherit_relation[]" class="form-control" ></td>
                    <td><input type="text" name="inherit_remarks[]" class="form-control"></td>
                    <td class="operation_btn text-right">
                        <a class="delete"
                        title="Delete" style="margin: 10px 0;" onclick="deleteItemFn(`+ randomId +`)">
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            `;

        $('#addRow').append(createRow);
    }

    function deleteItemFn(rowId){
        $('#addRow #' + rowId).remove();
    }


    /*    app.controller('appController', function($scope) {
           $scope.getBalance = function(){
               var annualAssessment = (!isNaN(parseFloat($scope.annualAssessment)) ? parseFloat($scope.annualAssessment) : 0);
               var amount = Math.ceil((annualAssessment/(14.28)));
               return amount;
           };

        });*/

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
