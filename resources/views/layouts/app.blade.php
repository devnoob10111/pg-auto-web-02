<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: black;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AUGAPLAY</title>
    <link rel="icon" href="{{ Session::get('LogoBase64') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">

    <!-- Datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    
    <style rc-util-key="@ant-design-icons">
        .anticon {
            display: inline-block;
            color: inherit;
            font-style: normal;
            line-height: 0;
            text-align: center;
            text-transform: none;
            vertical-align: -0.125em;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .anticon > * {
            line-height: 1;
        }

        .anticon svg {
            display: inline-block;
        }

        .anticon::before {
            display: none;
        }

        .anticon .anticon-icon {
            display: block;
        }

        .anticon[tabindex] {
            cursor: pointer;
        }

        .anticon-spin::before,
        .anticon-spin {
            display: inline-block;
            -webkit-animation: loadingCircle 1s infinite linear;
            animation: loadingCircle 1s infinite linear;
        }

        @-webkit-keyframes loadingCircle {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loadingCircle {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        .sweet-alert {
            background: linear-gradient(325deg,#222020 30%,#454444) !important;
        }
        .sweet-alert p {
            color: #dddcdc;
        }
        .sweet-alert button.cancel {
            background-color: #ac0000 !important;
        }
        .sweet-alert button.confirm {
            background-color: rgb(89 151 2) !important;
            box-shadow: rgb(165 245 140 / 80%) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset !important;
        }
        .sweet-alert .sa-icon.sa-success::before, .sweet-alert .sa-icon.sa-success::after {
            background: none !important;
        }
        .ant-layout-header {
            background: linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
            /* background-color:{{ Session::get('ColorTheme') }} !important; */
        }
        .ant-layout-sider {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        }
        /* .wallet-cashback {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        } */
        .menu-mobile-icon {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        }
        /* .form-card {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        }
        .ant-card {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        }
        .account-menu {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        } */
        .bottombar-mobile {
            background:linear-gradient(325deg,#1b1b1b 10%,{{ Session::get('ColorTheme') }}) !important;
        }
        .bank-card-logo {
            padding:0px !important;
        }
    </style>
    <link href="{{ asset('css/2.83342f34.chunk.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.dc093bf6.chunk.css') }}" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="{{ asset('js/sweetalert-dev.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script>
        function htmlEncode(value) {
            return $('<div/>').text(value).html();
        }
    </script>
    <style>
        .alert {
            position: absolute;
            width: 100%;
            z-index: 9999;
        }
        .alert-success {
            padding: 20px;
            background-color: #228B22;
            color: white;
            border-color: transparent;
        }

        .alert-error {
            padding: 20px;
            background-color: #f44336;
            color: white;
            border-color: transparent;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 36px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<?php
    if(Session::has('Background') && Session::get('Background') != "bg-ufa2.jpeg"){
        $imageBackground = Session::get('Background');
        $typeBackground = explode(".",$imageBackground);
        $typeBackground = $typeBackground[1];
        if($typeBackground == "jpg" || $typeBackground == "jpeg"){
            $imageTypeBackground = "image/jpeg";
        }else if($typeBackground == "png"){
            $imageTypeBackground = "image/png";
        }
        $fileBackground = config('app.host').'/images/background/'.$imageBackground;
        $imageDataBackground = base64_encode(file_get_contents($fileBackground));
        $backgroundBase64 = 'data:'.$imageTypeBackground.';base64,'.$imageDataBackground;
    }else{
        $backgroundBase64 = "";
    }
?>
<body style="background:url({{ $backgroundBase64 }});background-size: cover;position: relative;--webkit-overflow-scrolling: hidden;">
    <div class="alert hidden" role="alert" id="divAlert">
        <span class="closebtn" onclick="this.parentElement.classList.add('hidden');">&times;</span>
        <strong id="textAlert"></strong>
    </div>
    
    <div id="root">
        <section class="ant-layout ant-layout-has-sider">
            <aside class="ant-layout-sider ant-layout-sider-dark">
                <div class="ant-layout-sider-children">
                    <a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}">
                        <span class="ant-avatar ant-avatar-square ant-avatar-image avatar-logo" style="width: 125px; height: 125px; line-height: 125px; font-size: 18px; margin: 0px auto; display: block;">
                            <img src="{{ Session::get('LogoBase64') }}">
                        </span>
                    </a>
                    <ul class="menu-sidebar">
                        <li>
                            <a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'wallet' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/wallet.svg') }}" alt="wallet icon"> 
                                กระเป๋า
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'deposit' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/deposit.svg') }}" alt="deposit icon">
                                 เติมเงิน
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('withdraw') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'withdraw' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/withdraw.svg') }}" alt="withdraw icon">
                                 ถอนเงิน
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transactions-deposit') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'transactions' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/history.svg') }}" alt="history icon">
                                 ประวัติธุรกรรม
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('promotion') }}?prefix={{ Session::get('Prefix') }}" aria-current="page" class="{{ Request::segment(1) === 'promotion' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/promo.svg') }}" alt="promo icon">
                                 โปรโมชั่น
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lucky-wheel') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'lucky-wheel' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/wheel.svg') }}" alt="wheel icon">
                                 กงล้อเสี่ยงโชค
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('affiliate') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'affiliate' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/afflilate.svg') }}" alt="afflilate icon">
                                 ชวนเพื่อนเล่น
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account') }}?prefix={{ Session::get('Prefix') }}" class="{{ Request::segment(1) === 'profile' ? 'active-menu' : null }}">
                                <img src="{{ asset('images/icons/outline/profile.svg') }}" alt="profile icon">
                                 บัญชีของฉัน
                            </a>
                        </li>
                        <li>
                            <a href="{{ Session::get('Line') }}" target="_blank" rel="noreferrer">
                                <img src="{{ asset('images/icons/outline/chat.svg') }}" alt="chat icon">
                                 แจ้งปัญหา
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration:none;">
                                <img src="{{ asset('images/icons/outline/logout.svg') }}" alt="logout icon">
                                 ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ route('auth-logout') }}?prefix={{ Session::get('Prefix') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </aside>
            <section class="ant-layout">
                <header class="ant-layout-header">
                </header>
                <main class="ant-layout-content msn-container">
                    @yield('content')
                </main>
                @include('layouts.footer')
            </section>
        </section>
    </div>
    <script>
        function copyDepositBank(bank_account){
            navigator.clipboard.writeText(bank_account).then(function() {
                swalSuccess("คัดลอกเลขบัญชีสำเร็จ")
            }, function(err) {
                console.error('ไม่สามารถคัดลอกได้!');
            });
        }

        function copyDepositWallet(telephone){
            navigator.clipboard.writeText(telephone).then(function() {
                swalSuccess("คัดลอกเบอร์วอลเล็ทสำเร็จ")
            }, function(err) {
                console.error('ไม่สามารถคัดลอกได้!');
            });
        }

        function copyAffiliate(url){
            navigator.clipboard.writeText(url).then(function() {
                swalSuccess("คัดลอกลิงก์สำเร็จ")
            }, function(err) {
                console.error('ไม่สามารถคัดลอกได้!');
            });
        }

        function copyUsername(username){
            navigator.clipboard.writeText(username).then(function() {
                swalSuccess("คัดลอกยูสสำเร็จ")
            }, function(err) {
                console.error('ไม่สามารถคัดลอกได้!');
            });
        }

        function copyPassword(password){
            navigator.clipboard.writeText(password).then(function() {
                swalSuccess("คัดลอกรหัสผ่านสำเร็จ")
            }, function(err) {
                console.error('ไม่สามารถคัดลอกได้!');
            });
        }

        function swalError(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-error');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-error');
            }, 5000);
        }

        function swalSuccess(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-success');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-success');
            }, 5000);
        }

        function swalWarning(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-warning');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-warning');
            }, 5000);
        }
        
        function chkNumber(ele) {
            var vchar = String.fromCharCode(event.keyCode);
            if (event.keyCode != '13') {
                if ((vchar < '0' || vchar > '9')) {
                    swal({
                        title: "",
                        text: "กรุณาป้อนเฉพาะตัวเลขเท่านั้น!",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "รับทราบ",
                        closeOnConfirm: false
                    });
                    return false;
                } else {
                    ele.onKeyPress = vchar;
                }
            }
        }
    </script>
    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
    <!-- <script src="{{ asset('wheel/TweenMax.min.js') }}"></script>
    <script src="{{ asset('wheel/Winwheel.js') }}"></script> -->
    <!-- <script defer="defer" src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon="{&quot;token&quot;: &quot;1eb256c790de485091f33b4a5d6cce03&quot;}"></script> -->
    <script>!function(e){function r(r){for(var n,l,a=r[0],f=r[1],i=r[2],p=0,s=[];p<a.length;p++)l=a[p],Object.prototype.hasOwnProperty.call(o,l)&&o[l]&&s.push(o[l][0]),o[l]=0;for(n in f)Object.prototype.hasOwnProperty.call(f,n)&&(e[n]=f[n]);for(c&&c(r);s.length;)s.shift()();return u.push.apply(u,i||[]),t()}function t(){for(var e,r=0;r<u.length;r++){for(var t=u[r],n=!0,a=1;a<t.length;a++){var f=t[a];0!==o[f]&&(n=!1)}n&&(u.splice(r--,1),e=l(l.s=t[0]))}return e}var n={},o={1:0},u=[];function l(r){if(n[r])return n[r].exports;var t=n[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,l),t.l=!0,t.exports}l.m=e,l.c=n,l.d=function(e,r,t){l.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,r){if(1&r&&(e=l(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(l.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)l.d(t,n,function(r){return e[r]}.bind(null,n));return t},l.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(r,"a",r),r},l.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},l.p="/";var a=this["webpackJsonpmsn-react"]=this["webpackJsonpmsn-react"]||[],f=a.push.bind(a);a.push=r,a=a.slice();for(var i=0;i<a.length;i++)r(a[i]);var c=f;t()}([])</script>
    <script src="{{ asset('js/2.47b85de6.chunk.js') }}"></script>
</body>
</html>
