<!-- offcanvas area start -->
<div class="offcanvas__area">
    <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn" id="offcanvas__close-btn">
                <i class="fal fa-times"></i>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__logo mb-40">
                <a href="index.html">
                    <img src="store/img/logo/logo.svg" alt="logo" width="130px">
                </a>
            </div>
            <div class="offcanvas__search mb-25">
                <form action="#">
                    <input type="text" id="search_text_m" placeholder="{{ __('What are you looking for?') }}">
                    <button id="search_button_m" type="submit"><i class="far fa-search"></i></button>
                </form>
            </div>
            {{-- <div class="mobile-menu fix"></div> --}}
            <div class="offcanvas__action">

            </div>
            <div class="fix">
                <nav>
                    <ul>
                        @guest
                            @if (Route::has('login'))
                                <li class="position-relative float-start w-100">
                                    <a class="mobile_menu" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="position-relative float-start w-100">
                                    <a class="mobile_menu" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                </li>
                            @endif
                        @else
                            @hasanyrole('Administrator|Staff')
                                @if (Route::has('admin.index'))
                                    <li class="position-relative float-start w-100">
                                        <a class="mobile_menu"
                                            href="{{ route('admin.index') }}">{{ __('Merkea Administrator') }}</a>
                                    </li>
                                @endif
                            @endhasanyrole
                            <li class="position-relative float-start w-100">
                                <a class="mobile_menu" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas area end -->
<div class="body-overlay"></div>
<!-- offcanvas area end -->
