@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">กงล้อเสี่ยงโชค</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>กงล้อเสี่ยงโชค</span></div></div>`;
    </script>

    <link rel="stylesheet" href="{{ asset('wheel/mains.css') }}" type="text/css" />
    <script type="text/javascript" src="{{ asset('wheel/Winwheel.min.js') }}"></script>
    <script src="{{ asset('wheel/TweenMax.min.js') }}"></script>

    <link href="{{ asset('css/flipdown.css') }}" rel="stylesheet">
    <script src="{{ asset('js/flipdown.js') }}"></script>
    <style>
        /* components */
        .page {
            color: var(--white-1);
            display: grid;
            font-size: var(--ft-se-400);
            font-family: var(--ft-fy-1);
            background-color: var(--black-1);
            min-height: 100vh;
            place-items: center;
        }

        .progress-bar {
            width: calc(100% - var(--space-400));
            height: var(--__progress-bar_ht, 40px);
            overflow: hidden;
            position: relative;
            display: grid;
            border: 2px solid #d6a74d;
            border-radius: 50vw;
            background-color: var(--__progress-bar_bd-cr, var(--black-2));
            place-items: center;
            max-width: var(--__progress-bar_max-wh, 500px);
        }
        .progress-bar-25{
            width: 25%;
            position: absolute;
            content: "";
            height: 100%;
            justify-self: start;
            border-right: 1px solid #d6a74d;
            z-index: 9;
        }
        .progress-bar-50{
            width: 50%;
            position: absolute;
            content: "";
            height: 100%;
            justify-self: start;
            border-right: 1px dotted #d6a74d;
            z-index: 9;
        }
        .progress-bar-75{
            width: 75%;
            position: absolute;
            content: "";
            height: 100%;
            justify-self: start;
            border-right: 1px solid #d6a74d;
            z-index: 9;
        }
        .progress-bar::before {
            font-weight: bold;
            background: linear-gradient( 
            180deg
            , rgba(213, 172, 79, 1) 0%, rgba(214, 174, 81, 1) 2.99%, rgba(219, 182, 89, 1) 4.62%, rgba(226, 194, 103, 1) 5.93%, rgba(236, 213, 122, 1) 7.05%, rgba(250, 236, 147, 1) 8.06%, rgba(255, 245, 157, 1) 8.38%, rgba(243, 225, 136, 1) 9.88%, rgba(212, 173, 81, 1) 12.99%, rgba(212, 172, 80, 1) 13.03%, rgba(212, 172, 80, 1) 13.05%, rgba(194, 152, 67, 1) 16.03%, rgba(184, 141, 59, 1) 19.06%, rgba(180, 137, 56, 1) 22.2%, rgba(187, 147, 65, 1) 29.95%, rgba(205, 173, 89, 1) 43.06%, rgba(234, 216, 128, 1) 59.8%, rgba(255, 246, 156, 1) 70.18%, rgba(237, 220, 133, 1) 70.67%, rgba(216, 189, 106, 1) 71.38%, rgba(199, 165, 85, 1) 72.13%, rgba(187, 148, 70, 1) 72.92%, rgba(180, 138, 61, 1) 73.78%, rgba(178, 135, 58, 1) 74.84%, rgba(186, 144, 64, 1) 79.35%, rgba(211, 171, 82, 1) 83.65%, rgba(209, 171, 98, 1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#D5AC4F', endColorstr='#D1AB62', GradientType=0);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            z-index: var(--zx-400);
            position: absolute;
            content: attr(data-status);
            z-index: 999;
        }
        .progress-bar::after {
            width: var(--__progress-bar__status_wh, 0%);
            position: absolute;
            content: "";
            height: 100%;
            justify-self: start;
            background-image: linear-gradient(to left, #7a0707, #770808, #750808, #720909, #700909, #730909, #760809, #790809, #820708, #8b0607, #940506, #9d0404);
        }

        /* Style Count Down */
        .countdown {
            font-family: 'Roboto', sans-serif;
            width: 550px;
            /* height: 378px; */
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }
        .example .flipdown {
            margin: auto;
        }
        .countdown h1 {
            text-align: center;
            font-weight: 100;
            font-size: 3em;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .countdown p {
            text-align: center;
            font-weight: 100;
            margin-top: 0;
            margin-bottom: 35px;
        }
        .countdown .buttons {
            width: 100%;
            height: 50px;
            margin: 50px auto 0px auto;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .countdown .buttons p {
            height: 50px;
            line-height: 50px;
            font-weight: 400;
            padding: 0px 25px 0px 0px;
            color: #333;
            margin: 0px;
        }
        .countdown .button {
            display: inline-block;
            height: 50px;
            box-sizing: border-box;
            line-height: 46px;
            text-decoration: none;
            color: #333;
            padding: 0px 20px;
            border: solid 2px #333;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: 700;
            transition: all .2s ease-in-out;
        }
        .countdown .button:hover {
            background-color: #333;
            color: #FFF;
        }
        .countdown .button i {
            margin-right: 5px;
        }
        @media(max-width: 550px) {
            .countdown {
                width: 100%;
                /* height: 362px; */
            }
            .countdown h1 {
                font-size: 2.5em;
            }
            .countdown p {
                margin-bottom: 25px;
            }
            .countdown .buttons {
                width: 100%;
                margin-top: 25px;
                text-align: center;
                display: block;
            }
            .countdown .buttons p,
            .countdown .buttons a {
                float: none;
                margin: 0 auto;
            }
            .countdown .buttons p {
                padding-right: 0px;
            }
            .countdown .buttons a {
                display: inline-block;
            }
        }

    </style>
    <div align="center">
        <h1 style="color: #e3c413;">สุ่มวงล้อรับรางวัล</h1>
        <br />
        <div style="color: #30e314;font-size: 16px;"><marquee direction="right" style="position: absolute;margin-left: -25px;width: 25px;" scrolldelay="160">>>></marquee> <a href="{{ route('pageWheelHistory',['50','1']) }}">ประวัติหมุนวงล้อ</a> <marquee direction="left" style="position: absolute;margin-right: -25px;width: 25px;" scrolldelay="160"><<<</marquee></div>
        <div class="progress-bar" id="progress-bar" data-status="0%" aria-label="Progress bar.">
            <div class="progress-bar-25"></div>
            <div class="progress-bar-50"></div>
            <div class="progress-bar-75"></div>
        </div>
        <div style="color: #e3c414;">ครบ 10,000 คะแนน แลกรับเครดิตฟรี 100 บาท</div>
        <div id="btn-deal" style="display:none;"><button class="btn btn-success" style="font-size: 18px;" onclick="pointDeal()">ขอแลกเครดิต</button></div>
        <div class="countdown" id="countdown" style="display:none;">
            <p style="color:white;font-size: 18px;">⏰ นับเวลาถอยหลังจะหมุนได้อีกรอบ</p>
            <div id="flipdown" class="flipdown"></div>
        </div>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="490" height="490" class="the_wheel" align="center" valign="center">
                    <canvas id="spin_button" class="bbg" width="280" height="280"  alt="Spin" onClick="startSpin();"></canvas>
                    <canvas id="canvas" width="280" height="280" style="border-radius:50%;">
                        <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                    </canvas>
                </td>
            </tr>
        </table>
    </div>

    <script>
        var path = "/wheel/"
        let theWheel = new Winwheel({
            'numSegments'       : 8,    
            'outerRadius'       : 200,   
            'drawText'          : true,  
            'textFontSize'      : 26,
            'textAlignment'     : 'inner',
            'textMargin'        : 60,
            'textFontFamily'    : 'monospace',
            'textStrokeStyle'   : 'black',
            'textFillStyle'     : 'white',
            'drawMode'          : 'segmentImage',
            'segments'          : 
            [
                {'image' : path+'alex.png',  'text' : '50'},
                {'image' : path+'bruce.png',   'text' : '100'},
                {'image' : path+'alex.png',  'text' : '150'},
                {'image' : path+'bruce.png',  'text' : '250'},
                {'image' : path+'alex.png', 'text' : '350'},
                {'image' : path+'bruce.png', 'text' : '500'},
                {'image' : path+'alex.png',  'text' : '750'},
                {'image' : path+'bruce.png', 'text' : '1000'},
            ],
            'animation' :   
            {
                'type'     : 'spinToStop',
                'duration' : 5,    
                'spins'    : 3,     
                'callbackFinished' : alertPrize,
                'callbackSound'    : playSound, 
                'soundTrigger'     : 'pin'
            },
            'pins' :
            {
                'number'     : 8,
                'fillStyle'  : 'silver',
                'outerRadius': 0,
            }
        });

        let audio = new Audio(path+'tick.mp3');

        function playSound()
        {
            audio.pause();
            audio.currentTime = 0;

            var isPlaying = audio.currentTime > 0 && !audio.paused && !audio.ended && audio.readyState > audio.HAVE_CURRENT_DATA;
            if (!isPlaying) {
                audio.play();
            }
        }

        let wheelPower    = 0;
        let wheelSpinning = true;
        let valueSpin

        function powerSelected(powerLevel)
        {
            if (wheelSpinning == false) {
                document.getElementById('pw1').className = "";
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                if (powerLevel >= 1) {
                    document.getElementById('pw1').className = "pw1";
                }

                if (powerLevel >= 2) {
                    document.getElementById('pw2').className = "pw2";
                }

                if (powerLevel >= 3) {
                    document.getElementById('pw3').className = "pw3";
                }

                wheelPower = powerLevel;

                document.getElementById('spin_button').src = path+"spin_on.png";
                document.getElementById('spin_button').className = "clickable";
            }
        }

        async function startSpin()
        {
            if (wheelSpinning == false) {
                let value 
                try {
                    value = await wheelSpin()
                } catch(err) {
                    console.log(err);
                    return
                }
                let result
                if(value.code == "0"){
                    result = value.data;
                }else{
                    return
                }
                
                if (wheelPower == 1) {
                    theWheel.animation.spins = 3;
                } else if (wheelPower == 2) {
                    theWheel.animation.spins = 8;
                } else if (wheelPower == 3) {
                    theWheel.animation.spins = 15;
                }

                document.getElementById('spin_button').src       = path+"spin_off.png";
                document.getElementById('spin_button').className = "bbg";
                
                //ผลลัพท์
                if(result == 50){
                    result = 2;
                }else if(result == 100){
                    result = 47;
                }else if(result == 150){
                    result = 92;
                }else if(result == 250){
                    result = 137;
                }else if(result == 350){
                    result = 182;
                }else if(result == 500){
                    result = 227;
                }else if(result == 750){
                    result = 272;
                }else if(result == 1000){
                    result = 317;
                }

                let stopAt = (result + Math.floor((Math.random() * 42)))

                theWheel.animation.stopAngle = stopAt;

                theWheel.startAnimation();

                wheelSpinning = true;
                getWheelLast()
                setTimeout(function(){
                    getWheelPoint()
                }, 4500);
            }
        }

        function resetWheel()
        {
            theWheel.stopAnimation(false)
            theWheel.rotationAngle = 0;
            theWheel.draw();

            document.getElementById('pw1').className = "";
            document.getElementById('pw2').className = "";
            document.getElementById('pw3').className = "";

            wheelSpinning = false;
        }

        function alertPrize(indicatedSegment)
        {
            swalSuccess('ได้รับคะแนนจำนวน ' + indicatedSegment.text);
            // alert('ได้รับคะแนนจำนวน ' + indicatedSegment.text);
        }

        const progressBar = document.getElementById("progress-bar");
        let statusVal = 0;
        let id = null;

        getWheelPoint()
        getWheelLast()

        function updateProgressBar() {
            const max = 10000
            const isMaxVal = statusVal === max;
            progressBar.dataset.status = statusVal + " คะแนน";
            progressBar.setAttribute(
                "style",
                `--__progress-bar__status_wh: ${statusVal/(max/100)}%;`
            );
            if(statusVal >= max){
                document.getElementById("btn-deal").style.display = "block"
            }else{
                document.getElementById("btn-deal").style.display = "none"
            }
        }

        function getWheelPoint(){
            $.ajax({
                type: 'GET',
                url: "{{ route('getWheelPoint') }}?prefix={{ Session::get('Prefix') }}",
                contentType: "application/json",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    result = resp.result;
                    if(result == "Success."){
                        data = resp.data
                        statusVal = data
                        updateProgressBar();
                    }
                },
                error: function(resp){
                    resp = resp.responseJSON
                    if(resp.code == "802"){
                        swal({   
                            title: "",
                            text: "มีคนเข้าไอดีซ้อน กรุณาเข้าสู่ระบบใหม่",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false,
                            closeOnCancel: false 
                        },
                            function(isConfirm){
                                if (isConfirm){
                                    sessionStorage.clear();
                                    window.location.reload();
                                }
                            }
                        );
                    }
                    console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                }
            });
        }

        function getWheelLast(){
            $.ajax({
                type: 'GET',
                url: "{{ route('getWheelLast') }}?prefix={{ Session::get('Prefix') }}",
                contentType: "application/json",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    result = resp.code;
                    if(result == "0"){
                        data = resp.data
                        let date = new Date(data);
                        if(Number.isNaN(date.getMonth())) {
                            let arr = data.split(/[- :]/);
                            date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
                        }
                        let newDate = (date.getTime()+ (6*60*60*1000));
                        let now = new Date();
                        // console.log(now.getTime())
                        if(data == "0001-01-01 00:00:00"){
                            wheelSpinning = false;
                        }else if(now.getTime() > newDate){
                            wheelSpinning = false;
                        }else if(now.getTime() <= newDate){
                            document.getElementById("countdown").style.display = "block"
                            countDown((newDate / 1000))
                        }
                    }
                },
                error: function(resp){
                    resp = resp.responseJSON
                    if(resp.code == "802"){
                        swal({   
                            title: "",
                            text: "มีคนเข้าไอดีซ้อน กรุณาเข้าสู่ระบบใหม่",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false,
                            closeOnCancel: false 
                        },
                            function(isConfirm){
                                if (isConfirm){
                                    sessionStorage.clear();
                                    window.location.reload();
                                }
                            }
                        );
                    }
                    console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                }
            });
        }

        function wheelSpin(){
            return $.ajax({
                type: 'GET',
                url: "{{ route('getWheelSpin') }}?prefix={{ Session::get('Prefix') }}",
                contentType: "application/json",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    result = resp.code;
                    // console.log(resp)
                    if(result == "0"){
                        valueSpin = resp.data
                    }else {
                        valueSpin = "null"
                    }
                },
                error: function(resp){
                    resp = resp.responseJSON
                    if(resp.code == "802"){
                        swal({   
                            title: "",
                            text: "มีคนเข้าไอดีซ้อน กรุณาเข้าสู่ระบบใหม่",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false,
                            closeOnCancel: false 
                        },
                            function(isConfirm){
                                if (isConfirm){
                                    sessionStorage.clear();
                                    window.location.reload();
                                }
                            }
                        );
                    }
                    console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                }
            });
        }

        function pointDeal(){
            event.preventDefault();
            swal({   title: "คุณยืนยันที่จะทำรายการ!",
            text: "คุณแน่ใจที่จะดำเนินการ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#228B22",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน!",
            closeOnConfirm: false,
            closeOnCancel: false },
            function(isConfirm){
                if (isConfirm)
                {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('wheelPointDeal') }}?prefix={{ Session::get('Prefix') }}",
                        contentType: "application/json",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(resp) {
                            code = resp.code;
                            // console.log(resp)
                            if(code == "0"){
                                getWheelPoint();
                                swal("ขอแลกเครดิตสำเร็จ", "ดำเนินการขอแลกเครดิตแล้ว รอแอดมินอนุมัติสักครู่ค่ะ", "success");
                            }
                        },
                        error: function(resp){
                            resp = resp.responseJSON
                            if(resp.code == "802"){
                                swal({   
                                    title: "",
                                    text: "มีคนเข้าไอดีซ้อน กรุณาเข้าสู่ระบบใหม่",
                                    type: "warning",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "รับทราบ",
                                    closeOnConfirm: false,
                                    closeOnCancel: false 
                                },
                                    function(isConfirm){
                                        if (isConfirm){
                                            sessionStorage.clear();
                                            window.location.reload();
                                        }
                                    }
                                );
                            }
                            console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                        }
                    });
                }else{
                    swal("", "ข้อมูลไม่ถูกดำเนินการ!", "error");
                }
            });
        }

        function countDown(time){
            let twoDaysFromNow = time
            let flipdown = new FlipDown(twoDaysFromNow)
            flipdown.start()

            .ifEnded(() => {
                let element = document.getElementById("flipdown");
                while (element.firstChild) {
                    element.removeChild(element.firstChild);
                }
                wheelSpinning = false;
                document.getElementById("countdown").style.display = "none"
            });
        }
    </script>
@endsection