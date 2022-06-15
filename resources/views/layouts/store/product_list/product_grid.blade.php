<div class="tab-content" id="productGridTabContent">
    <div class="tab-pane fade show active" id="FourCol" role="tabpanel" aria-labelledby="FourCol-tab">
        <div class="row">
            @foreach ($products['products'] as $p)
                @component('components.store.product.product_grid_item', ['p' => $p])
                @endcomponent
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
        <div class="row">
            <div class="col-xxl-12">
                @foreach ($products['products'] as $p)
                    @component('components.store.product.product_list_item', ['p' => $p])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
</div>
