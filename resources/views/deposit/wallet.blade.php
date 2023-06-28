@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">ทรูมันนี่วอลเล็ท</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>ทรูมันนี่วอลเล็ท</span></div></div>`;
    </script>
    <div class="ant-row" style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
        <div class="ant-col ant-col-24" style="padding-left: 8px; padding-right: 8px;">
            <div class="notice-card danger">
                <i class="fa-solid fa-bullhorn"></i>
                <div class="notice-card-text">
                    ระบบจะเติมเงินอัตโนมัติเข้ายูสเซอร์ของท่าน 
                    <strong>ภายใน 30 วินาที</strong>
                </div>
            </div>
        </div>
        <div class="ant-col ant-col-24" style="padding-left: 8px; padding-right: 8px;">
            <div class="notice-card warning">
                <i class="fa-solid fa-message-exclamation"></i>
                <div class="notice-card-text">
                    สามารถโอนเงินเข้าธนาคารโดยใช้ 
                    <strong>ชื่อบัญชีและเลขบัญชี</strong> 
                    ที่สมัครโอนเข้ามาเท่านั้น
                </div>
            </div>
        </div>
        @if(empty($truewallet["Telephone"]))
        <div class="ant-col ant-col-xs-12 ant-col-sm-6 ant-col-lg-8 ant-col-xl-6 ant-col-xxl-4" style="padding-left: 8px; padding-right: 8px;">
            <div class="bank-deposit-card">
                <span class="v-chip__content" style="color:red;font-weight:bold;">ยังไม่มีการรับฝากผ่านช่องทางนี้</span>
            </div>
        </div>
        @else
        <div class="ant-col ant-col-xs-12 ant-col-sm-6 ant-col-lg-8 ant-col-xl-6 ant-col-xxl-4" style="padding-left: 8px; padding-right: 8px;">
            <div class="bank-deposit-card">
                <div class="bank-card-logo" style="background-color: rgb(255, 255, 255); box-shadow: rgb(255, 255, 255) 0px 8px 12px -10px;">
                    <img width="56" src="{{ asset('media/truewallet.2f48a29a.png') }}" alt="ทรูมันนี่วอลเล็ท" style="border-radius: 16px;">
                </div>
                <div class="bank-card-info">
                    <div>
                        <small>ทรูมันนี่วอลเล็ท</small>
                    </div>
                    <div class="bank-deposite-account">{{ $truewallet["Telephone"] }}</div>
                    <div>
                        <small>{{ $truewallet["Name"] }}</small>
                    </div>
                    <button type="button" class="ant-btn ant-btn-link" onclick="copyDepositWallet('{{ $truewallet['Telephone'] }}')">
                        <span role="img" aria-label="copy" class="anticon anticon-copy">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                <path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path>
                            </svg>
                        </span>
                        <span>คัดลอก</span>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection