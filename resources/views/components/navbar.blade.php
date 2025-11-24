<header class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Quick Scan Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-bolt"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Quick Scan</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item"><i class="fas fa-globe mr-2"></i> Scan Domain</a>
                <a href="#" class="dropdown-item"><i class="fas fa-network-wired mr-2"></i> Enumerate Subdomains</a>
                <a href="#" class="dropdown-item"><i class="fas fa-bug mr-2"></i> Vulnerability Scan</a>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if(isset($unreadNotifications) && $unreadNotifications > 0)
                    <span class="badge badge-warning navbar-badge">{{ $unreadNotifications }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Critical Vulnerability
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-shield-alt mr-2"></i> New CVE Alert
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('alerts.index') }}" class="dropdown-item dropdown-footer">See all notifications</a>
            </div>
        </li>

        <!-- User Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=6366f1&color=fff" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'User' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=6366f1&color=fff" class="img-circle" alt="User Image">
                    <p>
                        {{ auth()->user()->name ?? 'User' }} - {{ auth()->user()->getRoleNames()->first() ?? 'User' }}
                        <small>Member since {{ auth()->user()->created_at?->format('M Y') ?? 'N/A' }}</small>
                    </p>
                </li>
                <li class="user-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="{{ route('settings.index') }}">Settings</a>
                        </div>
                    </div>
                </li>
                <li class="user-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-default btn-flat float-right">Sign out</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>
