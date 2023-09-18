@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<!-- body nav start -->
<div class="body_nav">
    <ul>
        @if( ($privilege == 'super') ||  !empty($accessList->mobile_sms->submenu->custom_sms) && $accessList->mobile_sms->submenu->custom_sms == "custom_sms")
        <li><a class="customSms" href="{{route('admin.sms.custom_sms')}}">কাস্টম এসএমএস</a></li>
        @endif
        @if( ($privilege == 'super') ||  !empty($accessList->mobile_sms->submenu->send_sms) && $accessList->mobile_sms->submenu->send_sms == "send_sms")
        <li><a class="sendSms" href="{{route('admin.sms.send_sms')}}" >সেন্ড এসএমএস</a></li>
        @endif
        @if( ($privilege == 'super') ||  !empty($accessList->mobile_sms->submenu->sms_report) && $accessList->mobile_sms->submenu->sms_report == "sms_report")
        <li><a class="smsReport" href="{{route('admin.sms')}}" >এসএমএস রিপোর্ট</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
