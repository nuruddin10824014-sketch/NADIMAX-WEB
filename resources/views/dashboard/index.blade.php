@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="dashboard">

   <!-- ================= HERO ================= -->

<section class="hero-card">

    <div class="hero-left">

        <span class="hero-badge">

            <i class="fa-solid fa-heart-pulse"></i>

            Medical IoT Monitoring

        </span>

        <h1>Welcome to Nadimax Admin</h1>

        <p>

            Dashboard monitoring kesehatan berbasis ESP32.
            Sistem memantau Heart Rate, SpO₂, Suhu Tubuh,
            Air Quality, Battery Device dan Status Perangkat
            secara realtime.

        </p>

        <div class="hero-info">

            <div>

                <strong>{{ $onlineDevices }}</strong>

                <span>Online Device</span>

            </div>

            <div>

                <strong>{{ $totalUsers }}</strong>

                <span>Registered User</span>

            </div>

            <div>

                <strong>{{ $totalSubscriptions }}</strong>

                <span>Subscription</span>

            </div>

        </div>

    </div>

    <div class="hero-right">

        <small>Today</small>

        <h2 id="dashboardDate"></h2>

    </div>

</section>

    <!-- ================= STATISTIC ================= -->

    <section class="stats-grid">

    <!-- Users -->

    <div class="stats-card">

        <div>

            <span>Total Users</span>

            <h2>{{ $totalUsers }}</h2>

            <small>Registered Account</small>

        </div>

        <div class="stats-icon bg-primary">

            <i class="fa-solid fa-users"></i>

        </div>

    </div>

    <!-- Device -->

    <div class="stats-card">

        <div>

            <span>Total Devices</span>

            <h2>{{ $totalDevices }}</h2>

            <small>ESP32 Registered</small>

        </div>

        <div class="stats-icon bg-success">

            <i class="fa-solid fa-microchip"></i>

        </div>

    </div>

    <!-- Online -->

    <div class="stats-card">

        <div>

            <span>Online Device</span>

            <h2>{{ $onlineDevices }}</h2>

            <small>Realtime Status</small>

        </div>

        <div class="stats-icon bg-info">

            <i class="fa-solid fa-wifi"></i>

        </div>

    </div>

    <!-- Heart Rate -->

    <div class="stats-card">

        <div>

            <span>Heart Rate</span>

            <h2 id="bpm-value">

                {{ $latestHeartRate?->bpm ?? '--' }} BPM

            </h2>

            <small>

                @if(!$latestHeartRate)

                    No Data

                @elseif($latestHeartRate->bpm < 60)

                    Low

                @elseif($latestHeartRate->bpm <= 100)

                    Normal

                @else

                    High

                @endif

            </small>

        </div>

        <div class="stats-icon bg-danger">

            <i class="fa-solid fa-heart-pulse"></i>

        </div>

    </div>

</section>

    <!-- ================= MAIN ================= -->

    <section class="dashboard-grid">

        <!-- Chart -->

        <div class="dashboard-card chart-card">

            <div class="card-header">

                <div>

                    <h3>Heart Rate Monitoring</h3>

                    <small>Realtime Heart Rate</small>

                </div>

               <h2 class="bpm" id="bpm-value">
    {{ $latestHeartRate?->bpm ?? '--' }} BPM
</h2>

            </div>

            <canvas id="heartRateChart"></canvas>

        </div>

        <!-- Device -->

        <div class="dashboard-card">

            <div class="card-header">

                <h3>Device Status</h3>

            </div>

            <div class="device-box">

    <div class="device-top">

        <i class="fa-solid fa-microchip"></i>

        <div>

            <h4>

                {{ $latestDevice?->device_name ?? 'No Device' }}

            </h4>

            <small>

                {{ $latestDevice?->device_code ?? '-' }}

            </small>

        </div>

    </div>

    <div class="device-info">

        <div>

            <span>Status</span>

            <strong id="status-value">

                {{ $latestDevice?->status ?? '-' }}

            </strong>

        </div>

        <div>

            <span>Battery</span>

            <strong id="battery-value">

                {{ $latestDevice?->battery ?? '--' }}%

            </strong>

        </div>

        <div>

            <span>Signal</span>

            <strong id="wifi-value">

                {{ $latestDevice?->signal_strength ?? '--' }}

            </strong>

        </div>

        <div>

            <span>Last Sync</span>

            <strong>

                @if($latestDevice && $latestDevice->last_sync)

                    {{ $latestDevice->last_sync->diffForHumans() }}

                @else

                    -

                @endif

            </strong>

        </div>

    </div>

