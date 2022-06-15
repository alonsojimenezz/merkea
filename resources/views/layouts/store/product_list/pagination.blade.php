<div class="row">
    <div class="col-xxl-12">
        <div class="basic-pagination pt-30 pb-30">
            <nav>
                <ul>
                    @if ($products['page'] > 1)
                        <li>
                            <a class="pagination_button_previous">
                                <i class="fal fa-chevron-double-left"></i>
                            </a>
                        </li>
                    @endif
                    @for ($i = 1; $i <= $products['total_pages']; $i++)
                        <li>
                            <a role="button" data-page="{{ $i }}"
                                class="pagination_button {{ $products['page'] == $i ? 'active' : '' }}">{{ $i }}</a>
                        </li>
                    @endfor
                    @if ($products['page'] < $products['total_pages'] && $products['total_pages'] > 1)
                        <li>
                            <a class="pagination_button_next">
                                <i class="fal fa-chevron-double-right"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
