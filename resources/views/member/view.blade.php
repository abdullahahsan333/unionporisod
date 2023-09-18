@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('member.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>খানা সদস্যের প্রফাইল</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> প্রিন্ট</a>
                </div>
                <div class="panel_body">
                    
                    <!--<div class="enbn_btn">
                        <a href="{{route('admin.member.view-en', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> Engilish Profile
                        </a>
                    </div>-->
                    
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
                                <th>খানা প্রধানের নাম</th>
                                <td colspan="2">{{$info->householder}}</td>
                            </tr>
                            
                            <tr>
                                <th>খানা প্রধানের স্ত্রীর নাম</th>
                                <td colspan="2">{{$info->householder_wife}}</td>
                            </tr>
                            
                            <tr>
                                <th>পিতা/স্বামীর নাম</th>
                                <td>{{$info->father_name}}</td>
                            </tr>
                            
                            <tr>
                                <th>মাতার নাম</th>
                                <td>{{$info->mother_name}}</td>
                                <th>হোল্ডিং নং</th>
                                <td colspan="2">{{ numberFilter($info->holding_no,'bn')}}</td>
                            </tr>
                            
                            <tr>
                                <th style="width: 20%;">এন.আই.ডি নং</th>
                                <td>{{numberFilter($info->nid_no,'bn')}}</td>
                                <th style="width: 20%;">মোবাইল নং</th>
                                <td>{{numberFilter($info->mobile_no,'bn')}}</td>
                            </tr>
                            
                            <tr>
                                <th>ধর্ম</th>
                                <td>{{ $info->religion }}</td>
                                <th>ইউনিয়ন</th>
                                <td>{{ (!empty($union) ? $union->bn_name : " ")  }}</td>
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
                                <th>খানার সদস্য</th>
                                <td>
                                    পুরুষ({{numberFilter($info->member_male,'bn')}})-মহিলা({{numberFilter($info->member_female,'bn')}})
                                </td>
                            </tr>
                            
                            <tr>
                                <th>পেশা</th>
                                <td>{{$info->profession}}</td>
                                <th>বসতের মেঝের পরিমান</th>
                                <td>{{numberFilter($info->floor_size,'bn')}} ফুট</td>
                            </tr>
                            
                            <tr>
                                <th>আবাদী জমির পরিমান</th>
                                <td>{{ numberFilter($info->cultivable_land,'bn') }} শতাংশ</td>
                                <th>অনাবাদী জমির পরিমান</th>
                                <td>{{ numberFilter($info->uncultivated_land,'bn') }} শতাংশ</td>
                            </tr>
                            
                            <tr>
                                <th>খানার কোন সদস্য প্রতিবন্ধী কিনা?</th>
                                <td>{{ $info->handicapped }}</td>
                                <th>বসতের ধরন</th>
                                <td>{{ $info->settlement_type }}</td>
                            </tr>
                            
                            <tr>
                                @if($info->handicapped == "হ্যাঁ")
                                <th>প্রতিবন্ধী খানার নাম</th>
                                <td>{{ $info->handicapped_name; }}</td>
                                @endif
                                <th>বসত ভিটার জমির মালিকানার ধরন</th>
                                <td>{{ $info->ownership_type }}</td>
                            </tr>
                            
                            <tr>
                                <th colspan="3">খানার কোন সদস্য বর্তমানে সামাজিক নিরাপত্তা বেষ্টনী কোন কর্মসূচীর আওতায় আছে কিনা ?</th>
                                <td> {{ $info->social_security_act }} </td>
                            </tr>
                            
                            <tr>
                                @if($info->social_security_act == "হ্যাঁ")
                                <th>সামাজিক নিরাপত্তা বেষ্টনী কর্মসূচীর নাম</th>
                                <td>{{ $info->social_act_name }}</td>
                                @endif
                                <th>খানার কোন সদস্য মুক্তিযোদ্ধা কিনা?</th>
                                <td>{{ $info->freedom_fighters }}</td>
                            </tr>
                            
                            @if($info->freedom_fighters == "হ্যাঁ")
                            
                            <tr>
                                <th>মুক্তিযোদ্ধার নাম</th>
                                <td>{{ $info->freedom_fighters }}</td>
                                <th>মুক্তিযোদ্ধার সাথে খানা প্রধানের সম্পর্ক</th>
                                <td>{{ $info->freedom_fighters }}</td>
                            </tr>
                            
                            @endif
                            
                            <tr>
                                <th>দারিদ্রসীমা</th>
                                <td>{{ $info->poverty_line }}</td>
                                <th>টিউবওয়েল আছে কিনা ?</th>
                                <td>{{ $info->tubewell }}</td>
                            </tr>
                            
                            <tr>
                                <th>স্যানিটারী ল্যাট্রিন আছে কিনা ?</th>
                                <td>{{$info->latrine}}</td>
                                <th>খানা প্রধানের বাৎসরিক আয় </th>
                                <td>{{numberFilter($info->annual_income,'bn')}}</td>
                            </tr>
                            
                            <tr>
                                <th>বার্ষিক কর/ ট্যাক্সের পরিমাণ</th>
                                <td>{{numberFilter($info->taxes,'bn')}}</td>
                                <th>বার্ষিক মূল্যায়ণ</th>
                                <td>{{ numberFilter($info->annual_assessment,'bn') }}</td>
                            </tr>
                            
                            <tr>
                                <th>বসত ঘরের আনুমানিক মূল্য</th>
                                <td>{{ numberFilter($info->estimated_value,'bn') }}</td>
                                <th>&nbsp;</th>
                                <td>&nbsp;</td>
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
    table.table.table-bordered tbody tr th, table.table.table-bordered tbody tr td {vertical-align:middle;}
    @media print{
        .enbn_btn {
            display: none;
        }
    }
</style>
@endpush