</div>

        </div>

    </section>
    <!-- ================= HEALTH MONITOR ================= -->

<section class="health-grid">

    <!-- Heart Rate -->

    <div class="health-card">

        <div class="health-icon danger">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

        <span>Heart Rate</span>

        <h3 id="health-bpm">

            {{ $latestHeartRate?->bpm ?? '--' }}

            BPM

        </h3>

    </div>

    <!-- SPO2 -->

    <div class="health-card">

        <div class="health-icon primary">
            <i class="fa-solid fa-lungs"></i>
        </div>

        <span>SpO₂</span>

        <h3 id="spo2-value">

            {{ $latestHeartRate?->spo2 ?? '--' }}

            %

        </h3>

    </div>

    <!-- Temperature -->

    <div class="health-card">

        <div class="health-icon warning">
            <i class="fa-solid fa-temperature-three-quarters"></i>
        </div>

        <span>Body Temperature</span>

        <h3 id="temp-value">

            {{ $latestHeartRate?->body_temperature ?? '--' }}

            °C

        </h3>

    </div>

    <!-- Air -->

    <div class="health-card">

        <div class="health-icon success">
            <i class="fa-solid fa-wind"></i>
        </div>

        <span>Air Quality</span>

        <h3 id="air-value">

            {{ $latestHeartRate?->air_quality ?? '--' }}

        </h3>

    </div>

</section>

    <!-- ================= BOTTOM ================= -->

    <section class="dashboard-bottom">

    <!-- Timeline -->
    <div class="dashboard-card">

        <div class="card-header">

            <h3>
                Activity Timeline
            </h3>

            <span class="badge badge-primary">
                Today
            </span>

        </div>

        <div class="timeline">

            <div class="timeline-item">

                <div class="timeline-dot success"></div>

                <div>

                    <h5>Laravel System Started</h5>

                    <small>System berjalan normal.</small>

                </div>

            </div>

            <div class="timeline-item">

                <div class="timeline-dot primary"></div>

                <div>

                    <h5>Database Connected</h5>

                    <small>MySQL Connected Successfully.</small>

                </div>

            </div>

            <div class="timeline-item">

                <div class="timeline-dot warning"></div>

                <div>

                    <h5>API Ready</h5>

                    <small>Waiting ESP32 Connection.</small>

                </div>

            </div>

            <div class="timeline-item">

                <div class="timeline-dot danger"></div>

                <div>

                    <h5>Monitoring Active</h5>

                    <small>Realtime Monitoring Enabled.</small>

                </div>

            </div>

        </div>

    </div>

    <!-- Notification -->

    <div class="dashboard-card">

        <div class="card-header">

            <h3>

                Notifications

            </h3>

        </div>

        <div class="notification-list">

            <div class="notification success">

                <i class="fa-solid fa-circle-check"></i>

                Laravel Connected

            </div>

            <div class="notification success">

                <i class="fa-solid fa-database"></i>

                Database Connected

            </div>

            <div class="notification success">

                <i class="fa-solid fa-cloud"></i>

                REST API Ready

            </div>

            <div class="notification warning">

                <i class="fa-solid fa-microchip"></i>

                ESP32 Waiting Connection

            </div>

        </div>

    </div>

</section>
<section class="dashboard-bottom">

    <div class="dashboard-card">

        <div class="card-header">

            <h3>

                Quick Action

            </h3>

        </div>

        <div class="quick-grid">

            <a href="{{ route('users.create') }}" class="quick-card">

                <i class="fa-solid fa-user-plus"></i>

                <span>Add User</span>

            </a>

            <a href="{{ route('devices.create') }}" class="quick-card">

                <i class="fa-solid fa-microchip"></i>

                <span>Add Device</span>

            </a>

            <a href="{{ route('workout.create') }}" class="quick-card">

                <i class="fa-solid fa-dumbbell"></i>

                <span>Workout</span>

            </a>

            <a href="{{ route('reports.index') }}" class="quick-card">

                <i class="fa-solid fa-chart-column"></i>

                <span>Report</span>

            </a>

        </div>

    </div>

    <div class="dashboard-card">

        <div class="card-header">

            <h3>

                Server Status

            </h3>

        </div>

        <div class="server-status">

            <div>

                <span>Laravel</span>

                <strong class="text-success">

                    Online

                </strong>

            </div>

            <div>

                <span>Database</span>

                <strong class="text-success">

                    Connected

                </strong>

            </div>

            <div>

                <span>REST API</span>

                <strong class="text-success">

                    Running

                </strong>

            </div>

            <div>

                <span>ESP32</span>

                <strong class="text-warning">

                    Waiting

                </strong>

            </div>

        </div>

    </div>

