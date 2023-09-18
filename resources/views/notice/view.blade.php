@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('notice.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>ট্যাক্স নোটিশ</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> প্রিন্ট</a>
                </div>
                <div class="panel_body">
                    <div class="print_header_info print_only">
                        
                        @php($district = $districts->where('id', $info->district_id)->first())
                        @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                        @php($union    = $unions->where('id', $info->union_id)->first())
                        
                        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                        <h2>{{ $union->bn_name }} ইউনিয়ন পরিষদ কার্যালয়</h2>
                        <h4>{{ $upazila->bn_name }}, {{ $district->bn_name }}।</h4>
                    </div>
                    
                    <div class="notice_title">
                        <p>স্মারক নংঃ {{(!empty($info->memorial_no) ? numberFilter($info->memorial_no,'bn') : "")}}</p>
                        <p>তারিখঃ {{ (!empty($info->created) ? numberFilter($info->created,'bn') : "")}}</p>
                    </div>
                    
                    <div class="notice_sub">
                        <p><strong>বিষয়ঃ <span style=" text-decoration: underline;">ইউনিয়ন পরিষদের ট্যাক্স প্রদান প্রসঙ্গে।</span></strong></p>
                        <p><strong>সূত্রঃ {{(!empty($info->formula) ? numberFilter($info->formula,'bn') : " ")}} ।</strong></p>
                        <!--১৯ আশ্বিন ১৪১৯ বঙ্গাব্দ ০৪-১০-২০১২ খ্রি:-->
                    </div>
                    
                    <div class="notice_article">
                        <p class="normal_text">
                            উপযুক্ত বিষয়ের পরিপ্রেক্ষিতে জানানো যাচ্ছে যে,
                            <strong>{{ $union->bn_name }}</strong> ইউনিয়ন পরিষদের আওতাধীন সকল অফিস, 
                            ব্যাংক, শিক্ষা প্রতিষ্ঠান, স্বাস্থ্য কেন্দ্র , ক্লিনিক ও বাসা বাড়ীর উপর ধার্য্যকৃত বাৎসরিক ট্যাক্স ৬১ নং
                            আইন এর ধারা ৬৬ এ সরকার কর্তৃক প্রাক প্রকাশনার মাধ্যমে ইউনিয়ন পরিষদের বকেয়াসহ হালনাগাদ কর আদায় 
                            করার বিধান রয়েছে।
                            <strong style="text-decoration: underline;">{{ (!empty($info) ? numberFilter($info->holding_no,'bn') : " ") }}</strong>
                            নং হোল্ডিং অনুসারে  বাৎসরিক আরোপিত করের পরিমাণ 
                            <strong style="text-decoration: underline;">{{ (!empty($info) ? numberFilter($info->annual_assessment,'bn') : " ") }}</strong>
                            টাকা। বিগত
                            <strong style="text-decoration: underline;">{{ numberFilter(date("Y", strtotime($info->created))-1,'bn') }}</strong>
                            সাল হতে হালনাগাদ সর্বমোট 
                            <strong style="text-decoration: underline;">{{ numberFilter($info->balance,'bn') }}</strong>
                            টাকা পরিশোধযোগ্য ।
                        </p>
                        <p class="normal_text">পত্র প্রাপ্তির তারিখ হইতে আগামী ০৭ (সাত) কার্য দিবসের মধ্যে আপনার বকেয়া ট্যাক্স পরিশোধ করার জন্য অনুরোধ করা হলো ।</p>
                    </div>
                    
                    <div class="footer_signature">
                        <div class="signature_box">
                            <p><strong>প্রাপকঃ </strong>  {{ $info->name }}</p>
                            
                            <?php if(!empty($info)) { ?>
                            <p>
                                {{ (!empty($union) ? $union->bn_name : " ")  }},
                                {{ (!empty($upazila) ? $upazila->bn_name : " ")  }}, <br>
                                {{ (!empty($district) ? $district->bn_name : " ")  }}
                            </p>
                            <?php } ?>
                        </div>
                        <div class="signature_box">
                            <?php if(!empty($sign_name)){
                                $chairmans = $sign_name->where('union_id', $info->union_id)->first();
                            ?>
                            <?php if(!empty($chairmans)) { ?>
                                @php($district_name = $districts->where('id', $chairmans->district_id)->first())
                                @php($upazila_name  = $upazilas->where('id', $chairmans->upazila_id)->first())
                                @php($union_name    = $unions->where('id', $chairmans->union_id)->first())
                                
                                <p>{{ (!empty($chairmans) ? $chairmans->chairman : "") }}</p>
                                <p><strong>চেয়ারম্যান</strong></p>
                                <p>{{ (!empty($union_name) ? $union_name->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                    <p>
                                        {{ (!empty($upazila_name) ? $upazila_name->bn_name : " ")  }},
                                        {{ (!empty($district_name) ? $district_name->bn_name : " ")  }}।
                                    </p>
                            <?php }else{ ?>
                                <p>&nbsp;</p>
                                <p><strong>চেয়ারম্যান</strong></p>
                                <p>{{ (!empty($union) ? $union->bn_name : " ")  }} ইউনিয়ন পরিষদ কার্যালয়</p>
                                <p>
                                    {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                    {{ (!empty($district) ? $district->bn_name : " ")  }}।
                                </p>
                            <?php } } ?>
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
    .body_container {font-family: 'Noto Serif Bengali', serif;}
    .body_container p {font-size: 20px;color: #000;}
    .print_header_info {border-bottom: 1px solid #0B499D;margin-bottom: 10px;text-align: center;padding-bottom: 10px;}
    .print_header_info h2 {font-weight: bold;margin-top: 0;color: #000;}
    .print_header_info h4 {margin: 3px 0;color: #000;}
    .notice_title {justify-content: space-between;display: flex;}
    .notice_sub p {margin-bottom: 10px;}
    .notice_sub {margin: 25px 0 45px;}
    .notice_article .normal_text:first-letter {font-weight: bold;}
    .footer_signature {justify-content: space-between;margin-top: 75px;display: flex;}
    .footer_signature p {line-height: 22px;margin: 0;font-size: 18px;}
    .footer_signature .signature_box {text-align: center;padding-top: 10px;}
</style>
@endpush


