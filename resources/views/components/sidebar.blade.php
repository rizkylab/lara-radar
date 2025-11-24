<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <h4 class="mb-0">
                            <i class="bi bi-shield-check text-primary"></i>
                            <span class="text-primary">Lara</span>Radar
                        </h4>
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard ASM</span>
                    </a>
                </li>

                <li class="sidebar-title">Attack Surface</li>

                <li class="sidebar-item {{ request()->routeIs('domains.*') ? 'active' : '' }}">
                    <a href="{{ route('domains.index') }}" class='sidebar-link'>
                        <i class="bi bi-globe"></i>
                        <span>Domains</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('subdomains.*') ? 'active' : '' }}">
                    <a href="{{ route('subdomains.index') }}" class='sidebar-link'>
                        <i class="bi bi-diagram-3"></i>
                        <span>Subdomains</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('ports.*') ? 'active' : '' }}">
                    <a href="{{ route('ports.index') }}" class='sidebar-link'>
                        <i class="bi bi-ethernet"></i>
                        <span>Open Ports</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('tech-stack.*') ? 'active' : '' }}">
                    <a href="{{ route('tech-stack.index') }}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Tech Stack</span>
                    </a>
                </li>

                <li class="sidebar-title">Threat Intelligence</li>

                <li class="sidebar-item {{ request()->routeIs('vulnerabilities.*') ? 'active' : '' }}">
                    <a href="{{ route('vulnerabilities.index') }}" class='sidebar-link'>
                        <i class="bi bi-bug-fill"></i>
                        <span>Vulnerabilities</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('cve.*') ? 'active' : '' }}">
                    <a href="{{ route('cve.index') }}" class='sidebar-link'>
                        <i class="bi bi-shield-exclamation"></i>
                        <span>CVE Intelligence</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('darkweb.*') ? 'active' : '' }}">
                    <a href="{{ route('darkweb.index') }}" class='sidebar-link'>
                        <i class="bi bi-incognito"></i>
                        <span>Dark Web Monitoring</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('botnet.*') ? 'active' : '' }}">
                    <a href="{{ route('botnet.index') }}" class='sidebar-link'>
                        <i class="bi bi-hdd-network"></i>
                        <span>Botnet Data</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('pii.*') ? 'active' : '' }}">
                    <a href="{{ route('pii.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-badge"></i>
                        <span>PII Exposure</span>
                    </a>
                </li>

                <li class="sidebar-title">Operations</li>

                <li class="sidebar-item {{ request()->routeIs('threat-hunting.*') ? 'active' : '' }}">
                    <a href="{{ route('threat-hunting.index') }}" class='sidebar-link'>
                        <i class="bi bi-search"></i>
                        <span>Threat Hunting</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('alerts.*') ? 'active' : '' }}">
                    <a href="{{ route('alerts.index') }}" class='sidebar-link'>
                        <i class="bi bi-bell-fill"></i>
                        <span>Alert Center</span>
                        @if(isset($unreadAlerts) && $unreadAlerts > 0)
                        <span class="badge bg-danger">{{ $unreadAlerts }}</span>
                        @endif
                    </a>
                </li>

                <li class="sidebar-title">Administration</li>

                <li class="sidebar-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Users & Roles</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}">
                    <a href="{{ route('audit-logs.index') }}" class='sidebar-link'>
                        <i class="bi bi-journal-text"></i>
                        <span>Audit Logs</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
