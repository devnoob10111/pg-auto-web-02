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

        hr#hrAlert {
            background: #ff7a18;
            border: 0;
            display: block;
            width: 100%;
            height: 4px;
            /* position: absolute; */
            -webkit-animation: linear infinite;
            -webkit-animation-name: run;
            -webkit-animation-duration: 5s;
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
    <div class="alert hidden" role="alert" id="divAlert">
        <span class="closebtn" onclick="this.parentElement.classList.add('hidden');">&times;</span>
        <strong id="textAlert"></strong>
    </div>

    <div id="root">
        <div class="ant-row ant-row-center ant-row-middle" style="height: 100%;">
            <div class="auth-container">
                <span class="ant-avatar ant-avatar-square ant-avatar-image avatar-logo" style="width: 125px; height: 125px; line-height: 125px; font-size: 18px;">
                    <img src="{{ config('app.logo-base64') }}">
                </span>
                <form id="registerForm1" class="ant-form ant-form-vertical ant-form-hide-required-mark">
                    <div class="ant-row ant-form-item ant-form-item-with-help ant-form-item-has-feedback ant-form-item-has-error">
                        <div class="ant-col ant-form-item-label">
                            <label for="register-telephone" class="ant-form-item-required" title="เบอร์โทรศัพท์">เบอร์โทรศัพท์</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <input class="ant-input" placeholder="เบอร์โทรศัพท์" id="register-telephone" name="telephone" minLength="10" type="tel" value="" OnKeyPress="return chkNumber(this)">
                                </div>
                            </div>
                            <div class="ant-form-item-explain ant-form-item-explain-connected">
                                <div role="alert" class="ant-form-item-explain-error" style="">กรุณากรอกเบอร์โทรศัพท์</div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" ant-click-animating-without-extra-node="false" id="next1" onclick="nextOne()">
                                        <span>ถัดไป</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="registerForm2" class="ant-form ant-form-vertical ant-form-hide-required-mark" style="display:none;">
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="bank" class="ant-form-item-required" title="ธนาคาร">ธนาคาร</label>
                        </div>
                        <div class="ant-col ant-form-item-control" id="searchBank">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <div class="ant-select ant-select-in-form-item ant-select-has-feedback ant-select-single ant-select-show-arrow ant-select-show-search">
                                        <div class="ant-select-selector">
                                            <!-- <select type="text" class="form-control" name="bank" id="bank" required></select> -->
                                            <span class="ant-select-selection-search">
                                                <input type="hidden" id="bank" autocomplete="off" name="bank" value="">
                                                <input type="search" id="nameBank" autocomplete="off" class="ant-select-selection-search-input" value="">
                                            </span>
                                            <span class="ant-select-selection-placeholder" id="bankPlaceholder">เลือกธนาคารของท่าน ...</span>
                                        </div>
                                        <span class="ant-select-arrow" unselectable="on" aria-hidden="true" style="user-select: none;">
                                            <span role="img" aria-label="down" class="anticon anticon-down ant-select-suffix">
                                                <svg viewBox="64 64 896 896" focusable="false" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M884 256h-75c-5.1 0-9.9 2.5-12.9 6.6L512 654.2 227.9 262.6c-3-4.1-7.8-6.6-12.9-6.6h-75c-6.5 0-10.3 7.4-6.5 12.7l352.6 486.1c12.8 17.6 39 17.6 51.7 0l352.6-486.1c3.9-5.3.1-12.7-6.4-12.7z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <div class="ant-select-dropdown bank-list ant-select-dropdown-placement-bottomLeft ant-select-dropdown-hidden" style="min-width: 361px; width: 100%; left: 0px; top: 60px;">
                                            <div>
                                                <div class="rc-virtual-list" style="position: relative;">
                                                    <div class="rc-virtual-list-holder" style="max-height: 256px; overflow-y: scroll; overflow-anchor: none;">
                                                        <div style="height: 550px; position: relative; overflow: hidden;">
                                                            <div class="rc-virtual-list-holder-inner" id="bankList" style="display: flex; flex-direction: column; transform: translateY(0px); position: absolute; left: 0px; right: 0px; top: 0px;">
                                                                <!-- <div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารกสิกรไทย">
                                                                    <div class="ant-select-item-option-content">ธนาคารกสิกรไทย</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารกรุงเทพ">
                                                                    <div class="ant-select-item-option-content">ธนาคารกรุงเทพ</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารกรุงไทย"><div class="ant-select-item-option-content">ธนาคารกรุงไทย</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div><div aria-selected="false" class="ant-select-item ant-select-item-option ant-select-item-option-active" title="ธนาคารกรุงศรีอยุธยา"><div class="ant-select-item-option-content">ธนาคารกรุงศรีอยุธยา</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div><div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารไทยพาณิชย์"><div class="ant-select-item-option-content">ธนาคารไทยพาณิชย์</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div><div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารเกียรตินาคิน"><div class="ant-select-item-option-content">ธนาคารเกียรตินาคิน</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div><div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารซิตี้แบ้งค์"><div class="ant-select-item-option-content">ธนาคารซิตี้แบ้งค์</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div><div aria-selected="false" class="ant-select-item ant-select-item-option" title="ธนาคารซีไอเอ็มบี (ไทย)"><div class="ant-select-item-option-content">ธนาคารซีไอเอ็มบี (ไทย)</div><span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span></div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="rc-virtual-list-scrollbar rc-virtual-list-scrollbar-show" style="width: 8px; top: 0px; bottom: 0px; right: 0px; position: absolute; display: none;">
                                                        <div class="rc-virtual-list-scrollbar-thumb" style="width: 100%; height: 121px; top: 0px; left: 0px; position: absolute; background: rgba(0, 0, 0, 0.5); border-radius: 99px; cursor: pointer; user-select: none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="bank_number" class="ant-form-item-required" title="เลขที่บัญชี">เลขที่บัญชี</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="เลขที่บัญชี" inputmode="numeric" id="bank_number" name="bank_number" class="ant-input" type="text" value="">
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="first_name" class="ant-form-item-required" title="ชื่อจริง">ชื่อจริง</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="ชื่อจริง" inputmode="text" id="first_name" name="first_name" class="ant-input" type="text" value="">
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="last_name" class="ant-form-item-required" title="นามสกุล">นามสกุล</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="นามสกุล" inputmode="text" id="last_name" name="last_name" class="ant-input" type="text" value="">
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" id="next2" onclick="nextTwo()">
                                        <span class="ant-btn-loading-icon" style="width: 0px; opacity: 0; transform: scale(0);">
                                            <span role="img" aria-label="loading" class="anticon anticon-loading anticon-spin ant-btn-loading-icon-motion-leave ant-btn-loading-icon-motion-leave-active ant-btn-loading-icon-motion">
                                                <svg viewBox="0 0 1024 1024" focusable="false" data-icon="loading" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M988 548c-19.9 0-36-16.1-36-36 0-59.4-11.6-117-34.6-171.3a440.45 440.45 0 00-94.3-139.9 437.71 437.71 0 00-139.9-94.3C629 83.6 571.4 72 512 72c-19.9 0-36-16.1-36-36s16.1-36 36-36c69.1 0 136.2 13.5 199.3 40.3C772.3 66 827 103 874 150c47 47 83.9 101.8 109.7 162.7 26.7 63.1 40.2 130.2 40.2 199.3.1 19.9-16 36-35.9 36z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span>ถัดไป</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-danger ant-btn-block" id="previous1" onclick="previousOne()">
                                        <span class="ant-btn-loading-icon" style="width: 0px; opacity: 0; transform: scale(0);">
                                            <span role="img" aria-label="loading" class="anticon anticon-loading anticon-spin ant-btn-loading-icon-motion-leave ant-btn-loading-icon-motion-leave-active ant-btn-loading-icon-motion">
                                                <svg viewBox="0 0 1024 1024" focusable="false" data-icon="loading" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M988 548c-19.9 0-36-16.1-36-36 0-59.4-11.6-117-34.6-171.3a440.45 440.45 0 00-94.3-139.9 437.71 437.71 0 00-139.9-94.3C629 83.6 571.4 72 512 72c-19.9 0-36-16.1-36-36s16.1-36 36-36c69.1 0 136.2 13.5 199.3 40.3C772.3 66 827 103 874 150c47 47 83.9 101.8 109.7 162.7 26.7 63.1 40.2 130.2 40.2 199.3.1 19.9-16 36-35.9 36z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span>ย้อนกลับ</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="registerForm3" class="ant-form ant-form-vertical ant-form-hide-required-mark" style="display:none;">
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="password" class="ant-form-item-required" title="รหัสผ่าน">รหัสผ่าน</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-password ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="รหัสผ่าน" inputmode="text" action="click" id="register-password" name="password" type="password" class="ant-input">
                                        <span class="ant-input-suffix">
                                            <span role="img" aria-label="eye-invisible" tabindex="-1" class="anticon anticon-eye-invisible ant-input-password-icon" id="svg-eyes" onclick="showPassword('register-password')">
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
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="id_line" class="ant-form-item-required" title="ไอดีไลน์">ไอดีไลน์</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="ไอดีไลน์" inputmode="text" id="id_line" name="id_line" class="ant-input" type="text" value="">
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="ref" class="ant-form-item-required" title="ไอดีไลน์">ผู้แนะนำ</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback" style="background-color: #1d1d1d;">
                                        <input placeholder="" inputmode="text" id="ref" name="ref" class="ant-input" type="text" value="{{ request()->ref }}" style="background-color: #1d1d1d;" readonly>
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="registerForm_autoBonus" class="ant-form-item-required" title="รับโบนัสอัตโนมัติ">รับโบนัสอัตโนมัติ</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <div class="ant-select ant-select-in-form-item ant-select-has-feedback ant-select-single ant-select-show-arrow ant-select-show-search">
                                        <div class="ant-select-selector">
                                            <span class="ant-select-selection-search">
                                                <input type="search" id="registerForm_autoBonus" autocomplete="off" class="ant-select-selection-search-input" role="combobox" aria-haspopup="listbox" aria-owns="registerForm_autoBonus_list" aria-autocomplete="list" aria-controls="registerForm_autoBonus_list" aria-activedescendant="registerForm_autoBonus_list_0" value="">
                                            </span>
                                            <span class="ant-select-selection-item" title="ไม่รับโบนัสอัตโนมัติ">ไม่รับโบนัสอัตโนมัติ</span>
                                        </div>
                                        <span class="ant-select-arrow" unselectable="on" aria-hidden="true" style="user-select: none;">
                                            <span role="img" aria-label="down" class="anticon anticon-down ant-select-suffix">
                                                <svg viewBox="64 64 896 896" focusable="false" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M884 256h-75c-5.1 0-9.9 2.5-12.9 6.6L512 654.2 227.9 262.6c-3-4.1-7.8-6.6-12.9-6.6h-75c-6.5 0-10.3 7.4-6.5 12.7l352.6 486.1c12.8 17.6 39 17.6 51.7 0l352.6-486.1c3.9-5.3.1-12.7-6.4-12.7z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="channel" class="ant-form-item-required" title="ช่องทางที่รู้จักเรา">ช่องทางที่รู้จักเรา</label>
                        </div>
                        <div class="ant-col ant-form-item-control" id="searchChannel">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <div class="ant-select ant-select-in-form-item ant-select-has-feedback ant-select-single ant-select-show-arrow ant-select-show-search">
                                        <div class="ant-select-selector">
                                            <span class="ant-select-selection-search">
                                                <input type="search" id="channel" name="channel" autocomplete="off" class="ant-select-selection-search-input" role="combobox" aria-haspopup="listbox" aria-owns="registerForm_knowFrom_list" aria-autocomplete="list" aria-controls="registerForm_knowFrom_list" aria-activedescendant="registerForm_knowFrom_list_0" value="">
                                            </span>
                                            <span class="ant-select-selection-placeholder" id="channelPlaceholder">เลือกช่องทางที่รู้จักเรา ...</span>
                                        </div>
                                        <span class="ant-select-arrow" unselectable="on" aria-hidden="true" style="user-select: none;">
                                            <span role="img" aria-label="down" class="anticon anticon-down ant-select-suffix">
                                                <svg viewBox="64 64 896 896" focusable="false" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M884 256h-75c-5.1 0-9.9 2.5-12.9 6.6L512 654.2 227.9 262.6c-3-4.1-7.8-6.6-12.9-6.6h-75c-6.5 0-10.3 7.4-6.5 12.7l352.6 486.1c12.8 17.6 39 17.6 51.7 0l352.6-486.1c3.9-5.3.1-12.7-6.4-12.7z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <div class="ant-select-dropdown channel ant-select-dropdown-placement-bottomLeft  ant-select-dropdown-hidden" style="min-width: 361px; width: 100%; left: 0; top: 60px;">
                                            <div>
                                                <div class="rc-virtual-list" style="position: relative;">
                                                    <div class="rc-virtual-list-holder" style="max-height: 256px; overflow-y: scroll; overflow-anchor: none;">
                                                        <div style="height: 318px; position: relative; overflow: hidden;">
                                                            <div class="rc-virtual-list-holder-inner" style="display: flex; flex-direction: column; transform: translateY(0px); position: absolute; left: 0px; right: 0px; top: 0px;">
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Facebook" onclick="selectChannel('facebook');">
                                                                    <div class="ant-select-item-option-content">Facebook</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Line" onclick="selectChannel('line');">
                                                                    <div class="ant-select-item-option-content">Line</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Google" onclick="selectChannel('google');">
                                                                    <div class="ant-select-item-option-content">Google</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Instargram" onclick="selectChannel('instargram');">
                                                                    <div class="ant-select-item-option-content">Instargram</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Youtube" onclick="selectChannel('youtube');">
                                                                    <div class="ant-select-item-option-content">Youtube</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Tiktok" onclick="selectChannel('tiktok');">
                                                                    <div class="ant-select-item-option-content">Tiktok</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Onlyfans" onclick="selectChannel('onlyfans');">
                                                                    <div class="ant-select-item-option-content">Onlyfans</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                                <div aria-selected="false" class="ant-select-item ant-select-item-option" title="Telegram" onclick="selectChannel('telegram');">
                                                                    <div class="ant-select-item-option-content">Telegram</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="rc-virtual-list-scrollbar rc-virtual-list-scrollbar-show" style="width: 8px; top: 0px; bottom: 0px; right: 0px; position: absolute; display: none;">
                                                        <div class="rc-virtual-list-scrollbar-thumb" style="width: 100%; height: 128px; top: 0px; left: 0px; position: absolute; background: rgba(0, 0, 0, 0.5); border-radius: 99px; cursor: pointer; user-select: none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- <div class="captcha-row">
                        <img src="https://v2.apimsn.com/v2/register/captcha?prefix=PGTH&amp;t=1680431117978" alt="Captcha">
                        <button type="button" class="ant-btn ant-btn-link">
                            <span role="img" aria-label="redo" class="anticon anticon-redo">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="redo" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M758.2 839.1C851.8 765.9 912 651.9 912 523.9 912 303 733.5 124.3 512.6 124 291.4 123.7 112 302.8 112 523.9c0 125.2 57.5 236.9 147.6 310.2 3.5 2.8 8.6 2.2 11.4-1.3l39.4-50.5c2.7-3.4 2.1-8.3-1.2-11.1-8.1-6.6-15.9-13.7-23.4-21.2a318.64 318.64 0 01-68.6-101.7C200.4 609 192 567.1 192 523.9s8.4-85.1 25.1-124.5c16.1-38.1 39.2-72.3 68.6-101.7 29.4-29.4 63.6-52.5 101.7-68.6C426.9 212.4 468.8 204 512 204s85.1 8.4 124.5 25.1c38.1 16.1 72.3 39.2 101.7 68.6 29.4 29.4 52.5 63.6 68.6 101.7 16.7 39.4 25.1 81.3 25.1 124.5s-8.4 85.1-25.1 124.5a318.64 318.64 0 01-68.6 101.7c-9.3 9.3-19.1 18-29.3 26L668.2 724a8 8 0 00-14.1 3l-39.6 162.2c-1.2 5 2.6 9.9 7.7 9.9l167 .8c6.7 0 10.5-7.7 6.3-12.9l-37.3-47.9z"></path>
                                </svg>
                            </span>
                            <span>ลองรูปอื่น</span>
                        </button>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-label">
                            <label for="registerForm_captcha" class="ant-form-item-required" title="กรอกรหัสตามภาพ">กรอกรหัสตามภาพ</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <span class="ant-input-affix-wrapper ant-input-affix-wrapper-has-feedback">
                                        <input placeholder="กรอกรหัสตามภาพ" inputmode="text" id="registerForm_captcha" class="ant-input" type="text" value="">
                                        <span class="ant-input-suffix"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" id="register-submit" onclick="registerSubmit()">
                                        <span class="ant-btn-loading-icon" style="width: 0px; opacity: 0; transform: scale(0);">
                                            <span role="img" aria-label="loading" class="anticon anticon-loading anticon-spin ant-btn-loading-icon-motion-leave ant-btn-loading-icon-motion-leave-active ant-btn-loading-icon-motion">
                                                <svg viewBox="0 0 1024 1024" focusable="false" data-icon="loading" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M988 548c-19.9 0-36-16.1-36-36 0-59.4-11.6-117-34.6-171.3a440.45 440.45 0 00-94.3-139.9 437.71 437.71 0 00-139.9-94.3C629 83.6 571.4 72 512 72c-19.9 0-36-16.1-36-36s16.1-36 36-36c69.1 0 136.2 13.5 199.3 40.3C772.3 66 827 103 874 150c47 47 83.9 101.8 109.7 162.7 26.7 63.1 40.2 130.2 40.2 199.3.1 19.9-16 36-35.9 36z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span>สมัครสมาชิก</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-danger ant-btn-block" id="previous1" onclick="previousTwo()">
                                        <span class="ant-btn-loading-icon" style="width: 0px; opacity: 0; transform: scale(0);">
                                            <span role="img" aria-label="loading" class="anticon anticon-loading anticon-spin ant-btn-loading-icon-motion-leave ant-btn-loading-icon-motion-leave-active ant-btn-loading-icon-motion">
                                                <svg viewBox="0 0 1024 1024" focusable="false" data-icon="loading" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M988 548c-19.9 0-36-16.1-36-36 0-59.4-11.6-117-34.6-171.3a440.45 440.45 0 00-94.3-139.9 437.71 437.71 0 00-139.9-94.3C629 83.6 571.4 72 512 72c-19.9 0-36-16.1-36-36s16.1-36 36-36c69.1 0 136.2 13.5 199.3 40.3C772.3 66 827 103 874 150c47 47 83.9 101.8 109.7 162.7 26.7 63.1 40.2 130.2 40.2 199.3.1 19.9-16 36-35.9 36z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span>ย้อนกลับ</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div style="text-align: center;">
                    <span>ต้องการเข้าสู่ระบบใช่ไหม? </span>
                    <a href="/login?prefix={{ config('app.prefix') }}">เข้าสู่ระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <form id="form-login" class="ant-form ant-form-vertical ant-form-hide-required-mark hidden" method="POST" action="{{ route('auth-login') }}?prefix={{ config('app.prefix') }}">
        @csrf
        <div class="ant-row ant-form-item ant-form-item-has-success">
            <div class="ant-col ant-form-item-label">
                <label for="telephone" class="ant-form-item-required" title="เบอร์โทรศัพท์">เบอร์โทรศัพท์</label>
            </div>
            <div class="ant-col ant-form-item-control">
                <div class="ant-form-item-control-input">
                    <div class="ant-form-item-control-input-content">
                        <input class="ant-input" placeholder="เบอร์โทรศัพท์" name="telephone" id="telephone" minLength="10" maxLength="10" type="tel" value="" OnKeyPress="return chkNumber(this)">
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
                            <input placeholder="รหัสผ่าน" name="password" id="password" type="password" class="ant-input">
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
                        <button type="submit" class="ant-btn ant-btn-round ant-btn-primary ant-btn-block" id="btn-login">
                            <span>เข้าสู่ระบบ</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            getBankList()
            document.getElementById('searchBank').addEventListener('click', function(event) {
                event.preventDefault();
                var target = document.querySelector('.ant-select-dropdown.bank-list');
                if (target.classList.contains('ant-select-dropdown-hidden')) {
                    target.classList.remove('ant-select-dropdown-hidden');
                } else {
                    target.classList.add('ant-select-dropdown-hidden');
                }
            });
            document.getElementById('searchChannel').addEventListener('click', function(event) {
                event.preventDefault();
                var target = document.querySelector('.ant-select-dropdown.channel');
                if (target.classList.contains('ant-select-dropdown-hidden')) {
                    target.classList.remove('ant-select-dropdown-hidden');
                } else {
                    target.classList.add('ant-select-dropdown-hidden');
                }
            });
        })
        
        function selectItem(id,name){
            document.getElementById('bank').value = id;
            document.getElementById('nameBank').value = name;
            document.getElementById('bankPlaceholder').innerHTML = "";
        }
        
        function selectChannel(name){
            document.getElementById('channel').value = name;
            document.getElementById('channelPlaceholder').innerHTML = "";
        }

        let chkTimeout
        function nextOne(){
            err = checkFormOne()
            if(err == "error"){
                return
            }
            document.getElementById("registerForm1").style.display = "none";
            document.getElementById("registerForm2").style.display = "block";
        }

        function previousOne(){
            document.getElementById("registerForm1").style.display = "block";
            document.getElementById("registerForm2").style.display = "none";
        }

        function previousTwo(){
            document.getElementById("registerForm2").style.display = "block";
            document.getElementById("registerForm3").style.display = "none";
        }

        function nextTwo(){
            err = checkFormTwo()
            if(err == "error"){
                return
            }
            document.getElementById("registerForm2").style.display = "none";
            document.getElementById("registerForm3").style.display = "block";
        }

        // function checkFormOne(){
        //     telephone = document.getElementById("register-telephone").value;
        //     len = telephone.length;
        //     if(telephone == "" || (len < 10 || len > 10)){
        //         swalError("กรุณาใส่เบอร์โทรจำนวน 10 ตัวเท่านั้น");
        //         return "error"
        //     }
        // }

        function checkFormTwo(){
            number = document.getElementById("bank_number").value;
            len = number.length;
            if(number == "" || (len < 10 || len > 12)){
                swalError("กรุณาป้อนเลขบัญชีให้ถูกต้อง");
                return "error"
            }
            // first_name = document.getElementById("first_name").value;
            // last_name = document.getElementById("last_name").value;
            // if(first_name == "" || last_name == ""){
            //     swalError("กรุณาป้อนชื่อและนามสกุล");
            //     return "error"
            // }
        }

        // function checkFormThree(){
        //     line = document.getElementById("id_line").value;
        //     if(line == ""){
        //         swalError("กรุณาป้อนไอดีไลน์");
        //         return "error"
        //     }
        //     password = document.getElementById("register-password").value;
        //     confirm_password = document.getElementById("confirm-password").value;
        //     len = password.length;
        //     uppercase = password.substring(0, 1);
        //     if(password == "" || len < 8){
        //         swalError("กรุณาป้อนรหัสผ่านจำนวน 8 ตัวขึ้นไป");
        //         return "error"
        //     }else if((isNaN(uppercase) == false) || uppercase != uppercase.toUpperCase()){
        //         swalError("กรุณาป้อนรหัสผ่านขึ้นต้นด้วยตัวพิมพ์ใหญ่");
        //         return "error"
        //     }else if(password != confirm_password){
        //         swalError("คุณป้อนรหัสผ่านไม่ตรงกัน");
        //         return "error"
        //     }
        //     if(!verifyPassword(s)){
        //         swalError("Password ต้องมี 1ตัวพิมพ์ใหญ่ 1ตัวพิมพ์เล็ก 1ตัวเลขและ1ตัวอักษรพิเศษ.");
        //         return "error"
        //     }
        // }
    </script>
    <script>
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

        function getBankList(){
            $.ajax({
                type: 'GET',
                url: '{{ route("getBankList") }}?prefix={{ config("app.prefix") }}',
                contentType: "application/json",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    result = resp.result;
                    if(result == "Success."){
                        data = resp.data
                        data.forEach(function(obj) {
                            $('#bankList').append(`<div aria-selected="false" class="ant-select-item ant-select-item-option" title="`+ obj.Bank_Th +`" onclick="selectItem('`+ obj.Bank +`','`+ obj.Bank_Th +`')">
                                                                    <input type="hidden" value="`+ obj.Bank +`">
                                                                    <div class="ant-select-item-option-content">`+ obj.Bank_Th +`</div>
                                                                    <span class="ant-select-item-option-state" unselectable="on" aria-hidden="true" style="user-select: none;"></span>
                                                                </div>`)
                            // $('#bank').append('<option value="' + obj.Bank + '">' + obj.Bank_Th + '</option>')
                        })
                    }
                },
                error: function(resp){
                    console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                }
            });
            // return data
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

        function verifyPassword(s) {
            let hasNumber = false;
            let hasUpperCase = false;
            let hasLowercase = false;
            let hasSpecial = false;

            for (let i = 0; i < s.length; i++) {
                let c = s.charAt(i);

                if (/\d/.test(c)) {
                    hasNumber = true;
                } else if (c.toUpperCase() === c && c.toLowerCase() !== c) {
                    hasUpperCase = true;
                } else if (c.toLowerCase() === c && c.toUpperCase() !== c) {
                    hasLowercase = true;
                } else if (c === '#' || c === '|') {
                    return false;
                } else if (/[\p{P}\p{S}]/u.test(c)) {
                    hasSpecial = true;
                }
            }

            return hasNumber && hasUpperCase && hasLowercase && hasSpecial;
        }

        function checkFormOne(){
            telephone = document.getElementById("register-telephone").value;
            telephone = telephone.replaceAll("-","")
            len = telephone.length;
            if((telephone == "" || telephone.includes("_")) || (len < 10 || len > 10)){
                swalError("กรุณาใส่เบอร์โทรจำนวน 10 ตัวเท่านั้น");
                return "error"
            }
        }

        function checkFormTwo(){
            bank = document.getElementById("bank").value;
            if(bank == ""){
                swalError("กรุณาเลือกธนาคาร");
                return "error"
            }
            number = document.getElementById("bank_number").value;
            len = number.length;
            if(number == "" || (len < 10 || len > 12)){
                swalError("กรุณาป้อนเลขบัญชีให้ถูกต้อง");
                return "error"
            }
            first_name = document.getElementById("first_name").value;
            if(first_name == ""){
                swalError("กรุณาป้อนชื่อบัญชีธนาคาร");
                return "error"
            }
            last_name = document.getElementById("last_name").value;
            if(last_name == ""){
                swalError("กรุณาป้อนนามสกุลบัญชีธนาคาร");
                return "error"
            }
        }

        function checkFormThree(){
            password = document.getElementById("register-password").value;
            len = password.length;
            uppercase = password.substring(0, 1);
            if(password == "" || len < 8){
                swalError("กรุณาป้อนรหัสผ่านจำนวน 8 ตัวขึ้นไป");
                return "error"
            }else if((isNaN(uppercase) == false) || uppercase != uppercase.toUpperCase()){
                swalError("กรุณาป้อนรหัสผ่านขึ้นต้นด้วยตัวพิมพ์ใหญ่");
                return "error"
            }

            line = document.getElementById("id_line").value;
            if(line == ""){
                swalError("กรุณาป้อนไอดีไลน์");
                return "error"
            }
        }

        function registerSubmit(){
            err = checkFormOne()
            if(err == "error"){
                return
            }
            err = checkFormTwo()
            if(err == "error"){
                return
            }
            err = checkFormThree()
            if(err == "error"){
                return
            }

            window.swal({
                title: "",
                text: "กรุณารอสักครู่...",
                type: "info",
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            telephone = document.getElementById("register-telephone").value;
            bank = document.getElementById("bank").value;
            number = document.getElementById("bank_number").value;
            first_name = document.getElementById("first_name").value;
            last_name = document.getElementById("last_name").value;
            password = document.getElementById("register-password").value;
            line = document.getElementById("id_line").value;
            channel = document.getElementById("channel").value;
            ref = document.getElementById("ref").value;

            clearTimeout(chkTimeout)
            chkTimeout = setTimeout(function(){
                $.ajax({
                    type: 'POST',
                    url: '{{ route("register") }}?prefix={{ config("app.prefix") }}',
                    contentType: "application/json",
                    dataType: 'json',
                    data: JSON.stringify({
                        telephone:telephone,
                        password:password,
                        bank:bank,
                        bank_account:number,
                        first_name:first_name,
                        last_name:last_name,
                        channel:channel,
                        id_line:line,
                        bonus:"no",
                        ref:ref
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        result = resp.result;
                        if(result == "Success"){
                            // window.location..replace('{{ route("wallet") }}?prefix={{ config("app.prefix") }}');
                            document.getElementById("telephone").value = telephone;
                            document.getElementById("password").value = password;
                            document.getElementById("btn-login").click();
                        }else{
                            swal({
                                title: "",
                                text: resp.message,
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "รับทราบ",
                                closeOnConfirm: false
                            });
                        }
                    },
                    error: function(){
                        console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                    }
                });
            },3000)
        }
    </script>
    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script>!function(e){function r(r){for(var n,l,a=r[0],f=r[1],i=r[2],p=0,s=[];p<a.length;p++)l=a[p],Object.prototype.hasOwnProperty.call(o,l)&&o[l]&&s.push(o[l][0]),o[l]=0;for(n in f)Object.prototype.hasOwnProperty.call(f,n)&&(e[n]=f[n]);for(c&&c(r);s.length;)s.shift()();return u.push.apply(u,i||[]),t()}function t(){for(var e,r=0;r<u.length;r++){for(var t=u[r],n=!0,a=1;a<t.length;a++){var f=t[a];0!==o[f]&&(n=!1)}n&&(u.splice(r--,1),e=l(l.s=t[0]))}return e}var n={},o={1:0},u=[];function l(r){if(n[r])return n[r].exports;var t=n[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,l),t.l=!0,t.exports}l.m=e,l.c=n,l.d=function(e,r,t){l.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,r){if(1&r&&(e=l(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(l.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)l.d(t,n,function(r){return e[r]}.bind(null,n));return t},l.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(r,"a",r),r},l.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},l.p="/";var a=this["webpackJsonpmsn-react"]=this["webpackJsonpmsn-react"]||[],f=a.push.bind(a);a.push=r,a=a.slice();for(var i=0;i<a.length;i++)r(a[i]);var c=f;t()}([])</script>
    <script src="{{ asset('js/2.47b85de6.chunk.js') }}"></script>

    @if(\Session::get('message') == '809')
        <?php
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
        ?>
    @elseif(\Session::get('message') == '806')
        <?php
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
        ?>
    @elseif(\Session::get('message') == '888')
        <?php
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
        ?>
    @endif
    <script>
        $("#register-telephone").inputmask({"mask": "999-999-9999"});
    </script>
</body>
</html>
