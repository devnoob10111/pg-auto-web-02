@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">ถอนเงิน</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>ถอนเงิน</span></div></div>`;
    </script>
    <div class="ant-row ant-row-center">
        <div class="ant-col ant-col-xs-24 ant-col-md-16 ant-col-xl-12">
            <div class="form-card">
                <div class="form-card-body">
                    <div style="margin-bottom: 6px;">ถอนเงินเข้าบัญชีธนาคาร</div>
                    <div style="margin-bottom: 24px;">
                        <div class="bank-card">
                            <div class="bank-card-logo">
                                <img width="80" src="{{ asset('media/'.$account['Bank']) }}.png" alt="{{ $account['Bank_Th'] }}" style="border-radius: 16px;">
                            </div>
                            <div class="bank-card-info">
                                <label id="accountBank" hidden>{{ $account["Bank"] }}</label>
                                <div>
                                    <small>{{ $account["Bank_Th"] }}</small>
                                </div>
                                <div class="bank-deposite-account">{{ $account["Bank_Account"] }}</div>
                                <div>
                                    <small>{{ $account["Name"] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row" style="margin-left: -8px; margin-right: -8px; margin-bottom: 24px;">
                        <div class="ant-col ant-col-12" style="padding-left: 8px; padding-right: 8px;">
                            <div class="ant-statistic">
                                <div class="ant-statistic-title">จำนวนเงินที่ถอนได้</div>
                                <div class="ant-statistic-content">
                                    <span class="ant-statistic-content-prefix">฿</span>
                                    <span class="ant-statistic-content-value">
                                        <label id="userCreditWithdraw" hidden>{{ $credit }}</label>
                                        <span>{{ number_format(floor($credit * 100) / 100,2) }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ant-col ant-col-12" style="padding-left: 8px; padding-right: 8px;">
                            <div class="ant-statistic">
                                <div class="ant-statistic-title">ยอดถอนขั้นต่ำ</div>
                                <div class="ant-statistic-content">
                                    <span class="ant-statistic-content-prefix">฿</span>
                                    <span class="ant-statistic-content-value">
                                        <span>1.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="form-withdraw" method="POST" action="{{ route('transfer-withdraw') }}?prefix={{ Session::get('Prefix') }}" class="ant-form ant-form-vertical ant-form-hide-required-mark">
                        @csrf
                        <fieldset class="form-group">
                            <div class="ant-row ant-form-item ant-form-item-has-success">
                                <div class="ant-col ant-form-item-label">
                                    <label for="withdrawForm_amount" class="ant-form-item-required" title="จำนวนเงินที่ต้องการถอน">จำนวนเงินที่ต้องการถอน</label>
                                    <!-- <label class="ant-form-item-required" title="หากรับโบนัส จะถอนเงินทั้งหมดเท่านั้น"style="color:red;font-size:15px;">(หากรับโบนัส จะถอนเงินทั้งหมดเท่านั้น)</label> -->
                                </div>
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <div class="ant-input-number ant-input-number-in-form-item ant-input-number-status-success" style="width: 100%;">
                                                <div class="ant-input-number-input-wrap">
                                                    <input autocomplete="off" placeholder="จำนวนเงินที่ต้องการถอน" name="amount" id="amount" class="ant-input-number-input" minlength="1" maxlength="10" OnKeyPress="return chkNumber(this)" id="amount"<?php if($account["Condition"] == "code" || $account["Condition"] == "promotion"){ echo 'value="'.$account["Balance"].'" disabled'; } ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="btn-submit">
                            <button type="button" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" onclick="withdraw()">
                                <span>ยืนยันถอนเงิน</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let chkTimeout;
        function withdraw(){
            bank = document.getElementById('accountBank').innerHTML
            credit = document.getElementById('userCreditWithdraw').innerHTML
            amount = document.getElementById('amount').value
            if(bank == "gsb"){
                if(amount < 1){
                    swalError("บัญชีออมสินไม่สามารถรับยอดโอนต่ำว่า 1 บาทได้ กรุณาถอนเงินตั้งแต่ 1 บาทขึ้นไป");
                    return
                }
            }
            len = amount.length;
            if(len < 1 ){
                swalError("กรุณาป้อนจำนวนเงิน");
                return
            }else if(parseFloat(amount) > parseFloat(credit)){
                swalError("กรุณาป้อนจำนวนเงินให้ถูกต้อง");
                return
            }
            swal({
                title: "",
                text: "ยืนยันการถอนเงิน",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: "ยกเลิก",
            },function(){
                clearTimeout(chkTimeout)
                chkTimeout = setTimeout(function(){
                    $("#form-withdraw").submit();
                }, 3000);
            });
        }
    </script>
@endsection