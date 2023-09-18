@extends('layouts.backend')

@section('content')
    <!-- body container start -->
    <div class="body_container">
        @include('member.nav')

        <!-- body content start -->
        <div class="body_content">
            <div class="panel_container">
                <div class="panel_heading">
                    <h4> ট্যাক্স (কর) প্রদানের বিস্তারিত তথ্য </h4>
                    <a id="print" class="print_btn">
                        <i class="icon ion-md-print"></i> প্রিন্ট
                    </a>
                </div>
                <div class="panel_body">
                    @include('components.print')

                    <div class="table-responsive">
                        
                        <h4 class="header_style none"> ট্যাক্স (কর) প্রদানের বিস্তারিত তথ্য </h4>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered list-table" id="DataTable">
                                <thead>
                                    <tr>
                                        <th style="width: 120px;">অর্থ বছর</th>
                                        <th>ধার্যকৃত বার্ষিক ট্যাক্সের পরিমাণ (টাকা)</th>
                                        <th>সর্বমোট পরিশোধিত ট্যাক্স (টাকা)</th>
                                        <th>মোট বকেয়া ট্যাক্স </th>
                                        <th>মোট জরিমানা আদায়</th>
                                        <th>রসিদ নং</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @if(!empty($pInfo))
                                    <tr>
                                        <th>
                                            পূর্বের বকেয়া <br />
                                             @if(!empty($totalYear))
                                            {{$startYear}} ইং <br />
                                            হইতে <br />
                                            {{$endYear}} ইং <br />
                                            {{$totalYear}} বছর।
                                            @endif
                                        </th>
                                        <td><?php echo $pInfo->taxes; ?></td>
                                        <td><?php echo $pInfo->paid; ?></td>
                                        <td><?php echo ($pInfo->taxes - $pInfo->paid); ?></td>
                                        <td><?php echo $pInfo->fine; ?></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                    @if(!empty($cInfo))
                                    <tr>
                                        <td><?php echo $cInfo->year; ?></td>
                                        <td><?php echo $cInfo->taxes; ?></td>
                                        <td><?php echo $cInfo->paid; ?></td>
                                        <td><?php echo ($cInfo->taxes - $cInfo->paid); ?></td>
                                        <td><?php echo $cInfo->fine; ?></td>
                                        <td><?php echo $pInfo->receipt_no; ?></td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    @if(!empty($tInfo))
                                    <tr>
                                        <th>মোট</th>
                                        <td><?php echo $tInfo->taxes; ?></td>
                                        <td><?php echo $tInfo->paid; ?></td>
                                        <td><?php echo $tInfo->due; ?></td>
                                        <td><?php echo $tInfo->fine; ?></td>
                                        <th></th>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
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

@push('footer-style')
<style>
    #DataTable_wrapper .row:first-child, #DataTable_wrapper .row:last-child {display: none;}
    table.table.table-bordered tr th { text-align: center; vertical-align: middle;}
    .header_style {
        background: #3E3260;
        color: #fff;
        text-align:center;
        font-weight: bold;
        line-height: 1.8;
        display: none;
    }
    @media print {
        .header_style {display: block !important;}
        table.table.table-bordered tr th, table.table.table-bordered tr td,
        table.table.table-bordered, table.table.table-bordered tr {border:1px solid #3E3260 !important;}
    }
</style>
@endpush

@push('footer-script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
            });
        });
    </script>
@endpush