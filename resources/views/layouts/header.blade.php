<header class="">
    <div class="bg-mkea-gray">
        <div class="d-flex px-20 py-1">
            <div class="flex-grow-1 align-self-center ms-20">
                <a class="text-mkea-primary fw-bold"
                    href="{{ url('/') }}">{{ __('Welcome to Merkea Online') }}</a>
            </div>
            <div class="d-flex flex-row me-20 fw-600">
                @guest
                    @if (Route::has('login'))
                        <a class="nav-link text-mkea-primary fw-bolder" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register'))
                        <a class="nav-link text-mkea-primary fw-bolder"
                            href="{{ route('register') }}">{{ __('Sign up') }}</a>
                    @endif
                @else
                    @role('Administrator')
                        @if (Route::has('admin.index'))
                            <a class="nav-link text-mkea-primary fw-bolder" href="{{ route('admin.index') }}">{{ __('Merkea Administrator') }}</a>
                        @endif
                    @endrole

                    <div class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-mkea-primary fw-bolder" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>
