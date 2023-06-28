@extends('layouts.app')

@section('content')
    <style>
        /* .modal-dialog {
            margin: 1.5rem;
        } */
        .modal-content {
            position: relative;
            background-color: #2e3338;
            background-clip: padding-box;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
            pointer-events: auto;
            padding: 20px 24px;
        }
        .modal-content {
            background: linear-gradient(325deg,#1b1b1b 30%,#282828);
            border: 1px solid rgba(67,67,67,.2);
            border-radius: 20px;
            padding: 0!important;
        }
        /* .modal-close {
            position: absolute;
            top: 16.125px;
            inset-inline-end: 16.125px;
            z-index: 1010;
            padding: 0;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            background: transparent;
            border-radius: 6px;
            width: 24px;
            height: 24px;
            border: 0;
            outline: 0;
            cursor: pointer;
            transition: color 0.2s,background-color 0.2s;
        }
        .modal-content .ant-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        } */
        /* .ant-modal-close-x {
            display: block;
            font-size: 28px;
            font-style: normal;
            line-height: 35.75px;
            text-align: center;
            text-transform: none;
            text-rendering: auto;
        } */
        .modal-content .modal-close .anticon-close {
            font-size: 20px;
            transition: color .25s ease;
        }
        .modal-header {
            background: transparent!important;
            border-bottom: 1px solid rgba(67,67,67,.5);
            /* padding: 8px 16px; */
        }
        .modal-header {
            color: rgba(255, 255, 255, 0.85);
            background: #2e3338;
            border-radius: 12px 12px 0 0;
            margin-bottom: 8px;
        }
        .modal-header .ant-modal-title {
            font-size: 32px;
        }
        .modal-title {
            margin: 0;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 600;
            font-size: 28px;
            line-height: 1.2857142857142858;
            word-wrap: break-word;
        }
        .modal-body {
            padding: 8px 16px;
        }
        .modal-body {
            font-size: 24px;
            line-height: 1;
            word-wrap: break-word;
        }
        .modal-footer {
            text-align: end;
            background: transparent;
            margin-top: 12px;
        }
        .modal-footer {
            padding: 0 16px 24px;
            border-top: 0;
        }
    </style>
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">เติมเงิน</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>เติมเงิน</span></div></div>`;
    </script>
    <div class="ant-row ant-row-center">
        <div class="ant-col ant-col-xs-24 ant-col-md-16 ant-col-xl-12">
            <div style="margin-bottom: 16px;">
                <span class="ant-typography">กรุณาเลือกวิธีการเติมเงิน</span>
            </div>
            <a href="{{ route('deposit-bank') }}?prefix={{ Session::get('Prefix') }}">
                <div class="deposit-method">
                    <div class="deposit-method-icon">
                        <img src="{{ asset('images/icons/3d/bank.svg') }}" alt="โอนผ่านธนาคาร">
                    </div>
                    <div class="deposit-method-name">
                        <span>โอนผ่านธนาคาร</span>
                    </div>
                    <span role="img" aria-label="right" class="anticon anticon-right">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                        </svg>
                    </span>
                </div>
            </a>
            <a href="{{ route('deposit-wallet') }}?prefix={{ Session::get('Prefix') }}">
                <div class="deposit-method">
                    <div class="deposit-method-icon">
                        <img src="{{ asset('images/icons/3d/true-wallet.svg') }}" alt="โอนผ่านทรูมันนี่วอลเล็ท">
                    </div>
                    <div class="deposit-method-name">
                        <span>โอนผ่านทรูมันนี่วอลเล็ท</span>
                    </div>
                    <span role="img" aria-label="right" class="anticon anticon-right">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                        </svg>
                    </span>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#codeCredit" data-whatever="@mdo">
                <div class="deposit-method">
                    <div class="deposit-method-icon">
                        <img src="{{ asset('images/icons/3d/coupon.png') }}" alt="โอนผ่านทรูมันนี่วอลเล็ท">
                    </div>
                    <div class="deposit-method-name">
                        <span>เติมเงินเครดิตฟรี</span>
                        <br>
                        <small>(กรอกโค้ดรับเครดิตฟรี)</small>
                    </div>
                    <span role="img" aria-label="right" class="anticon anticon-right">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                        </svg>
                    </span>
                </div>
            </a>
            <!-- <div>
                <div class="deposit-method">
                    <div class="deposit-method-icon">
                        <img src="{{ asset('images/icons/3d/qr-code.svg') }}" alt="เติมเงินผ่าน QR Code">
                    </div>
                    <div class="deposit-method-name">
                        <span>เติมเงินผ่าน QR Code</span>
                        <br>
                        <small>(ทรูมันนี่วอลเล็ท)</small>
                    </div>
                    <span role="img" aria-label="right" class="anticon anticon-right">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                        </svg>
                    </span>
                </div>
            </div>
            <div>
                <div class="deposit-method">
                    <div class="deposit-method-icon">
                        <img src="{{ asset('images/icons/3d/voucher.svg') }}" alt="เติมเงินผ่านอังเปา">
                    </div>
                    <div class="deposit-method-name">
                        <span>เติมเงินผ่านอังเปา</span>
                        <br>
                        <small>(ทรูมันนี่วอลเล็ท)</small>
                    </div>
                    <span role="img" aria-label="right" class="anticon anticon-right">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                        </svg>
                    </span>
                </div>
            </div> -->
        </div>
    </div>
    <div class="modal fade" id="codeCredit" tabindex="-1" role="dialog" aria-labelledby="codeCredit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" data-dismiss="modal" aria-label="Close" class="ant-modal-close">
                    <span class="ant-modal-close-x">
                        <span role="img" aria-label="close" class="anticon anticon-close ant-modal-close-icon">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                <path d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path>
                            </svg>
                        </span>
                    </span>
                </button>
                <div class="modal-header">
                    <div class="ant-modal-title" id="rc_unique_0">เติมเงินเครดิตฟรี</div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('codeDeal') }}?prefix={{ Session::get('Prefix') }}" method="POST" class="ant-form ant-form-vertical ant-form-hide-required-mark" id="form-code">
                        @csrf
                        <div class="ant-form-item ant-form-item-has-success" style="margin-bottom: 0px;">
                            <div class="ant-row ant-form-item-row">
                                <div class="ant-col ant-form-item-label">
                                    <label for="truewalletVoucherForm_amount" class="ant-form-item-required" title="จำนวนเงินที่ต้องการเติม">กรอกโค้ดรับเครดิตฟรี</label>
                                </div>
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <div class="ant-input-number ant-input-number-in-form-item ant-input-number-status-success" style="width: 100%;">
                                                <div class="ant-input-number-input-wrap">
                                                    <input name="code" id="code" class="ant-input-number-input" value="" minLength="36" maxLength="36">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="ant-typography ant-typography-secondary">
                            <small>* กรุณากรอกโค้ดที่ต้องการเติมเครดิตฟรี</small>
                        </span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" onclick="CodeSubmit();"><span>ยืนยันโค้ด</span></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function CodeSubmit(){
            var code = document.getElementById('code').value
            len = code.length;
            if(code == "" || (len < 36 || len > 36)){
                swalError("กรุณาป้อนรหัสจำนวน 36 ตัว");
                return "error"
            }

            event.preventDefault();
            swal({   title: "คุณยืนยันที่จะทำรายการ!",
            text: "คุณแน่ใจที่จะดำเนินการ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#228B22",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน!",
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true, },
            function(isConfirm){
                if (isConfirm)
                {
                    $('#form-code').submit();
                }else{
                    swal("", "ข้อมูลไม่ถูกดำเนินการ!", "error");
                }
            });
        }
    </script>
@endsection