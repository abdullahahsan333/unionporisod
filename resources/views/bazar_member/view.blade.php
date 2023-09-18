@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('bazar_member.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের প্রফাইল</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> প্রিন্ট</a>
                </div>
                <div class="panel_body">
                    @include('components.print')
                    <div class="table-responsive">
                        <table class="table table-bordered list-table">
                            @php($division = $divisions->where('id', $info->division_id)->first())
                            @php($district = $districts->where('id', $info->district_id)->first())
                            @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                            @php($union    = $unions->where('id', $info->union_id)->first())
                            @php($ward     = $wards->where('id', $info->ward_id)->first())
                            <tr>
                                <th>তারিখ</th>
                                <td colspan="2">{{ numberFilter($info->created,'bn') }}</td>
                                <th rowspan="4" class="text-right">
                                    @if(!empty($info->path))
                                        <img class="img-fluid img-thumbnail" src="{{asset($info->path)}}" style="max-width: 120px; max-height:120px;" alt="">
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th>দোকান / কারখানার মালিকের নাম</th>
                                <td colspan="2">{{$info->holder_name}}</td>
                            </tr>
                            <tr>
                                <th>পিতা/স্বামীর নাম</th>
                                <td colspan="2">{{$info->father_name}}</td>
                            </tr>
                            <tr>
                                <th>মাতার নাম</th>
                                <td colspan="2">{{$info->mother_name}}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">ব্যবসার নাম</th>
                                <td style="width: 35%;">{{ $info->business_name }}</td>
                                <th style="width: 25%;">মোবাইল নং</th>
                                <td style="width: 20%;">{{numberFilter($info->mobile_no,'bn')}}</td>
                            </tr>
                            <tr>
                                <th>ঠিকানা</th>
                                <td>
                                    {{ numberFilter($info->holding_no,'bn') }}, 
                                    {{ $info->village }}, 
                                    {{ (!empty($ward) ? $ward->name_bn : " " ) }}, 
                                    {{ (!empty($union) ? $union->bn_name : " ")  }},  
                                    {{ (!empty($upazila) ? $upazila->bn_name : " ")  }}, 
                                    {{ (!empty($district) ? $district->bn_name : " ")  }}.
                                </td>
                                <th>ভাড়াটিয়া আছে কিনা ?</th>
                                <td>{{$info->tenant}}</td>
                            </tr>
                            <tr>
                                <th>ভাড়াটিয়ার নাম</th>
                                <td>{{ $info->tenant_name }}</td>
                                <th>ভাড়াটিয়ার পিতার নাম </th>
                                <td>{{ $info->tenant_father_name }}</td>
                            </tr>
                            <tr>
                                <th>ভাড়াটিয়ার ব্যবসার মোট পুঁজি</th>
                                <td>{{ numberFilter($info->tenant_business_assets,'bn') }} টাকা</td>
                                <th>কারখানা/দোকান ঘর সহ মোট জমি</th>
                                <td>{{ numberFilter($info->total_land,'bn') }} শতাংশ</td>
                            </tr>
                            <tr>
                                <th>বাজারের নাম</th>
                                <td>{{ $info->bazar_name }}</td>
                                <th>ঘর নির্মাণ সহ ব্যবসার মোট পুঁজি</th>
                                <td>{{ numberFilter($info->total_assets,'bn') }} টাকা</td>
                            </tr>
                            <tr>
                                <th>বার্ষিক ব্যবসার আয়</th>
                                <td>{{ numberFilter($info->business_income,'bn') }} টাকা</td>
                                <th>বার্ষিক মূল্যায়ণ</th>
                                <td>{{ numberFilter($info->annual_assessment,'bn') }} টাকা</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
@endsection

@push('footer-style')
<style>
    table.table.table-bordered tbody tr th, table.table.table-bordered tbody tr td {vertical-align:middle;}
</style>
@endpush
