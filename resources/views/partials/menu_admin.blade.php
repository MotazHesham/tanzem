<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        {{-- <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li> --}}
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('governmental_entity_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.governmental-entities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/governmental-entities") || request()->is("admin/governmental-entities/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-app-store-ios c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.governmentalEntity.title') }}
                </a>
            </li>
        @endcan
        @can('client_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.client.title') }}
                </a>
            </li>
        @endcan
        @can('companies_and_institution_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.companies-and-institutions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/companies-and-institutions") || request()->is("admin/companies-and-institutions/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-building c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.companiesAndInstitution.title') }}
                </a>
            </li>
        @endcan
        @can('cawader_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.cawaders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cawaders") || request()->is("admin/cawaders/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-astronaut c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.cawader.title') }}
                </a>
            </li>
        @endcan
        @can('event_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/events*") ? "c-show" : "" }} {{ request()->is("admin/brands*") ? "c-show" : "" }} {{ request()->is("admin/visitors*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.eventManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('event_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-camera-retro c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.event.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('brand_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.brands.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-braille c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.brand.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('visitor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.visitors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/visitors") || request()->is("admin/visitors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.visitor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('gate_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.gates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/gates") || request()->is("admin/gates/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-door-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.gate.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('general_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/specializations*") ? "c-show" : "" }} {{ request()->is("admin/cities*") ? "c-show" : "" }} {{ request()->is("admin/gates*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.generalSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('specialization_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.specializations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/specializations") || request()->is("admin/specializations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.specialization.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('break_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.break-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/break-types") || request()->is("admin/break-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-coffee c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.breakType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.setting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('said_about_tanzem_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.said-about-tanzems.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/said-about-tanzems") || request()->is("admin/said-about-tanzems/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-rev c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.saidAboutTanzem.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contactu_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contactus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contactus") || request()->is("admin/contactus/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-toolbox c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactu.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('news_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.news.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/news") || request()->is("admin/news/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-newspaper c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.news.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('subscription_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.subscriptions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/subscriptions") || request()->is("admin/subscriptions/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.subscription.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('important_link_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.important-links.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/important-links") || request()->is("admin/important-links/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-external-link-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.importantLink.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        {{-- @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif --}}
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>