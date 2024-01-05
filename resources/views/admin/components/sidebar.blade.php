@php
use App\Library\Helper;
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users') }}">
                <i class="fas fa-user-tie menu-icon"></i>
                <span class="menu-title">Members</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news">
                <i class="fa-solid fa-chart-line menu-icon"></i>
                <span class="menu-title">News</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="news">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.news.articles') }}">All Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.categories') }}">Categories</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('public.home') }}">
                <i class="fas fa-globe menu-icon"></i>
                <span class="menu-title">Web</span>
            </a>
        </li>
    </ul>
</nav>
