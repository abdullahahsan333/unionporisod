<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        <!--@if(Auth::user()->privilege == 'super')
        <li><a class="addMember" href="{{route('admin.member.create')}}">Add Member</a></li>
        @endif-->
        
        @if( ($privilege == 'super') || (!empty($accessList->notice->submenu->add_notice) && $accessList->notice->submenu->add_notice == "add_notice"))
        <li><a class="addNotice" href="{{route('admin.notice.create')}}">নতুন নোটিশ</a></li>
        @endif
        @if( ($privilege == 'super') || ( !empty($accessList->notice->submenu->all_notice) && $accessList->notice->submenu->all_notice == "all_notice"))
        <li><a class="allNotice" href="{{route('admin.notice')}}" >সকল নোটিশ</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
