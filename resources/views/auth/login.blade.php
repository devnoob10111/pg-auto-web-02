<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: black;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.owner') }}</title>
    <link rel="icon" href="{{ config('app.logo-base64') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
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
    </style>
    <link href="{{ asset('css/2.83342f34.chunk.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.dc093bf6.chunk.css') }}" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="{{ asset('js/sweetalert-dev.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <style>
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
    </style>
</head>
<?php
    if(config('app.background') != "bg-ufa2.jpeg"){
        $imageBackground = config('app.background');
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
    }
?>
<body style="background:url({{ $backgroundBase64 }});background-size: cover;">
    <div id="root">
        <div class="ant-row ant-row-center ant-row-middle" style="height: 100%;">
            <div class="auth-container">
                <span class="ant-avatar ant-avatar-square ant-avatar-image avatar-logo" style="width: 125px; height: 125px; line-height: 125px; font-size: 18px;">
                       <img src="{{ config('app.logo-base64') }}" style="width:100%">
                </span>
                <form id="form-login" class="ant-form ant-form-vertical ant-form-hide-required-mark" method="POST" action="{{ route('auth-login') }}?prefix={{ config('app.prefix') }}">
                    @csrf
                    <div class="ant-row ant-form-item ant-form-item-has-success">
                        <div class="ant-col ant-form-item-label">
                            <label for="telephone" class="ant-form-item-required" title="เบอร์โทรศัพท์">เบอร์โทรศัพท์</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <input class="ant-input" placeholder="เบอร์โทรศัพท์" name="telephone" id="telephone" minLength="10" maxLength="10" type="tel" value="<?php echo Session::get('telephone'); ?>" OnKeyPress="return chkNumber(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item ant-form-item-has-success">
                        <div class="ant-col ant-form-item-label">
                            <label for="password" class="ant-form-item-required" title="รหัสผ่าน">รหัสผ่าน</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-password ant-input-affix-wrapper-status-success">
                                        <input placeholder="รหัสผ่าน" name="password" id="password" type="password" class="ant-input" value="<?php echo Session::get('password'); ?>">
                                        <span class="ant-input-suffix">
                                            <span role="img" aria-label="eye-invisible" tabindex="-1" class="anticon anticon-eye-invisible ant-input-password-icon" id="svg-eyes" onclick="showPassword('password')">
                                                <svg viewBox="64 64 896 896" focusable="false" data-icon="eye-invisible" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M942.2 486.2Q889.47 375.11 816.7 305l-50.88 50.88C807.31 395.53 843.45 447.4 874.7 512 791.5 684.2 673.4 766 512 766q-72.67 0-133.87-22.38L323 798.75Q408 838 512 838q288.3 0 430.2-300.3a60.29 60.29 0 000-51.5zm-63.57-320.64L836 122.88a8 8 0 00-11.32 0L715.31 232.2Q624.86 186 512 186q-288.3 0-430.2 300.3a60.3 60.3 0 000 51.5q56.69 119.4 136.5 191.41L112.48 835a8 8 0 000 11.31L155.17 889a8 8 0 0011.31 0l712.15-712.12a8 8 0 000-11.32zM149.3 512C232.6 339.8 350.7 258 512 258c54.54 0 104.13 9.36 149.12 28.39l-70.3 70.3a176 176 0 00-238.13 238.13l-83.42 83.42C223.1 637.49 183.3 582.28 149.3 512zm246.7 0a112.11 112.11 0 01146.2-106.69L401.31 546.2A112 112 0 01396 512z"></path>
                                                    <path d="M508 624c-3.46 0-6.87-.16-10.25-.47l-52.82 52.82a176.09 176.09 0 00227.42-227.42l-52.82 52.82c.31 3.38.47 6.79.47 10.25a111.94 111.94 0 01-112 112z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item" style="padding-top: 12px;">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="submit" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block">
                                        <span>เข้าสู่ระบบ</span>
                                    </button>
                                    <div class="ant-divider ant-divider-horizontal ant-divider-with-text ant-divider-with-text-center ant-divider-plain" role="separator">
                                        <span class="ant-divider-inner-text">หรือ</span>
                                    </div>
                                    <a href="/register?prefix={{ config('app.prefix') }}">
                                        <button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-block" style="background: black;">
                                            <span>สมัครสมาชิก</span>
                                        </button>
                                    </a>
                                    <a target="_blank" href="{{ config('app.line') }}">
                                        <button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-block ant-btn-line" style="margin-top: 18px;background: black;">
                                            <i class="fa-brands fa-line" style="padding-right: 10px; color: rgb(6, 199, 85);"></i>
                                            <span style="margin-top: 2px;">ติดต่อแอดมิน</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // $("#telephone").inputmask({"mask": "999-999-9999"});

        function chkNumber(ele) {
            var vchar = String.fromCharCode(event.keyCode);
            if (event.keyCode != '13') {
                if ((vchar < '0' || vchar > '9')) {
                    // alert("กรุณาป้อนเฉพาะตัวเลขเท่านั้น!");
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

        function swalError(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-error');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-error');
            }, 5000);
            // swal({
            //     title: "",
            //     text: message,
            //     type: "error",
            //     showCancelButton: false,
            //     confirmButtonColor: "#DD6B55",
            //     confirmButtonText: "รับทราบ",
            //     closeOnConfirm: false
            // });
        }

        function swalSuccess(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-success');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-success');
            }, 5000);
            // swal({
            //     title: "",
            //     text: message,
            //     type: "success",
            //     showCancelButton: false,
            //     confirmButtonColor: "#228B22",
            //     confirmButtonText: "รับทราบ",
            //     closeOnConfirm: false
            // });
        }

        function swalWarning(message){
            $('#textAlert').text(message).html();
            $('#divAlert').addClass('alert-warning');
            $('#divAlert').removeClass('hidden');
            setTimeout(() => {
                $('#divAlert').addClass('hidden');
                $('#divAlert').removeClass('alert-warning');
            }, 5000);
            // swal({
            //     title: "",
            //     text: message,
            //     type: "success",
            //     showCancelButton: false,
            //     confirmButtonColor: "#FF9900",
            //     confirmButtonText: "รับทราบ",
            //     closeOnConfirm: false
            // });
        }

        function showPassword(element) {
            var x = document.getElementById(element);
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("svg-eyes").innerHTML = `<svg viewBox="64 64 896 896" focusable="false" data-icon="eye" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 000 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path></svg>`
            } else {
                x.type = "password";
                document.getElementById("svg-eyes").innerHTML = `<svg viewBox="64 64 896 896" focusable="false" data-icon="eye-invisible" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M942.2 486.2Q889.47 375.11 816.7 305l-50.88 50.88C807.31 395.53 843.45 447.4 874.7 512 791.5 684.2 673.4 766 512 766q-72.67 0-133.87-22.38L323 798.75Q408 838 512 838q288.3 0 430.2-300.3a60.29 60.29 0 000-51.5zm-63.57-320.64L836 122.88a8 8 0 00-11.32 0L715.31 232.2Q624.86 186 512 186q-288.3 0-430.2 300.3a60.3 60.3 0 000 51.5q56.69 119.4 136.5 191.41L112.48 835a8 8 0 000 11.31L155.17 889a8 8 0 0011.31 0l712.15-712.12a8 8 0 000-11.32zM149.3 512C232.6 339.8 350.7 258 512 258c54.54 0 104.13 9.36 149.12 28.39l-70.3 70.3a176 176 0 00-238.13 238.13l-83.42 83.42C223.1 637.49 183.3 582.28 149.3 512zm246.7 0a112.11 112.11 0 01146.2-106.69L401.31 546.2A112 112 0 01396 512z"></path>
                                                    <path d="M508 624c-3.46 0-6.87-.16-10.25-.47l-52.82 52.82a176.09 176.09 0 00227.42-227.42l-52.82 52.82c.31 3.38.47 6.79.47 10.25a111.94 111.94 0 01-112 112z"></path>
                                                </svg>`
            }
        }
    </script>
    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script>!function(e){function r(r){for(var n,l,a=r[0],f=r[1],i=r[2],p=0,s=[];p<a.length;p++)l=a[p],Object.prototype.hasOwnProperty.call(o,l)&&o[l]&&s.push(o[l][0]),o[l]=0;for(n in f)Object.prototype.hasOwnProperty.call(f,n)&&(e[n]=f[n]);for(c&&c(r);s.length;)s.shift()();return u.push.apply(u,i||[]),t()}function t(){for(var e,r=0;r<u.length;r++){for(var t=u[r],n=!0,a=1;a<t.length;a++){var f=t[a];0!==o[f]&&(n=!1)}n&&(u.splice(r--,1),e=l(l.s=t[0]))}return e}var n={},o={1:0},u=[];function l(r){if(n[r])return n[r].exports;var t=n[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,l),t.l=!0,t.exports}l.m=e,l.c=n,l.d=function(e,r,t){l.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,r){if(1&r&&(e=l(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(l.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)l.d(t,n,function(r){return e[r]}.bind(null,n));return t},l.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(r,"a",r),r},l.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},l.p="/";var a=this["webpackJsonpmsn-react"]=this["webpackJsonpmsn-react"]||[],f=a.push.bind(a);a.push=r,a=a.slice();for(var i=0;i<a.length;i++)r(a[i]);var c=f;t()}([])</script>
    <script src="{{ asset('js/2.47b85de6.chunk.js') }}"></script>

    @if(\Session::get('message') == '809')
        <script>
            swalError("รหัสผ่านผิด กรุณาตรวจสอบ.");
        </script>
        <!-- <?php
            echo '
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "เข้าสู่ระบบไม่สำเร็จ!",
                            text: "รหัสผ่านผิด กรุณาตรวจสอบ.",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false
                        });
                    }, 1000);
                </script>
            ';
        ?> -->
    @elseif(\Session::get('message') == '806')
        <script>
            swalError("ไม่พบบัญชีนี้ในระบบ.");
        </script>
        <!-- <?php
            echo '
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "เข้าสู่ระบบไม่สำเร็จ!",
                            text: "ไม่พบบัญชีนี้ในระบบ",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false
                        });
                    }, 1000);
                </script>
            ';
        ?> -->
    @elseif(\Session::get('message') == '888')
        <script>
            swalError("บัญชีผู้ใช้นี้ถูกล็อค กรุณาติดต่อแอดมิน.");
        </script>
        <!-- <?php
            echo '
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "เข้าสู่ระบบไม่สำเร็จ!",
                            text: "บัญชีผู้ใช้นี้ถูกล็อค กรุณาติดต่อแอดมิน.",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false
                        });
                    }, 1000);
                </script>
            ';
        ?> -->
    @endif
</body>
</html>
