@extends('layouts.backend')
@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('affidavit.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4>পারিবারিক সনদ যোগ করুন</h4>
                </div>
                <div class="panel_body">
                    <form action="{{route('admin.affidavit.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="summernote" name="all_data">{{ (!empty($familyData[0]->all_data) ? $familyData[0]->all_data : "") }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="district_id" value="{{$userInfo->district_id}}" id="districtId">
                            <input type="hidden" name="upazila_id" value="{{$userInfo->upazila_id}}" id="upazilaId">
                            <input type="hidden" name="union_id" value="{{$userInfo->union_id}}" id="unionId">

                            @if(!empty($familyData[0]->id))
                            <input type="hidden" name="id" value="{{ $familyData[0]->id }}" >
                            @endif

                            @php($affidavitNo = get_code($get_id+1,5))
                            <input type="hidden" name="affidavit_no" value="{{ $affidavitNo }}" >
                            <input type="hidden" name="affidavit_type" value="family_certificate" >

                            <div class="col-md-12">
                                <div class="form-group text-right mt-3">
                                    <button type="submit" class="btn submit_btn" name="save">সেইভ করুন</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel_footer"></div>
            </div>
        </div>
        <!-- body content end -->
    </div>
    <!-- body container end -->
@endsection

@push('footer-style')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .hr_style {
        display: block;
        width: 100%;
        border-top: 1px solid #0B499D !important;
    }
</style>
@endpush
@push('footer-script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'পারিবারিক সনদ যোগ করুন',
            tabsize: 2,
            height: 450
        });
    });
    // get Union English Name list
    function getAllData() {
        $('#summernote').empty();
        $.ajax({
            method: "POST",
            url: "{{route('admin.affidavit.all-data')}}",
            data: {id: 1, _token: "{{ csrf_token() }}"}
        }).then(function (response) {
            $('#summernote').val(response);
        });
    }
</script>
@endpush
