<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header justify-content-between">

        <div>
            <img src="{{ asset('admin_dashboard/assets/images/logo.png')}}" width="60"  />
        </div>
        <div class="toggle-icon "> <i class="bi bi-list"></i>
        </div>

    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard')  }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">@lang('text.Home')</div>
            </a>
        </li>



        @foreach($menuData as $menu)
            @if(count($menu->children) > 0)
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="{{$menu->icon}}"></i>
                        </div>
                        <div class="menu-title">@lang('text.'.$menu->route_name.'-index')</div>
                    </a>
                    <ul>
                        @can($menu->route_name.'-index')
                        <li> <a href="{{ route($menu->route_name.'.index')  }}"><i class="{{$menu->icon}}"></i>@lang('text.'.$menu->route_name.'-index')</a>
                        </li>
                        @endcan
                        @foreach($menu->children as $child)
                            @can($child->route_name.'-index')
                                <li> <a href="{{ route($child->route_name.'.index')  }}"><i class="{{$child->icon}}"></i>@lang('text.'.$child->route_name.'-index')</a>
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </li>
            @else
                @can($menu->route_name.'-index')
                <li>
                    <a href="{{ route($menu->route_name.'.index')  }}">
                        <div class="parent-icon"><i class="{{$menu->icon}}"></i>
                        </div>
                        <div class="menu-title">@lang('text.'.$menu->route_name.'-index')</div>
                    </a>
                </li>
                @endcan
            @endif
        @endforeach




    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
