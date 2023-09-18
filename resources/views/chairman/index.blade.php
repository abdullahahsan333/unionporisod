@extends('layouts.backend')

@section('content')
    @php($privilege = Auth::user()->privilege)
    @php($siteInfo = settings())
    @php($accessList = (!empty($siteInfo->accessInfo) ? json_decode($siteInfo->accessInfo->access) : ''))
    <!-- body container start -->
    <div class="body_container">
        @include('chairman.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>সকল চেয়ারম্যান ও সচিব </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    @include('components.print')

                    <form action="{{route('admin.chairman')}}" method="post" class="print_hide">
                        @csrf
                        <div class="row">
                            @if($userInfo->privilege != 'user')
                            <div class="col-md-3">
                                <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" >
                                    <option value="" selected> জেলা নির্বাচন করুন</option>
                                    <option value="39">সুনামগঞ্জ</option>
                                    <option value="45">কিশোরগঞ্জ</option>
                                    <option value="62">ময়মনসিংহ</option>
                                    <option value="64">নেত্রকোণা</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" >
                                    <option value="" selected> উপজেলা নির্বাচন করুন</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <select name="union_id" id="unionId" class="form-control" data-live-search="true" >
                                    <option value="" selected> ইউনিয়ন নির্বাচন করুন</option>
                                </select>
                            </div>
                            @endif
                            
                            <div class="col-md-3">
                                <input type="text" name="chairman" placeholder="চেয়ারম্যানের নাম" class="form-control" >
                            </div>
                            
                            <div class="col-md-3" <?php if($userInfo->privilege != 'user') { echo "style='margin-top: 15px;'"; } ?> >
                                <input type="text" name="minister" placeholder="সচিবের নাম" class="form-control" >
                            </div>
                            
                            <div class="col-md-1" <?php if($userInfo->privilege != 'user') { echo "style='margin-top: 15px;'"; } ?> >
                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn" name="show">খুজুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mt-0 border-primary print_hide">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered list-table" id="DataTable">
                            <thead>
                            <tr>
                                <th style="width: 30px;">ক্র.নং</th>
                                <th>তারিখ</th>
                                <th>চেয়ারম্যানের নাম</th>
                                <th>চেয়ারম্যানের ছবি</th>
                                <th>সচিবের নাম</th>
                                <th>সচিবের ছবি</th>
                                <th>ঠিকানা</th>
                                <th style="width: 105px;" class="text-right print_hide">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($results))
                                @foreach($results as $key => $row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->created }}</td>
                                        <td>{{ $row->chairman }}</td>
                                        <td><img style="max-width: 50px; max-height: 50px;" src="{{ asset($row->chairman_image) }}" alt="Chairman Image"></td>
                                        <td>{{ $row->minister }}</td>
                                        <td><img style="max-width: 50px; max-height: 50px;" src="{{ asset($row->minister_image) }}" alt="Minister Image"></td>
                                        <td>
                                            @php($district = $districts->where('id', $row->district_id)->first())
                                            @php($upazila  = $upazilas->where('id', $row->upazila_id)->first())
                                            @php($union    = $unions->where('id', $row->union_id)->first())

                                            {{ (!empty($union) ? $union->bn_name : " ")  }},
                                            {{ (!empty($upazila) ? $upazila->bn_name : " ")  }},
                                            {{ (!empty($district) ? $district->bn_name : " ")  }}
                                        </td>
                                        <td class="operation_btn text-right print_hide">
                                            <?php //if(($privilege == 'super') ||  (!empty($accessList->chairman->submenu->action->edit) && $accessList->chairman->submenu->action->edit == "edit")) { ?>
                                            <a href="{{route('admin.chairman.edit', $row->id)}}" class="edit" title="Edit">
                                                <i class="far fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <?php //}
                                            //if(($privilege == 'super') ||  (!empty($accessList->chairman->submenu->action->delete) && $accessList->chairman->submenu->action->delete == "delete")) { ?>
                                            <a href="{{route('admin.chairman.destroy', $row->id)}}" onclick="return confirm('Do you want to delete this data?')" class="delete" title="Delete">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </a>
                                            <?php //} ?>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
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
</script>
@endpush
