    <!-- product area start -->
    <section class="product__area box-plr-75 pb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 order-first order-lg-last">
                    <div class="product__grid-wrapper">
                        <div class="product__grid-item-wrapper">
                            @include('layouts.store.product_list.filter_product_list')
                            @include('layouts.store.product_list.product_grid')
                            @include('layouts.store.product_list.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->


    <!-- back to top btn area start -->
    <section class="back-btn-top">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-12">
                    <div id="scroll" class="back-to-top-btn text-center">
                        <a href="javascript:void(0);">back to top</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- back to top btn area end -->
