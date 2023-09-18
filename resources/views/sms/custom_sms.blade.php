@extends('layouts.backend')

@section('content')
<!-- body container start -->
<div class="body_container">
    @include('sms.nav')
    <!-- body content start -->
    <div class="body_content" ng-controller="customSMSCtrl">
        <div class="panel_container">
            <div class="panel_heading">
                <h4>কাস্টম এসএমএস</h4>
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
                <hr class="mt-0 print_hide">
                <form action="{{ route('admin.sms.submit_send_sms') }}" method="POST">
                    @csrf
                    <div class="form-row print_hide">
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea style="height: 206px;" class="form-control" name="mobiles"
                                    placeholder="আপনার মোবাইল নং লিথুন..." rows="4"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" ng-model="msgContant"
                                    placeholder="আপনার মেসেজ লিখুন। সর্বোচ্চ ১০৮০ অক্ষর লিখুন..." rows="8"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="total_msg">
                                        <strong>মোট অক্ষরঃ</strong>
                                        <input type="number" value="@{{ totalChar }}" name="characters" readonly>
                                        <strong>মোট মেসেজঃ</strong>
                                        <input type="number" name="message_length" readonly value="@{{msgSize}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn submit_btn" name="sendSms">সেন্ড</button>
                                    </div>
                                </div>
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

.form_head strong {
    font-size: 15px;
}

.total_msg {
    justify-content: flex-end;
    display: flex;
}

.total_msg strong {
    margin-left: 15px;
}

.total_msg input {
    box-shadow: none;
    border: none;
    width: 40px;
    padding: 0;
    outline: none;
    margin-left: 12px;
    text-align: right;
}
</style>
@endpush
