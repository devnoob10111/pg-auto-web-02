@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">ประวัติธุรกรรม</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>ประวัติธุรกรรม</span></div></div>`;
    </script>
    <style>
        table.dataTable thead th, table.dataTable thead td {
            border: 0.5px solid #b7b7b7;
            background-color: #a7a6a6;
        }
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            color: #fff;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0em 0em;
        }
    </style>
    <div class="ant-row ant-row-center">
        <div class="ant-col ant-col-xs-24 ant-col-md-16">
            <div class="ant-radio-group ant-radio-group-solid transaction-tab" style="margin-bottom: 16px;">
                <label class="ant-radio-button-wrapper {{ Request::segment(2) === 'deposit' ? 'ant-radio-button-wrapper-checked' : null }}" onclick="window.location.href='{{ route('transactions-deposit') }}?prefix={{ Session::get('Prefix') }}'">
                    <span class="ant-radio-button">
                        <input type="radio" class="ant-radio-button-input" value="deposit" checked="">
                        <span class="ant-radio-button-inner"></span>
                    </span>
                    <span>เติมเงิน</span>
                </label>
                <label class="ant-radio-button-wrapper {{ Request::segment(2) === 'withdraw' ? 'ant-radio-button-wrapper-checked' : null }}">
                    <span class="ant-radio-button">
                        <input type="radio" class="ant-radio-button-input" value="withdraw">
                        <span class="ant-radio-button-inner"></span>
                    </span>
                    <span>ถอนเงิน</span>
                </label>
                <label class="ant-radio-button-wrapper {{ Request::segment(2) === 'other' ? 'ant-radio-button-wrapper-checked' : null }}" onclick="window.location.href='{{ route('transactions-other') }}?prefix={{ Session::get('Prefix') }}'">
                    <span class="ant-radio-button ant-radio-button-checked">
                        <input type="radio" class="ant-radio-button-input" value="other">
                        <span class="ant-radio-button-inner"></span>
                    </span>
                    <span>อื่น ๆ</span>
                </label>
            </div>
            <table id="history-table" class="table table-borderless table-striped table-earning" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>วันเวลา</th>
                        <th>จำนวน</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $history)
                    <?php if($history["action"] != "credit_withdraw") { ?>
                    <tr>
                        <td align="center" hidden>{{ $history["date"] }}</td>
                        <td align="center">{{ date('d-m-Y H:i:s',strtotime($history["date"])) }}</td>
                        <td align="center">{{ number_format(floor($history["amount"] * 100) / 100,2) }}</td>
                        <td align="center">
                            <?php 
                                if($history["status"] == "0"){ 
                                    echo "<font color='orange'>ดำเนินการ</font>"; 
                                }else if($history["status"] == "1"){ 
                                    echo "<font color='green'>สำเร็จ</font>"; 
                                }else if($history["status"] == "3"){ 
                                    echo "<font color='blue'>รอแอดมินตรวจสอบ</font>"; 
                                }else if($history["status"] == "6"){ 
                                    echo "<font color='orange'>ไม่สำเร็จ ติดเงื่อนไขโปร</font>"; 
                                }else{ 
                                    echo "<font color='red'>ไม่สำเร็จ</font>"; 
                                } 
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#history-table').DataTable({
                "scrollX": true,
                "pageLength": 10,
                "bLengthChange": false,
                "searching": false,
                "language": {
                    "info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
                    "paginate": {
                        "previous": "<< ย้อนกลับ",
                        "next":"ถัดไป >>"
                    },
                    "emptyTable": "ไม่มีข้อมูลในตาราง",
                    "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                    "infoEmpty": "ไม่มีรายการที่จะแสดง",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ แถว)",
                },
                "order": [[ 0, "desc" ]],
                "deferRender" : true,
                "autoWidth": true,
                "columnDefs": [
                    { "orderable": false, "targets": [0, 1, 2, 3] }
                ]
            });
        });
    </script>
@endsection