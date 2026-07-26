<div class="device-card">

    <div class="device-top">

        <div class="device-icon">
            <i class="fa-solid fa-microchip"></i>
        </div>

        <div class="device-info">

            <h3>{{ $device }}</h3>

            <p>{{ $location }}</p>

        </div>

    </div>

    <div class="device-status">

        @if($status == 'Online')

            <span class="status online">
                <i class="fa-solid fa-circle"></i>
                Online
            </span>

        @else

            <span class="status offline">
                <i class="fa-solid fa-circle"></i>
                Offline
            </span>

        @endif

    </div>

    <div class="device-detail">

        <div class="detail-item">

            <span>Battery</span>

            <strong>{{ $battery }}</strong>

        </div>

        <div class="detail-item">

            <span>WiFi</span>

            <strong>{{ $wifi }}</strong>

        </div>

        <div class="detail-item">

            <span>Last Sync</span>

            <strong>{{ $sync }}</strong>

        </div>

    </div>

</div>