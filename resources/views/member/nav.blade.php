<!-- body nav start -->

<div class="body_nav">
    <ul>
        @if(accessPrivilege("member", "new_member", ""))
        <li><a class="addMember" href="{{route('admin.member.create')}}">নতুন খানা সদস্য </a></li>
        @endif
        @if(accessPrivilege("member", "all_member", ""))
        <li><a class="allMember" href="{{route('admin.member')}}" >সকল খানা সদস্য </a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
