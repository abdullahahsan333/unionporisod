

<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        
        @if(accessPrivilege("report","union_report",""))
        <li><a class="unionReport" href="{{route('admin.reports.union_report')}}">ইউনিয়ন রিপোর্ট</a></li>
        @endif

        @if(accessPrivilege("report","member_wise_tax_report",""))
        <li><a class="memberReport" href="{{route('admin.reports.member')}}" >সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
        @endif

        @if(accessPrivilege("report","bazar_member_wise_tax_report",""))
        <li><a class="bazar_memberReport" href="{{route('admin.reports.bazar_member')}}" >বাজার সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
        @endif

        @if(accessPrivilege("report","ward_wise_tax_report",""))
        <li><a class="wardReport" href="{{route('admin.reports.ward')}}" >ওয়ার্ড ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
        @endif
        
        @if(accessPrivilege("report","daily_tax_report",""))
        <li><a class="collectionReport" href="{{route('admin.reports.collection')}}" >দৈনিক ট্যাক্স সংগ্রহ রিপোর্ট</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->


