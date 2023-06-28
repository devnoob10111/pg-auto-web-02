<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Session::get('Owner') }}</title>
    <link rel="icon" href="{{ Session::get('LogoBase64') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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
        .menu-mobile-wrapper {
            display: flex !important;
            margin-bottom: 0px !important;
        }
        #root {
            width:100%;
        }
        .game-menu-wallet {
            padding: 0px 16px !important;
        }
        @media screen and (min-width:768px) {
            #root {
                width:500px;
            }
            .game-menu-wallet {
                padding: 0px 0px !important;
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
        .snow,
        .snow:before,
        .snow:after {
            /* z-index: 9; */
            position: absolute;
            top: -600px;
            left: 0;
            bottom: 0;
            right: 0;
            background-image: radial-gradient(4px 4px at 474px 548px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 219px 577px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 589px 246px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 387px 593px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 426px 35px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 288px 450px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 252px 396px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 268px 349px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 389px 300px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 37px 301px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 130px 200px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 115px 392px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 367px 149px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 489px 35px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 258px 484px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 253px 231px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 493px 402px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 550px 585px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 529px 347px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 476px 407px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 198px 448px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 112px 65px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 350px 64px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 426px 422px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 139px 173px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 152px 317px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 255px 487px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 482px 304px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 159px 263px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 126px 495px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 239px 174px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 578px 580px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 537px 43px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 218px 333px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 302px 548px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 377px 184px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 24px 169px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 441px 541px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 416px 84px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 234px 164px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 208px 156px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 303px 409px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 413px 458px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 505px 437px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 252px 383px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 126px 571px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 292px 173px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 77px 111px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 382px 183px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 242px 416px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 549px 306px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 294px 106px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 521px 32px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 197px 115px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 193px 113px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 189px 135px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 195px 50px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 560px 351px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 473px 249px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 583px 565px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 303px 221px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 533px 419px, rgba(255, 255, 255, 0.7) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 506px 347px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 337px 579px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(4px 4px at 538px 328px, rgba(255, 255, 255, 0.9) 50%, rgba(0, 0, 0, 0)), radial-gradient(5px 5px at 343px 52px, white 50%, rgba(0, 0, 0, 0)), radial-gradient(3px 3px at 250px 33px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 333px 439px, rgba(255, 255, 255, 0.6) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 476px 355px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0)), radial-gradient(6px 6px at 286px 32px, rgba(255, 255, 255, 0.8) 50%, rgba(0, 0, 0, 0));
            background-size: 600px 600px;
            animation: snow 9s linear infinite;
            content: "";
        }

        .snow:after {
            margin-left: -200px;
            opacity: 0.4;
            animation-duration: 6s;
            animation-direction: reverse;
            filter: blur(3px);
        }

        .snow:before {
            animation-duration: 9s;
            animation-direction: reverse;
            margin-left: -300px;
            opacity: 0.65;
            filter: blur(1.5px);
        }

        @keyframes snow {
            to {
                transform: translateY(600px);
            }
        }
    </style>
    <style>
        .snow2 {
            /* z-index: 9999; */
            display: block;
            position: fixed;
            z-index: 2;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            pointer-events: none;
            transform: translate3d(0, -100%, 0);
            -webkit-animation: snow2 linear infinite;
                    animation: snow2 linear infinite;
        }
        .snow2.foreground {
            background-image: url("https://dl6rt3mwcjzxg.cloudfront.net/assets/snow/snow-large-075d267ecbc42e3564c8ed43516dd557.png");
            -webkit-animation-duration: 15s;
                    animation-duration: 15s;
        }
        .snow2.foreground.layered {
            -webkit-animation-delay: 3.5s;
                    animation-delay: 3.5s;
        }
        .snow2.middleground {
            background-image: image-url("https://dl6rt3mwcjzxg.cloudfront.net/assets/snow/snow-medium-0b8a5e0732315b68e1f54185be7a1ad9.png");
            -webkit-animation-duration: 10s;
                    animation-duration: 10s;
        }
        .snow2.middleground.layered {
            -webkit-animation-delay: 5s;
                    animation-delay: 5s;
        }
        .snow2.background {
            background-image: image-url("https://dl6rt3mwcjzxg.cloudfront.net/assets/snow/snow-small-1ecd03b1fce08c24e064ff8c0a72c519.png");
            -webkit-animation-duration: 15s;
                    animation-duration: 15s;
        }
        .snow2.background.layered {
            -webkit-animation-delay: 7.5s;
                    animation-delay: 7.5s;
        }

        @-webkit-keyframes snow2 {
            0% {
                transform: translate3d(0, -100%, 0);
            }
            100% {
                transform: translate3d(15%, 100%, 0);
            }
        }

        @keyframes snow2 {
            0% {
                transform: translate3d(0, -100%, 0);
            }
            100% {
                transform: translate3d(15%, 100%, 0);
            }
        }
    </style>
</head>
<body style="background-image: url(/media/splash.png);background-position: center center;background-attachment: fixed;background-size: cover;background-repeat: no-repeat;">
    <div id="root" style="margin: auto;">

        <div class="snow"></div>
        <div class="snow2 foreground"></div>
        <div class="snow2 foreground layered"></div>
        <div class="snow2 middleground"></div>
        <div class="snow2 middleground layered"></div>
        <div class="snow2 background"></div>
        <div class="snow2 background layered"></div>

        <section class="ant-layout ant-layout-has-sider">
            <section class="ant-layout">
                <header class="ant-layout-header">
                    <div class="topbar-mobile" style="display: initial;">
                        <a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}">
                            <span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path>
                                </svg>
                            </span>
                        </a>
                        <div style="margin-left:30px;">
                            <div class="ant-row menu-mobile-wrapper" style="justify-content: space-evenly;">
                                <div class="game-menu-wallet ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4">
                                    <a class="menu-mobile" href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}">
                                        <div class="menu-mobile-icon">
                                            <img src="{{ asset('images/icons/3d/deposit.svg') }}" alt="deposit icon">
                                        </div>
                                        เติมเงิน
                                    </a>
                                </div>
                                <div class="game-menu-wallet ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4">
                                    <a class="menu-mobile" href="{{ route('withdraw') }}?prefix={{ Session::get('Prefix') }}">
                                        <div class="menu-mobile-icon">
                                            <img src="{{ asset('images/icons/3d/withdraw.svg') }}" alt="withdraw icon">
                                        </div>
                                        ถอนเงิน
                                    </a>
                                </div>
                                <div class="game-menu-wallet ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4">
                                    <a class="menu-mobile" href="{{ route('promotion') }}?prefix={{ Session::get('Prefix') }}">
                                        <div class="menu-mobile-icon">
                                            <img src="{{ asset('images/icons/3d/promo.svg') }}" alt="promo icon">
                                        </div>
                                        โปรโมชั่น
                                    </a>
                                </div>
                                <div class="game-menu-wallet ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4">
                                    <a class="menu-mobile" href="{{ route('transactions-deposit') }}?prefix={{ Session::get('Prefix') }}">
                                        <div class="menu-mobile-icon">
                                            <img src="{{ asset('images/icons/3d/history.svg') }}" alt="history icon">
                                        </div>
                                        ประวัติ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="ant-layout-content msn-container">
                    <div class="ant-row menu-mobile-wrapper" style="margin-left: -16px; margin-right: -16px; row-gap: 28px;display: flex;">
                        @foreach($data as $value)
                        <div class="ant-col ant-col-xs-8 ant-col-md-8 ant-col-lg-8" style="padding-left: 8px; padding-right: 8px;">
                            <a class="menu-mobile" href="#" style="background-color: black;">
                                <div class="menu-mobile-icon" style="background:none;border:none;margin-top: 20px;margin-bottom: 37px;">
                                    <img src="{{ $value['imgUrl'] }}" alt="deposit icon" style="width:100%;height: 160%;background: linear-gradient(325deg,#975303 30%,#ffa200);    border: #994e0b 2px solid;" onclick="playSlot('{{ $value['productCode'] }}','{{ $value['gameId'] }}')">
                                </div>
                                <!-- {{ $value['gameName'] }} -->
                            </a>
                        </div>
                        @endforeach
                    </div>
                </main>
            </section>
        </section>
    </div>
    <script>
        function playSlot(productcode,gameid){
            let url = "{{ route('game') }}/slot/play/"+productcode+"/"+gameid+"?prefix={{ Session::get('Prefix') }}"
            window.open(url, '_blank');
        }
    </script>
    <script src="{{ asset('js/2.47b85de6.chunk.js') }}"></script>
</body>
</html>
