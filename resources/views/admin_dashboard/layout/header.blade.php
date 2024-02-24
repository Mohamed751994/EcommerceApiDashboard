<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-icon fs-3">
            <i class="bi bi-list"></i>
        </div>


        <div class="top-navbar-right ms-auto">

            <ul class="navbar-nav align-items-center">
                <li class="mx-3">
                    <select class="form-control form-select" onchange="location.href=$(this).val()">
                        @foreach($languages as $lang)
                            <option @selected($lang->code == session()->get('locale')) value="{{route('switch-language',$lang->code)}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                </li>
{{--                <li class="nav-item dropdown dropdown-large">--}}
{{--                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">--}}
{{--                        <div class="notifications mt-2">--}}
{{--                            <span class="notify-badge">0</span>--}}
{{--                            <i class="bi bi-bell-fill"></i>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end p-0">--}}
{{--                        <div class="p-2 border-bottom m-2">--}}
{{--                            <h5 class="h5 mb-0"> @lang('text.Notifications')  </h5>--}}
{{--                        </div>--}}
{{--                        <div class="header-notifications-list p-2">--}}

{{--                            <div class="no_notifications text-center">--}}
{{--                                <strong class="mt-3"><i class="bi bi-bell"></i></strong>--}}
{{--                                <h6> @lang('text.NoNotifications')</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="p-2">--}}
{{--                            <div><hr class="dropdown-divider"></div>--}}
{{--                            <a class="dropdown-item" href="#">--}}
{{--                                <div class="text-center"> @lang('text.AllNotifications')</div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
            </ul>
        </div>
        <div class="dropdown dropdown-user-setting">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-3">
                    <i class="lni lni-user avatarHeader"></i>
                    <div class="d-none d-sm-block">
                        <p class="user-name mb-0">{{auth()->user()->name}}</p>
                        <small class="mb-0 dropdown-user-designation">{{auth()->user()->type}}</small>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{route('admin.userProfile')}}">
                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-person-fill"></i></div>
                            <div class="ms-3"><span>@lang('text.Profile') </span></div>
                        </div>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item" href="{{ route('logout_admin') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-lock-fill"></i></div>
                            <div class="ms-3"><span>@lang('text.Logout')</span></div>
                        </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout_admin') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--end top header-->
