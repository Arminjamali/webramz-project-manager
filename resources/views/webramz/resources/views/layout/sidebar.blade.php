@php use Illuminate\Routing\Route; @endphp


<div id="layoutSidenav_nav">
    <nav class="snav shadow-right snav-light">
        <div class="snav-menu">
            <div class="nav accordion" id="accordionSidenav">


                <div class="snav-menu-heading d-sm-none">حساب کاربری</div>

                <!-- اعلان ها -->
                <a class="nav-link d-sm-none" href="#">
                    <div class="nav-link-icon"><i class="bx bx-bell "></i></div>
                    اعلان ها
                    <span class="badge bg-warning-soft text-warning ms-auto">4 جدید!</span>
                </a>

                <!-- پیام ها -->
                <a class="nav-link d-sm-none" href="#">
                    <div class="nav-link-icon"><i class="bx bx-envelope"></i></div>
                    پیام ها
                    <span class="badge bg-success-soft text-success ms-auto">2 جدید!</span>
                </a>


                <div class="snav-menu-heading">هسته</div>
                <a class="nav-link pt-0" href="{{route('home')}}">
                    <div class="nav-link-icon"><i class='bx bx-layout'  ></i> </div>
                    داشبورد
                </a>
                <div class="snav-menu-heading">شهید</div>
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><i class='bx bxs-florist'  ></i></div>
                    شهدا
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="{{route('shahid.create')}}">
                            ایجاد شهید
                            <span class="badge bg-primary-soft text-primary ms-auto">بروز شده</span>
                        </a>
                        <a class="nav-link" href="{{route('shahid.create')}}">لیست شهدا</a>
                        <a class="nav-link" href="dashboard-affiliate.html">بارگزاری</a>
                    </nav>
                </div>

                <div class="snav-menu-heading">کاربران</div>
                <!-- برگه ها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="bx bxs-user"></i></div>
                    کاربران
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">


                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">


                        <a class="nav-link" href="{{route('user.index')}}">لیست کاربران</a>
                        <a class="nav-link" href="{{route('user.create')}}"> کاربر جدید</a>
                    </nav>
                </div>


            </div>
        </div>
    </nav>
</div>

<div id="layoutSidenav_nav">
    <nav class="snav shadow-right snav-light">
        <div class="snav-menu">
            <div class="nav accordion" id="accordionSidenav">

                <div class="snav-menu-heading d-sm-none">حساب کاربری</div>

                <a class="nav-link d-sm-none" href="#">
                    <div class="nav-link-icon"><i class="bx bx-bell"></i></div>
                    اعلان ها
                    <span class="badge bg-warning-soft text-warning ms-auto">4 جدید!</span>
                </a>

                <a class="nav-link d-sm-none" href="#">
                    <div class="nav-link-icon"><i class="bx bx-envelope"></i></div>
                    پیام ها
                    <span class="badge bg-success-soft text-success ms-auto">2 جدید!</span>
                </a>

                <div class="snav-menu-heading">هسته</div>

                <a class="nav-link pt-0 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <div class="nav-link-icon"><i class='bx bx-layout'></i></div>
                    داشبورد
                </a>

                <div class="snav-menu-heading">شهید</div>

                <a class="nav-link {{ request()->routeIs('shahid.*') ? '' : 'collapsed' }}"
                   href="javascript:void(0);"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseDashboards"
                   aria-expanded="{{ request()->routeIs('shahid.*') ? 'true' : 'false' }}"
                   aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><i class='bx bxs-florist'></i></div>
                    شهدا
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>

                <div class="collapse {{ request()->routeIs('shahid.*') ? 'show' : '' }}" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link {{ request()->routeIs('shahid.create') ? 'active' : '' }}" href="{{ route('shahid.create') }}">
                            ایجاد شهید
                        </a>
                        <a class="nav-link {{ request()->routeIs('shahid.index') ? 'active' : '' }}" href="{{ route('shahid.index') }}">
                            لیست شهدا
                        </a>
                        <a class="nav-link" href="#">بارگذاری</a>
                    </nav>
                </div>

                <div class="snav-menu-heading">کاربران</div>

                <a class="nav-link {{ request()->routeIs('user.*') ? '' : 'collapsed' }}"
                   href="javascript:void(0);"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapsePages"
                   aria-expanded="{{ request()->routeIs('user.*') ? 'true' : 'false' }}"
                   aria-controls="collapsePages">
                    <div class="nav-link-icon"><i class="bx bxs-user"></i></div>
                    کاربران
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>

                <div class="collapse {{ request()->routeIs('user.*') ? 'show' : '' }}" id="collapsePages" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">
                            لیست کاربران
                        </a>
                        <a class="nav-link {{ request()->routeIs('user.create') ? 'active' : '' }}" href="{{ route('user.create') }}">
                            کاربر جدید
                        </a>
                    </nav>
                </div>

            </div>
        </div>
    </nav>
</div>
