<footer>
    <div class="footer__area footer-bg">
        <div class="container" style="margin-top: 30px;margin-bottom: 10px;">

            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 hidesm">
                    <div class="footer__widget" style="margin:0px 0px;">
                        <div class="footer__widget-title">
                            <div class="footer__logo">
                                <a href="index.html"><img src="store/img/logo/logo.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="footer__widget-content">
                        <div class="footer__hotline d-flex align-items-center">
                            <div class="icon mr-15">
                                <img src="store/img/whatsapp.svg" style="width: 50px;">
                            </div>
                            <div class="text">
                                <a href="https://wa.me/+525510562027"><span>Contáctanos</span>
                                    <h2 style="color:#9da3af;">55 1056-2027</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer__info">
                        <ul>
                            <li>

                            <li><span style="color:#9da3af;"><strong>Email:</strong> <a
                                        href="mailto:info@merkeaminimarket.com">info@merkeaminimarket.com</a>
                                </span></li>
                            <li><span style="color:#9da3af;"><strong>Phone:</strong> <a href="tel:5510562027">55
                                        1056-2027</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="footer__bottom " style="padding: 5px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="footer__links text-center">
                        <p>
                            @isset($categories)
                                @foreach($categories as $category)
                                    <a href="{{ route('store.category', $category->slug) }}">{{ $category->name }}</a>
                                @endforeach
                            @endisset
                            <a href="#">Despensa</a>
                            <a href="#">Pan y tortillas</a>
                            <a href="#">Cerveza, vinos y licores</a>
                            <a href="#">Congelados</a>
                            <a href="#">Salchichonería</a>
                            <a href="#">Lácteos y huevo</a>
                            <a href="#">Granel</a>
                            <a href="#">Frutas y verduras</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright footer-bottom-bg" style="padding: 5px 0px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="footer__copyright-text">
                        <p>Copyright © <a href="index.html">Merkea.</a> Todos los derechos reservador. Sitio
                            diseñado por <a href="https://3clue.com">3CLUE.</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</footer>
