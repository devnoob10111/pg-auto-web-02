@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">ชวนเพื่อนเล่น</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>ชวนเพื่อนเล่น</span></div></div>`;
    </script>
    <div class="ant-row ant-row-center">
        <div class="ant-col ant-col-xs-24 ant-col-md-16 ant-col-xl-12">
            <div class="invite-qrcode-container" style="margin-bottom: 16px;">
                <img src="{{ asset('coin/small.png') }}" class="small-coin" alt="">
                <img src="{{ asset('coin/medium.png') }}" class="medium-coin" alt="">
                <img src="{{ asset('coin/large.png') }}" class="large-coin" alt="">
                <img src="{{ asset('coin/x_large.png') }}" class="x-large-coin" alt="">
                <div class="invite-qrcode">
                    <img src="" class="qr-code" width="150" height="150">
                    <!-- <svg width="150" height="150">
                        <defs>
                            <clipPath id="clip-path-dot-color">
                                <circle cx="3" cy="35" r="2" transform="rotate(0,3,35)"></circle>
                                <path d="M 1 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,3,43)"></path>
                                <path d="M 1 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,3,51)"></path>
                                <rect x="1" y="53" width="4" height="4" transform="rotate(0,3,55)"></rect>
                                <path d="M 1 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,3,59)"></path>
                                <path d="M 1 69v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,3,71)"></path>
                                <circle cx="3" cy="79" r="2" transform="rotate(0,3,79)"></circle>
                                <path d="M 1 89v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,3,91)"></path>
                                <circle cx="3" cy="103" r="2" transform="rotate(0,3,103)"></circle>
                                <path d="M 1 109v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,3,111)"></path>
                                <rect x="5" y="41" width="4" height="4" transform="rotate(0,7,43)"></rect>
                                <path d="M 5 45v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,7,47)"></path>
                                <path d="M 5 57v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,7,59)"></path>
                                <path d="M 5 65v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,7,67)"></path>
                                <rect x="5" y="69" width="4" height="4" transform="rotate(0,7,71)"></rect>
                                <path d="M 5 73v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,7,75)"></path>
                                <path d="M 5 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,7,87)"></path>
                                <path d="M 5 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,7,91)"></path>
                                <rect x="5" y="109" width="4" height="4" transform="rotate(0,7,111)"></rect>
                                <path d="M 9 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,11,35)"></path>
                                <rect x="9" y="37" width="4" height="4" transform="rotate(0,11,39)"></rect>
                                <rect x="9" y="41" width="4" height="4" transform="rotate(0,11,43)"></rect>
                                <rect x="9" y="45" width="4" height="4" transform="rotate(0,11,47)"></rect>
                                <path d="M 9 49v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,11,51)"></path>
                                <circle cx="11" cy="63" r="2" transform="rotate(0,11,63)"></circle>
                                <path d="M 9 73v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,11,75)"></path>
                                <rect x="9" y="109" width="4" height="4" transform="rotate(0,11,111)"></rect>
                                <path d="M 9 113v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,11,115)"></path>
                                <path d="M 13 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,15,35)"></path>
                                <rect x="13" y="37" width="4" height="4" transform="rotate(0,15,39)"></rect>
                                <rect x="13" y="41" width="4" height="4" transform="rotate(0,15,43)"></rect>
                                <rect x="13" y="45" width="4" height="4" transform="rotate(0,15,47)"></rect>
                                <rect x="13" y="49" width="4" height="4" transform="rotate(0,15,51)"></rect>
                                <path d="M 13 57v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,15,59)"></path>
                                <circle cx="15" cy="67" r="2" transform="rotate(0,15,67)"></circle>
                                <path d="M 13 81v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,15,83)"></path>
                                <path d="M 13 97v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,15,99)"></path>
                                <rect x="13" y="109" width="4" height="4" transform="rotate(0,15,111)"></rect>
                                <rect x="17" y="41" width="4" height="4" transform="rotate(0,19,43)"></rect>
                                <rect x="17" y="49" width="4" height="4" transform="rotate(0,19,51)"></rect>
                                <path d="M 17 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,19,59)"></path>
                                <path d="M 17 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,19,63)"></path>
                                <path d="M 17 69v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,19,71)"></path>
                                <rect x="17" y="73" width="4" height="4" transform="rotate(0,19,75)"></rect>
                                <rect x="17" y="77" width="4" height="4" transform="rotate(0,19,79)"></rect>
                                <rect x="17" y="81" width="4" height="4" transform="rotate(0,19,83)"></rect>
                                <path d="M 17 93v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,19,95)"></path>
                                <path d="M 17 97v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,19,99)"></path>
                                <path d="M 17 105v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,19,107)"></path>
                                <rect x="17" y="109" width="4" height="4" transform="rotate(0,19,111)"></rect>
                                <path d="M 21 33v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,23,35)"></path>
                                <rect x="21" y="41" width="4" height="4" transform="rotate(0,23,43)"></rect>
                                <rect x="21" y="49" width="4" height="4" transform="rotate(0,23,51)"></rect>
                                <path d="M 21 53v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,23,55)"></path>
                                <path d="M 21 77v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,23,79)"></path>
                                <rect x="21" y="81" width="4" height="4" transform="rotate(0,23,83)"></rect>
                                <path d="M 21 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,23,87)"></path>
                                <path d="M 21 109v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,23,111)"></path>
                                <path d="M 21 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,23,115)"></path>
                                <rect x="25" y="33" width="4" height="4" transform="rotate(0,27,35)"></rect>
                                <rect x="25" y="41" width="4" height="4" transform="rotate(0,27,43)"></rect>
                                <path d="M 25 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,27,51)"></path>
                                <path d="M 25 57v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,27,59)"></path>
                                <circle cx="27" cy="67" r="2" transform="rotate(0,27,67)"></circle>
                                <circle cx="27" cy="75" r="2" transform="rotate(0,27,75)"></circle>
                                <path d="M 25 81v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,27,83)"></path>
                                <path d="M 25 89v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,27,91)"></path>
                                <path d="M 25 97v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,27,99)"></path>
                                <circle cx="27" cy="107" r="2" transform="rotate(0,27,107)"></circle>
                                <path d="M 25 113v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,27,115)"></path>
                                <rect x="29" y="33" width="4" height="4" transform="rotate(0,31,35)"></rect>
                                <rect x="29" y="37" width="4" height="4" transform="rotate(0,31,39)"></rect>
                                <path d="M 29 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,31,43)"></path>
                                <path d="M 29 53v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,31,55)"></path>
                                <rect x="29" y="57" width="4" height="4" transform="rotate(0,31,59)"></rect>
                                <path d="M 29 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,31,63)"></path>
                                <path d="M 29 85v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,31,87)"></path>
                                <path d="M 29 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,31,91)"></path>
                                <path d="M 29 97v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,31,99)"></path>
                                <path d="M 29 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,31,103)"></path>
                                <path d="M 33 5v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,35,7)"></path>
                                <circle cx="35" cy="15" r="2" transform="rotate(0,35,15)"></circle>
                                <path d="M 33 21v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,35,23)"></path>
                                <rect x="33" y="25" width="4" height="4" transform="rotate(0,35,27)"></rect>
                                <rect x="33" y="29" width="4" height="4" transform="rotate(0,35,31)"></rect>
                                <rect x="33" y="33" width="4" height="4" transform="rotate(0,35,35)"></rect>
                                <path d="M 33 37v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,35,39)"></path>
                                <path d="M 33 45v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,35,47)"></path>
                                <path d="M 33 49v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,35,51)"></path>
                                <path d="M 33 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,35,87)"></path>
                                <circle cx="35" cy="95" r="2" transform="rotate(0,35,95)"></circle>
                                <path d="M 33 105v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,35,107)"></path>
                                <rect x="33" y="109" width="4" height="4" transform="rotate(0,35,111)"></rect>
                                <rect x="33" y="113" width="4" height="4" transform="rotate(0,35,115)"></rect>
                                <rect x="33" y="117" width="4" height="4" transform="rotate(0,35,119)"></rect>
                                <rect x="33" y="121" width="4" height="4" transform="rotate(0,35,123)"></rect>
                                <path d="M 33 125v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,35,127)"></path>
                                <path d="M 33 133v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,35,135)"></path>
                                <path d="M 33 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,35,139)"></path>
                                <path d="M 33 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,35,147)"></path>
                                <path d="M 37 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,39,3)"></path>
                                <rect x="37" y="5" width="4" height="4" transform="rotate(0,39,7)"></rect>
                                <path d="M 37 17v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,39,19)"></path>
                                <path d="M 37 33v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,39,35)"></path>
                                <rect x="37" y="49" width="4" height="4" transform="rotate(0,39,51)"></rect>
                                <rect x="37" y="53" width="4" height="4" transform="rotate(0,39,55)"></rect>
                                <path d="M 37 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,39,59)"></path>
                                <path d="M 37 89v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,39,91)"></path>
                                <circle cx="39" cy="99" r="2" transform="rotate(0,39,99)"></circle>
                                <path d="M 37 109v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,39,111)"></path>
                                <rect x="37" y="121" width="4" height="4" transform="rotate(0,39,123)"></rect>
                                <rect x="37" y="125" width="4" height="4" transform="rotate(0,39,127)"></rect>
                                <path d="M 37 133v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,39,135)"></path>
                                <rect x="37" y="137" width="4" height="4" transform="rotate(0,39,139)"></rect>
                                <rect x="37" y="141" width="4" height="4" transform="rotate(0,39,143)"></rect>
                                <rect x="37" y="145" width="4" height="4" transform="rotate(0,39,147)"></rect>
                                <path d="M 41 5v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,43,7)"></path>
                                <path d="M 41 13v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,43,15)"></path>
                                <rect x="41" y="17" width="4" height="4" transform="rotate(0,43,19)"></rect>
                                <circle cx="43" cy="27" r="2" transform="rotate(0,43,27)"></circle>
                                <path d="M 41 37v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,43,39)"></path>
                                <path d="M 41 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,43,43)"></path>
                                <path d="M 41 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,43,51)"></path>
                                <path d="M 41 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,43,59)"></path>
                                <path d="M 41 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,43,63)"></path>
                                <rect x="41" y="89" width="4" height="4" transform="rotate(0,43,91)"></rect>
                                <path d="M 41 121v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,43,123)"></path>
                                <rect x="41" y="125" width="4" height="4" transform="rotate(0,43,127)"></rect>
                                <path d="M 41 129v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,43,131)"></path>
                                <path d="M 41 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,43,143)"></path>
                                <rect x="41" y="145" width="4" height="4" transform="rotate(0,43,147)"></rect>
                                <path d="M 45 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,47,19)"></path>
                                <path d="M 45 21v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,47,23)"></path>
                                <rect x="45" y="37" width="4" height="4" transform="rotate(0,47,39)"></rect>
                                <rect x="45" y="41" width="4" height="4" transform="rotate(0,47,43)"></rect>
                                <path d="M 45 45v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,47,47)"></path>
                                <circle cx="47" cy="55" r="2" transform="rotate(0,47,55)"></circle>
                                <path d="M 45 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,47,87)"></path>
                                <rect x="45" y="89" width="4" height="4" transform="rotate(0,47,91)"></rect>
                                <rect x="45" y="93" width="4" height="4" transform="rotate(0,47,95)"></rect>
                                <rect x="45" y="97" width="4" height="4" transform="rotate(0,47,99)"></rect>
                                <path d="M 45 101v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,47,103)"></path>
                                <path d="M 45 109v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,47,111)"></path>
                                <path d="M 45 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,47,115)"></path>
                                <rect x="45" y="125" width="4" height="4" transform="rotate(0,47,127)"></rect>
                                <rect x="45" y="129" width="4" height="4" transform="rotate(0,47,131)"></rect>
                                <path d="M 45 133v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,47,135)"></path>
                                <rect x="45" y="145" width="4" height="4" transform="rotate(0,47,147)"></rect>
                                <path d="M 49 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,51,3)"></path>
                                <rect x="49" y="5" width="4" height="4" transform="rotate(0,51,7)"></rect>
                                <path d="M 49 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,51,11)"></path>
                                <rect x="49" y="21" width="4" height="4" transform="rotate(0,51,23)"></rect>
                                <rect x="49" y="25" width="4" height="4" transform="rotate(0,51,27)"></rect>
                                <path d="M 49 29v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,51,31)"></path>
                                <path d="M 49 37v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,51,39)"></path>
                                <path d="M 49 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,51,43)"></path>
                                <path d="M 49 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,51,51)"></path>
                                <path d="M 49 57v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,51,59)"></path>
                                <path d="M 49 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,51,63)"></path>
                                <path d="M 49 93v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,51,95)"></path>
                                <path d="M 49 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,51,103)"></path>
                                <path d="M 49 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,51,115)"></path>
                                <rect x="49" y="117" width="4" height="4" transform="rotate(0,51,119)"></rect>
                                <rect x="49" y="121" width="4" height="4" transform="rotate(0,51,123)"></rect>
                                <rect x="49" y="125" width="4" height="4" transform="rotate(0,51,127)"></rect>
                                <rect x="49" y="129" width="4" height="4" transform="rotate(0,51,131)"></rect>
                                <rect x="49" y="133" width="4" height="4" transform="rotate(0,51,135)"></rect>
                                <path d="M 49 141v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,51,143)"></path>
                                <rect x="49" y="145" width="4" height="4" transform="rotate(0,51,147)"></rect>
                                <rect x="53" y="9" width="4" height="4" transform="rotate(0,55,11)"></rect>
                                <rect x="53" y="21" width="4" height="4" transform="rotate(0,55,23)"></rect>
                                <rect x="53" y="49" width="4" height="4" transform="rotate(0,55,51)"></rect>
                                <circle cx="55" cy="87" r="2" transform="rotate(0,55,87)"></circle>
                                <circle cx="55" cy="111" r="2" transform="rotate(0,55,111)"></circle>
                                <rect x="53" y="121" width="4" height="4" transform="rotate(0,55,123)"></rect>
                                <rect x="53" y="125" width="4" height="4" transform="rotate(0,55,127)"></rect>
                                <path d="M 53 133v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,55,135)"></path>
                                <rect x="53" y="145" width="4" height="4" transform="rotate(0,55,147)"></rect>
                                <path d="M 57 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,59,3)"></path>
                                <rect x="57" y="5" width="4" height="4" transform="rotate(0,59,7)"></rect>
                                <path d="M 57 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,59,11)"></path>
                                <path d="M 57 17v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,59,19)"></path>
                                <rect x="57" y="21" width="4" height="4" transform="rotate(0,59,23)"></rect>
                                <path d="M 57 25v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,59,27)"></path>
                                <path d="M 57 33v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,59,35)"></path>
                                <path d="M 57 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,59,43)"></path>
                                <rect x="57" y="45" width="4" height="4" transform="rotate(0,59,47)"></rect>
                                <rect x="57" y="49" width="4" height="4" transform="rotate(0,59,51)"></rect>
                                <path d="M 57 53v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,59,55)"></path>
                                <path d="M 57 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,59,91)"></path>
                                <rect x="57" y="93" width="4" height="4" transform="rotate(0,59,95)"></rect>
                                <path d="M 57 97v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,59,99)"></path>
                                <circle cx="59" cy="107" r="2" transform="rotate(0,59,107)"></circle>
                                <path d="M 57 113v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,59,115)"></path>
                                <path d="M 57 121v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,59,123)"></path>
                                <path d="M 57 125v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,59,127)"></path>
                                <circle cx="59" cy="139" r="2" transform="rotate(0,59,139)"></circle>
                                <path d="M 57 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,59,147)"></path>
                                <rect x="61" y="5" width="4" height="4" transform="rotate(0,63,7)"></rect>
                                <circle cx="63" cy="15" r="2" transform="rotate(0,63,15)"></circle>
                                <rect x="61" y="21" width="4" height="4" transform="rotate(0,63,23)"></rect>
                                <rect x="61" y="33" width="4" height="4" transform="rotate(0,63,35)"></rect>
                                <rect x="61" y="49" width="4" height="4" transform="rotate(0,63,51)"></rect>
                                <path d="M 61 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,63,87)"></path>
                                <path d="M 61 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,63,91)"></path>
                                <path d="M 61 97v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,63,99)"></path>
                                <path d="M 61 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,63,103)"></path>
                                <path d="M 61 109v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,63,111)"></path>
                                <rect x="61" y="113" width="4" height="4" transform="rotate(0,63,115)"></rect>
                                <circle cx="63" cy="131" r="2" transform="rotate(0,63,131)"></circle>
                                <rect x="65" y="5" width="4" height="4" transform="rotate(0,67,7)"></rect>
                                <path d="M 65 9v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,67,11)"></path>
                                <path d="M 65 17v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,67,19)"></path>
                                <rect x="65" y="21" width="4" height="4" transform="rotate(0,67,23)"></rect>
                                <rect x="65" y="25" width="4" height="4" transform="rotate(0,67,27)"></rect>
                                <rect x="65" y="29" width="4" height="4" transform="rotate(0,67,31)"></rect>
                                <path d="M 65 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,67,35)"></path>
                                <path d="M 65 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,67,43)"></path>
                                <rect x="65" y="45" width="4" height="4" transform="rotate(0,67,47)"></rect>
                                <rect x="65" y="49" width="4" height="4" transform="rotate(0,67,51)"></rect>
                                <rect x="65" y="53" width="4" height="4" transform="rotate(0,67,55)"></rect>
                                <path d="M 65 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,67,59)"></path>
                                <circle cx="67" cy="95" r="2" transform="rotate(0,67,95)"></circle>
                                <rect x="65" y="113" width="4" height="4" transform="rotate(0,67,115)"></rect>
                                <rect x="65" y="117" width="4" height="4" transform="rotate(0,67,119)"></rect>
                                <rect x="65" y="121" width="4" height="4" transform="rotate(0,67,123)"></rect>
                                <path d="M 65 125v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,67,127)"></path>
                                <path d="M 65 133v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,67,135)"></path>
                                <rect x="65" y="137" width="4" height="4" transform="rotate(0,67,139)"></rect>
                                <rect x="65" y="141" width="4" height="4" transform="rotate(0,67,143)"></rect>
                                <path d="M 65 145v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,67,147)"></path>
                                <path d="M 69 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,71,3)"></path>
                                <path d="M 69 5v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,71,7)"></path>
                                <path d="M 69 13v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,71,15)"></path>
                                <rect x="69" y="29" width="4" height="4" transform="rotate(0,71,31)"></rect>
                                <path d="M 69 37v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,71,39)"></path>
                                <rect x="69" y="41" width="4" height="4" transform="rotate(0,71,43)"></rect>
                                <rect x="69" y="45" width="4" height="4" transform="rotate(0,71,47)"></rect>
                                <rect x="69" y="49" width="4" height="4" transform="rotate(0,71,51)"></rect>
                                <rect x="69" y="53" width="4" height="4" transform="rotate(0,71,55)"></rect>
                                <rect x="69" y="57" width="4" height="4" transform="rotate(0,71,59)"></rect>
                                <path d="M 69 61v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,71,63)"></path>
                                <circle cx="71" cy="91" r="2" transform="rotate(0,71,91)"></circle>
                                <path d="M 69 101v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,71,103)"></path>
                                <path d="M 69 105v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,71,107)"></path>
                                <path d="M 69 113v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,71,115)"></path>
                                <rect x="69" y="121" width="4" height="4" transform="rotate(0,71,123)"></rect>
                                <circle cx="71" cy="131" r="2" transform="rotate(0,71,131)"></circle>
                                <rect x="69" y="145" width="4" height="4" transform="rotate(0,71,147)"></rect>
                                <path d="M 73 13v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,75,15)"></path>
                                <path d="M 73 21v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,75,23)"></path>
                                <rect x="73" y="25" width="4" height="4" transform="rotate(0,75,27)"></rect>
                                <rect x="73" y="29" width="4" height="4" transform="rotate(0,75,31)"></rect>
                                <path d="M 73 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,75,35)"></path>
                                <rect x="73" y="49" width="4" height="4" transform="rotate(0,75,51)"></rect>
                                <rect x="73" y="57" width="4" height="4" transform="rotate(0,75,59)"></rect>
                                <rect x="73" y="61" width="4" height="4" transform="rotate(0,75,63)"></rect>
                                <path d="M 73 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,75,87)"></path>
                                <path d="M 73 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,75,103)"></path>
                                <path d="M 73 121v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,75,123)"></path>
                                <path d="M 73 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,75,139)"></path>
                                <rect x="73" y="141" width="4" height="4" transform="rotate(0,75,143)"></rect>
                                <path d="M 73 145v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,75,147)"></path>
                                <path d="M 77 5v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,79,7)"></path>
                                <path d="M 77 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,79,19)"></path>
                                <path d="M 77 21v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,79,23)"></path>
                                <rect x="77" y="33" width="4" height="4" transform="rotate(0,79,35)"></rect>
                                <path d="M 77 45v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,79,47)"></path>
                                <rect x="77" y="49" width="4" height="4" transform="rotate(0,79,51)"></rect>
                                <rect x="77" y="53" width="4" height="4" transform="rotate(0,79,55)"></rect>
                                <rect x="77" y="57" width="4" height="4" transform="rotate(0,79,59)"></rect>
                                <rect x="77" y="61" width="4" height="4" transform="rotate(0,79,63)"></rect>
                                <rect x="77" y="85" width="4" height="4" transform="rotate(0,79,87)"></rect>
                                <rect x="77" y="89" width="4" height="4" transform="rotate(0,79,91)"></rect>
                                <path d="M 77 93v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,79,95)"></path>
                                <path d="M 77 109v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,79,111)"></path>
                                <rect x="77" y="113" width="4" height="4" transform="rotate(0,79,115)"></rect>
                                <path d="M 77 117v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,79,119)"></path>
                                <path d="M 77 133v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,79,135)"></path>
                                <rect x="77" y="137" width="4" height="4" transform="rotate(0,79,139)"></rect>
                                <path d="M 77 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,79,143)"></path>
                                <path d="M 81 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,83,3)"></path>
                                <rect x="81" y="5" width="4" height="4" transform="rotate(0,83,7)"></rect>
                                <path d="M 81 13v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,83,15)"></path>
                                <rect x="81" y="17" width="4" height="4" transform="rotate(0,83,19)"></rect>
                                <circle cx="83" cy="27" r="2" transform="rotate(0,83,27)"></circle>
                                <path d="M 81 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,83,35)"></path>
                                <path d="M 81 37v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,83,39)"></path>
                                <rect x="81" y="57" width="4" height="4" transform="rotate(0,83,59)"></rect>
                                <path d="M 81 61v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,83,63)"></path>
                                <rect x="81" y="85" width="4" height="4" transform="rotate(0,83,87)"></rect>
                                <path d="M 81 93v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,83,95)"></path>
                                <rect x="81" y="97" width="4" height="4" transform="rotate(0,83,99)"></rect>
                                <rect x="81" y="101" width="4" height="4" transform="rotate(0,83,103)"></rect>
                                <rect x="81" y="105" width="4" height="4" transform="rotate(0,83,107)"></rect>
                                <rect x="81" y="109" width="4" height="4" transform="rotate(0,83,111)"></rect>
                                <path d="M 81 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,83,115)"></path>
                                <path d="M 81 121v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,83,123)"></path>
                                <rect x="81" y="125" width="4" height="4" transform="rotate(0,83,127)"></rect>
                                <path d="M 81 129v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,83,131)"></path>
                                <circle cx="83" cy="147" r="2" transform="rotate(0,83,147)"></circle>
                                <rect x="85" y="5" width="4" height="4" transform="rotate(0,87,7)"></rect>
                                <path d="M 85 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,87,11)"></path>
                                <rect x="85" y="17" width="4" height="4" transform="rotate(0,87,19)"></rect>
                                <circle cx="87" cy="31" r="2" transform="rotate(0,87,31)"></circle>
                                <rect x="85" y="37" width="4" height="4" transform="rotate(0,87,39)"></rect>
                                <path d="M 85 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,87,43)"></path>
                                <path d="M 85 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,87,51)"></path>
                                <rect x="85" y="57" width="4" height="4" transform="rotate(0,87,59)"></rect>
                                <rect x="85" y="85" width="4" height="4" transform="rotate(0,87,87)"></rect>
                                <path d="M 85 97v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,87,99)"></path>
                                <rect x="85" y="101" width="4" height="4" transform="rotate(0,87,103)"></rect>
                                <rect x="85" y="105" width="4" height="4" transform="rotate(0,87,107)"></rect>
                                <circle cx="87" cy="119" r="2" transform="rotate(0,87,119)"></circle>
                                <path d="M 85 133v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,87,135)"></path>
                                <rect x="85" y="137" width="4" height="4" transform="rotate(0,87,139)"></rect>
                                <path d="M 85 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,87,143)"></path>
                                <rect x="89" y="5" width="4" height="4" transform="rotate(0,91,7)"></rect>
                                <path d="M 89 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,91,11)"></path>
                                <rect x="89" y="17" width="4" height="4" transform="rotate(0,91,19)"></rect>
                                <circle cx="91" cy="27" r="2" transform="rotate(0,91,27)"></circle>
                                <path d="M 89 37v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,91,39)"></path>
                                <path d="M 89 45v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,91,47)"></path>
                                <rect x="89" y="49" width="4" height="4" transform="rotate(0,91,51)"></rect>
                                <rect x="89" y="53" width="4" height="4" transform="rotate(0,91,55)"></rect>
                                <rect x="89" y="57" width="4" height="4" transform="rotate(0,91,59)"></rect>
                                <path d="M 89 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,91,63)"></path>
                                <rect x="89" y="85" width="4" height="4" transform="rotate(0,91,87)"></rect>
                                <rect x="89" y="101" width="4" height="4" transform="rotate(0,91,103)"></rect>
                                <path d="M 89 105v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,91,107)"></path>
                                <path d="M 89 121v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,91,123)"></path>
                                <rect x="89" y="125" width="4" height="4" transform="rotate(0,91,127)"></rect>
                                <rect x="89" y="129" width="4" height="4" transform="rotate(0,91,131)"></rect>
                                <path d="M 89 133v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,91,135)"></path>
                                <path d="M 89 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,91,143)"></path>
                                <path d="M 89 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,91,147)"></path>
                                <path d="M 93 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,95,3)"></path>
                                <rect x="93" y="5" width="4" height="4" transform="rotate(0,95,7)"></rect>
                                <rect x="93" y="17" width="4" height="4" transform="rotate(0,95,19)"></rect>
                                <path d="M 93 29v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,95,31)"></path>
                                <rect x="93" y="49" width="4" height="4" transform="rotate(0,95,51)"></rect>
                                <rect x="93" y="85" width="4" height="4" transform="rotate(0,95,87)"></rect>
                                <path d="M 93 97v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,95,99)"></path>
                                <path d="M 93 101v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,95,103)"></path>
                                <circle cx="95" cy="119" r="2" transform="rotate(0,95,119)"></circle>
                                <path d="M 93 129v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,95,131)"></path>
                                <rect x="97" y="5" width="4" height="4" transform="rotate(0,99,7)"></rect>
                                <rect x="97" y="9" width="4" height="4" transform="rotate(0,99,11)"></rect>
                                <rect x="97" y="13" width="4" height="4" transform="rotate(0,99,15)"></rect>
                                <rect x="97" y="17" width="4" height="4" transform="rotate(0,99,19)"></rect>
                                <rect x="97" y="21" width="4" height="4" transform="rotate(0,99,23)"></rect>
                                <rect x="97" y="25" width="4" height="4" transform="rotate(0,99,27)"></rect>
                                <rect x="97" y="29" width="4" height="4" transform="rotate(0,99,31)"></rect>
                                <rect x="97" y="33" width="4" height="4" transform="rotate(0,99,35)"></rect>
                                <rect x="97" y="37" width="4" height="4" transform="rotate(0,99,39)"></rect>
                                <path d="M 97 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,99,43)"></path>
                                <rect x="97" y="49" width="4" height="4" transform="rotate(0,99,51)"></rect>
                                <path d="M 97 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,99,63)"></path>
                                <rect x="97" y="85" width="4" height="4" transform="rotate(0,99,87)"></rect>
                                <path d="M 97 105v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,99,107)"></path>
                                <path d="M 97 109v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,99,111)"></path>
                                <path d="M 97 121v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,99,123)"></path>
                                <path d="M 97 125v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,99,127)"></path>
                                <path d="M 97 133v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,99,135)"></path>
                                <path d="M 97 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,99,143)"></path>
                                <path d="M 97 145v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,99,147)"></path>
                                <path d="M 101 5v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,103,7)"></path>
                                <rect x="101" y="9" width="4" height="4" transform="rotate(0,103,11)"></rect>
                                <rect x="101" y="13" width="4" height="4" transform="rotate(0,103,15)"></rect>
                                <rect x="101" y="17" width="4" height="4" transform="rotate(0,103,19)"></rect>
                                <path d="M 101 21v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,103,23)"></path>
                                <path d="M 101 29v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,103,31)"></path>
                                <path d="M 101 37v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,103,39)"></path>
                                <path d="M 101 45v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,103,47)"></path>
                                <path d="M 101 49v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,103,51)"></path>
                                <path d="M 101 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,103,63)"></path>
                                <path d="M 101 85v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,103,87)"></path>
                                <path d="M 101 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,103,91)"></path>
                                <path d="M 101 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,103,103)"></path>
                                <rect x="101" y="105" width="4" height="4" transform="rotate(0,103,107)"></rect>
                                <circle cx="103" cy="115" r="2" transform="rotate(0,103,115)"></circle>
                                <rect x="101" y="121" width="4" height="4" transform="rotate(0,103,123)"></rect>
                                <rect x="101" y="133" width="4" height="4" transform="rotate(0,103,135)"></rect>
                                <rect x="101" y="137" width="4" height="4" transform="rotate(0,103,139)"></rect>
                                <rect x="101" y="141" width="4" height="4" transform="rotate(0,103,143)"></rect>
                                <rect x="101" y="145" width="4" height="4" transform="rotate(0,103,147)"></rect>
                                <circle cx="107" cy="3" r="2" transform="rotate(0,107,3)"></circle>
                                <path d="M 105 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,107,11)"></path>
                                <rect x="105" y="13" width="4" height="4" transform="rotate(0,107,15)"></rect>
                                <path d="M 105 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,107,19)"></path>
                                <circle cx="107" cy="27" r="2" transform="rotate(0,107,27)"></circle>
                                <path d="M 105 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,107,43)"></path>
                                <rect x="105" y="45" width="4" height="4" transform="rotate(0,107,47)"></rect>
                                <path d="M 105 53v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,107,55)"></path>
                                <path d="M 105 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,107,59)"></path>
                                <path d="M 105 89v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,107,91)"></path>
                                <rect x="105" y="93" width="4" height="4" transform="rotate(0,107,95)"></rect>
                                <path d="M 105 97v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,107,99)"></path>
                                <rect x="105" y="105" width="4" height="4" transform="rotate(0,107,107)"></rect>
                                <path d="M 105 117v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,107,119)"></path>
                                <rect x="105" y="121" width="4" height="4" transform="rotate(0,107,123)"></rect>
                                <path d="M 105 125v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,107,127)"></path>
                                <rect x="105" y="133" width="4" height="4" transform="rotate(0,107,135)"></rect>
                                <path d="M 105 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,107,139)"></path>
                                <path d="M 105 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,107,147)"></path>
                                <path d="M 109 5v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,111,7)"></path>
                                <rect x="109" y="13" width="4" height="4" transform="rotate(0,111,15)"></rect>
                                <circle cx="111" cy="35" r="2" transform="rotate(0,111,35)"></circle>
                                <rect x="109" y="45" width="4" height="4" transform="rotate(0,111,47)"></rect>
                                <rect x="109" y="49" width="4" height="4" transform="rotate(0,111,51)"></rect>
                                <rect x="109" y="53" width="4" height="4" transform="rotate(0,111,55)"></rect>
                                <rect x="109" y="57" width="4" height="4" transform="rotate(0,111,59)"></rect>
                                <circle cx="111" cy="87" r="2" transform="rotate(0,111,87)"></circle>
                                <path d="M 109 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,111,103)"></path>
                                <path d="M 109 105v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,111,107)"></path>
                                <rect x="109" y="121" width="4" height="4" transform="rotate(0,111,123)"></rect>
                                <rect x="109" y="125" width="4" height="4" transform="rotate(0,111,127)"></rect>
                                <rect x="109" y="129" width="4" height="4" transform="rotate(0,111,131)"></rect>
                                <rect x="109" y="133" width="4" height="4" transform="rotate(0,111,135)"></rect>
                                <path d="M 113 1v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,115,3)"></path>
                                <path d="M 113 5v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,115,7)"></path>
                                <path d="M 113 13v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,115,15)"></path>
                                <rect x="113" y="17" width="4" height="4" transform="rotate(0,115,19)"></rect>
                                <rect x="113" y="21" width="4" height="4" transform="rotate(0,115,23)"></rect>
                                <rect x="113" y="25" width="4" height="4" transform="rotate(0,115,27)"></rect>
                                <path d="M 113 29v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,115,31)"></path>
                                <path d="M 113 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,115,43)"></path>
                                <rect x="113" y="45" width="4" height="4" transform="rotate(0,115,47)"></rect>
                                <rect x="113" y="49" width="4" height="4" transform="rotate(0,115,51)"></rect>
                                <rect x="113" y="53" width="4" height="4" transform="rotate(0,115,55)"></rect>
                                <rect x="113" y="57" width="4" height="4" transform="rotate(0,115,59)"></rect>
                                <path d="M 113 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,115,63)"></path>
                                <circle cx="115" cy="91" r="2" transform="rotate(0,115,91)"></circle>
                                <path d="M 113 97v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,115,99)"></path>
                                <path d="M 113 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,115,115)"></path>
                                <rect x="113" y="117" width="4" height="4" transform="rotate(0,115,119)"></rect>
                                <rect x="113" y="121" width="4" height="4" transform="rotate(0,115,123)"></rect>
                                <rect x="113" y="125" width="4" height="4" transform="rotate(0,115,127)"></rect>
                                <rect x="113" y="129" width="4" height="4" transform="rotate(0,115,131)"></rect>
                                <rect x="113" y="133" width="4" height="4" transform="rotate(0,115,135)"></rect>
                                <rect x="113" y="137" width="4" height="4" transform="rotate(0,115,139)"></rect>
                                <rect x="113" y="141" width="4" height="4" transform="rotate(0,115,143)"></rect>
                                <path d="M 113 145v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,115,147)"></path>
                                <path d="M 117 33v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,119,35)"></path>
                                <path d="M 117 37v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,119,39)"></path>
                                <path d="M 117 49v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,119,51)"></path>
                                <rect x="117" y="53" width="4" height="4" transform="rotate(0,119,55)"></rect>
                                <path d="M 117 57v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,119,59)"></path>
                                <path d="M 117 93v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,119,95)"></path>
                                <rect x="117" y="97" width="4" height="4" transform="rotate(0,119,99)"></rect>
                                <path d="M 117 101v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,119,103)"></path>
                                <rect x="117" y="113" width="4" height="4" transform="rotate(0,119,115)"></rect>
                                <rect x="117" y="129" width="4" height="4" transform="rotate(0,119,131)"></rect>
                                <rect x="117" y="145" width="4" height="4" transform="rotate(0,119,147)"></rect>
                                <rect x="121" y="33" width="4" height="4" transform="rotate(0,123,35)"></rect>
                                <path d="M 121 41v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,123,43)"></path>
                                <path d="M 121 45v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,123,47)"></path>
                                <rect x="121" y="53" width="4" height="4" transform="rotate(0,123,55)"></rect>
                                <path d="M 121 61v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,123,63)"></path>
                                <rect x="121" y="65" width="4" height="4" transform="rotate(0,123,67)"></rect>
                                <rect x="121" y="69" width="4" height="4" transform="rotate(0,123,71)"></rect>
                                <rect x="121" y="73" width="4" height="4" transform="rotate(0,123,75)"></rect>
                                <rect x="121" y="77" width="4" height="4" transform="rotate(0,123,79)"></rect>
                                <rect x="121" y="81" width="4" height="4" transform="rotate(0,123,83)"></rect>
                                <path d="M 121 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,123,87)"></path>
                                <rect x="121" y="113" width="4" height="4" transform="rotate(0,123,115)"></rect>
                                <circle cx="123" cy="123" r="2" transform="rotate(0,123,123)"></circle>
                                <rect x="121" y="129" width="4" height="4" transform="rotate(0,123,131)"></rect>
                                <path d="M 121 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,123,139)"></path>
                                <rect x="121" y="141" width="4" height="4" transform="rotate(0,123,143)"></rect>
                                <rect x="121" y="145" width="4" height="4" transform="rotate(0,123,147)"></rect>
                                <path d="M 125 33v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,127,35)"></path>
                                <rect x="125" y="53" width="4" height="4" transform="rotate(0,127,55)"></rect>
                                <rect x="125" y="57" width="4" height="4" transform="rotate(0,127,59)"></rect>
                                <path d="M 125 61v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,127,63)"></path>
                                <rect x="125" y="69" width="4" height="4" transform="rotate(0,127,71)"></rect>
                                <path d="M 125 73v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,127,75)"></path>
                                <circle cx="127" cy="91" r="2" transform="rotate(0,127,91)"></circle>
                                <path d="M 125 105v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,127,107)"></path>
                                <rect x="125" y="113" width="4" height="4" transform="rotate(0,127,115)"></rect>
                                <rect x="125" y="129" width="4" height="4" transform="rotate(0,127,131)"></rect>
                                <path d="M 125 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,127,139)"></path>
                                <rect x="125" y="141" width="4" height="4" transform="rotate(0,127,143)"></rect>
                                <rect x="125" y="145" width="4" height="4" transform="rotate(0,127,147)"></rect>
                                <circle cx="131" cy="39" r="2" transform="rotate(0,131,39)"></circle>
                                <path d="M 129 49v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,131,51)"></path>
                                <path d="M 129 53v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,131,55)"></path>
                                <path d="M 129 65v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,131,67)"></path>
                                <path d="M 129 69v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,131,71)"></path>
                                <circle cx="131" cy="83" r="2" transform="rotate(0,131,83)"></circle>
                                <path d="M 129 93v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,131,95)"></path>
                                <rect x="129" y="97" width="4" height="4" transform="rotate(0,131,99)"></rect>
                                <rect x="129" y="101" width="4" height="4" transform="rotate(0,131,103)"></rect>
                                <rect x="129" y="105" width="4" height="4" transform="rotate(0,131,107)"></rect>
                                <rect x="129" y="113" width="4" height="4" transform="rotate(0,131,115)"></rect>
                                <rect x="129" y="117" width="4" height="4" transform="rotate(0,131,119)"></rect>
                                <rect x="129" y="121" width="4" height="4" transform="rotate(0,131,123)"></rect>
                                <rect x="129" y="125" width="4" height="4" transform="rotate(0,131,127)"></rect>
                                <rect x="129" y="129" width="4" height="4" transform="rotate(0,131,131)"></rect>
                                <path d="M 129 133v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,131,135)"></path>
                                <path d="M 129 141v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,131,143)"></path>
                                <rect x="129" y="145" width="4" height="4" transform="rotate(0,131,147)"></rect>
                                <circle cx="135" cy="35" r="2" transform="rotate(0,135,35)"></circle>
                                <circle cx="135" cy="43" r="2" transform="rotate(0,135,43)"></circle>
                                <rect x="133" y="49" width="4" height="4" transform="rotate(0,135,51)"></rect>
                                <path d="M 133 57v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,135,59)"></path>
                                <rect x="133" y="61" width="4" height="4" transform="rotate(0,135,63)"></rect>
                                <path d="M 133 65v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,135,67)"></path>
                                <path d="M 133 77v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,135,79)"></path>
                                <path d="M 133 85v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,135,87)"></path>
                                <rect x="133" y="93" width="4" height="4" transform="rotate(0,135,95)"></rect>
                                <rect x="133" y="97" width="4" height="4" transform="rotate(0,135,99)"></rect>
                                <rect x="133" y="101" width="4" height="4" transform="rotate(0,135,103)"></rect>
                                <rect x="133" y="105" width="4" height="4" transform="rotate(0,135,107)"></rect>
                                <path d="M 133 113v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,135,115)"></path>
                                <rect x="133" y="117" width="4" height="4" transform="rotate(0,135,119)"></rect>
                                <rect x="133" y="129" width="4" height="4" transform="rotate(0,135,131)"></rect>
                                <path d="M 133 137v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,135,139)"></path>
                                <rect x="133" y="145" width="4" height="4" transform="rotate(0,135,147)"></rect>
                                <path d="M 137 45v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,139,47)"></path>
                                <rect x="137" y="49" width="4" height="4" transform="rotate(0,139,51)"></rect>
                                <path d="M 137 53v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,139,55)"></path>
                                <path d="M 137 69v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,139,71)"></path>
                                <rect x="137" y="73" width="4" height="4" transform="rotate(0,139,75)"></rect>
                                <rect x="137" y="77" width="4" height="4" transform="rotate(0,139,79)"></rect>
                                <rect x="137" y="85" width="4" height="4" transform="rotate(0,139,87)"></rect>
                                <rect x="137" y="89" width="4" height="4" transform="rotate(0,139,91)"></rect>
                                <rect x="137" y="93" width="4" height="4" transform="rotate(0,139,95)"></rect>
                                <rect x="137" y="97" width="4" height="4" transform="rotate(0,139,99)"></rect>
                                <rect x="137" y="105" width="4" height="4" transform="rotate(0,139,107)"></rect>
                                <path d="M 137 109v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,139,111)"></path>
                                <rect x="137" y="117" width="4" height="4" transform="rotate(0,139,119)"></rect>
                                <path d="M 137 125v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,139,127)"></path>
                                <rect x="137" y="129" width="4" height="4" transform="rotate(0,139,131)"></rect>
                                <rect x="137" y="133" width="4" height="4" transform="rotate(0,139,135)"></rect>
                                <path d="M 137 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,139,139)"></path>
                                <path d="M 137 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(0,139,147)"></path>
                                <circle cx="143" cy="35" r="2" transform="rotate(0,143,35)"></circle>
                                <path d="M 141 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,143,43)"></path>
                                <path d="M 141 45v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,143,47)"></path>
                                <path d="M 141 61v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(180,143,63)"></path>
                                <path d="M 141 69v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,143,71)"></path>
                                <rect x="141" y="73" width="4" height="4" transform="rotate(0,143,75)"></rect>
                                <rect x="141" y="77" width="4" height="4" transform="rotate(0,143,79)"></rect>
                                <rect x="141" y="81" width="4" height="4" transform="rotate(0,143,83)"></rect>
                                <rect x="141" y="85" width="4" height="4" transform="rotate(0,143,87)"></rect>
                                <rect x="141" y="89" width="4" height="4" transform="rotate(0,143,91)"></rect>
                                <rect x="141" y="93" width="4" height="4" transform="rotate(0,143,95)"></rect>
                                <rect x="141" y="97" width="4" height="4" transform="rotate(0,143,99)"></rect>
                                <rect x="141" y="101" width="4" height="4" transform="rotate(0,143,103)"></rect>
                                <rect x="141" y="105" width="4" height="4" transform="rotate(0,143,107)"></rect>
                                <rect x="141" y="109" width="4" height="4" transform="rotate(0,143,111)"></rect>
                                <rect x="141" y="113" width="4" height="4" transform="rotate(0,143,115)"></rect>
                                <rect x="141" y="117" width="4" height="4" transform="rotate(0,143,119)"></rect>
                                <path d="M 141 125v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,143,127)"></path>
                                <path d="M 141 129v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,143,131)"></path>
                                <path d="M 145 37v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,147,39)"></path>
                                <path d="M 145 41v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,147,43)"></path>
                                <path d="M 145 49v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,147,51)"></path>
                                <path d="M 145 53v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,147,55)"></path>
                                <path d="M 145 61v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,147,63)"></path>
                                <path d="M 145 65v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,147,67)"></path>
                                <path d="M 145 93v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,147,95)"></path>
                                <rect x="145" y="97" width="4" height="4" transform="rotate(0,147,99)"></rect>
                                <path d="M 145 101v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,147,103)"></path>
                                <path d="M 145 109v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,147,111)"></path>
                                <rect x="145" y="113" width="4" height="4" transform="rotate(0,147,115)"></rect>
                                <path d="M 145 117v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,147,119)"></path>
                                <circle cx="147" cy="135" r="2" transform="rotate(0,147,135)"></circle>
                                <path d="M 145 141v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(-90,147,143)"></path>
                                <path d="M 145 145v 4h 2a 2 2, 0, 0, 0, 0 -4" transform="rotate(90,147,147)"></path>
                            </clipPath>
                            <linearGradient id="dot-color" gradientUnits="userSpaceOnUse" x1="12" y1="0" x2="138" y2="150">
                                <stop offset="0%" stop-color="#fff0b8"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-square-color-0-0">
                                <path clip-rule="evenodd" d="M 1 11v 8a 10 10, 0, 0, 0, 10 10h 8a 10 10, 0, 0, 0, 10 -10v -8a 10 10, 0, 0, 0, -10 -10h -8a 10 10, 0, 0, 0, -10 10M 11 5h 8a 6 6, 0, 0, 1, 6 6v 8a 6 6, 0, 0, 1, -6 6h -8a 6 6, 0, 0, 1, -6 -6v -8a 6 6, 0, 0, 1, 6 -6" transform="rotate(0,15,15)"></path>
                            </clipPath>
                            <linearGradient id="corners-square-color-0-0" gradientUnits="userSpaceOnUse" x1="15" y1="1" x2="15" y2="29">
                                <stop offset="0%" stop-color="#ffdf6b"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-dot-color-0-0">
                                <path d="M 9 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,11,11)"></path>
                                <rect x="9" y="13" width="4" height="4" transform="rotate(0,11,15)"></rect>
                                <path d="M 9 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,11,19)"></path>
                                <rect x="13" y="9" width="4" height="4" transform="rotate(0,15,11)"></rect>
                                <rect x="13" y="13" width="4" height="4" transform="rotate(0,15,15)"></rect>
                                <rect x="13" y="17" width="4" height="4" transform="rotate(0,15,19)"></rect>
                                <path d="M 17 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,19,11)"></path>
                                <rect x="17" y="13" width="4" height="4" transform="rotate(0,19,15)"></rect>
                                <path d="M 17 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,19,19)"></path>
                            </clipPath>
                            <linearGradient id="corners-dot-color-0-0" gradientUnits="userSpaceOnUse" x1="15" y1="9" x2="15" y2="21">
                                <stop offset="0%" stop-color="#ffdc5c"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-square-color-1-0">
                                <path clip-rule="evenodd" d="M 121 11v 8a 10 10, 0, 0, 0, 10 10h 8a 10 10, 0, 0, 0, 10 -10v -8a 10 10, 0, 0, 0, -10 -10h -8a 10 10, 0, 0, 0, -10 10M 131 5h 8a 6 6, 0, 0, 1, 6 6v 8a 6 6, 0, 0, 1, -6 6h -8a 6 6, 0, 0, 1, -6 -6v -8a 6 6, 0, 0, 1, 6 -6" transform="rotate(90,135,15)"></path>
                            </clipPath>
                            <linearGradient id="corners-square-color-1-0" gradientUnits="userSpaceOnUse" x1="149" y1="15" x2="121" y2="15">
                                <stop offset="0%" stop-color="#ffdf6b"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-dot-color-1-0">
                                <path d="M 129 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,131,11)"></path>
                                <rect x="129" y="13" width="4" height="4" transform="rotate(0,131,15)"></rect>
                                <path d="M 129 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,131,19)"></path>
                                <rect x="133" y="9" width="4" height="4" transform="rotate(0,135,11)"></rect>
                                <rect x="133" y="13" width="4" height="4" transform="rotate(0,135,15)"></rect>
                                <rect x="133" y="17" width="4" height="4" transform="rotate(0,135,19)"></rect>
                                <path d="M 137 9v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,139,11)"></path>
                                <rect x="137" y="13" width="4" height="4" transform="rotate(0,139,15)"></rect>
                                <path d="M 137 17v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,139,19)"></path>
                            </clipPath>
                            <linearGradient id="corners-dot-color-1-0" gradientUnits="userSpaceOnUse" x1="141" y1="15" x2="129" y2="15">
                                <stop offset="0%" stop-color="#ffdc5c"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-square-color-0-1">
                                <path clip-rule="evenodd" d="M 1 131v 8a 10 10, 0, 0, 0, 10 10h 8a 10 10, 0, 0, 0, 10 -10v -8a 10 10, 0, 0, 0, -10 -10h -8a 10 10, 0, 0, 0, -10 10M 11 125h 8a 6 6, 0, 0, 1, 6 6v 8a 6 6, 0, 0, 1, -6 6h -8a 6 6, 0, 0, 1, -6 -6v -8a 6 6, 0, 0, 1, 6 -6" transform="rotate(-90,15,135)"></path>
                            </clipPath>
                            <linearGradient id="corners-square-color-0-1" gradientUnits="userSpaceOnUse" x1="1" y1="135" x2="29" y2="135">
                                <stop offset="0%" stop-color="#ffdf6b"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                            <clipPath id="clip-path-corners-dot-color-0-1">
                                <path d="M 9 129v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(-90,11,131)"></path>
                                <rect x="9" y="133" width="4" height="4" transform="rotate(0,11,135)"></rect>
                                <path d="M 9 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(180,11,139)"></path>
                                <rect x="13" y="129" width="4" height="4" transform="rotate(0,15,131)"></rect>
                                <rect x="13" y="133" width="4" height="4" transform="rotate(0,15,135)"></rect>
                                <rect x="13" y="137" width="4" height="4" transform="rotate(0,15,139)"></rect>
                                <path d="M 17 129v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(0,19,131)"></path>
                                <rect x="17" y="133" width="4" height="4" transform="rotate(0,19,135)"></rect>
                                <path d="M 17 137v 4h 4v -2a 2 2, 0, 0, 0, -2 -2" transform="rotate(90,19,139)"></path>
                            </clipPath>
                            <linearGradient id="corners-dot-color-0-1" gradientUnits="userSpaceOnUse" x1="9" y1="135" x2="21" y2="135">
                                <stop offset="0%" stop-color="#ffdc5c"></stop>
                                <stop offset="100%" stop-color="#ffc600"></stop>
                            </linearGradient>
                        </defs>
                        <rect x="0" y="0" height="150" width="150" clip-path="url('#clip-path-background-color')" fill="#000000"></rect>
                        <rect x="0" y="0" height="150" width="150" clip-path="url('#clip-path-dot-color')" fill="url('#dot-color')"></rect>
                        <rect x="1" y="1" height="28" width="28" clip-path="url('#clip-path-corners-square-color-0-0')" fill="url('#corners-square-color-0-0')"></rect>
                        <rect x="9" y="9" height="12" width="12" clip-path="url('#clip-path-corners-dot-color-0-0')" fill="url('#corners-dot-color-0-0')"></rect>
                        <rect x="121" y="1" height="28" width="28" clip-path="url('#clip-path-corners-square-color-1-0')" fill="url('#corners-square-color-1-0')"></rect>
                        <rect x="129" y="9" height="12" width="12" clip-path="url('#clip-path-corners-dot-color-1-0')" fill="url('#corners-dot-color-1-0')"></rect>
                        <rect x="1" y="121" height="28" width="28" clip-path="url('#clip-path-corners-square-color-0-1')" fill="url('#corners-square-color-0-1')"></rect>
                        <rect x="9" y="129" height="12" width="12" clip-path="url('#clip-path-corners-dot-color-0-1')" fill="url('#corners-dot-color-0-1')"></rect>
                        <image x="29" y="67" width="92px" height="16px" href="data:image/png;base64,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mT+E/8ZTM/ikOAFQiczfkcg8HoLo3Yg2QRbVC4AwZEV6AdjeXrH+EVmyvd1ULFIDMpqUjI+/ReZHnDkAX7rGx8caxse/VCHFPgSgeXRqrp8Q5aMAePU7u9iGdIae//f/DJia+b/p8d8aTFTgAP6t/waeXRoZIpQsFwAAAAlwSFlzAAALEwAACxMBAJqcGAAACl5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDQ4OCwgMjAyMC8wNy8xMC0yMjowNjo1MyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHhtcDpDcmVhdGVEYXRlPSIyMDIwLTA3LTA2VDIwOjA0OjUwKzA3OjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIxLTEwLTA4VDE1OjE3OjE0KzA3OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMS0xMC0wOFQxNToxNzoxNCswNzowMCIgcGhvdG9zaG9wOkNvbG9yTW9kZT0iMyIgcGhvdG9zaG9wOklDQ1Byb2ZpbGU9IkRpc3BsYXkiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOmVlNWVkZDI0LTAzNTAtNGJkYi1hNzk2LWY5NWFmZGQ4YzY3MCIgeG1wTU06RG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOmUzN2I2ZTY5LThlMGMtNmE0Mi1hMGI3LTIwN2M4NGY2ZGRkMyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjdjYTVjMjQ5LWUyYWItNGI0Mi04ZmNmLWZiZTFmMjdmMjk5OCIgdGlmZjpPcmllbnRhdGlvbj0iMSIgdGlmZjpYUmVzb2x1dGlvbj0iNzIwMDAwLzEwMDAwIiB0aWZmOllSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiIGV4aWY6Q29sb3JTcGFjZT0iNjU1MzUiIGV4aWY6UGl4ZWxYRGltZW5zaW9uPSIxMDAwIiBleGlmOlBpeGVsWURpbWVuc2lvbj0iNTAwIj4gPHBob3Rvc2hvcDpEb2N1bWVudEFuY2VzdG9ycz4gPHJkZjpCYWc+IDxyZGY6bGk+YWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOmExY2NhMWM4LTFmZDUtY2E0Yy05NWIxLWFkNmNiNmZjOTU0MjwvcmRmOmxpPiA8L3JkZjpCYWc+IDwvcGhvdG9zaG9wOkRvY3VtZW50QW5jZXN0b3JzPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjdjYTVjMjQ5LWUyYWItNGI0Mi04ZmNmLWZiZTFmMjdmMjk5OCIgc3RFdnQ6d2hlbj0iMjAyMC0wNy0wNlQyMDowNDo1MCswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjcwNzJjZDI0LTBkMDgtNGIyMy1hMmExLTI5YjE5ZDZhMDc2NiIgc3RFdnQ6d2hlbj0iMjAyMS0xMC0wOFQxNToxNzoxNCswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iZGVyaXZlZCIgc3RFdnQ6cGFyYW1ldGVycz0iY29udmVydGVkIGZyb20gYXBwbGljYXRpb24vdm5kLmFkb2JlLnBob3Rvc2hvcCB0byBpbWFnZS9wbmciLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmVlNWVkZDI0LTAzNTAtNGJkYi1hNzk2LWY5NWFmZGQ4YzY3MCIgc3RFdnQ6d2hlbj0iMjAyMS0xMC0wOFQxNToxNzoxNCswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjAgKE1hY2ludG9zaCkiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjcwNzJjZDI0LTBkMDgtNGIyMy1hMmExLTI5YjE5ZDZhMDc2NiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3Y2E1YzI0OS1lMmFiLTRiNDItOGZjZi1mYmUxZjI3ZjI5OTgiIHN0UmVmOm9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRp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"></image>
                    </svg> -->
                </div>
            </div>
            <button type="button" class="ant-btn ant-btn-round ant-btn-default" style="margin: 0px auto 32px; display: block;">
                <span>ดาวน์โหลด QR Code ชวนเพื่อน</span>
            </button>
            <div class="form-card">
                <div class="ant-row form-card-body" style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
                    <div class="ant-col ant-col-24" style="padding-left: 8px; padding-right: 8px;">
                        <label style="display: block; margin-bottom: 8px;">ลิงก์ชวนเพื่อน</label>
                        <span class="ant-input-group ant-input-group-compact" style="display: flex;">
                            <input disabled="" class="ant-input ant-input-disabled" type="text" value="{{ Request::root() }}/register?prefix={{ Session::get('Prefix') }}&amp;ref=<?php echo str_replace(strtolower(Session::get('Agent')),"",strtolower(Session::get('Username'))); ?>" style="background: rgb(13, 15, 16); color: rgb(255, 255, 255);">
                            <button type="button" class="ant-btn ant-btn-primary ant-btn-icon-only" style="width: 64px; height: auto;" onclick="copyAffiliate('{{ Request::root() }}/register?prefix={{ Session::get('Prefix') }}&amp;ref=<?php echo str_replace(strtolower(Session::get('Agent')),"",strtolower(Session::get('Username'))); ?>')">
                                <span role="img" aria-label="copy" class="anticon anticon-copy" style="font-size: 20px;">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path>
                                    </svg>
                                </span>
                            </button>
                        </span>
                        <div class="ant-divider ant-divider-horizontal" role="separator" style="margin-bottom: 8px;"></div>
                    </div>
                    <div class="ant-col ant-col-xs-24 ant-col-sm-12" style="padding-left: 8px; padding-right: 8px;">
                        <div class="ant-statistic">
                            <div class="ant-statistic-title">ยอดที่ใช้ได้จากการชวนเพื่อน</div>
                            <div class="ant-statistic-content">
                                <span class="ant-statistic-content-prefix">฿</span>
                                <span class="ant-statistic-content-value">
                                    {{ number_format($summary["total"],2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ant-col ant-col-xs-24 ant-col-sm-12" style="padding-left: 8px; padding-right: 8px;">
                        <div class="ant-statistic">
                            <div class="ant-statistic-title">รหัสชวนเพื่อน</div>
                            <div class="ant-statistic-content">
                                <span class="ant-statistic-content-value"><?php echo str_replace(strtolower(Session::get('Agent')),"",strtolower(Session::get('Username'))); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="ant-col ant-col-24" style="padding-left: 8px; padding-right: 8px;">
                        <form id="affiliatewithdrawForm" class="ant-form ant-form-vertical ant-form-hide-required-mark" style="margin-top: 8px;">
                            <div class="ant-row ant-form-item ant-form-item-has-success ant-form-item-hidden" style="display: none;">
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <input type="hidden" placeholder="จำนวนเงินที่ต้องการโยก" id="affiliatewithdrawForm_amount" class="ant-input ant-input-status-success" value="{{ number_format(floor($summary['total'] * 100) / 100,2) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-submit">
                                <button type="submit" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block">
                                    <span>โยกเงินเข้ากระเป๋า</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let finalURL = 'https://chart.googleapis.com/chart?cht=qr&chl=' + htmlEncode("{{ Request::root() }}/register%3Fprefix={{ Session::get('Prefix') }}%26ref=<?php echo str_replace(strtolower(Session::get('Agent')),"",strtolower(Session::get('Username'))); ?>%26openExternalBrowser=1") + '&chs=160x160&chld=L|0'
        $('.qr-code').attr('src', finalURL);
    </script>
@endsection