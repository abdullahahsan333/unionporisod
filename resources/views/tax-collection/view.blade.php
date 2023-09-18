@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('tax-collection.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের কর-সংগ্রহ</h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <?php $copy = ["অফিস কপি", "কাস্টমার কপি"];
                        for ($i = 0; $i < 2 ; $i++) {
                    ?>

                    <div id="receipt" class="receipt {{ ($i > 0) ? 'only-print' : '' }}">

                        @php($members  = $member->where('id', $info->member_id)->first())
                        @php($division = $divisions->where('id', $members->division_id)->first())
                        @php($district = $districts->where('id', $members->district_id)->first())
                        @php($upazila  = $upazilas->where('id', $members->upazila_id)->first())
                        @php($union    = $unions->where('id', $members->union_id)->first())

                        <div class="receipt_header">
                            <p>ইউপি ফরম-৩ [ বিধি ৮ দ্রষ্টব্য ]</p>
                            <h2 class="text-center">কর ও রেইট আদায়ের রশিদ</h2>
							<h4 class="text-center"><?php echo $copy[$i];?></h4>
                        </div>

                        <div class="receipt_body">
                            <p class="text-right"> রসিদ নংঃ
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ numberFilter($info->receipt_no,'bn') }}
                                </span>
                            </p>
                            <p> ১। ইউনিয়ন পরিষদের নামঃ
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ !empty($union) ?  $union->bn_name : '' }}
                                </span>
                            </p>
                            <p> ২। গ্রামের নামঃ
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ !empty($members) ?  $members->village : '' }}
                                </span>
                            </p>
                            <p> ৩। মালিক বা দখলদারের নামঃ
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ !empty($members) ?  $members->householder : '' }}
                                </span>
                            </p>
                            <p> ৪। মূল্যায়ন তালিকার ক্রমিক নংঃ
                                <span style="width: 250px; border-bottom: 1px dashed #222;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                            </p>
                            <p> ৫। গৃহীত অর্থঃ টাকা
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ numberFilter($info->paid,'bn') }}
                                </span>
                                (কথায়) {{ $obj->numToWord($info->paid) }} টাকা মাত্র।
                            </p>
                            <p> ৬। জরিমানা (যদি থাকে): টাকা
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ numberFilter($info->fine,'bn') }}
                                </span>
                                (কথায়) {{ $obj->numToWord($info->fine) }} টাকা মাত্র।
                            </p>
                            <p> ৭। মোট টাকা
                                <span style="border-bottom: 1px dashed #222;">
                                    {{ numberFilter($info->total,'bn') }}
                                </span>
                                (কথায়) {{ $obj->numToWord($info->total) }} টাকা মাত্র।
                            </p>
                        </div>
                    </div>

                    <?php } ?>

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
    .receipt {border: 1px solid #444;width: 50%;border-radius: 15px;padding: 15px;}
    .only-print, .receipt_header {display: none;}
    @media print {
        .only-print, .receipt_header {display: block;}
        .panel_body {display: flex; justify-content: center; align-items: center;}
        .receipt {margin-right: 15px; width: 50%}
        .enbn_btn {display: none;}
        table.table.table-bordered tr th, table.table.table-bordered tr td,
        table.table.table-bordered tr, table.table.table-bordered {
            border: 1px solid transparent !important;
        }
    }
</style>
@endpush

@push('footer-script')

@endpush



