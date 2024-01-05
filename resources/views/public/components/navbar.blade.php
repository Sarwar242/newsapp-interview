@php $auth_user=auth()->user();
$categories = App\Models\Category::latest()->get();
 @endphp
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('public.home') }}"><img
                src="{{ Vite::asset(\App\Library\Enum::LOGO2_PATH) }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('public.home') }}"><img
                src="{{ Vite::asset(\App\Library\Enum::LOGO2_PATH) }}"
                alt="logo" /></a>
    </div>

    <div class="welcome-text-sm" style="text-align: center;">
        <span style="color: #14886D;font-size: 16px;">Welcome to News APP! </span>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <div class="welcome-text" style="width: 100%; text-align: center; margin-left: -125px;">
            <span style="color: #14886D;font-size: 16px;">Welcome to News APP! </span>
        </div>

        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <strong> Categories </strong>
        </a>
        @if($categories?->count()>0)
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="navbarDropdownMenuLink">
            @foreach($categories as $category)
            <a class="dropdown-item" href="{{URL::to('category/'.$category->id )}}">{{$category->name}}</a>
            @endforeach
        </div>
        @endif
      </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                <img src="{{ $auth_user ? $auth_user->getAvatar() : Vite::asset(\App\Library\Enum::NO_AVATAR_PATH) }}"
                        alt="{{ $auth_user?->full_name }}" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                @auth
                    <a class="dropdown-item" href="{{ route('home.dashboard') }}">
                        <i class="fas fa-user"></i>
                        Dashboard
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                @else
                    <a class="dropdown-item" href="{{ route('login') }}">
                        <i class="fas fa-user"></i>
                        Login
                    </a>
                    <a class="dropdown-item" href="{{ route('register') }}">
                        <i class="fas fa-user"></i>
                        Register
                    </a>
                @endauth
                </div>
            </li>
        </ul>

    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
