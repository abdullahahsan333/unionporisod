@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>বিবাহিত সনদপত্র</h4>

                    <a id="print" title="Page: A4; margin: none; Scale: (Firefox: Default & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.affidavit.view_married_en', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> Engilish Profile
                        </a>
                    </div>

                    <div class="affidavit">
                        @php($division   = $divisions->where('id', $info->division_id)->first())
                        @php($district   = $districts->where('id', $info->district_id)->first())
                        @php($upazila    = $upazilas->where('id', $info->upazila_id)->first())
                        @php($union      = $unions->where('id', $info->union_id)->first())
                        @php($ward       = $wards->where('id', $info->ward_id)->first())

                        @php($wifeDistrict = $districts->where('id', $info->wife_district_id)->first())
                        @php($wifeUpazila  = $upazilas->where('id', $info->wife_upazila_id)->first())
                        @php($wifeUnion    = $unions->where('id', $info->wife_union_id)->first())
                        @php($wifeWard     = $wards->where('id', $info->wife_ward_id)->first())

                        @php($union_name     = $unions->where('id', $info->union_id)->first())
                        @php($upazilas_name  = $upazilas->where('id', $info->upazila_id)->first())
                        @php($districts_name = $districts->where('id', $info->district_id)->first())

                        <div class="print_header_info">
                            <figure class="photo">
                                <img class="govbd" src="{{asset('public/license/govbd.png')}}" alt="Photo Not Found!">
                            </figure>

                            <div class="title">
                                <h1>{{ (!empty($union_name) ? $union_name->bn_name : " ") }}  ইউনিয়ন পরিষদ কার্যালয়</h1>
                                <h4>{{ (!empty($upazilas_name) ?  $upazilas_name->bn_name : " ") }}, {{ (!empty($districts_name) ? $districts_name->bn_name : " ") }}</h4>
                                <p>ওয়েবসাইট/Website: {{ $_SERVER['HTTP_HOST'] }}</p>{{-- URL::to('') --}}

                                <h2><strong>বিবাহিত সনদপত্র</strong></h2>
                            </div>
                        </div>

                        <div class="affidavit_body">
                            <div class="row">
                                <div class="col col-sm-5">
                                    <p>
                                        <strong>প্রত্যয়ন পত্র নং </strong>
                                        {{ numberFilter($info->affidavit_no,'bn') }}
                                    </p>
                                </div>
                                <div class="col">
                                    <!--<p>
                                        <strong>স্মারক নংঃ </strong>
                                        {{ numberFilter($info->memorial_no,'bn') }}
                                    </p>-->
                                </div>
                                <div class="col col-sm-4">
                                    <p class="text-right">
                                        <strong>বিবাহ অনুষ্ঠিত হওয়ার তারিখ </strong>
                                        {{ numberFilter($info->marriage_date,'bn') }}
                                    </p>
                                </div>
                            </div>
                            <p class="my_contain">
                                এতদ্বারা প্রত্যয়ন করা যাইতেছে যে,
                                <span>{{ $info->father_name }}</span> এবং <span>{{ $info->mother_name }}</span>
                                এর পুত্র <span>{{ $info->member_name }}</span>,
                                গ্রাম <span>{{ $info->village }}</span>,
                                ডাকঘর <span>{{ $info->post_office }}</span>,
                                উপজেলা <span>{{ $upazilas_name->bn_name }}</span>,
                                জেলা <span>{{ $districts_name->bn_name }}</span> এবং
                                জন্ম তারিখ <span>{{ numberFilter($info->dob,'bn') }}</span> এর সাথে
                                <span>{{ $info->wife_father_name }}</span> এবং <span>{{ $info->wife_mother_name }}</span>
                                এর কন্যা <span>{{ $info->wife_name }}</span>
                                গ্রাম <span>{{ $info->wife_village }}</span>,
                                ডাকঘর <span>{{ $info->wife_post_office }}</span>,
                                উপজেলা <span>{{ $wifeUpazila->bn_name }}</span>,
                                জেলা <span>{{ $wifeDistrict->bn_name }}</span> এবং
                                জন্ম তারিখ <span>{{ numberFilter($info->wife_dob, 'bn') }}</span> এর
                                সাথে <span>{{ numberFilter($info->marriage_date,'bn') }}</span> তারিখে বিবাহ অনুষ্ঠিত হয়েছে।
                                এই বিবাহ <span>{{ numberFilter($info->ragi_date, 'bn') }}</span> তারিখে আমার অফিসে নিবন্ধিত করা হয়,
                                নিবন্ধিত সিরিয়াল নং <span>{{ numberFilter($info->ragi_serial_no, 'bn') }}</span>
                                পেইজ নং <span>{{ numberFilter($info->ragi_page_no, 'bn') }}</span>
                                কলাম নং <span>{{ numberFilter($info->ragi_column_no, 'bn') }}</span>
                                বছর <span>{{ numberFilter($info->ragi_year, 'bn') }}</span> এবং আমার অফিসের
                                ঠিকানা <span>{{ $info->regi_address }}</span>।

                                <br> <br>
                                আমি তাদের সকলের মঙ্গল ও সমৃদ্ধি কামনা করছি। <br />
                                সনদপত্রটি <span>{{ numberFilter($info->created,'bn') }}</span> তারিখ প্রদান করা হয়েছে।
                            </p>
                        </div>

                        <div class="footer_signature">
                            <div class="signature_box">
                                <?php if(!empty($sign_name)){
                                    $chairmans = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($chairmans)) { ?>
                                    @php($district = $districts->where('id', $chairmans->district_id)->first())
                                    @php($upazila  = $upazilas->where('id', $chairmans->upazila_id)->first())
                                    @php($union    = $unions->where('id', $chairmans->union_id)->first())

                                    <p>{{ (!empty($chairmans) ? $chairmans->chairman : "") }}</p>
                                    <p><strong>চেয়ারম্যান</strong></p>
                                    <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                        {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><strong>চেয়ারম্যান</strong></p>
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
<!-- Page style Linked -->
<link rel="stylesheet" href="{{asset('backend')}}/style/page.css">
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
    .btn-link {color: #222;}
    .body_container {font-family: 'Noto Serif Bengali', serif;}
    .body_container p {
        font-size: 18px;
        line-height: 36px;
        color: #000;
    }
    /* .panel_body {
        background-image: url('{{asset("backend")}}/images/bg_images/border.png');
        background-size: cover;
        height: 100vh;
    } */

    .affidavit {
        padding: 15px;
        border: 4px double #444;
        border-radius: 15px;
    }
    .print_header_info {
        text-align: center;
        padding-bottom: 10px;
        position: relative;
    }
    .print_header_info figure.photo {
        position: absolute;
        left: 0;
        top: 0;
        max-width: 100px;
        width: 100%;
    }
    .print_header_info img {
        max-width: 100%;
        height: 100px;
    }
    .print_header_info img.govbd {
        width: 100px;
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
        background: #444;
        color: #fff;
        font-weight: bold;
        border-radius: 40px;
    }
    .print_header_info h4 {
        margin: 3px 0;
        color: #000;
    }
    .my_contain span {
        display: inline-block;
        line-height: 95%;
        border-bottom: 2px dotted #000;
    }

    .footer_signature {
        justify-content: flex-end;
        margin-top: 35px;
        margin-bottom: 25px;
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
    .table-bordered td, .table-bordered th, .body_content .table th {font-size: 18px !important;}
    @media print{
        .enbn_btn {
            display: none;
        }
        table.table.table-bordered tr th, table.table.table-bordered tr td,table.table.table-bordered tr, table.table.table-bordered {
            border: 1px solid transparent !important;
        }
    }
</style>
@endpush
