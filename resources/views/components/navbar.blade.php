<nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ $unreadAlerts ?? 0 }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $unreadAlerts ?? 0 }} Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('alerts.index') }}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> View all alerts
                </a>
            </div>
        </li>
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('settings.index') }}" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 text-left w-100" style="text-decoration:none;color:inherit;">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
