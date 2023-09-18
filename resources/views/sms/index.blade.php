@extends('layouts.backend')

@section('content')
<!-- body container start -->
<div class="body_container">
    @include('sms.nav')

    <!-- body content start -->
    <div class="body_content">
        <div class="panel_container">
            <div class="panel_heading">
                <h4>এসএমএস রিপোর্ট</h4>
            </div>
            <div class="panel_body">
               <blockquote class="form_head">
                   <p>মোট এসএমএসঃ <strong>{{ smsLimit() }}</strong><br />
                       মোট সেন্ড এসএমএসঃ
                       <strong>{{ totalSendSms() }}</strong><br />
                       মোট বাকি এসএমএসঃ
                       <strong>{{ smsLimit() - totalSendSms() }}</strong>
                   </p>
                </blockquote>

                <form action="{{ route('admin.sms') }}" method="POST">
                    @csrf
                    
                    
                    <div class="form-row print_hide">
                        @if($userInfo->privilege != 'user')
                        <div class="col-md-3">
                            <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" >
                                <option value="" selected> জেলা নির্বাচন করুন</option>
                                <option value="39">সুনামগঞ্জ</option>
                                <option value="45">কিশোরগঞ্জ</option>
                                <option value="62">ময়মনসিংহ</option>
                                <option value="64">নেত্রকোণা</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" >
                                <option value="" selected> উপজেলা নির্বাচন করুন</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <select name="union_id" id="unionId" class="form-control" data-live-search="true" >
                                <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                            <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                            <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                        @endif
                        
						<div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="form" placeholder="Form" class="form-control datepicker">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="to" placeholder="To" class="form-control datepicker">
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
								<input type="submit" class="btn submit_btn" name="search" value="Show">
							</div>
						</div>
                    </div>
                </form>
                <hr class="mt-0 print_hide">
                @if(!empty($sms_report))
                <div class="table-responsive">
                    <table class="table table-bordered list-table">
                        <thead>
                            <tr>
                                <th>ক্র নং</th>
                                <th>তারিখ</th>
                                <th>মোবাইল</th>
                                <th>মেসেজ</th>
                                <th class="text-center">স্টেটাস</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sms_report as $key => $row)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->sending_date }}</td>
                                <td>{{ $row->mobile }}</td>
                                <td>{{ $row->sms }}</td>
                                <td class="text-center">
                                    @if($row->is_send)
                                        <button class="btn btn-outline-success btn-sm" type="submit">এসএমএস সেন্ড হইছে</button>
                                    @else
                                        <button class="btn btn-outline-danger btn-sm" type="submit">এসএমএস সেন্ড হয়নি</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="panel_footer"></div>
        </div>
    </div>
    <!-- body content end -->
</div>
<!-- body container end -->
@endsection

@push('header-style')
<style>
    .form_head {
        border-left: 4px solid #303F9F;
        padding: 7px 0 7px 12px;
        margin-bottom: 20px;
    }
    .form_head p {
        font-size: 16px;
        margin: 0;
    }
    .form_head strong {font-size: 15px;}
</style>
@endpush
