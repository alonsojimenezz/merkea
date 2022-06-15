<div class="product__filter mb-50">
    <div class="row align-items-center">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
            <div class="product__filter-left d-sm-flex align-items-center">
                <div class="product__col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="FourCol-tab" data-bs-toggle="tab"
                                data-bs-target="#FourCol" type="button" role="tab" aria-controls="FourCol"
                                aria-selected="true">
                                <i class="fal fa-border-all"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list"
                                type="button" role="tab" aria-controls="list" aria-selected="false">
                                <i class="fal fa-list"></i>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="product__result pl-60">
                    <p>{{ __('Showing') }}
                        {{ $products['offset'] + 1 }}-{{ $products['offset'] + $products['limit'] > $products['totals'] ? $products['totals'] : $products['offset'] + $products['limit'] }}
                        {{ __('of') }} {{ $products['totals'] }}
                        {{ __('results') }}</p>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
            <div class="product__filter-right d-flex align-items-center justify-content-md-end">
                <div class="product__sorting product__show-no">
                    <input type="hidden" id="result_page" value="{{ $products['page'] ?? 1 }}">
                    <select id="result_limit">
                        <option value="12" {{ $products['limit'] == 12 ? 'selected' : '' }}>12</option>
                        <option value="24" {{ $products['limit'] == 24 ? 'selected' : '' }}>24</option>
                        <option value="36" {{ $products['limit'] == 36 ? 'selected' : '' }}>36</option>
                        <option value="48" {{ $products['limit'] == 48 ? 'selected' : '' }}>48</option>
                    </select>
                </div>
                <div class="product__sorting product__show-position ml-20">
                    <select id="result_sort">
                        <option data-sort="name" data-direction="asc"
                            {{ $products['order'] == 'p.Name' && $products['orderDirection'] == 'asc' ? 'selected' : '' }}>
                            {{ __('Product Name') }}</option>
                        <option data-sort="price" data-direction="asc"
                            {{ $products['order'] == 'pp.BasePrice' && $products['orderDirection'] == 'asc' ? 'selected' : '' }}>
                            {{ __('Lower Price') }}</option>
                        <option data-sort="price" data-direction="desc"
                            {{ $products['order'] == 'pp.BasePrice' && $products['orderDirection'] == 'desc' ? 'selected' : '' }}>
                            {{ __('Higher Price') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
