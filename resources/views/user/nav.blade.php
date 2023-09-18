
<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
@php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
<div class="body_nav">
    <ul>
        @if( ($privilege == 'super') || (!empty($accessList->user->submenu->add_user) && $accessList->user->submenu->add_user=="add_user"))
        <li><a class="add_user" href="{{route('admin.user.create')}}" class="active">নতুন ইউজার</a></li>
        @endif
        @if( ($privilege == 'super') || (!empty($accessList->user->submenu->all_user) && $accessList->user->submenu->all_user=="all_user"))
        <li><a class="all_user" href="{{route('admin.user')}}" >সকল ইউজার</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
