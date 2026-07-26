<aside class="sidebar" id="sidebar">

    <!-- ========================= -->
    <!-- Logo -->
    <!-- ========================= -->
    <div class="sidebar-header">

        <div class="logo-icon">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

        <div class="logo-text">
            <h2>Nadimax</h2>
            <span>Admin Panel</span>
        </div>

    </div>

    <!-- ========================= -->
    <!-- Menu -->
    <!-- ========================= -->
    <nav class="sidebar-menu">

        <span class="menu-title">MAIN MENU</span>

        <ul>

            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="{{ route('users.index') }}"
                   class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Devices -->
            <li>
                <a href="{{ route('devices.index') }}"
                   class="{{ request()->routeIs('devices.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Devices</span>
                </a>
            </li>

            <!-- Heart Rate -->
            <!-- Heart Rate -->
<li>
    <a href="{{ route('heart-rate.index') }}"
       class="{{ request()->routeIs('heart-rate.*') ? 'active' : '' }}">
        <i class="fa-solid fa-heart-pulse"></i>
        <span>Heart Rate</span>
    </a>
</li>
            <!-- Workout -->
            <li>
                <a href="{{ route('workout.index') }}"
                   class="{{ request()->routeIs('workout.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-dumbbell"></i>
                    <span>Workout</span>
                </a>
            </li>

            <!-- Subscription -->
            <li>
                <a href="{{ route('subscription.index') }}"
                   class="{{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Subscription</span>
                </a>
            </li>

            <!-- Reports -->
            <li>
                <a href="{{ route('reports.index') }}"
                   class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Reports</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="nav-item">
    <a href="{{ route('setting.index') }}"
       class="nav-link {{ request()->routeIs('setting.*') ? 'active' : '' }}">
        <i class="fa-solid fa-gear"></i>
        <span>Setting</span>
    </a>
</li>

        </ul>

    </nav>

    <!-- ========================= -->
    <!-- Footer -->
    <!-- ========================= -->
    <div class="sidebar-footer">

        <div class="admin-avatar">
            <img src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff"
                 alt="Admin">
        </div>

        <div class="admin-info">
            <h4>Administrator</h4>
            <span>Online</span>
        </div>

    </div>

</aside>