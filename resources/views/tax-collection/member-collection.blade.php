@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container" ng-controller="appController" ng-cloak>
        @include('tax-collection.nav')
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.tax-collection.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="member_id" ng-init="memberId='{{$memberInfo->id}}'" ng-value="memberId">
                        
						<div class="row">
						    
                            <div class="col-md-6">
                                <label>তারিখ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="created" value="{{ date('Y-m-d') }}" class="form-control datepicker" required>
                                </div>
    						</div>
						    
                            <div class="col-md-6">
                                <label>রসিদ নং <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="receipt_no" class="form-control" required>
                                </div>
    						</div>
    						
    						
    						<div class="col-md-6">
                                <label>ওয়ার্ড নং <span class="text-danger">*</span></label>
                                <div class="form-group" >
                                    @php($wardInfo = $wards->where('id', $memberInfo->ward_id)->first())
                                    @php($wardName = !empty($wardInfo->name_bn) ? $wardInfo->name_bn : '')
                                    <input type="text" name="" value="{{$wardName}}" class="form-control" readonly>
                                </div>
                            </div>
    						
                            <div class="col-md-6">
                                <label>সদস্যের নাম <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" name="" value="{{$memberInfo->name}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>হোল্ডিং নং</label>
                                <div class="form-group">
                                    <input type="text" name="" value="{{$memberInfo->holding_no}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পিতা/স্বামীর নাম</label>
                                <div class="form-group">
                                    <input type="text" name="" value="{{$memberInfo->householder_wife}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>মোবাইল নং</label>
                                <div class="form-group">
                                    <input type="text" name="" value="{{$memberInfo->mobile_no}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>খানা প্রধানের বাৎসরিক আয় <span class="text-danger">&nbsp;</span></label>
                                    <input pattern="[0-9]*" type="number" name="" value="{{$memberInfo->annual_income}}" class="form-control" readonly >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক কর/ ট্যাক্সের পরিমাণ</label>
                                <div class="form-group">
                                    <input type="text" name="taxes" class="form-control" value="{{$memberInfo->taxes}}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বার্ষিক মূল্যায়ণ</label>
                                <div class="form-group">
                                    <input type="text" name="annual_assessment" value="{{$memberInfo->annual_assessment}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>বসত ঘরের আনুমানিক মূল্য</label>
                                <div class="form-group">
                                    <input type="text" name="estimated_value" value="{{$memberInfo->estimated_value}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>পূর্বের জমাকৃত ট্যাক্স</label>
                                <div class="form-group">
                                    <input type="text" ng-model="previousPaid" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> অর্থ বছর </label>
                                <div class="form-group">
                                    <select name="finence_year" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="" selected> নির্বাচন করুন</option>
                                        @for ($i = date('Y'); $i >= (date('Y')-4); $i--)
                                        @php($finenceYear = ($i . '-' . ($i+1)))
                                            <option value="{{ $finenceYear }}">{{ $finenceYear }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>ট্যাক্স জমা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-model="paid" pattern="[0-9]*" type="number" name="paid" class="form-control" value="" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>জরিমানা</label>
                                <div class="form-group">
                                    <input inputmode="numeric" ng-model="fine" pattern="[0-9]*" type="number" name="fine" class="form-control" value="" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label> মোট টাকা </label>
                                <div class="form-group">
                                    <input type="text" name="total" class="form-control" ng-value="paid + fine" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn submit_btn" name="save"> সেইভ করুন </button>
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
    app.controller('appController', function($scope, $http) {
        
        $scope.previousPaid = 0
    
        $scope.$watch('memberId', function(memberId){
            
            $http({
                method : "POST",
                url    : "{{route('admin.tax-collection.member-info')}}",
                data   : { id: memberId, _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $scope.previousPaid = parseFloat(response.data.previous_paid);
            })
        });
    });
</script>
@endpush
