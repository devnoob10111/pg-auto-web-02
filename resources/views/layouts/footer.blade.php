<div class="bottombar-mobile">
    <ul class="nav-menu">
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) === 'wallet' ? 'active' : null }}" href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}">
                <img src="{{ asset('images/icons/outline/wallet.svg') }}" alt="wallet icon">
                <span>กระเป๋า</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) === 'deposit' ? 'active' : null }}" href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}">
                <img src="{{ asset('images/icons/outline/deposit.svg') }}" alt="deposit icon">
                <span>เติมเงิน</span>
            </a>
        </li>
        <li class="nav-item middle-item">
            <!-- <form method="GET" action="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" id="play-game" target="_blank" hidden>
                @csrf
            </form> -->
            <a href="{{ route('game') }}?prefix={{ Session::get('Prefix') }}" class="nav-link" target="_blank">
                <div class="icon-button">
                    <div class="icon-container">
                        <img class="icon-center" src="{{ asset('images/icons/3d/dices.svg') }}" alt="dices icon">
                    </div>
                </div>
                <span>เข้าเล่นเกม</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) === 'withdraw' ? 'active' : null }}" href="{{ route('withdraw') }}?prefix={{ Session::get('Prefix') }}">
                <img src="{{ asset('images/icons/outline/withdraw.svg') }}" alt="withdraw icon">
                <span>ถอนเงิน</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::segment(1) === 'account' ? 'active' : null }}" href="{{ route('account') }}?prefix={{ Session::get('Prefix') }}">
                <img src="{{ asset('images/icons/outline/profile.svg') }}" alt="profile icon">
                <span>บัญชี</span>
            </a>
        </li>
    </ul>
</div>
<script>
    // function playGame(){
    //     $("#play-game").submit();
    // }

    if("{{ Request::segment(1) }}" === 'game'){
        document.getElementsByClassName("bottombar-mobile")[0].innerHTML = "";
    }
</script>
@if(\Session::get('message') == 'withdraw_success')
    <script>
        swalSuccess("ถอนเงินเรียบร้อยแล้ว.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "สำเร็จ!",
                        text: "ถอนเงินเรียบร้อยแล้ว",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#228B22",
                        confirmButtonText: "รับทราบ",
                        closeOnConfirm: false
                    });
                }, 1000);
            </script>
        ';
    ?> -->
@elseif(\Session::get('message') == 'withdraw_failed')
    <script>
        swalError("ถอนเงินไม่สำเร็จ.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "ไม่สำเร็จ!",
                        text: "ถอนเงินไม่สำเร็จ",
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
@elseif(\Session::get('message') == 'change_success')
    <script>
        swalSuccess("เปลี่ยนรหัสผ่านเรียบร้อยแล้ว.");
    </script>
<!-- <?php
    echo '
        <script type="text/javascript">
            setTimeout(function () {
                swal({
                    title: "สำเร็จ!",
                    text: "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#228B22",
                    confirmButtonText: "รับทราบ",
                    closeOnConfirm: false
                });
            }, 1000);
        </script>
    ';
?> -->
@elseif(\Session::get('message') == 'change_wrong')
    <script>
        swalError("รหัสผ่านเก่าไม่ถูกต้อง.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "ไม่สำเร็จ!",
                        text: "รหัสผ่านเก่าไม่ถูกต้อง",
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
@elseif(\Session::get('message') == 'change_failed')
    <script>
        swalError("เปลี่ยนรหัสผ่านไม่สำเร็จ.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "ไม่สำเร็จ!",
                        text: "เปลี่ยนรหัสผ่านไม่สำเร็จ",
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
@elseif(\Session::get('message') == 'success')
    <script>
        swalSuccess("ดำเนินการเรียบร้อยแล้ว.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "สำเร็จ!",
                        text: "ดำเนินการเรียบร้อยแล้ว",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#228B22",
                        confirmButtonText: "รับทราบ",
                        closeOnConfirm: false
                    });
                }, 1000);
            </script>
        ';
    ?> -->
@elseif(\Session::get('message') == 'failed')
    <script>
        swalError("ดำเนินการไม่สำเร็จ.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "ไม่สำเร็จ!",
                        text: "ดำเนินการไม่สำเร็จ",
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
@elseif((\Session::get('code') == '0'))
    <script>
        swalSuccess("ดำเนินการเรียบร้อยแล้ว.");
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "สำเร็จ!",
                        text: "ดำเนินการเรียบร้อยแล้ว",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#228B22",
                        confirmButtonText: "รับทราบ",
                        closeOnConfirm: false
                    });
                }, 1000);
            </script>
        ';
    ?> -->
@elseif((\Session::get('code') == '819') || (\Session::get('code') == '816') || (\Session::get('code') == '806') || (\Session::get('code') == '812'))
    <script>
        swalError(Session::get('message'));
    </script>
    <!-- <?php
        echo '
            <script type="text/javascript">
                setTimeout(function () {
                    swal({
                        title: "ไม่สำเร็จ!",
                        text: "'.Session::get('message').'",
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
@if(!empty($code))
    @if($code == '0')
        <script>
            swalSuccess("ดำเนินการเรียบร้อยแล้ว.");
        </script>
        <!-- <?php
            echo '
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "สำเร็จ!",
                            text: "ดำเนินการเรียบร้อยแล้ว.",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#228B22",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: false
                        });
                    }, 1000);
                </script>
            ';
        ?> -->
    @elseif($code == '819' || $code == '816' || $code == '806' || $code == '812')
        <script>
            swalError($message);
        </script>
        <!-- <?php
            echo '
                <script type="text/javascript">
                    setTimeout(function () {
                        swal({
                            title: "ไม่สำเร็จ!",
                            text: "'.$message.'",
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
@endif