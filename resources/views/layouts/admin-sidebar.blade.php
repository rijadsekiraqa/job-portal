<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><img
                            src="{{ asset('admin/assets/img/icons/dashboard.svg') }}" alt="img"><span>
                            Dashboard</span> </a>
                </li>
                @can('view-category')
                <li class="submenu">
                    <a href="javascript:void(0);"
                        class="{{ request()->routeIs('categories.index') || request()->routeIs('categories.edit') ? 'active' : '' }}">
                        <img src="{{ asset('admin/assets/img/icons/product.svg') }}" alt="img">
                        <span>Kategorite</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li> <a href="{{ route('categories.index') }}"
                                class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                Lista Kategorive
                            </a></li>
                        <li> <a href="{{ route('categories.create') }}"
                                class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                Regjistrimi i Kategorive
                            </a></li>
                    </ul>
                </li>
                @endcan
                @can('view-city')
                    <li class="submenu">
                        <a href="javascript:void(0);"
                            class="{{ request()->routeIs('cities.index') || request()->routeIs('cities.edit') ? 'active' : '' }}">
                            <img src="{{ asset('admin/assets/img/icons/city1.svg') }}" alt="img"><span> Qytetet</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li>
                                <a href="{{ route('cities.index') }}"
                                    class="{{ request()->routeIs('cities.index') ? 'active' : '' }}">
                                    Lista e Qyteteve
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cities.create') }}"
                                    class="{{ request()->routeIs('cities.create') ? 'active' : '' }}">
                                    Regjistrimi i Qyteteve
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li class="submenu">
                    <a href="javascript:void(0);"
                        class="{{ request()->routeIs('companies.index') || request()->routeIs('companies.edit') ? 'active' : '' }}">
                        <img src="{{ asset('admin/assets/img/icons/company.svg') }}" alt="img">
                        <span>Kompanite</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li> <a href="{{ route('companies.index') }}"
                                class="{{ request()->routeIs('companies.index') ? 'active' : '' }}">
                                Lista e Kompanive
                            </a></li>
                        <li> <a href="{{ route('companies.create') }}"
                                class="{{ request()->routeIs('companies.create') ? 'active' : '' }}">
                                Regjistrimi i Kompanive
                            </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"
                        class="{{ request()->routeIs('announcements.index') || request()->routeIs('announcements.show') || request()->routeIs('announcements.edit') || request()->routeIs('announcements.manage') ? 'active' : '' }}">
                        <img src="{{ asset('admin/assets/img/icons/purchase1.svg') }}"
                            alt="img"><span>Shpalljet</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li>
                            <a href="{{ route('announcements.index') }}"
                                class="{{ request()->routeIs('announcements.index') ? 'active' : '' }}">
                                Lista e Shpalljeve
                            </a>
                        </li>
                        <li> <a href="{{ route('announcements.create') }}"
                                class="{{ request()->routeIs('announcements.create') ? 'active' : '' }}">
                                Regjistrimi i Shpalljeve
                            </a></li>
                        <li> <a href="{{ route('announcements.manage') }}"
                                class="{{ request()->routeIs('announcements.manage') ? 'active' : '' }}">
                                Kerkesat e Shpalljeve
                            </a></li>
                    </ul>
                </li>
                @canAny(['view-user','view-role','view-permission'])
                <li class="submenu">
                    <a href="javascript:void(0);"
                        class="{{ request()->routeIs('users.index') || request()->routeIs('users.create') || request()->routeIs('users.edit') || request()->routeIs('role.create') || request()->routeIs('role.edit') || request()->routeIs('permission.create') || request()->routeIs('permission.edit') || request()->routeIs('userprofile') ? 'active' : '' }}">
                        <img src="{{ asset('admin/assets/img/icons/users1.svg') }}"
                            alt="img"><span>Perdoruesit</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('users.index') }}"
                                class="{{ request()->routeIs('users.index') ? 'active' : '' }}">Lista e Perdoruesve</a>
                        </li>
                        <li><a href="{{ route('role.index') }}"
                                class="{{ request()->routeIs('role.index') ? 'active' : '' }}">Lista e Roleve</a></li>
                        <li><a href="{{ route('permission.index') }}"
                                class="{{ request()->routeIs('permission.index') ? 'active' : '' }}">Lista e Lejeve</a>
                        </li>
                    </ul>
                </li>
                @endcanAny
                <li class="submenu">
                    <a href="javascript:void(0);"
                        class="{{ request()->routeIs('applications.index') ? 'active' : '' }}">
                        <img src="{{ asset('admin/assets/img/icons/applications.svg') }}"
                            alt="img"><span>Aplikimet</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('applications.index') }}"
                                class="{{ request()->routeIs('applications.index') ? 'active' : '' }}">Lista e
                                Aplikimeve</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
