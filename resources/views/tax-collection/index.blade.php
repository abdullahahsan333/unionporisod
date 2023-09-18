@extends('layouts.backend')

@section('content')
    @php($privilege = Auth::user()->privilege)
    @php($siteInfo = settings())
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
    <!-- body container start -->
    <div class="body_container">
        @include('tax-collection.nav')
    
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল কর দেখুন</h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    @include('components.print')
                    <?php
                        if (!empty($_GET['wno'])) {
                            $action = route('admin.tax-collection', ['wno' => $_GET['wno']]);
                            $wno    = strDecode($_GET['wno']);
                        } else {
                            $action = route('admin.tax-collection');
                            $wno    = '';
                        }
                    ?>
                    <form action="{{$action}}" method="post" class="d-print-none">
                        @csrf
                        <div class="row">
                            
                            @if(($userInfo->privilege != 'user'))
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true">
                                        <option value="" selected>জেলা নির্বাচন করুন</option>
                                        <option value="39">সুনামগঞ্জ</option>
                                        <option value="45">কিশোরগঞ্জ</option>
                                        <option value="62">ময়মনসিংহ</option>
                                        <option value="64">নেত্রকোণা</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()"
                                            class="form-control" data-live-search="true">
                                        <option value="" selected>উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control"
                                            data-live-search="true">
                                        <option value="" selected>ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                                <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                                <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                            @endif
                            
                            @if(empty($wno))
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="ward_id" id="wardId" onchange="getMemberWardWiseFn()" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>ওয়ার্ড নির্বাচন করুন</option>
                                        @foreach($wards as $key => $value)
                                            <option value="{{ $value->id }}" {{$wno == $value->id ? 'selected' : '' }}>{{$value->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" id="wardId" value="{{$wards->where('id', $wno)->first()->name_bn}}" class="form-control" readonly>
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="member_id" id="memberId" class="form-control" data-live-search="true">
                                        <option value="" selected>সদস্য নির্বাচন করুন</option>
                                        
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="receipt_no" placeholder="Receipt No" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="date_from" value="" placeholder="From" class="form-control" id="startDate">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="date_to" value="" placeholder="To" class="form-control" id="endDate">
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
                                    <th>নাম</th>
                                    <th style="width: 90px;">পিতা/স্বাীর নাম</th>
                                    <th>ঠিকানা</th>
                                    <th style="width: 85px;">অর্থ বছর</th>
                                    <th style="width: 85px;">ধার্যকৃত কর</th>
                                    <th style="width: 85px;">ট্যাক্স জমা</th>
                                    <th style="width: 105px;" class="text-right print_hide">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($totalTaxes = $totalPaid = $annualAssessment = 0)
                            @if(!empty($results))
                                @foreach($results as $key => $row)
                                    <?php $totalTaxes += $row->taxes; ?>
                                    <?php $annualAssessment += $row->annual_assessment; ?>
                                    <?php $totalPaid += $row->paid; ?>
                                    <tr>
                                        <td>{{ numberFilter(++$key,'bn') }}</td>
                                        <td>{{ numberFilter($row->holding_no,'bn') }}</td>
                                        <td>{{ $row->name }} - ({{ numberFilter($row->mobile_no,'bn') }})</td>
                                        <td>{{ $row->father_name }}</td>
                                        <td>
                                            @php($division = $divisions->where('id', $row->division_id)->first())
                                            @php($district = $districts->where('id', $row->district_id)->first())
                                            @php($upazila  = $upazilas->where('id', $row->upazila_id)->first())
                                            @php($union    = $unions->where('id', $row->union_id)->first())
                                            @php($ward     = $wards->where('id', $row->ward_id)->first())

                                            {{ numberFilter($row->holding_no,'bn') }},
                                            {{ $row->village }},
                                            {{ (!empty($union) ? $union->bn_name : " ")  }}
                                            ({{ (!empty($ward) ? $ward->name_bn : " ") }}),
                                            {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                            {{ (!empty($district) ? $district->bn_name : " ")  }}.
                                        </td>
                                        <td>{{ $row->year }}</td>
                                        <td> {{ numberFilter($row->taxes,'bn') }} টাকা</td>
                                        <td> {{ numberFilter($row->paid,'bn') }} টাকা</td>
                                        <td class="operation_btn text-right print_hide">
                                            {{--@if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->action->view) && $accessList->tax_collection->submenu->action->view == "view"))--}}
                                                <a href="{{route('admin.tax-collection.view', $row->id)}}" class="view" title="View">
                                                    <i class="far fa-eye" aria-hidden="true"></i>
                                                </a>
                                            {{--@endif
                                            @if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->action->edit) && $accessList->tax_collection->submenu->action->edit == "edit"))--}}
                                                <a href="{{route('admin.tax-collection.edit', $row->id)}}" class="edit" title="Edit">
                                                    <i class="far fa-edit" aria-hidden="true"></i>
                                                </a>
                                            {{--@endif
                                            @if( ($privilege == 'super') || (!empty($accessList->tax_collection->submenu->action->delete) && $accessList->tax_collection->submenu->action->delete == "delete")) --}}
                                                <a href="{{route('admin.tax-collection.destroy', $row->id)}}" onclick="return confirm('Do you want to delete this data?')" class="delete" title="Delete">
                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                </a>
                                           {{--@endif--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-right">মোট</th>
                                    <th>{{ numberFilter($totalTaxes,'bn') }} টাকা</th>
                                    <th>{{ numberFilter($totalPaid,'bn') }} টাকা</th>
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

@push('footer-script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
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
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.ward-wise-mamber')}}",
                data: {ward_id : _wardId , union_id : _unionId, _token : "{{ csrf_token() }}"}
            }).then(function (response) {
                $('#memberId').append(response);
                $('#memberId').selectpicker('refresh');
            });
        }
    </script>
@endpush
