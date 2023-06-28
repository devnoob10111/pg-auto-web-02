@extends('layouts.app')

@section('content')
<?php
    function getBanner(){
        $AccessToken = Session::get('AccessToken');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api-src')."/banner/list?limit=50&page=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: */*",
                "accept-language: th",
                "content-type: application/json",
                "Authorization: Bearer ".$AccessToken,
                'Origin:'.Session::get('Origin')
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
    }
?>
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">กระเป๋า</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar"><div class="topbar-logo">
            <a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}">
                <span class="ant-avatar ant-avatar-square ant-avatar-image avatar-logo">
                    <img src="{{ Session::get('LogoBase64') }}">
                </span>
            </a>
        </div>
        <div class="topbar-welcome">
            <h5 class="ant-typography" style="margin-bottom: 0px;">สวัสดี, คุณ{{ Session::get('Name') }}</h5>
        </div>
        <div class="topbar-member">
            <div class="topbar-profile">
                <div class="topbar-profile-rank">
                    <img src="{{ asset('media/icon.png') }}" alt="bronze">
                </div>
                <div class="topbar-info">
                    <span class="ant-typography">{{ Session::get('Name') }}</span>
                    <div>
                        <span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span>
                        <a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;">
                            <span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank">
            <button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple">
                <span>เข้าเล่นเกม </span>
                <span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                        <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                    </svg>
                </span>
            </button>
            </a>
        </div></div>`;
    </script>
    <div class="ant-row" style="margin-left: -16px; margin-right: -16px; margin-bottom: 32px;">
        <div class="ant-col ant-col-xs-24 ant-col-xl-16" style="padding-left: 16px; padding-right: 16px;">
            <div id="slide"style="margin-bottom: 15px;">
                <div class="slideshow-container">
                    <?php
                        $banner = getBanner();
                        if(isset($banner["code"]) && $banner["code"] == "0"){
                            $pagination = $banner["data"];
                            $data = $pagination["data"];

                            foreach($data as $i => $val){
                                $image = $val["Picture"];
                                $type = explode(".",$image);
                                $type = $type[1];
                                if($type == "jpg" || $type == "jpeg"){
                                    $imageType = "image/jpeg";
                                }else if($type == "png"){
                                    $imageType = "image/png";
                                }
                                $file = config('app.host').'/images/banner/'.$image;
                                $source = file_get_contents($file);
                                $imageData = base64_encode(file_get_contents($file));
                                echo '<div class="mySlides fadeBanner"><img src="data:'.$imageType.';base64,'.$imageData.'" style="width:100%"></div>';
                            }
                        }
                    ?>

                </div>
            </div> 
            <div class="wallet-container">
                <span>
                    <span style="opacity: 0.75;">ยอดเงินทั้งหมด</span>
                    <span role="img" aria-label="redo" tabindex="-1" class="anticon anticon-redo redo-button" style="font-size: 18px; margin-left: 6px;" onclick="getCredit()">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="redo" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                            <path d="M758.2 839.1C851.8 765.9 912 651.9 912 523.9 912 303 733.5 124.3 512.6 124 291.4 123.7 112 302.8 112 523.9c0 125.2 57.5 236.9 147.6 310.2 3.5 2.8 8.6 2.2 11.4-1.3l39.4-50.5c2.7-3.4 2.1-8.3-1.2-11.1-8.1-6.6-15.9-13.7-23.4-21.2a318.64 318.64 0 01-68.6-101.7C200.4 609 192 567.1 192 523.9s8.4-85.1 25.1-124.5c16.1-38.1 39.2-72.3 68.6-101.7 29.4-29.4 63.6-52.5 101.7-68.6C426.9 212.4 468.8 204 512 204s85.1 8.4 124.5 25.1c38.1 16.1 72.3 39.2 101.7 68.6 29.4 29.4 52.5 63.6 68.6 101.7 16.7 39.4 25.1 81.3 25.1 124.5s-8.4 85.1-25.1 124.5a318.64 318.64 0 01-68.6 101.7c-9.3 9.3-19.1 18-29.3 26L668.2 724a8 8 0 00-14.1 3l-39.6 162.2c-1.2 5 2.6 9.9 7.7 9.9l167 .8c6.7 0 10.5-7.7 6.3-12.9l-37.3-47.9z"></path>
                        </svg>
                    </span>
                </span>
                <div class="wallet-amount">฿ {{ Session::get('Credit') }}</div>
            </div>
            <div>
                <div class="wallet-cashback">
                    <div>
                        <span style="opacity: 0.75;">ยอดแคชแบ็ก</span>
                        <?php
                            $cashback = $lose[0];
                        ?>
                        <div class="wallet-cashback-amount">฿ {{ number_format(floor($cashback["Amount"] * 100) / 100,2) }}</div>
                        <form id="cashback-form{{$cashback['ID']}}" action="{{ route('requestCashBack') }}?prefix={{ Session::get('Prefix') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="text" value="{{ $cashback['ID'] }}" name="cashback">
                        </form>
                    </div>
                    <button type="button" class="ant-btn ant-btn-round ant-btn-primary ant-btn-purple" onclick="ConfirmCashback('{{ $cashback['ID'] }}');" <?php if($cashback["Amount"] <= 0){ echo "disabled"; } ?>>
                        <span>รับแคชแบ็ก</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="ant-col ant-col-xs-24 ant-col-xl-8" style="padding-left: 16px; padding-right: 16px;">
            <div class="invite-card">
                <div class="invite-card-body">
                    <div class="invite-qrcode-container">
                        <img src="{{ asset('coin/small.png') }}" class="small-coin" alt="">
                        <img src="{{ asset('coin/medium.png') }}" class="medium-coin" alt="">
                        <img src="{{ asset('coin/large.png') }}" class="large-coin" alt="">
                        <img src="{{ asset('coin/x_large.png') }}" class="x-large-coin" alt="">
                        <div class="invite-qrcode">
                            <img src="" class="qr-code" width="150" height="150">
                        </div>
                    </div>
                    <div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ant-row menu-mobile-wrapper" style="margin-left: -16px; margin-right: -16px; row-gap: 16px;">
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/deposit.svg') }}" alt="deposit icon">
                </div>
                เติมเงิน
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('withdraw') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/withdraw.svg') }}" alt="withdraw icon">
                </div>
                ถอนเงิน
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('promotion') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/promo.svg') }}" alt="promo icon">
                </div>
                โปรโมชั่น
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('transactions-deposit') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/history.svg') }}" alt="history icon">
                </div>
                ประวัติ
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('profile') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/profile.svg') }}" alt="profile icon">
                </div>
                โปรไฟล์
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('affiliate') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/affiliate.svg') }}" alt="affiliate icon">
                </div>
                ชวนเพื่อน
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('lucky-wheel') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/wheel.svg') }}" alt="wheel icon">
                </div>
                กงล้อ
            </a>
        </div>
        <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a href="{{ Session::get('Line') }}" target="_blank" rel="noreferrer" class="menu-mobile">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/chat.svg') }}" alt="chat icon">
                </div>
                แจ้งปัญหา
            </a>
        </div>
        <!-- <div class="ant-col ant-col-xs-6 ant-col-md-3 ant-col-lg-4" style="padding-left: 16px; padding-right: 16px;">
            <a class="menu-mobile" href="{{ route('ranking') }}?prefix={{ Session::get('Prefix') }}">
                <div class="menu-mobile-icon">
                    <img src="{{ asset('images/icons/3d/ranking.svg') }}" alt="affiliate icon">
                </div>
                จัดอันดับ
            </a>
        </div> -->
    </div>
    <script>
        function ConfirmCashback(id){
            if(!id){
                swalError("คุณไม่มียอดที่ขอคืนได้")
                return
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
            closeOnCancel: false },
            function(isConfirm){
                if (isConfirm)
                {
                    console.log(id)
                    document.getElementById('cashback-form'+id).submit();
                }else{
                    swal("", "ข้อมูลไม่ถูกดำเนินการ!", "error");
                }
            });
        }

        function getCredit(){
            // window.swal({
            //     title: "",
            //     text: "กรุณารอสักครู่...",
            //     type: "info",
            //     showCancelButton: false,
            //     showConfirmButton: false,
            //     allowOutsideClick: false
            // });
            setTimeout(()=>{
                $.ajax({
                    type: 'GET',
                    url: "{{ route('getCredit') }}?prefix={{ Session::get('Prefix') }}",
                    contentType: "application/json",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        // console.log(resp)
                        code = resp.code;
                        if(code == "0"){
                            data = resp.data
                            document.getElementsByClassName("wallet-amount")[0].innerHTML = "฿ "+ data
                            swalSuccess("อัพเดตยอดสำเร็จ");
                        }
                    },
                    error: function(resp){
                        resp = resp.responseJSON
                        if(resp.code == "802"){
                            // swal({   
                            //     title: "",
                            //     text: "มีคนเข้าไอดีซ้อน กรุณาเข้าสู่ระบบใหม่",
                            //     type: "warning",
                            //     showCancelButton: false,
                            //     confirmButtonColor: "#DD6B55",
                            //     confirmButtonText: "รับทราบ",
                            //     closeOnConfirm: false,
                            //     closeOnCancel: false 
                            // },
                            //     function(isConfirm){
                            //         if (isConfirm){
                            //             sessionStorage.clear();
                            //             window.location.reload();
                            //         }
                            //     }
                            // );
                        }
                        console.log("เกิดข้อผิดพลาดบางอย่าง กรุณาโหลดหน้าใหม่หรือติดต่อผู้ดูแล")
                    }
                });
            }, 3000)
        }
    </script>
    <script>
        if("{{ Session::get('Line') }}" != "#"){
            let finalURL = 'https://chart.googleapis.com/chart?cht=qr&chl=' + htmlEncode("{{ Session::get('Line') }}") + '&chs=160x160&chld=L|0'
            $('.qr-code').attr('src', finalURL);
        }
    </script>
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            // let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            if(slides.length == 0){
                return
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            // for (i = 0; i < dots.length; i++) {
            //     dots[i].className = dots[i].className.replace(" active", "");
            // }
            slides[slideIndex-1].style.display = "block";  
            // dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 10000); // Change image every 2 seconds
        }
    </script>
@endsection
