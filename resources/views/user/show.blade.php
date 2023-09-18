@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('user.nav')
        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>প্রফাইল</h4>
                </div>
                <div class="panel_body">
                    <div class="user_profile">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="profile_info">
                                    <div class="header_info">
                                        <div class="profile_img" style="cursor: default;">
                                            <img class="file-upload-image" src="{{asset($info->avatar)}}" alt="">
                                            <!--<span class="cover" data-toggle="modal" data-target="#edit_modal">-->
                                            <!--    <i class="fas fa-images"></i>-->
                                            <!--</span>-->
                                        </div>
                                        <div class="title">
                                            <h5>{{$info->name}}</h5>
                                            <p>{{ date('F j Y', strtotime($info->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile_info">
                                    <div class="profile_edit">
                                        <h4>ব্যক্তিগত তথ্য</h4>
                                        <a href="#" data-toggle="modal" data-target="#edit_modal" title="পরিবর্তন করুন">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </div>
                                    <ul>
                                        <li><strong>নাম</strong>: {{$info->name}}</li>
                                        <li><strong>ইউজারনেম</strong>: {{$info->username}}</li>
                                        <li><strong>ইমেইল</strong>: {{$info->email}}</li>
                                        <li><strong>মোবাইল</strong>: {{$info->mobile}}</li>
                                        <li><strong>ইউনিয়ন</strong>: {{ (!empty($unions->bn_name) ? $unions->bn_name : '') }}</li>
                                        <li><strong>ঠিকানা</strong>: {{$info->address}}</li>
                                        <li><strong>ব্যবহারকারী</strong>: {{ (!empty($info->user_type) ? strFilter($info->user_type) : "") }}</li>
                                    </ul>
                                </div>

                                <!-- edit modal -->
                                <div class="modal fade" id="edit_modal">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ব্যক্তিগত তথ্য পরিবর্তন করুন</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form content -->
                                                <form action="{{route('admin.user.update')}}" method="post">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{$info->id}}">

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">নাম <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{$info->name}}" class="form-control" required>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">মোবাইল</label>
                                                            <input type="text" name="mobile" value="{{$info->mobile}}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">ইমেইল</label>
                                                            <input type="email" name="email" value="{{$info->email}}" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">ঠিকানা</label>
                                                            <input type="text" name="address" value="{{$info->address}}" class="form-control">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">ব্যবহারকারী</label>
                                                            <select name="user_type" class="form-control">
                                                                <option value="" selected>ব্যবহারকারী নির্বাচন করুন</option>
                                                                <option value="চেয়ারম্যান" {{ (($info->user_type=="চেয়ারম্যান") ? "selected" : "") }}>চেয়ারম্যান</option>
                                                                <option value="সচিব" {{ (($info->user_type=="সচিব") ? "selected" : "") }}>সচিব</option>
                                                                <option value="উদ্দোক্তা" {{ (($info->user_type=="উদ্দোক্তা") ? "selected" : "") }}>উদ্দোক্তা</option>
                                                                <option value="আমার ইউপি" {{ (($info->user_type=="আমার ইউপি") ? "selected" : "") }}>আমার ইউপি</option>
                                                            </select>
                                                        </div>
                                                        
                                                        @if(Auth::user()->privilege != 'user')
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">জেলা<span class="text-danger">*</span></label>
                                                            <select name="district_id" id="districtId" onchange="getUpazilaFn()" class="form-control" data-live-search="true" required>
                                                                <option value="" selected> জেলা নির্বাচন করুন </option>
                                                                <option value="39" {{$info->district_id == '39' ? 'selected' : ''}}>সুনামগঞ্জ</option>
                                                                <option value="45" {{$info->district_id == '45' ? 'selected' : ''}}>কিশোরগঞ্জ</option>
                                                                <option value="62" {{$info->district_id == '62' ? 'selected' : ''}}>ময়মনসিংহ</option>
                                                                <option value="64" {{$info->district_id == '64' ? 'selected' : ''}}>নেত্রকোণা</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">উপজেলা<span class="text-danger">*</span></label>
                                                            <select name="upazila_id" id="upazilaId" onchange="getUnionFn()" class="form-control" data-live-search="true" required>
                                                                <option value="" selected> উপজেলা নির্বাচন করুন </option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">ইউনিয়ন <span class="text-danger">*</span></label>
                                                            <select name="union_id" id="unionId" class="form-control" data-live-search="true" required>
                                                                <option value="" selected> ইউনিয়ন নির্বাচন করুন </option>
                                                            </select>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">প্রিভিলেজ</label>
                                                            <select name="privilege" class="form-control" required>
                                                                <option value="">প্রিভিলেজ নির্বাচন করুন </option>
                                                                @if(Auth::user()->privilege == 'super')
                                                                <option value="super" {{($info->privilege == 'super' ? 'selected' : '')}}>Super</option>
                                                                @endif
                                                                <option value="admin" {{($info->privilege == 'admin' ? 'selected' : '')}}>Admin</option>
                                                                <option value="user" {{($info->privilege == 'user' ? 'selected' : '')}}>User</option>
                                                            </select>
                                                        </div>
                                                        @else
                                                            <input type="hidden" name="district_id" value="{{$info->district_id}}">
                                                            <input type="hidden" name="upazila_id" value="{{$info->upazila_id}}">
                                                            <input type="hidden" name="union_id" value="{{$info->union_id}}">
                                                            <input type="hidden" name="privilege" value="{{$info->privilege}}">
                                                        @endif

                                                        <div class="form-group col-md-12 text-right">
                                                            <button type="submit" class="btn submit_btn">পরিবর্তন করুন</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-6">
                                <div class="password_form">
                                    <h4>পাসওয়ার্ড পরিবর্তন করুন</h4>
                                    <form action="{{route('admin.user.change-password')}}" method="POST">
                                        @csrf

                                        <input type="hidden" name="id" value="{{$info->id}}">

                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="password" name="current_password" placeholder="পুরাতন পাসওয়ার্ড" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="password" name="password" placeholder="নতুন পাসওয়ার্ড" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="password" name="password_confirmation" placeholder="পুনরায় নতুন পাসওয়ার্ড দিন" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn submit_btn">পাসওয়ার্ড পরিবর্তন করুন</button>
                                                    <button type="reset" class="btn reset_btn">রিসেট করুন</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

@push('footer-script')
    <script>
        $('#divisionId').selectpicker();
        $('#districtId').selectpicker();

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
            var _selectId = '{{$info->upazila_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.upazila-list')}}",
                data: { id: _districtId, select_id: _selectId, _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $('#upazilaId').append(response);
                $('#upazilaId').selectpicker('refresh');
                getUnionFn();
            });
        }
        getUpazilaFn();

        // get Upazila list
        function getUnionFn (){
            $('#unionId').empty();
            var _upazilaId = $('#upazilaId').val();
            var _selectId = '{{$info->union_id}}';
            $.ajax({
                method: "POST",
                url: "{{route('admin.member.union-list')}}",
                data: { id: _upazilaId, select_id: _selectId, _token: "{{ csrf_token() }}" }
            }).then(function(response){
                $('#unionId').append(response);
                $('#unionId').selectpicker('refresh');
            });
        }
    </script>
@endpush