<header class="navbar">

    {{-- LEFT --}}
    <div class="navbar-left">

        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="search-box" id="menuSearch">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                placeholder="Search menu..."
                autocomplete="off">

        </div>

    </div>

    {{-- RIGHT --}}
    <div class="navbar-right">

        {{-- Clock --}}
        <div class="datetime">
            <span id="currentTime">00:00:00</span>
        </div>

        {{-- Notification --}}
        <div class="dropdown-wrapper">

    <button class="nav-icon" id="notificationBtn">

        <i class="fa-regular fa-bell"></i>

        <span class="badge">3</span>

    </button>

    <div class="dropdown-menu" id="notificationMenu">

        <div class="dropdown-title">

            <h5>Notifications</h5>

            <span>3 New</span>

        </div>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-heart-pulse text-danger"></i>

            <div>

                <strong>Heart Rate Alert</strong>

                <small>Heart rate exceeds normal limit</small>

            </div>

        </a>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-temperature-three-quarters text-warning"></i>

            <div>

                <strong>Temperature Warning</strong>

                <small>Body temperature increased</small>

            </div>

        </a>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-circle-check text-success"></i>

            <div>

                <strong>Device Connected</strong>

                <small>ESP32 successfully connected</small>

            </div>

        </a>

    </div>

</div>

        {{-- Message --}}
       <div class="dropdown-wrapper">

    <button class="nav-icon" id="messageBtn">

        <i class="fa-regular fa-envelope"></i>

        <span class="badge">5</span>

    </button>

    <div class="dropdown-menu" id="messageMenu">

        <div class="dropdown-title">

            <h5>Messages</h5>

            <span>5 New</span>

        </div>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-user-doctor text-primary"></i>

            <div>

                <strong>Administrator</strong>

                <small>Monitoring started successfully</small>

            </div>

        </a>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-microchip text-success"></i>

            <div>

                <strong>ESP32 Device</strong>

                <small>Device synchronized</small>

            </div>

        </a>

        <a href="#" class="dropdown-item">

            <i class="fa-solid fa-bell text-warning"></i>

            <div>

                <strong>System</strong>

                <small>New report available</small>

            </div>

        </a>

    </div>

</div>

        {{-- Profile --}}
        <div class="profile-dropdown">

            <button class="profile-btn" id="profileBtn">

                <img
                    src="https://ui-avatars.com/api/?name=Administrator&background=7A0019&color=ffffff"
                    alt="Administrator">

                <div class="profile-info">

                    <h4>Administrator</h4>

                    <span>Super Admin</span>

                </div>

                <i class="fa-solid fa-chevron-down"></i>

            </button>

            <div class="profile-menu" id="profileMenu">

                <a href="#">
                    <i class="fa-solid fa-user"></i>
                    My Profile
                </a>

                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>

                <hr>

                <a href="#" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>

            </div>

        </div>

    </div>

</header>