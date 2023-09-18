@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    @if($info->affidavit_type=='unmarried_certificate')
                    <h4>অবিবাহিত সনদপত্র</h4>
                    @elseif($info->affidavit_type == "citizenship_certificate")
                    <h4>নাগরিকত্ব সনদ পত্র</h4>
                    @elseif($info->affidavit_type == "carecture_certificate")
                    <h4>চারিত্রিক সনদপত্র</h4>
                    @elseif($info->affidavit_type == "income_certificate")
                    <h2>বাষির্ক আয় সনদপত্র</h2>
                    @elseif($info->affidavit_type == "affidavit_certificate")
                    <h2>প্রত্যয়ন পত্র</h2>
                    @endif
                    <a id="print" title="Page: A4; margin: none; Scale: (Firefox: Default & Chrome: Default);" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.affidavit.view-en', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> Engilish Profile
                        </a>
                    </div>

                    <div class="affidavit">
                        @php($division   = $divisions->where('id', $info->division_id)->first())
                        @php($district   = $districts->where('id', $info->district_id)->first())
                        @php($upazila    = $upazilas->where('id', $info->upazila_id)->first())
                        @php($pourashava = $pourashavas->where('id', $info->pourashava_id)->first())
                        @php($union      = $unions->where('id', $info->union_id)->first())
                        @php($ward       = $wards->where('id', $info->ward_id)->first())

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

                                @if( $info->affidavit_type=='unmarried_certificate')
                                <h2><strong>অবিবাহিত সনদপত্র</strong></h2>
                                @elseif($info->affidavit_type == "citizenship_certificate")
                                <h2><strong>নাগরিকত্ব সনদপত্র</strong></h2>
                                @elseif($info->affidavit_type == "carecture_certificate")
                                <h2><strong>চারিত্রিক সনদপত্র</strong></h2>
                                @elseif($info->affidavit_type == "income_certificate")
                                <h2><strong>বাষির্ক আয় সনদপত্র</strong></h2>
                                @elseif($info->affidavit_type == "affidavit_certificate")
                                <h2><strong>প্রত্যয়ন পত্র</strong></h2>
                                @endif

                            </div>
                        </div>

                        <div class="affidavit_body">
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
                            <p class="my_contain">
                                এই মর্মে প্রত্যয়ন করা যাইতেছে যে, <span>{{ $info->member_name }}</span>

                                পিতা/স্বামীঃ <span>{{ $info->father_name }}</span>

                                মাতাঃ <span>{{ $info->mother_name }}</span>

                                গ্রামঃ <span>{{ $info->village }}</span>

                                ডাকঘরঃ <span>{{ $info->post_office }}</span>

                                @if($info->affidavit_type == "carecture_certificate")
                                পোষ্ট কোডঃ <span>{{ numberFilter($info->post_code,'bn') }}</span>
                                @endif

                                উপজেলাঃ <span>{{ $upazilas_name->bn_name }}</span>

                                @if( $info->affidavit_type=='unmarried_certificate')
                                <span>{{ (!empty($pourashava->name_bn) ? 'পৌরসভাঃ ' . $pourashava->name_bn : "") }}</span>
                                @endif

                                জেলাঃ <span>{{ $districts_name->bn_name }}</span> ।

                                তিনি অএ ইউনিয়নের <span>{{ $ward->name_bn }}</span> নং ওয়ার্ডের

                                <span>{{ numberFilter($info->holding_no, 'bn') }}</span> নং হোল্ডিং এর স্থায়ী বাসিন্দা এবং জন্ম সূত্রে বাংলাদেশের নাগরিক।

                                @if($info->affidavit_type == "affidavit_certificate")
                                    তিনি স্থানীয় বিশিষ্ট <span>{{ $info->religion }}</span> সম্ভ্রান্ত পরিবারের সদস্য।
                                @endif

                                আমার নিকট তিনি ব্যক্তিগত ভাবে পরিচিত।

                                @if($info->affidavit_type == "carecture_certificate" ||
                                $info->affidavit_type == "income_certificate" ||
                                $info->affidavit_type == "affidavit_certificate")
                                আমার জানামতে তিনি রাষ্ট্র বা সমাজ বিরোধী কোন কর্মকান্ডে জড়িত নয়।
                                @endif

                                তাঁহার স্বভাব চরিত্র ভাল।

                                @if($info->affidavit_type == "affidavit_certificate")
                                আমার জানা মতে তিনি <span>{{ $info->marital_status }}</span>।
                                @endif

                                @if($info->affidavit_type == "income_certificate")
                                    তার পিতা পেশায় একজন <span>{{ $info->father_profession }}</span> এবং আথির্ক ভাবে অছচ্চল ও
                                    তাঁহার পিতার মাসিক আয় <span>{{ numberFilter($info->monthly_income,'bn') }}</span> টাকা। এতএব তার
                                    বাষির্ক আয় <span>{{ numberFilter($info->yearly_income,'bn') }}</span> টাকা।
                                @endif

                                @if( $info->affidavit_type=='unmarried_certificate')
                                    আমার জানা মতে তিনি এখনও বিবাহ করে নাই অর্থ্যাৎ অবিবাহিত। <br>
                                @endif

                                @if($info->affidavit_type == "citizenship_certificate" ||
                                $info->affidavit_type == "affidavit_certificate")
                                    <br> তাঁহার ব্যাক্তি পরিচিতি নং (এন আই ডি/জন্ম নিবন্ধন) <span>{{ numberFilter($info->nid,'bn') }}</span>
                                @endif

                                <br> <br>
                                আমি তাঁহার সর্বাঙ্গীন উন্নতি ও মঙ্গল কামনা করি।
                            </p>
                            <br />
                            
                            <ul class="standard_words">
                                
                                @if($info->affidavit_type == "carecture_certificate")
                                
                                <li>নিবো সেবা, দিবো কর, ইউনিয়ন হবে স্বনির্ভর।</li>
                                <li>সময়মত ইউ.পি ট্যাক্স পরিশোধ করুন এবং পাশ বই সংরক্ষণ করুন।</li>
                                
                                @endif
                                @if( $info->affidavit_type=='unmarried_certificate')
                                
                                <li>জন্ম নিবন্ধন করে নাগরিক অধিকার নিশ্চিত করুন।</li>
                                <li>জন্ম নিবন্ধন অথবা মৃত্যু সনদ নিজ দায়িত্বে ইউনিয়ন পরিষদে প্রেরণ করুন।</li>
                                
                                @endif
                                @if($info->affidavit_type == "affidavit_certificate")
                                
                                <li>আপনার শিশুকে স্কুলে পাঠান।</li>
                                <li>গ্রাম আদালতের বিচার কার্যে সহায়তা করুন।</li>
                                
                                @endif
                                @if($info->affidavit_type == "income_certificate")
                                
                                <li>সেনেটারী টয়লেট ব্যবহার করুন, নিজে সুস্থ্য থাকুন এবং অপরকে সুস্থ্য রাখুন ।</li>
                                <li>বাল্য বিবাহ, যৌতুক বন্ধ করুন।</li>
                                
                                @endif
                                @if( $info->affidavit_type=='unmarried_certificate')
                                
                                <li>হোক আমার কুঁড়ে ঘর, আমিও দেব অল্প কর।</li>
                                <li>আসুন আমরা ট্যাক্স দেই, জনসেবায় অংশ নেই।</li>
                                
                                @endif
                                @if($info->affidavit_type == "citizenship_certificate")
                                
                                <li>দারিদ্র বিমোচনের জন্য সকল ক্ষেত্রে স্বচ্ছ থাকুন।</li>
                                <li>গাছ লাগান পরিবেশ বাঁচান।</li>
                                
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
        .enbn_btn {display: none;}
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
