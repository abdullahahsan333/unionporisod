<!-- body nav start -->
@php($siteInfo = settings())
@php($privilege = Auth::user()->privilege)
<div class="body_nav">
    <ul>
        @if(accessPrivilege("tax_collection","add_tax",""))
        <li><a class="addTaxCollection" href="{{route('admin.tax-collection.create')}}">খানা সদস্য কর-সংগ্রহ করুন</a></li>
        @endif
        
        @if(accessPrivilege("tax_collection","bazar_tax",""))
        <li><a class="bazarTaxCollection" href="{{route('admin.tax-collection.bazar')}}">বাজারের সদস্য কর-সংগ্রহ করুন</a></li>
        @endif
        
        @if(accessPrivilege("tax_collection","all_tax",""))
        <li><a class="allTaxCollection" href="{{route('admin.tax-collection')}}">সকল কর দেখুন</a></li>
        @endif
    </ul>
</div>
<!-- body nav start -->