</section>

    <div class="dashboard-card">

    <div class="card-header">

        <h3>

            Recent Sensor Data

        </h3>

    </div>

    <table class="table">

        <thead>

        <tr>

            <th>User</th>

            <th>BPM</th>

            <th>SpO₂</th>

            <th>Temp</th>

            <th>Time</th>

        </tr>

        </thead>

        <tbody>

        @forelse($recentHeartRates as $item)

            <tr>

                <td>

                    {{ $item->user?->name ?? '-' }}

                </td>

                <td>

                    {{ $item->bpm }}

                </td>

                <td>

                    {{ $item->spo2 }} %

                </td>

                <td>

                    {{ $item->body_temperature }} °C

                </td>

                <td>

                    {{ $item->recorded_at->format('H:i') }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5">

                    Belum ada data sensor.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

        <div class="dashboard-card">

    <div class="card-header">

        <h3>System Status</h3>

    </div>

    <ul class="activity-list">

        <li>

            <i class="fa-solid fa-circle-check text-success"></i>

            Laravel Connected

        </li>

        <li>

            <i class="fa-solid fa-circle-check text-success"></i>

            Database Connected

        </li>

        <li>

            <i class="fa-solid fa-circle-check text-success"></i>

            API Ready

        </li>

        <li>

            <i class="fa-solid fa-circle-check text-success"></i>

            ESP32 Waiting Connection

        </li>

    </ul>

</div>

    </section>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('heartRateChart');

const heartChart = new Chart(ctx, {

    type:'line',

    data:{

        labels:@json($chartLabels),

        datasets:[{

            label:'Heart Rate',

            data:@json($chartValues),

            borderWidth:3,

            tension:.4,

            fill:true

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{

                display:false

            }

        },

        scales:{

            y:{

                min:40,

                max:180

            }

        }

    }

});

async function loadDashboard(){

    try{

        const response = await fetch('/api/dashboard/latest');

        const data = await response.json();

        /*
        |--------------------------------------------------------------------------
        | HEART RATE
        |--------------------------------------------------------------------------
        */

        if(data.heart_rate){

            document.getElementById('bpm-value').innerHTML =
                data.heart_rate.bpm + " BPM";

            document.getElementById('health-bpm').innerHTML =
                data.heart_rate.bpm + " BPM";

            document.getElementById('spo2-value').innerHTML =
                data.heart_rate.spo2 + " %";

            document.getElementById('temp-value').innerHTML =
                data.heart_rate.body_temperature + " °C";

            document.getElementById('air-value').innerHTML =
                data.heart_rate.air_quality;

        }

        /*
        |--------------------------------------------------------------------------
        | DEVICE
        |--------------------------------------------------------------------------
        */

        if(data.device){

            document.getElementById('battery-value').innerHTML =
                data.device.battery + "%";

            document.getElementById('wifi-value').innerHTML =
                data.device.signal_strength;

            document.getElementById('status-value').innerHTML =
                data.device.status;

        }

        /*
        |--------------------------------------------------------------------------
        | CHART
        |--------------------------------------------------------------------------
        */

        heartChart.data.labels = data.chart.labels;

        heartChart.data.datasets[0].data = data.chart.values;

        heartChart.update();

    }catch(error){

        console.log(error);

    }

}

setInterval(loadDashboard,5000);
function updateClock(){

    const now = new Date();

    document.getElementById("dashboardDate").innerHTML =
        now.toLocaleDateString('id-ID',{
            weekday:'long',
            day:'numeric',
            month:'long',
            year:'numeric'
        });

}

updateClock();
</script>

@endpush