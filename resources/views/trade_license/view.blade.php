@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>ট্রেড লাইসেন্স</h4>
                    <a id="print" title="Page: A4; Scale: (Firefox: Custom(112) & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.trade_license.view-en', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> Engilish Profile
                        </a>
                    </div>

                    <div class="trade_license position-relative">
                        <!-- <div class="position-absolute justify-content-center align-items-center h-100 w-100 bg_photo">
                            <img class="bg_img" src="{{asset('public/license/govbd.png')}}" alt="Photo Not Found!">
                        </div> -->

                        @php($union_name     = $unions->where('id', $info->union_id)->first())
                        @php($upazilas_name  = $upazilas->where('id', $info->upazila_id)->first())
                        @php($districts_name = $districts->where('id', $info->district_id)->first())

                        <div class="print_header_info print_only">

                            <div class="row">
                                <div class="col-3">
                                    <figure class="qr_code">
                                        <img src="{{asset('public/license/qr_code.webp')}}" alt="Photo Not Found!">
                                    </figure>
                                    <h6>লাইসেন্স ইস্যুর বিবরণ</h6>
                                    <small>ইস্যুর তারিখ (Date of Issue): {{ numberFilter($info->created,'bn') }}</small>
                                    <!-- <p>ইস্যুর সময় (Issue Time):</p> -->
                                </div>
                                <div class="col-6">
                                    <h4>{{ (!empty($union_name) ? $union_name->bn_name : " ") }}  ইউনিয়ন পরিষদ কার্যালয়</h4>
                                    <h4>{{ (!empty($upazilas_name) ?  $upazilas_name->bn_name : " ") }}, {{ (!empty($districts_name) ? $districts_name->bn_name : " ") }}</h4>
                                    <p>ওয়েবসাইট/Website: {{ $_SERVER['HTTP_HOST'] }}</p>{{-- URL::to('') --}}
                                    <figure class="govbd">
                                        <img src="{{asset('public/license/govbd.png')}}" alt="Photo Not Found!">
                                    </figure>
                                </div>
                                <div class="col-3">
                                    @if(!empty($info->path))
                                    <figure class="profile">
                                        <img src="{{asset($info->path)}}" alt="Photo Not Found!">
                                    </figure>
                                    @else
                                    <figure class="profile">&nbsp;</figure>
                                    @endif
                                </div>
                            </div>

                            <!-- <h1>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h1> -->
                            <h2><strong class="title">ট্রেড লাইসেন্স</strong></h2>
                            <p>
                                ট্রেড লাইসেন্স নং: {{ numberFilter($info->license_no,'bn') }}
                            </p>
                        </div>

                        <div class="license_body">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <p>
                                    স্থানীয় সরকার (ইউনিয়ন পরিষদ) আইন, ২০০৯ (২০০৯ সনের ৬১ নং আইন) এর ধারা ৬৬ তে প্রদত্ত  ক্ষমতা বলে সরকার প্রণীত আদর্শ কর তফসিল , ২০১৬ এর ৬ ও ১৭ নং অনুচ্ছেদ অনুযায়ী ব্যবসা , বৃত্তি , পেশা বা শিল্প প্রতিষ্ঠানের উপর আরোপিত কর আদায়ের লক্ষ্যে নির্ধারিত শর্তে নিম্নবর্ণিত ব্যক্তি/প্রতিষ্ঠানের অনুকূলে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো:
                                    </p>
                                    <hr class="hr">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        <span>০১. ব্যবসা প্রতিষ্ঠানের নাম: </span>
                                        {{ $info->business_name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০২. স্বত্বাধিকারী/লাইসেন্সধারীর নাম: </span>
                                        {{ $info->license_owner }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৩. মাতা নাম: </span>
                                        {{ $info->mother_name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৪. পিতা/স্বামী নাম: </span>
                                        {{ $info->father_name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৫. স্পাউজের নাম (প্রযোজ্য ক্ষেত্রে): </span>
                                        {{ $info->spouse_name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৬. ব্যবসার প্রকৃতি: </span>
                                        {{ $info->business_nature }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৭. ব্যবসার/পেশার ধরণ: </span>
                                        {{ $info->business_type }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>০৮. ব্যবসা প্রতিষ্ঠানের ঠিকানা: </span>
                                        {{ $info->business_address }}
                                    </p>
                                </div>
                                <div class="col-sm-7">
                                    <p>
                                        <span>০৯. (ক) অঞ্চল (প্রযোজ্য ক্ষেত্রে): </span>
                                        {{ $info->zone }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(খ) ওয়ার্ড নং: </span>
                                        {{ $info->ward_no }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>১০. (ক) জন্ম নিবন্ধন/এনআইডি/পাসপোর্ট নং: </span>
                                        {{ numberFilter($info->nid,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>(খ) টিআইএন: </span>
                                        {{ numberFilter($info->tin,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(গ) বিআইএন: </span>
                                        {{ numberFilter($info->bin,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>(ঘ) টেলিফোন / মোবাইল নাম্বার: </span>
                                        {{ numberFilter($info->mobile,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(ঙ) ই-মেইল: </span>
                                        <span style="font-size: 14px;">{{ $info->email }}</span>
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span>১১. (ক) অর্থ বছরঃ </span>
                                        {{ numberFilter($info->finance_year,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(খ) ব্যবসা শুরুর তারিখ: </span>
                                        {{ numberFilter($info->business_start, 'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p><strong class="title">১২. মালিক / স্বতাধিকারীর বর্তমান ঠিকানা </strong></p>
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>হোল্ডিং নং: </span>
                                        {{ numberFilter($info->pre_holding_no, 'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p><strong class="title">মালিক / স্বতাধিকারীর স্থায়ী ঠিকানা </strong></p>
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>হোল্ডিং নং: </span>
                                        {{ numberFilter($info->par_holding_no, 'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>রোড নং: </span>
                                        {{ numberFilter($info->pre_road_no, 'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>রোড নং: </span>
                                        {{ numberFilter($info->par_road_no, 'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>গ্রাম বা মহল্লা: </span>
                                        {{ $info->pre_village }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>গ্রাম বা মহল্লা: </span>
                                        {{ $info->par_village }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                    <span class="tab_space">&nbsp;</span>
                                        <span>ডাকঘর: </span>
                                        {{ $info->pre_post_office }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>ডাকঘর: </span>
                                        {{ $info->par_post_office }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>পোস্ট কোড: </span>
                                        {{ $info->pre_post_code }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>পোস্ট কোড: </span>
                                        {{ $info->par_post_code }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_upazilas_name  = $upazilas->where('id', $info->pre_upazila_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>উপজেলা: </span>
                                        {{ $pre_upazilas_name->bn_name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($par_upazilas_name  = $upazilas->where('id', $info->par_upazila_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>উপজেলা: </span>
                                        {{ $par_upazilas_name->bn_name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_districts_name = $districts->where('id', $info->pre_district_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>জেলা: </span>
                                        {{ $pre_districts_name->bn_name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_districts_name = $districts->where('id', $info->par_district_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>জেলা: </span>
                                        {{ $pre_districts_name->bn_name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>১৩. আদর্শ কর তফসিল , ২০১৬ এর ক্রমিক নং: </span>
                                        {{ numberFilter($info->tax_serial_no,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span>১৪. লাইসেন্স ফি: </span>
                                        {{ numberFilter($info->license_fee,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>সাইন বোর্ড (পরিচিতি মূলক): </span>
                                        {{ numberFilter($info->signboard_charge,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>বকেয়া টাকা: </span>
                                        {{ numberFilter($info->due_charge,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>আয়কর/উৎস কর: </span>
                                        {{ numberFilter($info->income_tax,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>সারচার্জ: </span>
                                        {{ numberFilter($info->sur_charge,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>ভ্যাট: </span>
                                        {{ numberFilter($info->vat,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>সংশোধন ফি: </span>
                                        {{ numberFilter($info->amendment_charge,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>মোট: </span>
                                        {{ numberFilter($info->total,'bn') }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>১৫. কথায়: </span>
                                        {{ $obj->numToWord($info->total) }} টাকা মাত্র।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="footer_signature">
                            <div class="signature_box">

                                <?php if(!empty($sign_name)){
                                    $ministers = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($ministers)) { ?>
                                    <p>{{ (!empty($ministers) ? $ministers->minister : "") }}</p>
                                    <p><span>সচিব</span></p>

                                        @php($district = $districts->where('id', $ministers->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $ministers->upazila_id)->first())
                                        @php($union    = $unions->where('id', $ministers->union_id)->first())

                                    <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                        {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><span>সচিব</span></p>
                                <p>{{(!empty($union_name) ? $union_name->bn_name : " ")}} ইউনিয়ন পরিষদ কার্যালয়</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->bn_name : " ")}}, {{(!empty($districts_name) ? $districts_name->bn_name : " ")}}।</p>

                                <?php } } ?>

                            </div>
                            <div class="signature_box">

                                <?php if(!empty($sign_name)){
                                    $chairmans = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($chairmans)) { ?>
                                    <p>{{ (!empty($chairmans) ? $chairmans->chairman : "") }}</p>
                                    <p><span>চেয়ারম্যান</span></p>

                                        @php($district = $districts->where('id', $chairmans->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $chairmans->upazila_id)->first())
                                        @php($union    = $unions->where('id', $chairmans->union_id)->first())

                                    <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                        {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><span>চেয়ারম্যান</span></p>
                                <p>{{(!empty($union_name) ? $union_name->bn_name : " ")}} ইউনিয়ন পরিষদ কার্যালয়</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->bn_name : " ")}}, {{(!empty($districts_name) ? $districts_name->bn_name : " ")}}।</p>

                                <?php } } ?>

                            </div>
                        </div>
                    </div>
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
    .enbn_btn {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }
    .enbn_btn .view {
        color: #fff !important;
        display: inline-block;
        border-radius: 2px;
        font-size: 14px;
        padding: 4px 10px;
        transition: all .2s;
        background: #303F9F;
    }

    strong.title {text-decoration: underline;}
    .panel_body p {margin: 0;}
    .btn-link {color: #222;}
    .body_container {font-family: 'Noto Serif Bengali', serif;}
    .body_container p {
        font-size: 20px;
        color: #000;
    }

    span.tab_space {
        width:40px;
        display: block;
        float: left;
    }
    .white_space {height: 100%; width: 40px;}
    /* .license_main_body {float:left;} */
    hr.hr {
        margin: 8px 25px;
    }
    .print_header_info figure {
        margin: 0 auto;
        width: 40%;
        display:block;
        overflow:hidden;
    }
    .print_header_info {
        text-align: center;
        padding-bottom: 10px;
    }
    .print_header_info figure img {
        max-width: 100%;
        width: 100%;
        height: 100px;
    }
    .print_header_info figure.profile img, .print_header_info figure.qr_code img, .print_header_info figure.govbd img {
        width: 100%;
    }
    .print_header_info figure.govbd {
        width: 25%;
    }
    .print_header_info figure.profile {
        width: 60%;
        height: 150px;
        overflow: hidden;
    }
    .print_header_info figure.profile img {
        height: 100% !important;
    }
    .print_header_info figure.profile, .print_header_info figure.qr_code {
        margin-top: 60px;
        border:1px solid #444;
    }

    .bg_photo {
        display: none;
    }
    .bg_img{
        width: 60%;
        opacity:0.12;
    }
    .print_header_info h1 {
        font-weight: bold;
        margin-top: 0;
        color: #000;
    }
    .print_header_info h2 {
        margin-top: 10px !important;
    }
    .print_header_info h2 strong {
        padding: 0 70px;
        /* background: #444; */
        color: #000;
        font-weight: bold;
    }
    .print_header_info h4 {
        margin: 3px 0;
        color: #000;
    }
    .footer_signature {
        justify-content: space-between;
        margin-top: 85px;
        margin-bottom: 45px;
        display: flex;
    }
    .footer_signature p {
        line-height: 22px;
        margin: 0;
        font-size: 18px;
    }
    .footer_signature .signature_box {
        border-top: 2px dashed #000;
        text-align: center;
        padding-top: 10px;
    }
    .footer_middle {
        margin: 20px 0;
    }
    .footer_middle img.qr_code {
        max-width: 100%;
        width: 120px;
    }
    .footer_middle p, .footer_bottom p {
        margin-bottom: 0;
        width: 100%;
    }
    .footer_bottom {
        border-top: 2px solid #333;
    }
    .table-bordered td, .table-bordered th, .body_content .table th {font-size: 18px !important;}
    @media print{
        .enbn_btn {
            display: none;
        }
        .bg_photo {
            display: flex;
        }
        table.table.table-bordered tr th, table.table.table-bordered tr td,table.table.table-bordered tr, table.table.table-bordered {
            border: 1px solid transparent !important;
        }
    }
</style>
@endpush
