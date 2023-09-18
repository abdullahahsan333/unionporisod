@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">

                    @if( $info->affidavit_type=='unmarried_certificate')
                    <h4>Unmarried Certificate</h4>
                    @elseif($info->affidavit_type == "citizenship_certificate")
                    <h4>Citizenship Certificate</h4>
                    @elseif($info->affidavit_type == "carecture_certificate")
                    <h4>Carecture Certificate</h4>
                    @elseif($info->affidavit_type == "income_certificate")
                    <h2>Annual Income Certificate</h2>
                    @elseif($info->affidavit_type == "affidavit_certificate")
                    <h2>Affidavit Certificate</h2>
                    @endif
                    <a id="print" title="Page: A4; margin: none; Scale: (Firefox: Default & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> Print
                    </a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.affidavit.view', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> বাংলা প্রফাইল
                        </a>
                    </div>

                    <div class="affidavit">
                        @php($division = $divisions->where('id', $info->division_id)->first())
                        @php($district = $districts->where('id', $info->district_id)->first())
                        @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                        @php($pourashava = $pourashavas->where('id', $info->pourashava_id)->first())
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
                                <h1>{{ (!empty($union_name) ? $union_name->name : " ") }} Union Parishad</h1>
                                <h4>{{ (!empty($upazilas_name) ?  $upazilas_name->name : " ") }}, {{ (!empty($districts_name) ? $districts_name->name : " ") }}</h4>
                                <p>Website: {{ $_SERVER['HTTP_HOST'] }}</p>{{-- URL::to('') --}}

                                @if( $info->affidavit_type=='unmarried_certificate')
                                <h2><strong>Unmarried Certificate</strong></h2>
                                @elseif($info->affidavit_type == "citizenship_certificate")
                                <h2><strong>Citizenship Certificate</strong></h2>
                                @elseif($info->affidavit_type == "carecture_certificate")
                                <h2><strong>Carecture Certificate</strong></h2>
                                @elseif($info->affidavit_type == "income_certificate")
                                <h2><strong>Annual Income Certificate</strong></h2>
                                @elseif($info->affidavit_type == "affidavit_certificate")
                                <h2><strong>Affidavit Certificate</strong></h2>
                                @endif
                            </div>
                        </div>

                        <div class="affidavit_body">
                            <div class="row">
                                <div class="col col-sm-5">
                                    <p>
                                        <strong>Certificate no.: </strong>
                                        {{ numberFilter($info->affidavit_no,'en') }}
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
                                        <strong>Issue Date: </strong>
                                        {{ numberFilter($info->created,'en') }}
                                    </p>
                                </div>
                            </div>

                            <p class="my_contain">
                                This is to certify that <span>{{ $info->member_name_en }}</span>

                                Father/Husband <span>{{ $info->father_name_en }}</span>

                                Mother <span>{{ $info->mother_name_en }}</span>

                                Village <span>{{ $info->village_en }}</span>

                                Post Office <span>{{ $info->post_office_en }}</span>

                                @if($info->affidavit_type == "carecture_certificate")
                                Post Code: <span>{{ numberFilter($info->post_code,'en') }}</span>
                                @endif

                                @if( $info->affidavit_type=='unmarried_certificate')
                                <span>{{ (!empty($pourashava->name_bn) ? 'Pourashava ' . $pourashava->name_bn : "") }}</span>
                                @endif

                                Upazila <span>{{ $upazilas_name->name }}</span>

                                District <span>{{ $districts_name->name }}</span>.

                                He/She is a permanent resident of holding No. <span>{{ numberFilter($info->holding_no,'en') }}</span>

                                of Ward No. <span>{{ $ward->name_en }}</span> of This Union and a citizen of Bangladesh(by birth).

                                @if($info->affidavit_type == "affidavit_certificate")
                                He/She is member of local <span>{{ strFilter($info->religion_en) }}</span> noble family.
                                @endif

                                I know him personally.

                                @if($info->affidavit_type == "carecture_certificate" ||
                                $info->affidavit_type == "income_certificate" ||
                                $info->affidavit_type == "affidavit_certificate")
                                As far as I know, he/She is not involved in any anti-state or anti-social activities.
                                @endif

                                His/Her character is good.

                                @if($info->affidavit_type == "affidavit_certificate")
                                As far as I know he/she is <span>{{ $info->marital_status_en }}</span>.
                                @endif

                                @if($info->affidavit_type == "income_certificate")
                                His/Her father's profession is a <span>{{ $info->father_profession_en }}</span> and financially weak and
                                his/Her father's monthly income is Tk <span>{{ numberFilter($info->monthly_income,'en') }}</span>.
                                So far his annual income is <span>{{ numberFilter($info->yearly_income,'en') }}</span> taka.
                                @endif

                                @if( $info->affidavit_type=='unmarried_certificate')
                                As far as I know he/she is not yet married and he/she is single. <br>
                                @endif

                                @if($info->affidavit_type == "citizenship_certificate" ||
                                $info->affidavit_type == "affidavit_certificate")
                                <br />His/Her Personal Identification Number (NID/Birth Certificate) <span>{{ numberFilter($info->nid,'en') }}</span>
                                @endif

                                <br />
                                <br />
                                I wish him all the best and prosperity.
                            </p>
                            <br />
                            <ul class="standard_words">
                                @if($info->affidavit_type == "carecture_certificate")
                                
                                <li>Take service, Give tax, Union will be self-supporting.</li>
                                <li>Pay UP Tax on time and keep the pass book.</li>
                                
                                @endif
                                @if( $info->affidavit_type=='unmarried_certificate')
                                
                                <li>Ensure citizenship rights by registering births.</li>
                                <li>Send the birth registration or death certificate to the Union Parishad on your own responsibility.</li>
                                
                                @endif
                                @if($info->affidavit_type == "affidavit_certificate")
                                
                                <li>Send your child to school.</li>
                                <li>Assist in village court proceedings.</li>
                                
                                @endif
                                @if($info->affidavit_type == "income_certificate")
                                
                                <li>Use sanitary toilets, Keep yourself and others healthy.</li>
                                <li>Stop child marriage, Dowry.</li>
                                
                                @endif
                                @if( $info->affidavit_type=='unmarried_certificate')
                                
                                <li>Be it my hut, I will also pay a little tax.</li>
                                <li>Let us pay taxes, Participate in public services.</li>
                                
                                @endif
                                @if($info->affidavit_type == "citizenship_certificate")
                                
                                <li>Be transparent in all aspects of poverty alleviation.</li>
                                <li>Save the environment by planting trees.</li>
                                
                                @endif
                            </ul>

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
                                    <p><strong>The Chairman</strong></p>
                                    <p>{{ (!empty($union) ? $union->name : " ")  }} Union Parishad</p>
                                    <p>
                                        {{ (!empty($upazila) ? $upazila->name : " ")  }},
                                        {{ (!empty($district) ? $district->name : " ")  }}।
                                    </p>
                                <?php }else{ ?>

                                <p>&nbsp;</p>
                                <p><strong>The Chairman</strong></p>
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
    
    .standard_words {
        display: block;
        width: 100%;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .standard_words li {
        display: inline-block;
        width: 100%;
        background: #fff;
        background-size: 30px 30px;
        background-repeat: no-repeat;
        padding-left: 35px;
        line-height: 35px;
        background-image: url({{ asset('public/backend/images/chacked.jpg') }});
    }
</style>
@endpush
