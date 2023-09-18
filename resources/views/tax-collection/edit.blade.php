  @extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        @include('tax-collection.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ পরিবর্তন করুন</h4>
                </div>
                
                <div class="panel_body">
                    <form action="{{route('admin.tax-collection.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$info->id}}" >
                        <div class="row">
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="{{ $info->created }}" class="form-control datepicker" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>রসিদ নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="receipt_no" value="{{ $info->receipt_no }}" class="form-control" required>
                                </div>
    						</div>
                            
                            @if($userInfo->privilege != 'user')
                            <div class="col-md-6">
                                <label>জেলা <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        <option value="39" {{ ($info->memberInfo->district_id=='39' ? "selected" : " ") }} >
                                            সুনামগঞ্জ
                                        </option>
                                        <option value="45" {{ ($info->memberInfo->district_id=='45' ? "selected" : " ") }} >
                                            কিশোরগঞ্জ
                                        </option>
                                        <option value="62" {{ ($info->memberInfo->district_id=='62' ? "selected" : " ") }} >
                                            ময়মনসিংহ
                                        </option>
                                        <option value="64" {{ ($info->memberInfo->district_id=='64' ? "selected" : " ") }} >
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
                                    <select name="ward_id" id="wardNo" onchange="getWardWiseFn()" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @foreach($wards as $key => $value)
                                            <option value="{{ $value->id }}" {{ (($info->memberInfo->ward_id==$value->id) ? "selected" : " ") }}>{{$value->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    						
                            <div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select name="member_id" id="memberName" class="form-control" data-live-search="true" required>
                                        <option value="" selected>সদস্য নির্বাচন করুন </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং</label>
                                <div class="form-group">
                                    <input type="text" id="holdingNo" value="{{ (!empty($info->memberInfo) ? $info->memberInfo->holding_no : " ") }}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম</label>
                                <div class="form-group">
                                    <input type="text" id="fatherName" value="{{ (!empty($info->memberInfo) ? $info->memberInfo->father_name : " ") }}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং</label>
                                <div class="form-group">
                                    <input type="text" id="mobileNo" class="form-control" value="{{ (!empty($info->memberInfo) ? $info->memberInfo->mobile_no : " ") }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>খানা প্রধানের বাৎসরিক আয় <span class="text-danger">&nbsp;</span></label>
                                    <input inputmode="numeric" ng-init="annualIncome={{ $info->annual_income }}" ng-model="annualIncome" pattern="[0-9]*" type="number" name="annual_income" class="form-control" autocomplete="off" >
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ</label>
                                <div class="form-group">
                                    <input type="text" id="taxes" name="taxes" class="form-control" ng-init="taxes={{ $info->taxes }}" ng-model="taxes" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group">
                                    <input type="text" name="annual_assessment" class="form-control" ng-value="getAnnualAsset()" readonly>
                                </div>
                            </div>
						
                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-value="getEstimatedValue()" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পূর্বের জমাকৃত ট্যাক্স</label>
                                <div class="form-group">
                                    <input type="text" id="previousPaid" class="form-control" value="{{ $previousPaid }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> অর্থ বছর </label>
                                <div class="form-group">
                                    <select name="finence_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y'); $i >= (date('Y')-4); $i--)
                                        <?php $finenceYear = ($i . '-' . ($i+1));
                                              $currentYear = date('Y') . '-' . (date('Y')+1);
                                        ?>
                                            <option value="{{ $finenceYear }}" {{ (($finenceYear==$currentYear) ? 'selected' : '') }}>{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ট্যাক্স জমা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-init="paid={{ $info->paid }}" ng-model="paid" pattern="[0-9]*" type="number" name="paid" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>জরিমানা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-init="fine={{ $info->fine }}" ng-model="fine" pattern="[0-9]*" type="number" name="fine" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মোট টাকা </label>
                                <div class="form-group">
                                    <input type="text" name="total" id="totalAmount" class="form-control" ng-value="paid + fine" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save"> আপডেট করুন </button>
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
    $('#memberName').on('change', function(){

        var holdingNo        = "";
        var fatherInfo       = "";
        var mobileNo         = "";
        var annualIncome     = "";
        var taxes            = "";
        var previousPaid     = "";

        var _memberId = $(this).val();

        $.ajax({
            method : "POST",
            url    : "{{route('admin.tax-collection.member-info')}}",
            data   : { id: _memberId, _token: "{{ csrf_token() }}" }
        }).then(function(response){

            fatherInfo       = response.father_name;
            holdingNo        = response.holding_no;
            mobileNo         = response.mobile_no;
            annualIncome     = response.annualIncome
            taxes            = response.taxes
            previousPaid     = response.previous_paid

            $('#holdingNo').val(holdingNo);
            $('#fatherName').val(fatherInfo);
            $('#mobileNo').val(mobileNo);
            $('#annualIncome').val(annualIncome);
            $('#taxes').val(taxes);
            $('#previousPaid').val(previousPaid);
        });
    });
    
    // get Ward Wise Member Info
    $('#memberName').selectpicker();
    function getWardWiseFn() {
        $('#memberName').empty();
        var _wardNo = ($('#wardNo').val()) ? $('#wardNo').val() : '{{ $info->memberInfo->ward_id }}';
        var _unionId = ($('#unionId').val()) ? $('#unionId').val() : '{{ $info->memberInfo->union_id }}';
        $.ajax({
            method: "POST",
            url: "{{route('admin.tax-collection.ward-wise-member')}}",
            data: {ward_id: _wardNo, select_id: "{{$info->memberInfo->id}}",union_id: _unionId, _token: "{{ csrf_token() }}"}
        }).then(function (response) {
            $('#memberName').append(response);
            $('#memberName').selectpicker('refresh');
        });
    }
    getWardWiseFn();

    $('#divisionId').selectpicker();
    $('#districtId').selectpicker();
    
    // get Upazila list
    function getUpazilaFn (){
        $('#upazilaId').empty();
        var _districtId = ($('#districtId').val()) ? $('#districtId').val() : '{{$info->memberInfo->district_id}}';
        $.ajax({
            method: "POST",
            url: "{{route('admin.member.upazila-list')}}",
            data: { id: _districtId, select_id: "{{$info->memberInfo->upazila_id}}", _token: "{{ csrf_token() }}" }
        }).then(function(response){
            $('#upazilaId').append(response);
            $('#upazilaId').selectpicker('refresh');
        });
    }
    getUpazilaFn();
    // get Upazila list
    function getUnionFn (){
        $('#unionId').empty();
        var _upazilaId = ($('#upazilaId').val()) ? $('#upazilaId').val() : '{{$info->memberInfo->upazila_id}}';
        $.ajax({
            method: "POST",
            url: "{{route('admin.member.union-list')}}",
            data: { id: _upazilaId, select_id: "{{$info->memberInfo->union_id}}", _token: "{{ csrf_token() }}" }
        }).then(function(response){
            $('#unionId').append(response);
            $('#unionId').selectpicker('refresh');
        });
    }
    getUnionFn();
    
    app.controller('appController', function($scope) {
        
       $scope.getAnnualAsset = function() {
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*14.28));
           return amount;
       };

       $scope.getEstimatedValue = function() {
           var taxes = (!isNaN(parseFloat($scope.taxes)) ? parseFloat($scope.taxes) : 0);
           var amount = Math.ceil((taxes*284.78));
           return amount;
       };
    });
</script>
@endpush
