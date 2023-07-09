<div class="container-fluid d-flex align-items-center justify-content-between">

    <a href="{{ route('landing') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Bersama</h1>
    </a>

    <nav id="navbar" class="navbar">
        @include('partials.frontend.navbar')
    </nav><!-- .navbar -->

    <div>
        <ul class="navbar-nav d-flex flex-row me-1">
            @guest
                <div class='row'>
                    @if (Route::has('login'))
                        <div class="col-sm">
                            <a class="btn-getstarted d-flex" href="{{ route('login') }}">Bergabunglah!</a>
                        </div>
                    @endif
                    {{-- 
                    @if (Route::has('register'))
                        <div class="col-sm">
                            <a class="btn-getstarted d-flex" href="{{ route('register') }}">register</a>
                        </div>
                </div>
                @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
        </ul>
    </div>

</div>
