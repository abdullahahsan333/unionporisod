@extends('layouts.backend')

@section('content')
    @php($privilege = Auth::user()->privilege)
    @php($siteInfo = settings())
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
    <!-- body container start -->
    <div class="body_container">
        @include('bazar_member.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল সদস্য </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    @include('components.print')
                    <?php
                        if (!empty($_GET['wno'])) {
                            $action = route('admin.bazar_member', ['wno' => $_GET['wno']]);
                            $wno    = strDecode($_GET['wno']);
                        } else {
                            $action = route('admin.bazar_member');
                            $wno    = '';
                        }
                    ?>
                    <form action="{{$action}}" method="post" class="d-print-none">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="member_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>সদস্য নির্বাচন করুন</option>
                                        @foreach($allMember as $key => $value)
                                        @if(!empty($value->holder_name))
                                        <option value="{{ $value->id }}">({{ numberFilter($value->holding_no,'bn') }}) - {{ $value->holder_name }} - ({{ numberFilter($value->mobile_no,'bn') }})</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn" name="show">খুজুন</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr class="mt-0 border-primary d-print-none">

                    <div class="table-responsive">
                        <table class="table table-bordered list-table" id="DataTable">
                            <thead>
                            <tr>
                                <th style="width: 30px;">ক্র.নং</th>
                                <th>হোল্ডিং নং</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>পিতা/স্বামীর নাম</th>
                                <th>ব্যবসার নাম</th>
                                <th>ঠিকানা</th>
                                <th>বার্ষিক কর</th>
                                <th style="width: 70px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($totalTaxes = 0)
                            @if(!empty($results))
                                @foreach($results as $key => $row)
                                    @php($division = $divisions->where('id', $row->division_id)->first())
                                    @php($district = $districts->where('id', $row->district_id)->first())
                                    @php($upazila  = $upazilas->where('id', $row->upazila_id)->first())
                                    @php($union    = $unions->where('id', $row->union_id)->first())
                                    @php($ward     = $wards->where('id', $row->ward_id)->first())
                                    @php($totalTaxes += $row->total_taxes)
                                    <tr>
                                        <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                                        <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                                        <td><img src="{{asset($row->path)}}" alt=""></td>
                                        <td>
                                            {{ $row->holder_name }} - ({{ numberFilter($row->mobile_no,'bn') }})
                                        </td>
                                        <td>{{ $row->father_name }}</td>
                                        <td> {{ numberFilter($row->business_name,'bn') }} </td>
                                        <td>
                                            {{ numberFilter($row->holding_no,'bn') }},
                                            {{ (!empty($union) ? $union->bn_name : " ")  }}
                                            ({{ (!empty($ward) ? $ward->name_bn : " ") }}),
                                            {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                            {{ (!empty($district) ? $district->bn_name : " ")  }}.
                                        </td>
                                        <td>{{ numberFilter($row->total_taxes, 'bn') }}</td>
                                        <td class="operation_btn text-right print_hide">
                                            <a href="{{route('admin.bazar_member.view', $row->id)}}" class="view" title="View">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{route('admin.bazar_member.edit', $row->id)}}" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a>

                                            @if($row->bazar_license != 'yes')
                                            <a href="{{route('admin.bazar_member.trade_license', $row->id)}}" class="report" title="Trade License">
                                                <i class="fab fa-trade-federation" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            
                                            <a target="_blank" href="{{route('admin.tax-collection.bazar', strEncode($row->id))}}" class="tax_collection" title="Tax Collection">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </a>

                                            <a href="{{route('admin.bazar_member.destroy', $row->id)}}" onclick="return confirm('Do you want to delete this data?')" class="delete" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right">মোট টাকা</th>
                                    <th>{{ numberFilter($totalTaxes,'bn') }}</th>
                                    <th class="print_hide"></th>
                                </tr>
                            </tfoot>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    <style>
        .report {
            background: #00897B !important;
            color: #fff !important;
            font-size: 14px !important;
        }
        .tax_collection {
            background: #5E35B1 !important;
            color: #fff !important;
            font-size: 14px !important;
        }
    </style>
@endpush

@push('footer-script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
            });
        });
        $('#divisionId').selectpicker();

        // get distric list
        function getDistrictFn() {
            $('#districtId').empty();
            var _divisionId = $('#divisionId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.district-list')}}",
                data: {id: _divisionId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#districtId').append(response);
                $('#districtId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUpazilaFn() {
            $('#upazilaId').empty();
            var _districtId = $('#districtId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: {id: _districtId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
            });
        }

        // get Upazila list
        function getUnionFn() {
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: {id: _upazilaId, _token: "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }

        // get Ward Wise Member list
        function getMemberWardWiseFn() {
            $('#memberId').empty();
            var _unionId = $('#unionId').val();
            var _wardId = $('#wardId').val();
            console.log(_unionId);
            $.ajax({
                method: "POST",
                url: "{{route('admin.bazar_member.ward-wise-mamber')}}",
                data: {ward_id : _wardId , union_id : _unionId, _token : "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#memberId').append(response);
                $('#memberId').selectpicker('refresh');
            });
        }
    </script>
@endpush
