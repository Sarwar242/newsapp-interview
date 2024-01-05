
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.home.dashboard') }}"><img
                src="{{ settings('logo') ? asset(settings('logo')) : Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home.dashboard') }}"><img
                src="{{ settings('logo') ? asset(settings('logo')) : Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}"
                alt="logo" /></a>
    </div>
    <div class="welcome-text-sm" style="width: 50%;text-align: center;">
        <span style="color: #14886D;font-size: 16px;">Welcome! </span>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <div class="welcome-text" style="width: 100%; text-align: center; margin-left: -125px;">
            <span style="color: #14886D;font-size: 16px;">Welcome! </span>
        </div>

        <ul class="navbar-nav navbar-nav-right">

        </ul>

    </div>
</nav>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>
