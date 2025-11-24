<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <!-- Quick Scan -->
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Quick Scan</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-globe me-2"></i>Scan Domain</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-diagram-3 me-2"></i>Enumerate Subdomains</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bug me-2"></i>Vulnerability Scan</a></li>
                        </ul>
                    </li>

                    <!-- Notifications -->
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-expanded="false">
                            <i class="bi bi-bell bi-sub fs-4"></i>
                            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                            <span class="badge badge-notification bg-danger">{{ $unreadNotifications }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notifications</h6>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-danger">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </div>
                                    <div class="notification-text ms-3">
                                        <p class="notification-title font-bold">Critical Vulnerability</p>
                                        <p class="notification-subtitle font-thin text-sm">Found in example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-warning">
                                        <i class="bi bi-shield-exclamation"></i>
                                    </div>
                                    <div class="notification-text ms-3">
                                        <p class="notification-title font-bold">New CVE Alert</p>
                                        <p class="notification-subtitle font-thin text-sm">CVE-2025-12345 published</p>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-info">
                                        <i class="bi bi-incognito"></i>
                                    </div>
                                    <div class="notification-text ms-3">
                                        <p class="notification-title font-bold">Dark Web Leak</p>
                                        <p class="notification-subtitle font-thin text-sm">Credentials found</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <p class="text-center py-2 mb-0"><a href="{{ route('alerts.index') }}">See all notifications</a></p>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->name ?? 'User' }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=6366f1&color=fff" alt="Avatar">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ auth()->user()->name ?? 'User' }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('settings.index') }}"><i class="icon-mid bi bi-gear me-2"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
