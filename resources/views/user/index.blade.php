@extends('layouts.backend')

@section('content')
    @php($privilege = Auth::user()->privilege)
    @php($siteInfo = settings())
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
    <!-- body container start -->
    <div class="body_container">

    @include('user.nav')

    <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল ইউজার</h4>
                    <a href="#" id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    <div class="table-responsive">
                        <table class="table table-bordered list-table">
                            <thead>
                            <tr>
                                <th width="30">ক্রঃ নং</th>
                                <th width="60">ছবি</th>
                                <th>নাম</th>
                                <th>মোবাইল</th>
                                <th>ঠিকানা</th>
                                
                                <th>জেলা</th>
                                <th>উপজেলা</th>
                                <th>ইউনিয়ন</th>
                                
                                <th>ব্যবহারকারী</th>
                                <th>ইউজারনেম</th>
                                <th>প্রিভিলেজ</th>
                                <th class="text-right print_hide" width="100">একশন</th>
                            </tr>
                            </thead>

                            @if(!empty($results) && $results->isNotEmpty())
                                @foreach($results as $key => $row)
                                
                                @php($district = $districts->where('id', $row->district_id)->first())
                                @php($upazila  = $upazilas->where('id', $row->upazila_id)->first())
                                @php($union    = $unions->where('id', $row->union_id)->first())
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td class="img">
                                            <img src="{{asset($row->avatar)}}" alt="">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->mobile}}</td>
                                        <td>{{$row->address}}</td>
                                        
                                        <td>{{ (!empty($district) ? $district->bn_name : " ")  }}</td>
                                        <td>{{ (!empty($upazila) ? $upazila->bn_name : " ")  }}</td>
                                        <td>{{ (!empty($union) ? $union->bn_name : " ")  }}</td>
                                        
                                        <td>{{ (!empty($row->user_type) ? strFilter($row->user_type) : "") }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ strFilter($row->privilege) }}</td>
                                        <td class="operation_btn text-right print_hide">
                                            @if( ($privilege == 'super') || (!empty($accessList->user->submenu->action->view) && $accessList->user->submenu->action->view == "view"))
                                            <a href="{{route('admin.user.show', strEncode($row->id))}}" class="view" title="দেখুন">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            @endif
                                            @if( ($privilege == 'super') || (!empty($accessList->user->submenu->action->delete) && $accessList->user->submenu->action->delete == "delete"))
                                            <a href="{{route('admin.user.destroy', $row->id)}}" onclick="return confirm('Do you want to delete this data?')" class="delete" title="ডিলিট করুন">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
@push('header-style')
    <link rel="stylesheet" href="{{asset('backend')}}/style/profile.css">
@endpush
