@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    @if ($info->affidavit_type == "inheritance_certificate")
                    <h4>উত্তরাধিকার সনদপত্র</h4>
                    @elseif ($info->affidavit_type == "family_certificate")
                    <h4>পারিবারিক সনদপত্র</h4>
                    @endif
                    <a id="print" title="Page: A4; Scale: (Firefox: Custom(112) & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <div class="trade_license position-relative">
                        @php($division = $divisions->where('id', $info->division_id)->first())
                        @php($district = $districts->where('id', $info->district_id)->first())
                        @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                        @php($union    = $unions->where('id', $info->union_id)->first())
                        @php($ward     = $wards->where('id', $info->ward_id)->first())

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

                                @if ($info->affidavit_type == "inheritance_certificate")
                                <h2><strong>উত্তরাধিকার সনদপত্র</strong></h2>
                                @elseif ($info->affidavit_type == "family_certificate")
                                <h2><strong>পারিবারিক সনদপত্র</strong></h2>
                                @endif
                            </div>
                        </div>


                        <div class="license_body">
                            <div class="row">
                                <div class="col col-sm-5">
                                    <p>
                                        <strong>সনদ নংঃ </strong>
                                        {{ numberFilter($info->affidavit_no,'bn') }}
                                    </p>
                                </div>
                                <div class="col">
                                    <!--<p>
                                        <strong>স্মারক নংঃ </strong>
                                        {{ numberFilter($info->memorial_no,'bn') }}
                                    </p>-->
                                </div>
                                <div class="col col-sm-3">
                                    <p>
                                        <strong>ইস্যু তারিখঃ </strong>
                                        {{ numberFilter($info->created,'bn') }}
                                    </p>
                                </div>
                            </div>

                            @php($division = $divisions->where('id', $info->division_id)->first())
                            @php($district = $districts->where('id', $info->district_id)->first())
                            @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                            @php($union    = $unions->where('id', $info->union_id)->first())
                            @php($ward     = $wards->where('id', $info->ward_id)->first())

                            <div class="row">
                                {!! $info->all_data !!}
                            </div>
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
<style>
    .btn-link {color: #222;}
    .body_container {font-family: 'Noto Serif Bengali', serif;}
    .body_container p { font-size: 14px; color: #000; }
    .trade_license {
        border: 4px double #333 !important;
        padding: 15px 15px 0 15px;
        border-radius: 15px;
    }
    .bg_photo { display: none; }
    .bg_img{ width: 60%; opacity:0.12; }
    .print_header_info { text-align: center; padding-bottom: 10px; position: relative; }
    .print_header_info figure.photo {
        position: absolute;
        left: 0;
        top: 0;
        max-width: 100px;
        width: 100%;
    }
    .print_header_info img { max-width: 100%; height: 100px; }
    .print_header_info img.govbd { width: 100px; }
    .print_header_info h1 { font-weight: bold; margin-top: 0; color: #000; }
    .print_header_info h2 { margin-top: 10px !important; }
    .print_header_info h2 strong {
        padding: 0 70px;
        background: #444;
        color: #fff;
        font-weight: bold;
        border-radius: 40px;
    }
    .print_header_info h4 { margin: 3px 0; color: #000; }
    .MsoNormal {width: 100% !important;}
    .license_body { padding: 15px; }
    .footer_signature {
        justify-content: flex-end;
        margin-top: 45px;
        margin-bottom: 10px;
        display: flex;
    }
    .footer_signature p { line-height: 22px; margin: 0; font-size: 18px; }
    .footer_signature .signature_box {border-top: 2px dashed #000;text-align: center;padding-top: 10px;}
    .footer_middle {margin: 5px 0;text-align: left !important;}
    .footer_middle img.qr_code {max-width: 100%;width: 120px;}
    .footer_middle p, .footer_bottom p {margin-bottom: 0;width: 100%;}
    .footer_bottom {border-top: 4px double #333 !important;}
    @media print{
        .license_body .row table tr th, .license_body .row table tr td { font-size: 10px !important; }
        .bg_photo {display: flex;}
        /*table.table.table-bordered tr th, table.table.table-bordered tr td,table.table.table-bordered tr, table.table.table-bordered {
            border: 1px solid transparent !important;
        }*/
    }
</style>
@endpush

