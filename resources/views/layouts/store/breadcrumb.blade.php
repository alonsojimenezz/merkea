<section class="breadcrumb__area box-plr-75 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pt-5 pb-0">
                            @php
                                $parent = $breadcrumbs;
                                $hasChild = isset($breadcrumbs['child']) && count($breadcrumbs['child']) > 0;
                            @endphp
                            <li class="breadcrumb-item"><a
                                    href="{{ $breadcrumbs['url'] }}">{{ ucwords(mb_strtolower($breadcrumbs['text'])) }}</a>
                            </li>
                            @while ($hasChild)
                                @php
                                    $parent = $parent['child'];
                                    $hasChild = isset($parent['child']) && count($parent['child']) > 0;
                                @endphp
                                @if ($hasChild)
                                    <li class="breadcrumb-item"><a
                                            href="{{ $parent['url'] }}">{{ ucwords(mb_strtolower($parent['text'])) }}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ ucwords(mb_strtolower($parent['text'])) }}</li>
                                @endif
                            @endwhile
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
