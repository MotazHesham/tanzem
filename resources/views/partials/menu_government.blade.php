<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("government.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>  
        <li class="c-sidebar-nav-dropdown {{ request()->is("government/events*") ? "c-show" : "" }} {{ request()->is("government/brands*") ? "c-show" : "" }} {{ request()->is("government/visitors*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.eventManagment.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items"> 
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("government.events.index") }}" class="c-sidebar-nav-link {{ request()->is("government/events") || request()->is("government/events/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-camera-retro c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.event.title') }}
                    </a>
                </li> 
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("government.brands.index") }}" class="c-sidebar-nav-link {{ request()->is("government/brands") || request()->is("government/brands/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-braille c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.brand.title') }}
                    </a>
                </li> 
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("government.visitors.index") }}" class="c-sidebar-nav-link {{ request()->is("government/visitors") || request()->is("government/visitors/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.visitor.title') }}
                    </a>
                </li>  
            </ul>
        </li> 
        <li class="c-sidebar-nav-item">
            <a href="{{ route("government.news.index") }}" class="c-sidebar-nav-link {{ request()->is("government/news") || request()->is("government/news/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-newspaper c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.news.title') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>