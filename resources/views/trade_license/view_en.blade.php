@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>Trade License</h4>
                    <a id="print" title="Page: A4; Scale: (Firefox: Custom(112) & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> Print
                    </a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.trade_license.view', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> বাংলা প্রফাইল
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
                                    <h6>license issue Details</h6>
                                    <small>Date of Issue: {{ numberFilter($info->created,'en') }}</small>
                                    <!-- <p>ইস্যুর সময় (Issue Time):</p> -->
                                </div>
                                <div class="col-6">
                                    <h4>{{ (!empty($union_name) ? $union_name->name : " ") }}  Union Parishad</h4>
                                    <h4>{{ (!empty($upazilas_name) ?  $upazilas_name->name : " ") }}, {{ (!empty($districts_name) ? $districts_name->name : " ") }}</h4>
                                    <p>Website: {{ $_SERVER['HTTP_HOST'] }}</p>{{-- URL::to('') --}}
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
                            <h2><strong class="title">Trade License</strong></h2>
                            <p>
                                Trade License No.: {{ numberFilter($info->license_no,'en') }}
                            </p>
                        </div>

                        <div class="license_body">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <p>
                                        The power conferred by section 66 of the Local Government (Union Councils) Act, 2009 (Act No. 61 of 2009) for the purpose of levying taxes levied on business, profession, profession or industrial establishment in accordance with sections 6 and 17 of the Model Tax Schedule, 2016 made by the Government. This trade license is issued in favor of the following persons/institutions subject to the conditions prescribed:
                                    </p>
                                    <hr class="hr">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        <span>01. Business Name: </span>
                                        {{ $info->business_name_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>02. Name of Owner/Licensee: </span>
                                        {{ $info->license_owner_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>03. Mother's Name: </span>
                                        {{ $info->mother_name_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>04. Father/Husband Name: </span>
                                        {{ $info->father_name_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>05. Spouse's Name (if applicable): </span>
                                        {{ $info->spouse_name_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>06. Business Nature: </span>
                                        {{ $info->business_nature_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>07. Business/profession Type: </span>
                                        {{ $info->business_type_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>08. Business Address: </span>
                                        {{ $info->business_address_en }}
                                    </p>
                                </div>
                                <div class="col-sm-7">
                                    <p>
                                        <span>09. (A) Zone (if applicable): </span>
                                        {{ $info->zone_en }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(B) Ward No.: </span>
                                        {{ $info->zone_en }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>10. (A) Birth Certificate/NID/Passport No: </span>
                                        {{ numberFilter($info->nid,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>(B) TIN: </span>
                                        {{ numberFilter($info->tin,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(C) BIN: </span>
                                        {{ numberFilter($info->bin,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>(D) Mobile No.: </span>
                                        {{ numberFilter($info->mobile,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(E) Email: </span>
                                        <span style="font-size: 14px;">{{ $info->email }}</span>
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span>11. (A) Finance year: </span>
                                        {{ numberFilter($info->finance_year,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>(B) Business Starting Date: </span>
                                        {{ numberFilter($info->business_start, 'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p><strong class="title">12. Present address of owner/Proprietor </strong></p>
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Holding No.: </span>
                                        {{ numberFilter($info->pre_holding_no, 'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p><strong class="title">Present address of owner/proprietor </strong></p>
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Holding No.: </span>
                                        {{ numberFilter($info->pre_holding_no, 'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Road No.: </span>
                                        {{ numberFilter($info->pre_road_no, 'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Road No.: </span>
                                        {{ numberFilter($info->par_road_no, 'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Village: </span>
                                        {{ $info->pre_village_en }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Village: </span>
                                        {{ $info->par_village_en }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                    <span class="tab_space">&nbsp;</span>
                                        <span>Post Office: </span>
                                        {{ $info->pre_post_office_en }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Post Office: </span>
                                        {{ $info->par_post_office_en }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Post Code: </span>
                                        {{ $info->pre_post_code }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Post Code: </span>
                                        {{ $info->par_post_code }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_upazilas_name  = $upazilas->where('id', $info->pre_upazila_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Upazila: </span>
                                        {{ $pre_upazilas_name->name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($par_upazilas_name  = $upazilas->where('id', $info->par_upazila_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Upazila: </span>
                                        {{ $par_upazilas_name->name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_districts_name = $districts->where('id', $info->pre_district_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>District: </span>
                                        {{ $pre_districts_name->name }}
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p>
                                        @php($pre_districts_name = $districts->where('id', $info->par_district_id)->first())
                                        <span class="tab_space">&nbsp;</span>
                                        <span>District: </span>
                                        {{ $pre_districts_name->name }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>13. Serial no. of model taxation schedule 2016: </span>
                                        {{ numberFilter($info->tax_serial_no,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span>14. License Fee: </span>
                                        {{ numberFilter($info->license_fee,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>Signboard Fee: </span>
                                        {{ numberFilter($info->signboard_charge,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Arrear Amount: </span>
                                        {{ numberFilter($info->due_charge,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>Income Tax/Source Tax: </span>
                                        {{ numberFilter($info->income_tax,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Sur Charge: </span>
                                        {{ numberFilter($info->sur_charge,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>Vat: </span>
                                        {{ numberFilter($info->vat,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-7">
                                    <p>
                                        <span class="tab_space">&nbsp;</span>
                                        <span>Amendment Fee: </span>
                                        {{ numberFilter($info->amendment_charge,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-5">
                                    <p>
                                        <span>Total: </span>
                                        {{ numberFilter($info->total,'en') }}
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <p>
                                        <span>15. In Word: </span>
                                        {{ inWordEn($info->total) }} Taka Only.
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
                                    <p><span>The Secretary</span></p>

                                        @php($district = $districts->where('id', $ministers->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $ministers->upazila_id)->first())
                                        @php($union    = $unions->where('id', $ministers->union_id)->first())

                                    <p>{{ (!empty($union) ? $union->name : " ")  }} Union Parishad</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->name : " ")  }},
                                        {{ (!empty($district) ? $district->name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><span>The Secretary</span></p>
                                <p>{{(!empty($union_name) ? $union_name->name : " ")}} Union Parishad</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->name : " ")}}, {{(!empty($districts_name) ? $districts_name->name : " ")}}</p>

                                <?php } } ?>

                            </div>
                            <div class="signature_box">

                                <?php if(!empty($sign_name)){
                                    $chairmans = $sign_name->where('union_id', $info->union_id)->first();
                                ?>
                                <?php if(!empty($chairmans)) { ?>
                                    <p>{{ (!empty($chairmans) ? $chairmans->chairman : "") }}</p>
                                    <p><span>The Chairman</span></p>

                                        @php($district = $districts->where('id', $chairmans->district_id)->first())
                                        @php($upazila  = $upazilas->where('id', $chairmans->upazila_id)->first())
                                        @php($union    = $unions->where('id', $chairmans->union_id)->first())

                                    <p>{{ (!empty($union) ? $union->name : " ")  }} Union Parishad</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->name : " ")  }},
                                        {{ (!empty($district) ? $district->name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><span>The Chairman</span></p>
                                <p>{{(!empty($union_name) ? $union_name->name : " ")}} Union Parishad</p>
                                <p>{{(!empty($upazilas_name) ? $upazilas_name->name : " ")}}, {{(!empty($districts_name) ? $districts_name->name : " ")}}</p>

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
        margin-top: 75px;
        margin-bottom: 25px;
        display: flex;
    }
    .footer_signature p {
        line-height: 20px;
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
