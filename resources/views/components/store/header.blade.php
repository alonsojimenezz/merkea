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
                                    <a href="index.html"><img src="store/img/logo/logo.svg" alt="logo"
                                            class="merkea"></a>
                                </div>
                                <div class="header__hotline align-items-center d-none d-sm-flex  d-lg-none d-xl-flex">

                                    <div class="header__hotline-icon">
                                        <img src="store/img/whatsapp.svg" style="width: 50px;">
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
                                            <input type="text" placeholder="Busca tus productos favoritos...">
                                            <button type="submit">Buscar</button>
                                        </div>
                                        <div class="header__search-cat">
                                            <select>
                                                <option>{{ __('All Categories') }}</option>
                                                @isset($categories)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->Id }}">{{ $category->Name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="cart__mini-wrapper d-none d-md-flex f-right p-relative">
                                    <a href="javascript:void(0);" class="cart__toggle">
                                        <span class="cart__total-item">01</span>
                                    </a>
                                    <span class="cart__content">
                                        <span class="cart__my">Carrito:</span>
                                        <span class="cart__total-price">$ 255.00</span>
                                    </span>
                                    <div class="cart__mini">
                                        <div class="cart__close"><button type="button" class="cart__close-btn"><i
                                                    class="fal fa-times"></i></button></div>
                                        <ul>
                                            <li>
                                                <div class="cart__title">
                                                    <h4>Carrito</h4>
                                                    <span>(1 elemento en el carrito)</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="cart__item d-flex justify-content-between align-items-center">
                                                    <div class="cart__inner d-flex">
                                                        <div class="cart__thumb">
                                                            <a href="product-details.html">
                                                                <img src="store/img/shop/product/cart/cart-mini-1.jpg"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="cart__details">
                                                            <h6><a href="product-details.html"> Samsung C49J89: £875,
                                                                    Debenhams Plus </a></h6>
                                                            <div class="cart__price">
                                                                <span>$255.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart__del">
                                                        <a href="#"><i class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="cart__sub d-flex justify-content-between align-items-center">
                                                    <h6>Subtotal</h6>
                                                    <span class="cart__sub-total">$255.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="checkout.html" class="t-y-btn w-100 mb-10">Proceder al pago</a>
                                                <a href="cart.html" class="t-y-btn t-y-btn-border w-100 mb-10">Ver
                                                    carrito</a>
                                            </li>
                                        </ul>
                                    </div>
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
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-6 col-6">
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
                                                <a
                                                    href="{{ Route::has('store.home') ? route('store.home') : '#' }}">{{ __('Home') }}
                                                    <i class="far fa-home"></i></a>

                                            </li>
                                            <li><a href="#">{{ __('Products') }} <i class="far fa-store"></i></a>
                                                <ul class="submenu">
                                                    @isset($categories)
                                                        @foreach ($categories as $category)
                                                            <li><a href="#">{{ __($category->Name) }}</a></li>
                                                        @endforeach
                                                    @endisset
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">{{ __('Branch Offices') }} <i
                                                        class="far fa-location"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"> <i class="far fa-phone"></i></a>
                                            </li>
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
