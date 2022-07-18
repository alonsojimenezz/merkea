<section class="contact__area box-plr-90 pt-55 pb-100">
    <div class="container-fluid">
        <div class="row">
            @foreach ($branches_global as $branch)
                <div class="col-xxl-4 col-xl-4 col-lg-5">
                    {!! $branch->Frame !!}
                    <div class="contact__info">
                        <h3 class="contact__title">{{ $branch->Name }}</h3>
                        <p class="contact__text">{{ $branch->Address }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
