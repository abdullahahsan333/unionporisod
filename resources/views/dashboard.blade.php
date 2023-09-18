@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    @php($siteInfo = settings())
    @php($privilege = Auth::user()->privilege)
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
    <div class="body_container">
        <!-- body content start -->
        <div class="body_content">
            <div class="box_wrapper">

                @if($privilege != 'super' && !empty($chairman[0]))
                    <div class="dash_box box_8" style="display: flex; padding: 15px;">
                        <div class="part2">
                            <img style="max-width: 100px; width: 100px;" src="{{ (!empty($chairman[0]) ? asset($chairman[0]->chairman_image) : '') }}" alt="Image Not Found!">
                        </div>
                        <div class="part1">
                            <h2>{{ (!empty($chairman[0]) ? $chairman[0]->chairman : '') }}</h2>
                            <h3>চেয়ারম্যান</h3>
                        </div>
                    </div>

                    <div class="dash_box box_12" style="display: flex; padding: 15px;">
                        <div class="part2">
                            <img style="max-width: 100px; width: 100px;" src="{{ (!empty($chairman[0]) ? asset($chairman[0]->minister_image) : '') }}" alt="Image Not Found!">
                        </div>
                        <div class="part1">
                            <h2>{{ (!empty($chairman[0]) ? $chairman[0]->minister : '') }}</h2>
                            <h3>সচিব</h3>
                        </div>
                    </div>
                    <div class="dash_box" >
                        &nbsp;
                    </div>
                    <div class="dash_box" >
                        &nbsp;
                    </div>
                @endif
            </div>
            <div class="box_wrapper">
                @if($privilege != 'user')
                    @if( ($privilege == 'super') || (!empty($accessList->dashboard->submenu->total_upazila) && $accessList->dashboard->submenu->total_upazila=="total_upazila"))
                    <div class="dash_box box_1">
                        <h2>মোট উপজেলা</h2>
                        <h3>{{ numberFilter($allUpazila,'bn') }}</h3>
                    </div>
                    @endif
                    @if( ($privilege == 'super') || (!empty($accessList->dashboard->submenu->total_union) && $accessList->dashboard->submenu->total_union=="total_union"))
                    <div class="dash_box box_2">
                        <h2>মোট ইউনিয়ন</h2>
                        <h3>{{ numberFilter($allUnion,'bn') }}</h3>
                    </div>
                    @endif
                @endif

                <div class="dash_box box_3">
                    <h2>মোট খানা সদস্য</h2>
                    <h3>{{ numberFilter($allMember,'bn') }} জন</h3>
                </div>

                <div class="dash_box box_4">
                    <h2>মোট ধার্য্যকৃত ট্যাক্সের পরিমাণ</h2>
                    <h3>{{numberFilter($totalTaxes,'bn')}} টাকা</h3>
                </div>

                <div class="dash_box box_5">
                    <h2>নিম্নবিত্ত পরিবার</h2>
                    <h3>{{numberFilter($lowerClass,'bn')}} টি</h3>
                </div>

                <div class="dash_box box_6">
                    <h2>মধ্যবিত্ত পরিবার</h2>
                    <h3>{{numberFilter($middleClass,'bn')}} টি</h3>
                </div>
                <div class="dash_box box_7">
                    <h2>উচ্চবিত্ত পরিবার</h2>
                    <h3>{{numberFilter($upplerClass,'bn')}} টি</h3>
                </div>
                <div class="dash_box box_8">
                    <h2>পুরুষের সংখ্যা</h2>
                    <h3>{{numberFilter($totalMale,'bn')}} জন</h3>
                </div>
                <div class="dash_box box_9">
                    <h2>মহিলার সংখ্যা</h2>
                    <h3>{{numberFilter($totalFemale,'bn')}} জন</h3>
                </div>
                <div class="dash_box box_10">
                    <h2>প্রতিষ্ঠানের সংখ্যা</h2>
                    <h3>{{numberFilter($allBazarMember,'bn')}} জন</h3>
                </div>
                <div class="dash_box box_12">
                    <h2>পেশা ভিত্তির উপর কর</h2>
                    <h3>{{numberFilter($allBazarMemberTax,'bn')}} টাকা</h3>
                </div>


                @if($privilege == 'user')
                    @if(!empty($wards))
                    @foreach($wards as $key => $value)
                    <a href="{{route('admin.member', ['wno' => strEncode($value->ward_id)])}}" title="{{$value->name_bn}}">
                        <div class="dash_box box_{{ $key+1 }}">
                            <h2>{{$value->name_bn}}</h2>
                            <h3>{{ numberFilter($value->total_member,'bn') }}</h3>
                        </div>
                    </a>
                    @endforeach
                    @endif
                @endif
                
            </div>
            
            @if($socialSecurityBGD->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityBGD[0]->social_act_name) ? $socialSecurityBGD[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesBGD = 0.00; ?>
                        @foreach($socialSecurityBGD as $key => $row)
                        <?php $totalTaxesBGD += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesBGD,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityBGF->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityBGF[0]->social_act_name) ? $socialSecurityBGF[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesBGF = 0.00; ?>
                        @foreach($socialSecurityBGF as $key => $row)
                        <?php $totalTaxesBGF += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesBGF,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityOld->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityOld[0]->social_act_name) ? $socialSecurityOld[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesOld = 0.00; ?>
                        @foreach($socialSecurityOld as $key => $row)
                        <?php $totalTaxesOld += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesOld,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityMother->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityMother[0]->social_act_name) ? $socialSecurityMother[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesMother = 0.00; ?>
                        @foreach($socialSecurityMother as $key => $row)
                        <?php $totalTaxesMother += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesMother,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityWidow->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityWidow[0]->social_act_name) ? $socialSecurityWidow[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesWidow = 0.00; ?>
                        @foreach($socialSecurityWidow as $key => $row)
                        <?php $totalTaxesWidow += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesWidow,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityDisability->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityDisability[0]->social_act_name) ? $socialSecurityDisability[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesDisability = 0.00; ?>
                        @foreach($socialSecurityDisability as $key => $row)
                        <?php $totalTaxesDisability += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesDisability,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityFreedom->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityFreedom[0]->social_act_name) ? $socialSecurityFreedom[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesFreedom = 0.00; ?>
                        @foreach($socialSecurityFreedom as $key => $row)
                        <?php $totalTaxesFreedom += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesFreedom,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityPregnant->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityPregnant[0]->social_act_name) ? $socialSecurityPregnant[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesPregnant = 0.00; ?>
                        @foreach($socialSecurityPregnant as $key => $row)
                        <?php $totalTaxesPregnant += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesPregnant,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            @if($socialSecurityOther->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="5">
                                <h3 class="text-center">{{ (!empty($socialSecurityOther[0]->social_act_name) ? $socialSecurityOther[0]->social_act_name : "") }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 30px;">ক্র.নং</th>
                            <th>হোল্ডিং নং</th>
                            <th>নাম</th>
                            <th>পিতা/স্বামীর নাম</th>
                            <th style="width: 150px;">ধার্যকৃত কর</th>
                        </tr>
                        <?php $totalTaxesOther = 0.00; ?>
                        @foreach($socialSecurityOther as $key => $row)
                        <?php $totalTaxesOther += $row->taxes; ?>
                        <tr>
                            <td>{{ numberFilter($key+1,'bn') }}</td>
                            <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                            <td>
                                {{ $row->householder }} - ({{ numberFilter($row->mobile_no,'bn') }})
                            </td>
                            <td>{{ $row->father_name }}</td>
                            <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">মোট</th>
                            <th>{{ numberFilter($totalTaxesOther,'bn') }} টাকা</th>
                        </tr>
                    </table>
                </div>
            </div>
            @endif

            <!--<div class="footer_copy_right text-center">
                <p>{{ $siteInfo->copy_right }}</p>
            </div>-->

        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
@endsection
@push('footer-style')
<style>
    .footer_copy_right {background: #F5F7FA; position: fixed; bottom: 0; right: 0; width: 100%;}
    .footer_copy_right p {margin: 10px 0 !important; font-weight: bold;}
    .part1 {width: 75%; padding-top: 20px;}
    .part2 {width: 25%;}
</style>
@endpush


