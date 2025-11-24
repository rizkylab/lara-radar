<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <i class="fas fa-shield-alt nav-icon" style="margin-left:10px;color:#fff;"></i>
        <span class="brand-text font-weight-light">LaraRadar</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard ASM</p>
                    </a>
                </li>
                <li class="nav-header">ATTACK SURFACE</li>
                <li class="nav-item">
                    <a href="{{ route('domains.index') }}" class="nav-link {{ request()->routeIs('domains.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Domains</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subdomains.index') }}" class="nav-link {{ request()->routeIs('subdomains.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>Subdomains</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ports.index') }}" class="nav-link {{ request()->routeIs('ports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>Open Ports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tech-stack.index') }}" class="nav-link {{ request()->routeIs('tech-stack.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Tech Stack</p>
                    </a>
                </li>
                <li class="nav-header">THREAT INTELLIGENCE</li>
                <li class="nav-item">
                    <a href="{{ route('vulnerabilities.index') }}" class="nav-link {{ request()->routeIs('vulnerabilities.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bug"></i>
                        <p>Vulnerabilities</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cve.index') }}" class="nav-link {{ request()->routeIs('cve.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shield-virus"></i>
                        <p>CVE Intelligence</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('darkweb.index') }}" class="nav-link {{ request()->routeIs('darkweb.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-secret"></i>
                        <p>Dark Web Monitoring</p>
                    </a>
                </li>
                <li class="nav-header">OPERATIONS</li>
                <li class="nav-item">
                    <a href="{{ route('botnet.index') }}" class="nav-link {{ request()->routeIs('botnet.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-server"></i>
                        <p>Botnet Data</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pii.index') }}" class="nav-link {{ request()->routeIs('pii.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-secret"></i>
                        <p>PII Exposure</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('threat-hunting.index') }}" class="nav-link {{ request()->routeIs('threat-hunting.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Threat Hunting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('alerts.index') }}" class="nav-link {{ request()->routeIs('alerts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Alert Center</p>
                        @if(isset($unreadAlerts) && $unreadAlerts > 0)
                            <span class="right badge badge-danger">{{ $unreadAlerts }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-header">ADMINISTRATION</li>
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users & Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('audit-logs.index') }}" class="nav-link {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Audit Logs</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
