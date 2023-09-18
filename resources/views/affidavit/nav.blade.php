@if(accessPrivilege("affidavit","",""))
<!-- body nav start -->
<div class="body_nav">
    <ul>
        @if(accessPrivilege("affidavit","new_affidavit",""))
        <li><a class="newAffidavit" href="{{route('admin.affidavit.new_affidavit')}}">১ম প্রত্যয়ন পত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","add_affidavit",""))
        <li><a class="addAffidavit" href="{{route('admin.affidavit.create')}}">২য় নাগরিকত্ব সনদপত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","inheritance_certificate",""))
        <li><a class="inheritanceCertificate" href="{{route('admin.affidavit.inheritance')}}">৩য় উত্তরাধিকার সনদপত্র</a></li>
        @endif

        @if(accessPrivilege("affidavit","family_certificate",""))
        <li><a class="familyCertificate" href="{{route('admin.affidavit.family')}}">৪র্থ পারিবারিক সনদপত্র</a></li>
        @endif

        @if(accessPrivilege("affidavit","unmarried_certificate",""))
        <li><a class="unmarriedCertificate" href="{{route('admin.affidavit.unmarried')}}">৫ম অবিবাহিত সনদপত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","married_certificate",""))
        <li><a class="marriedCertificate" href="{{route('admin.affidavit.married')}}">৬ষ্ঠ বিবাহিত সনদপত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","income_certificate",""))
        <li><a class="incomeCertificate" href="{{route('admin.affidavit.income')}}">৭ম বার্ষিক আয় সনদপত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","carecture_certificate",""))
        <li><a class="carectureCertificate" href="{{route('admin.affidavit.carecture')}}">৮ম চারিত্রিক সনদপত্র </a></li>
        @endif

        @if(accessPrivilege("affidavit","all_affidavit",""))
        <li><a class="allAffidavit" href="{{route('admin.affidavit')}}" >সকল সনদপত্র</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
@endif
