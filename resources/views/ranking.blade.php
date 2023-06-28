@extends('layouts.app')

@section('content')
    <script>
        var header = document.getElementsByClassName("ant-layout-header");
        header[0].innerHTML = `
        <div class="topbar topbar-hidden"><div class="topbar-welcome"><h5 class="ant-typography" style="margin-bottom: 0px;">โปรโมชั่น</h5></div><div class="topbar-member"><div class="topbar-profile"><div class="topbar-profile-rank"><img src="{{ asset('media/bronze.a15902f9.png') }}" alt="bronze"></div><div class="topbar-info"><span class="ant-typography">{{ Session::get('Name') }}</span><div><span class="ant-typography ant-typography-secondary">฿ {{ Session::get('Credit') }}</span><a href="{{ route('deposit') }}?prefix={{ Session::get('Prefix') }}" style="margin-left: 6px;"><span role="img" aria-label="plus-circle" class="anticon anticon-plus-circle primary-color" style="font-size: 16px; opacity: 0.85;"><svg viewBox="64 64 896 896" focusable="false" data-icon="plus-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm192 472c0 4.4-3.6 8-8 8H544v152c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V544H328c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h152V328c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v152h152c4.4 0 8 3.6 8 8v48z"></path></svg></span></a></div></div></div><button type="button" class="ant-btn ant-btn-round ant-btn-default ant-btn-purple"><span>เข้าเล่นเกม </span><span role="img" aria-label="right" class="anticon anticon-right" style="font-size: 14px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span></button></div></div>
        <div class="topbar-mobile"><a href="{{ route('wallet') }}?prefix={{ Session::get('Prefix') }}"><span role="img" aria-label="left" tabindex="-1" class="anticon anticon-left" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path></svg></span></a><div class="topbar-mobile-title"><span>ตารางจัดอันดับ</span></div></div>`;
    </script>
    <div class="ant-row ant-row-center">
        <div class="ant-col ant-col-xs-24 ant-col-md-16 ant-col-xl-12">
            <div class="ant-row" style="margin-left: -6px; margin-right: -6px; row-gap: 16px;">
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">1</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">กฤษณ์</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>80,224,550</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">2</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">ดนุพล</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>6,513,624</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">3</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">ณัฐวุฒิ</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>4,182,599</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">4</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">นิติวัฒน์</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>2,922,093</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">5</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">อัจจิรา</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>2,796,594</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">6</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">ณัฐพร</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>2,748,956</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">7</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">ชญาน์รัศมิ์</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>2,674,862</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">8</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">กมลลักษณ์</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>1,869,724</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">9</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">นพปฎล</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>1,710,472</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ranking-card top-ten">
                        <div class="ranking-card-num">10</div>
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/supreme.f9c84eae.png') }}" alt="supreme">
                        </div>
                        <div class="ranking-card-name">มะนาเซ</div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>1,570,831</span>
                        </div>
                    </div>
                </div>
                <div class="ant-col ant-col-24 ranking-col" style="padding-left: 6px; padding-right: 6px;">
                    <div class="ant-divider ant-divider-horizontal" role="separator" style="margin: 16px 0px 28px;"></div>
                    <div class="ranking-card">
                        <div class="ranking-card-icon">
                            <img src="{{ asset('media/bronze.a15902f9.png') }}" alt="bronze">
                        </div>
                        <div class="ranking-card-name">
                            <div>ดอน </div>
                            <div>
                                <small>อันดับ 195,491</small>
                            </div>
                        </div>
                        <div class="ranking-card-point">
                            <img src="/icons/gif/coin.gif" alt="coin">
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection