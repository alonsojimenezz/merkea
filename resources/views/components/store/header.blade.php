<header>
    <div class="header__area">
        <div class="header__top d-none d-sm-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-5 d-none d-md-block">
                        <div class="header__welcome">
                            <span>Bienvenido a Merkea en línea </span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-7">
                        <div class="header__action d-flex justify-content-center justify-content-md-end">
                            <ul>
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">{{ __('Sign up') }}</a></li>
                                    @endif
                                @else
                                    @hasanyrole('Administrator|Staff')
                                        @if (Route::has('admin.index'))
                                            <li><a href="{{ route('admin.index') }}">{{ __('Merkea Administrator') }}</a>
                                            </li>
                                        @endif
                                    @endhasanyrole
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (isset($show_search) && $show_search == true)
            <div class="header__info">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-3">
                            <div
                                class="header__info-left d-flex justify-content-center justify-content-sm-between align-items-center">
                                <div class="logo">
                                    <a href="/"><img src="/store/img/logo/logo.svg" alt="logo"
                                            class="merkea"></a>
                                </div>
                                <div class="header__hotline align-items-center d-none d-sm-flex  d-lg-none d-xl-flex">

                                    <div class="header__hotline-icon">
                                        <img src="/store/img/whatsapp.svg" style="width: 50px;">
                                    </div>
                                    <div class="header__hotline-info">
                                        <a href="https://wa.me/+525510562027"><span>Contáctanos</span>
                                            <h6>55 1056-2027</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-9">
                            <div class="header__info-right">
                                <div class="header__search f-left d-none d-sm-block">
                                    <form action="#">
                                        <div class="header__search-box">
                                            <input type="text" id="search_text" style="text-align:right;"
                                                placeholder="{{ __('Find your favorite products...') }}"
                                                value="{{ isset($products['search']) ? mb_strtoupper($products['search']) : '' }}">
                                            <button id="search_button">Buscar</button>
                                        </div>
                                        <div class="header__search-cat">
                                            <select id="search_department">
                                                <option value="0">{{ __('All Categories') }}</option>
                                                @isset($categories)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category['id'] }}"
                                                            {{ isset($products['department']) && $products['department'] == $category['id'] ? 'selected' : '' }}>
                                                            {{ $category['text'] }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="cart__mini-wrapper d-none d-md-flex f-right p-relative">
                                    @include('layouts.store.cart_mini')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="header__bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="header__bottom-left d-flex d-xl-block align-items-center">
                            <div class="side-menu d-xl-none mr-20">
                                <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i
                                        class="fas fa-bars"></i></button>
                            </div>
                            @if (isset($show_menu) && $show_menu == true)
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="{{ Route::has('store.home') ? route('store.home') : '#' }}">{{ __('Home') }}
                                                    <i class="ms-1 far fa-home"></i></a>

                                            </li>
                                            <li><a href="#">{{ __('Products') }} <i
                                                        class="far fa-store"></i></a>
                                                @isset($categories)
                                                    <ul class="submenu">
                                                        @foreach ($categories as $category)
                                                            <li>
                                                                <a href="#">{{ ucwords(strtolower($category['text'])) }}
                                                                    <i class="far fa-angle-down"></i>
                                                                </a>

                                                                <ul class="submenu">
                                                                    @foreach ($category['children'] as $child)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('store.category', $child['slug']) }}">{{ ucwords(strtolower($child['text'])) }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endisset
                                            </li>
                                            <li>
                                                <a href="#">{{ __('Branch Offices') }} <i
                                                        class="ms-1 far fa-location"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"> {{ __('Contact') }}<i
                                                        class="ms-1 far fa-phone"></i></a>
                                            </li>
                                            @isset($branches)
                                                <li class="float-end">
                                                    @if (count($branches) < 2)
                                                        <a>{{ $branches[0]->Name }}</a>
                                                    @else
                                                        <a role="button">
                                                            @foreach ($branches as $branch)
                                                                {{ $branch->Id == $bid ? $branch->Name : '' }}
                                                            @endforeach
                                                            <i class="far fa-angle-down"></i>
                                                        </a>
                                                        <ul class="submenu">
                                                            @foreach ($branches as $branch)
                                                                <li>
                                                                    <a role="button" class="header_branch_select"
                                                                        data-branch="{{ $branch->Id }}">{{ $branch->Name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endisset
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
