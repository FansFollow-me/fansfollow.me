<!--------- Header area start --------->
    <header class="header__area">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo__main">
                    @php($homeUrl = '/')
                    <a href="{{ $homeUrl }}"><img src="/assets/img/logo-main.svg" alt=""></a>
                </div>
                <div class="header__right">
                    <!--onclick="location.href='{{$settings->home_style == 0 ? url('login') : url('/')}}';"-->
                    	@guest
                    <button class="common__btn active login" id="modal-1" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                        login
                    </button>
                     <!--onclick="location.href='{{$settings->home_style == 0 ? url('signup') : url('/')}}';"-->
                    @if ($settings->registration_active == '1')
                    <button class="common__btn" id="modal-3" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        creator signup
                    </button>
                    @endif
                    <!--<button class="common__btn" id="modal-3" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        fan signup
                    </button>-->
                    @endguest
                </div>
            </div>
        </div>
    </header>
    <!--------- Header area end --------->
