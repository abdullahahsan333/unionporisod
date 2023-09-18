@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('member.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সদস্যের প্রফাইল</h4>
                    <a id="print" class="print_btn"><i class="icon ion-md-print"></i> প্রিন্ট</a>
                </div>
                <div class="panel_body">

                    <div class="enbn_btn">
                        <a href="{{route('admin.member.view', $info->id)}}" class="view">
                            <i class="icon ion-md-eye"></i> বাংলা প্রফাইল
                        </a>
                    </div>

                    @include('components.print')
                    <div class="table-responsive">
                        <table class="table table-bordered list-table">
                            @php($division = $divisions->where('id', $info->division_id)->first())
                            @php($district = $districts->where('id', $info->district_id)->first())
                            @php($upazila  = $upazilas->where('id', $info->upazila_id)->first())
                            @php($union    = $unions->where('id', $info->union_id)->first())
                            @php($ward     = $wards->where('id', $info->ward_id)->first())
                            <tr>
                                <th>Date</th>
                                <td colspan="2">{{ numberFilter($info->created,'en') }}</td>
                                <th rowspan="4" class="text-right">
                                    @if(!empty($info->path))
                                        <img class="img-fluid img-thumbnail" src="{{asset($info->path)}}" style="max-width: 120px; max-height:120px;" alt="">
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th> House Holder Name </th>
                                <td colspan="2">{{$info->householder_en}}</td>
                            </tr>
                            <tr>
                                <th> House Holder's Wife Name </th>
                                <td colspan="2">{{$info->householder_wife_en}}</td>
                            </tr>
                            <tr>
                                <th>Father / Husband Name</th>
                                <td colspan="2">{{$info->father_name_en}}</td>
                            </tr>
                            <tr>
                                <th>Mother Name</th>
                                <td>{{$info->mother_name_en}}</td>
                                <th>Holding No.</th>
                                <td colspan="2">{{ numberFilter($info->holding_no,'en')}}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">NID No.</th>
                                <td>{{numberFilter($info->nid_no,'en')}}</td>
                                <th style="width: 20%;">Mobile No.</th>
                                <td>{{numberFilter($info->mobile_no,'en')}}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>{{ $info->religion_en }}</td>
                                <th>Union Name</th>
                                <td>{{ (!empty($union) ? $union->name : " ")  }}</td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td>
                                    {{ numberFilter($info->holding_no,'en') }},
                                    {{ $info->village_en }},
                                    {{ (!empty($ward) ? $ward->name_en : " " ) }},
                                    {{ (!empty($union) ? $union->name : " ")  }},
                                    {{ (!empty($upazila) ? $upazila->name : " ")  }},
                                    {{ (!empty($district) ? $district->name : " ")  }}.
                                </td>
                                <th>Family Member</th>
                                <td>
                                    Male ({{numberFilter($info->member_male,'en')}}) - Female ({{numberFilter($info->member_female,'en')}})
                                </td>
                            </tr>

                            <tr>
                                <th>Profession</th>
                                <td>{{ strFilter($info->profession_en) }}</td>
                                <th>Amount of living space</th>
                                <td>{{numberFilter($info->floor_size,'en')}} Feet</td>
                            </tr>

                            <tr>
                                <th>Amount of cultivated land</th>
                                <td>{{ numberFilter($info->cultivable_land,'en') }} Shotangsho</td>
                                <th>Amount of unclaimed land</th>
                                <td>{{ numberFilter($info->uncultivated_land,'en') }} Shotangsho</td>
                            </tr>

                            <tr>
                                <th>Have you any Handicapped Member?</th>
                                <td>{{ strFilter($info->handicapped_en) }}</td>
                                <th>Type of Settlement</th>
                                <td>{{ strFilter($info->settlement_type_en) }}</td>
                            </tr>

                            <tr>
                                @if($info->handicapped_en == "Yes")
                                <th>Name of Handicapped Member</th>
                                <td>{{ strFilter($info->handicapped_name_en) }}</td>
                                @endif
                                <th>Type of Land Ownership</th>
                                <td>{{ strFilter($info->ownership_type_en) }}</td>
                            </tr>

                            <tr>
                                <th colspan="3">Have you recently been a member of the Social Security Program ?</th>
                                <td> {{ $info->social_security_act_en }} </td>
                            </tr>

                            <tr>
                                @if($info->social_security_act_en == "Yes")
                                <th>Social Security Program Name</th>
                                <td>{{ strFilter($info->social_act_name_en) }}</td>
                                @endif

                                <th>Have you any Freedom Fighter member ?</th>
                                <td>{{ $info->freedom_fighters_en }}</td>
                            </tr>

                            @if($info->freedom_fighters_en == "Yes")
                            <tr>
                                <th>Freedom Fighters Name</th>
                                <td>{{ strFilter($info->fighter_name_en) }}</td>
                                <th>Relation with Freedom Fighter</th>
                                <td>{{ strFilter($info->fighter_reletion_en) }}</td>
                            </tr>
                            @endif

                            <tr>
                                <th>Poverty Line</th>
                                <td>{{ strFilter($info->poverty_line_en) }}</td>
                                <th>Have you a Tubewell ?</th>
                                <td>{{ ($info->tubewell == "হ্যাঁ") ? "Yes" : "No" }}</td>
                            </tr>
                            <tr>
                                <th>Have you a Latrine ?</th>
                                <td>{{ ($info->latrine == "হ্যাঁ") ? "Yes" : "No" }}</td>
                                <th>Annual Tax/Tax's Amount </th>
                                <td>{{ numberFilter($info->taxes,'en') }}</td>
                            </tr>
                            <tr>
                                <th>Annual Assessment</th>
                                <td>{{ numberFilter($info->annual_assessment,'en') }}</td>
                                <th>Estimated price of the house</th>
                                <td>{{ numberFilter($info->estimated_value,'en') }}</td>
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
