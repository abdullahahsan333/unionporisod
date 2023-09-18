@extends('layouts.backend')

@section('content')
    @php($privilege = Auth::user()->privilege)
    @php($siteInfo = settings())
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))

    <!-- body container start -->
    <div class="body_container">
        @include('trade_license.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">

                <div class="panel_heading">
                    <h4>সকল ট্রেড লাইসেন্স </h4>
                    <a id="print" class="print_btn"> <i class="icon ion-md-print"></i> প্রিন্ট </a>
                </div>

                <div class="panel_body">
                    @include('components.print')

                    <form action="{{route('admin.trade_license')}}" method="post" class="d-print-none">
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
                                    <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true">
                                        <option value="" selected>উপজেলা নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="union_id" id="unionId" class="form-control" data-live-search="true">
                                        <option value="" selected>ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                </div>
                            </div>

                            @else
                                <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                                <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                                <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">
                            @endif

                            <!--<div class="col-md-3">
                                <div class="form-group">
                                    <select name="ward_id" id="wardId" onchange="getMemberWardWiseFn()" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected>ওয়ার্ড নির্বাচন করুন</option>
                                        @foreach($wards as $key => $value)
                                            <option value="{{ $value->id }}">{{$value->name_bn}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>-->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="license_no" id="licenseNo" class="form-control selectpicker" data-live-search="true" >
                                        <option value="" selected> ট্রেড লাইসেন্স নির্বাচন করুন </option>
                                        @if(!empty($allLicense))
                                        @foreach($allLicense as $key => $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->license_no }} - {{ $value->license_owner }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
    								<input type="text" name="mobile" placeholder="মোবাইল নাম্বার" class="form-control">
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
                                    <th>তারিখ</th>
                                    <th>লাইসেন্স নং</th>
                                    <th>নাম</th>
                                    <th>ঠিকানা</th>
                                    <th>লাইসেন্স ফি</th>
                                    <th>ভ্যাট</th>
                                    <th>কর-২</th>
                                    <!--<th>সার্ভিস চার্জ </th>-->
                                    <th>মোট</th>
                                    <th style="width: 105px;" class="text-right print_hide">অ্যাকশন</th>
                                </tr>

                            </thead>
                            <tbody>

                                <?php $totalLicense = $totalVat = $totalTax2 = $totalAmount = $totalServiceCharge = 0; ?>
                                @foreach($results as $key => $value)
                                <?php 
                                    $totalLicense       += $value->license_fee;
                                    $totalVat           += $value->vat;
                                    $totalTax2          += $value->tax_2;
                                    $totalServiceCharge += $value->service_charge;
                                    //$totalAmount        += $value->total;
                                    $total = ($value->total - $value->service_charge);
                                    $totalAmount        += $total;
                                ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ numberFilter($value->created,'bn') }}</td>
                                    <td>
                                        <?php 
                                            $myvalue = numberFilter($value->license_no,'en');
                                            $strinfo = strPrefix($myvalue,'*','3','4'); 
                                        ?>
                                        {{ numberFilter($strinfo,'bn')  }}
                                    </td>
                                    <td>{{$value->license_owner}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>{{numberFilter($value->license_fee,'bn') }}</td>
                                    <td>{{numberFilter($value->vat,'bn') }}</td>
                                    <td>{{numberFilter($value->tax_2,'bn') }}</td>
                                    <!--<td>{{numberFilter($value->service_charge,'bn') }}</td>-->
                                    <td>{{numberFilter($total,'bn') }}</td>
                                    <td class="operation_btn text-right print_hide">
                                        
                                        <a  href="{{route('admin.trade_license.view', $value->id)}}"
                                            class="view" title="View">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a  href="{{route('admin.trade_license.edit', $value->id)}}"
                                            class="edit" title="Edit">
                                            <i class="far fa-edit" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a  href="{{route('admin.trade_license.destroy', $value->id)}}"
                                            onclick="return confirm('Do you want to delete this data?')"
                                            class="delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr>
                                    <th colspan="5" class="text-right">সর্বমোট</th>
                                    <th>{{ numberFilter(numFilter($totalLicense),'bn') }}</th>
                                    <th>{{ numberFilter(numFilter($totalVat),'bn') }}</th>
                                    <th>{{ numberFilter(numFilter($totalTax2),'bn') }}</th>
                                    <!--<th>{{ numberFilter(numFilter($totalServiceCharge),'bn') }}</th>-->
                                    <th>{{ numberFilter(numFilter($totalAmount),'bn') }}</th>
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
    function getDistrictFn (){
        $('#districtId').empty();
        var _divisionId = $('#divisionId').val();
        $.ajax({
            method: "POST",
            url: "{{route('admin.member.district-list')}}",
            data: { id: _divisionId, _token: "{{ csrf_token() }}" }
        }).then(function(response){
            $('#districtId').append(response);
            $('#districtId').selectpicker('refresh');
        });
    }

    // get Upazila list
    function getUpazilaFn (){
        $('#upazilaId').empty();
        var _districtId = $('#districtId').val();
        $.ajax({
            method: "POST",
            url: "{{route('admin.member.upazila-list')}}",
            data: { id: _districtId, _token: "{{ csrf_token() }}" }
        }).then(function(response){
            $('#upazilaId').append(response);
            $('#upazilaId').selectpicker('refresh');
        });
    }

    // get Upazila list
    function getUnionFn (){
        $('#unionId').empty();
        var _upazilaId = $('#upazilaId').val();
        $.ajax({
            method: "POST",
            url: "{{route('admin.member.union-list')}}",
            data: { id: _upazilaId, _token: "{{ csrf_token() }}" }
        }).then(function(response){
            $('#unionId').append(response);
            $('#unionId').selectpicker('refresh');
        });
    }

    // get Ward Wise Member list
/*    function getMemberWardWiseFn() {
        $('#licenseNo').empty();
        var _unionId = $('#unionId').val();

        $.ajax({
            method: "POST",
            url: "{{route('admin.trade_license.ward-wise-mamber')}}",
            data: {union_id : _unionId, _token : "{{ csrf_token() }}"}
        }).then(function (response) {
            $('#licenseNo').append(response);
            $('#licenseNo').selectpicker('refresh');
        });
    }*/
</script>
@endpush
