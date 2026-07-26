@extends('layouts.app')

@section('title','Reports')

@section('content')

<div class="container-fluid">

    <!-- Header -->

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-chart-line text-primary me-2"></i>

                Reports & Analytics

            </h1>

            <p class="text-muted mb-0">

                Monitoring statistik dan laporan seluruh sistem Nadimax.

            </p>

        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-success">

                <i class="fa-solid fa-file-excel me-2"></i>

                Export Excel

            </button>

            <button class="btn btn-danger">

                <i class="fa-solid fa-file-pdf me-2"></i>

                Export PDF

            </button>

        </div>

    </div>

    <!-- Filter -->

    <div class="card-premium mb-4">

        <div class="row g-3">

            <div class="col-lg-3">

                <label class="form-label">

                    Start Date

                </label>

                <input
                    type="date"
                    class="form-control">

            </div>

            <div class="col-lg-3">

                <label class="form-label">

                    End Date

                </label>

                <input
                    type="date"
                    class="form-control">

            </div>

            <div class="col-lg-3">

                <label class="form-label">

                    Device

                </label>

                <select class="form-select">

                    <option>

                        All Device

                    </option>

                </select>

            </div>

            <div class="col-lg-3">

                <label class="form-label">

                    User

                </label>

                <select class="form-select">

                    <option>

                        All User

                    </option>

                </select>

            </div>

        </div>

        <div class="mt-4 d-flex gap-2">

            <button class="btn-premium">

                <i class="fa-solid fa-filter me-2"></i>

                Filter Report

            </button>

            <button class="btn btn-outline-secondary">

                Reset

            </button>

        </div>

    </div>

    <!-- Statistic -->

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Total User

                </small>

                <h2 class="fw-bold mt-2">

                    {{ \App\Models\User::count() }}

                </h2>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Total Device

                </small>

                <h2 class="fw-bold mt-2">

                    {{ \App\Models\Device::count() }}

                </h2>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Heart Rate Record

                </small>

                <h2 class="fw-bold mt-2">

                    {{ \App\Models\Heartrate::count() }}

                </h2>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Average BPM

                </small>

                <h2 class="fw-bold mt-2 text-danger">

                    {{ number_format(\App\Models\Heartrate::avg('bpm'),0) }}

                </h2>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-8">

    <div class="card-premium">

        <h4 class="fw-bold mb-4">
            Heart Rate Analytics
        </h4>

        <div style="height:380px; position:relative;">

            <canvas id="heartChart"></canvas>

        </div>

    </div>

</div>
        <div class="col-lg-4">

            <div class="card-premium">

                <h4 class="fw-bold mb-4">

                    Health Summary

                </h4>
                                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            Average Heart Rate

                        </span>

                        <strong class="text-danger">

                            {{ number_format(\App\Models\Heartrate::avg('bpm'),0) }} BPM

                        </strong>

                    </div>

                    <div class="progress" style="height:10px;">

                        <div
                            class="progress-bar bg-danger"
                            style="width:75%">

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            Average SpO₂

                        </span>

                        <strong class="text-success">

                            {{ number_format(\App\Models\Heartrate::avg('spo2'),1) }}%

                        </strong>

                    </div>

                    <div class="progress" style="height:10px;">

                        <div
                            class="progress-bar bg-success"
                            style="width:98%">

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            Body Temperature

                        </span>

                        <strong class="text-warning">

                            {{ number_format(\App\Models\Heartrate::avg('body_temperature'),1) }}°C

                        </strong>

                    </div>

                    <div class="progress" style="height:10px;">

                        <div
                            class="progress-bar bg-warning"
                            style="width:70%">

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span>

                            Air Quality

                        </span>

                        <strong class="text-info">

                            {{ number_format(\App\Models\Heartrate::avg('air_quality'),0) }}

                        </strong>

                    </div>

                    <div class="progress" style="height:10px;">

                        <div
                            class="progress-bar bg-info"
                            style="width:65%">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card-premium mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                Latest Monitoring Records

            </h4>

            <span class="badge bg-primary">

                {{ \App\Models\Heartrate::count() }} Records

            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>User</th>

                        <th>Device</th>

                        <th>BPM</th>

                        <th>SpO₂</th>

                        <th>Temperature</th>

                        <th>Recorded At</th>

                    </tr>

                </thead>

                <tbody>

                @foreach(\App\Models\Heartrate::latest()->take(10)->get() as $record)

                    <tr>

                        <td>

                            {{ $record->user->name }}

                        </td>

                        <td>

                            {{ $record->device->device_name }}

                        </td>

                        <td>

                            <span class="badge bg-danger">

                                {{ $record->bpm }} BPM

                            </span>

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $record->spo2 }}%

                            </span>

                        </td>

                        <td>

                            <span class="badge bg-warning">

                                {{ number_format($record->body_temperature,1) }}°C

                            </span>

                        </td>

                        <td>

                            {{ $record->recorded_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>
        <div class="card-premium mt-4">

        <h4 class="fw-bold mb-4">

            Report Information

        </h4>

        <div class="row">

            <div class="col-md-3">

                <div class="text-center p-3">

                    <i class="fa-solid fa-users fa-2x text-primary mb-3"></i>

                    <h5>

                        {{ \App\Models\User::count() }}

                    </h5>

                    <small class="text-muted">

                        Registered Users

                    </small>

                </div>

            </div>

            <div class="col-md-3">

                <div class="text-center p-3">

                    <i class="fa-solid fa-microchip fa-2x text-success mb-3"></i>

                    <h5>

                        {{ \App\Models\Device::count() }}

                    </h5>

                    <small class="text-muted">

                        Active Devices

                    </small>

                </div>

            </div>

            <div class="col-md-3">

                <div class="text-center p-3">

                    <i class="fa-solid fa-heart-pulse fa-2x text-danger mb-3"></i>

                    <h5>

                        {{ \App\Models\Heartrate::count() }}

                    </h5>

                    <small class="text-muted">

                        Heart Records

                    </small>

                </div>

            </div>

            <div class="col-md-3">

                <div class="text-center p-3">

                    <i class="fa-solid fa-chart-line fa-2x text-warning mb-3"></i>

                    <h5>

                        {{ number_format(\App\Models\Heartrate::avg('bpm'),0) }}

                    </h5>

                    <small class="text-muted">

                        Avg BPM

                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('heartChart');

if(ctx){

    new Chart(ctx,{

        type:'line',

        data:{

            labels:[
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ],

            datasets:[{

                label:'Average BPM',

                data:[
                    74,
                    78,
                    76,
                    82,
                    79,
                    75,
                    77
                ],

                borderWidth:3,

                tension:.4,

                fill:true,

                backgroundColor:'rgba(59,130,246,.15)',

                borderColor:'#3b82f6',

                pointRadius:4,

                pointHoverRadius:6

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{
                    display:true
                }

            },

            scales:{

                y:{
                    beginAtZero:false
                }

            }

        }

    });

}

</script>

@endsection