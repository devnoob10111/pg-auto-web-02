@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">โปรโมชั่น</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/icon.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" target="_blank"><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></a></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>โปรโมชั่น</span></div></div>`;
    </script>
    <style>

    .ant-radio-wrapper-checked {
        border-color: #0da104;
        background-color: #26600b;
    }
    .ant-radio-promotion .ant-radio-wrapper-checked .ant-radio-inner {
        background: #52c41a !important;
    }
    .ant-radio-promotion .ant-radio-wrapper-checked .ant-radio-inner:before {
        opacity: 1 !important;
    }
    </style>
    <div class="ant-radio-group ant-radio-group-outline ant-radio-promotion">
        <div class="ant-row" style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
            
            @foreach($list as $proList)
            <div class="ant-col ant-col-xs-24 ant-col-sm-12 ant-col-xxl-8" style="padding-left: 8px; padding-right: 8px;">
                <div class="ant-card ant-card-bordered promotion-card">
                    <div class="ant-card-cover">
                        <?php
                            if(!empty($proList["Picture"])){
                                $imagePromotion = $proList["Picture"];
                                $typePromotion = explode(".",$imagePromotion);
                                $typePromotion = $typePromotion[1];
                                if($typePromotion == "jpg" || $typePromotion == "jpeg"){
                                    $imageTypePromotion = "image/jpeg";
                                }else if($typePromotion == "png"){
                                    $imageTypePromotion = "image/png";
                                }
                                $filePromotion = config('app.host').'/images/promotion/'.$imagePromotion;
                                $imageDataPromotion = base64_encode(file_get_contents($filePromotion));
                                echo '<img src="data:'.$imageTypePromotion.';base64,'.$imageDataPromotion.'" style="width:100%">';
                            }
                        ?>
                        <!-- <img src="https://msn.cdnbet.co/msn/pgth/promotion/c81b298fbc9dd82117a2e87b5e24de53cc1474fd145e10ac76ff0c9e734a7c081676056559.jpg" alt="สมัครสมาชิกใหม่ 50%"> -->
                    </div>
                    <div class="ant-card-body">
                        <div class="ant-card-meta">
                            <div class="ant-card-meta-detail">
                                <div class="ant-card-meta-title">{{ $proList["PromotionName"] }}</div>
                                <div class="ant-card-meta-description">{{ $proList["PromotionDescription"] }}</div>
                            </div>
                        </div>
                        <div class="promotion-actions">
                            <?php if(!empty($data) && $data["AgentPromotionId"] == $proList["Id"]) { ?>
                                <label class="ant-radio-wrapper ant-radio-wrapper-checked"><span class="ant-radio"><input type="radio" class="ant-radio-input" value="pgth-20230211-vedj00fu" checked=""><span class="ant-radio-inner"></span></span><span>กำลังใช้งานโปรนี้</span></label>
                                <div class="ant-col" style="padding-left: 8px; padding-right: 8px;">
                                    <button type="button" class="ant-btn ant-btn-round ant-btn-danger" onclick="ConfirmCancelPromotion()">
                                        <span>ไม่รับโปร</span>
                                    </button>
                                </div>
                            <?php }else { ?>
                                <label class="ant-radio-wrapper">
                                    <span class="ant-radio"> <!-- ant-radio ant-radio-checked class check-->
                                        <input type="radio" class="ant-radio-input" name="promotion" id="promotion{{$proList['Id']}}" value="newuser">
                                        <span class="ant-radio-inner"></span>
                                    </span>
                                    <span>รับโปรโมชั่นนี้</span>
                                </label>
                                <button type="button" class="ant-btn ant-btn-round ant-btn-primary" onclick="ConfirmRequestPromotion('{{$proList['Id']}}')">
                                    <span>กดรับโปร</span>
                                </button>
                                <form id="request-promotion{{$proList['Id']}}" action="{{ route('promotionRequest',[$proList['Id']]) }}?prefix={{ Session::get('Prefix') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <form id="cancel-promotion" action="{{ route('promotionCancel') }}?prefix={{ Session::get('Prefix') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="ant-divider ant-divider-horizontal" role="separator"></div>
        <!-- <label class="ant-radio-wrapper" style="display: flex;">
            <span class="ant-radio">
                <input type="radio" class="ant-radio-input" value="off" checked="">
                <span class="ant-radio-inner"></span>
            </span>
            <span>ไม่รับโบนัสอัตโนมัติ</span>
        </label> -->
    </div>
    <script>
        let chkRequestTimeout
        function ConfirmRequestPromotion(id){
            checked = document.getElementById("promotion"+id).checked;
            if(!checked){
                swalError("กรุณาติ๊กถูก ตรงรับโปรโมชั่นนี้ก่อน.");
                return
            }
            console.log("checked ",id)
            event.preventDefault();
            swal({   
                title: "คุณยืนยันเลือกโปรนี้!",
                text: "ยืนยันหรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#228B22",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน",
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                closeOnCancel: false 
            },
                function(isConfirm){
                    if (isConfirm)
                    {
                        clearTimeout(chkRequestTimeout)
                        chkRequestTimeout = setTimeout(function(){
                            document.getElementById('request-promotion'+id).submit();
                        },1000);
                    }else{
                        swal("", "ข้อมูลไม่ถูกดำเนินการ!", "error");
                    }
                }
            );
        }
        function ConfirmCancelPromotion(){
            event.preventDefault();
            swal({   
                title: "คุณต้องการยกเลิกโปร!",
                text: "ยืนยันหรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#228B22",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน",
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                closeOnCancel: false 
            },
                function(isConfirm){
                    if (isConfirm)
                    {
                        clearTimeout(chkRequestTimeout)
                        chkRequestTimeout = setTimeout(function(){
                            document.getElementById('cancel-promotion').submit();
                        },1000);
                    }else{
                        swal("", "ข้อมูลไม่ถูกดำเนินการ!", "error");
                    }
                }
            );
        }
    </script>
@endsection