<section class="slider__area pt-30 grey-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 custom-col-2 d-none d-xl-block">
                <div class="cat__menu-wrapper">
                    <div class="cat-toggle">
                        <button type="button" class="cat-toggle-btn"><i class="fas fa-bars"></i>
                            DEPARTAMENTOS</button>
                        <div class="cat__menu">
                            <nav id="mobile-menu">
                                <ul>
                                    @isset($categories)
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="">{{ ucwords(strtolower($category['text'])) }}
                                                    @if (isset($category['children']) && count($category['children']) > 0)
                                                        <i class="far fa-angle-down"></i>
                                                </a>

                                                <ul class="submenu">
                                                    @foreach ($category['children'] as $child)
                                                        <li>
                                                            <a href="#">{{ ucwords(strtolower($child['text'])) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                </a>
                                        @endif
                                        </li>
                                        @endforeach

                                    @endisset
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 custom-col-10 col-lg-12 hidesm">
                <div class="slider__inner slider-active">
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slider-01.jpg" alt="slider">
                    </div>
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slider-01.jpg" alt="slider">
                    </div>
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slider-01.jpg" alt="slider">
                    </div>
                </div>

            </div>


            <div class="col-xl-10 custom-col-10 col-lg-12 hidelg">
                <div class="slider__inner slider-active">
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slide1-mov.jpg" alt="slider">
                    </div>
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slide1-mov.jpg" alt="slider">
                    </div>
                    <div class="single-slider w-img">
                        <img src="store/img/slider/03/slide1-mov.jpg" alt="slider">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
