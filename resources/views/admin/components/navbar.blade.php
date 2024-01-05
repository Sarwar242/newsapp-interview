@php
$auth_user = auth()->user();
@endphp

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('home.dashboard') }}"><img
                src="{{ Vite::asset(\App\Library\Enum::LOGO2_PATH) }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home.dashboard') }}"><img
                src="{{ Vite::asset(\App\Library\Enum::LOGO2_PATH) }}"
                alt="logo" /></a>
    </div>
    <div class="welcome-text-sm" style="width: 50%;text-align: center;">
        <span style="color: #14886D;font-size: 16px;">Welcome! {{ $auth_user?->full_name }}</span>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-4">

        </ul>

        <div class="welcome-text" style="width: 50%;text-align: right;">
            <span style="color: #14886D;font-size: 16px;">Welcome! {{ $auth_user?->full_name }}</span>
        </div>

        <ul class="navbar-nav navbar-nav-right">
            {{-- <li class="nav-item nav-profile">
                <a href="{{ url('/') }}" target="_blank" class="navbar-toggler navbar-toggler align-self-center mx-2">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </li> --}}
            <li class="nav-item nav-profile">
                <a href="{{ url('/panel/clear-cache') }}"
                    class="align-self-center btn p-1 px-2 btn2-secondary text-white"><i
                        class="fa-solid fa-broom"></i> </a>
            </li>



            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                <img src="{{ $auth_user ? $auth_user->getAvatar() : Vite::asset(\App\Library\Enum::NO_AVATAR_PATH) }}"
                        alt="{{ $auth_user?->full_name }}" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
