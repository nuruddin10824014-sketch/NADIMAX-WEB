@extends('layouts.app')

@section('title', 'Device Detail')

@section('content')

<div class="container-fluid">

    {{-- ================================
        Page Header
    ================================= --}}
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h1 class="mb-1">
                <i class="fa-solid fa-microchip text-primary me-2"></i>
                Device Detail
            </h1>

            <p class="text-muted mb-0">
                Informasi lengkap perangkat Nadimax Monitoring System.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('devices.edit',$device) }}"
               class="btn-warning-premium">

                <i class="fa-solid fa-pen me-2"></i>
                Edit Device

            </a>

            <a href="{{ route('devices.index') }}"
               class="btn-premium">

                <i class="fa-solid fa-arrow-left me-2"></i>
                Back

            </a>

        </div>

    </div>

    {{-- ================================
        TOP INFORMATION
    ================================= --}}
    <div class="row g-4">

        <div class="col-xl-4">

            <div class="card-premium device-card shadow-hover text-center">

                <div class="py-4">

                    <div class="health-icon bg-primary mx-auto mb-3">

                        <i class="fa-solid fa-microchip"></i>

                    </div>

                    <h3 class="fw-bold mb-1">

                        {{ $device->device_name }}

                    </h3>

                    <div class="text-muted mb-3">

                        {{ $device->device_code }}

                    </div>

                    <span
                        class="status-badge

                        @if($device->status=='Online')

                            status-online

                        @elseif($device->status=='Offline')

                            status-offline

                        @else

                            status-maintenance

                        @endif">

                        {{ $device->status }}

                    </span>

                </div>

                <hr>

                <div class="row text-center">

                    <div class="col-4">

                        <h4 class="fw-bold text-success">

                            {{ $device->battery ?? 0 }}%

                        </h4>

                        <small class="text-muted">
                            Battery
                        </small>

                    </div>

                    <div class="col-4">

                        <h4 class="fw-bold text-info">

                            {{ $device->signal_strength ?? 0 }}%

                        </h4>

                        <small class="text-muted">
                            Signal
                        </small>

                    </div>

                    <div class="col-4">

                        <h4 class="fw-bold text-danger">

                            {{ $device->heartRates->count() }}

                        </h4>

                        <small class="text-muted">
                            Records
                        </small>

                    </div>

                </div>

            </div>

            <div class="card-premium device-card shadow-hover mt-4">

                <h5 class="fw-bold mb-4">

                    Device Status

                </h5>

                <div class="mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span>

                            🔋 Battery

                        </span>

                        <strong>

                            {{ $device->battery ?? 0 }}%

                        </strong>

                    </div>

                    <div class="progress-premium">

                        <div

                            class="progress-fill

                            @if(($device->battery ?? 0) < 30)

                                progress-danger

                            @elseif(($device->battery ?? 0) < 70)

                                progress-warning

                            @endif"

                            style="width:{{ $device->battery ?? 0 }}%">

                        </div>

                    </div>

                </div>

                <div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>

                            📶 Signal

                        </span>

                        <strong>

                            {{ $device->signal_strength ?? 0 }}%

                        </strong>

                    </div>

                    <div class="progress-premium">

                        <div

                            class="progress-fill"

                            style="width:{{ $device->signal_strength ?? 0 }}%">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-8">

            <div class="card-premium device-card shadow-hover">

                <h4 class="fw-bold mb-4">

                    Device Information

                </h4>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Device Name
                        </label>

                        <h6 class="fw-semibold">

                            {{ $device->device_name }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Device Code
                        </label>

                        <h6>

                            {{ $device->device_code }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Serial Number
                        </label>

                        <h6>

                            {{ $device->serial_number }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Firmware
                        </label>

                        <h6>

                            {{ $device->firmware ?: '-' }}

                        </h6>

                    </div>
                                        <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Device Owner
                        </label>

                        <h6>

                            {{ $device->user->name ?? 'Belum Terhubung' }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Last Sync
                        </label>

                        <h6>

                            @if($device->last_sync)

                                {{ $device->last_sync->format('d M Y H:i:s') }}

                            @else

                                -

                            @endif

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Created At
                        </label>

                        <h6>

                            {{ $device->created_at->format('d M Y H:i') }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Updated At
                        </label>

                        <h6>

                            {{ $device->updated_at->format('d M Y H:i') }}

                        </h6>

                    </div>

                    <div class="col-12">

                        <label class="text-muted">
                            API Key
                        </label>

                        <code class="d-block mt-2">

                            {{ $device->api_key }}

                        </code>

                    </div>

                </div>

            </div>

            <div class="row g-4 mt-1">

                <div class="col-lg-4">

                    <div class="card-premium text-center shadow-hover">

                        <div class="health-icon bg-success mx-auto mb-3">

                            <i class="fa-solid fa-heart-pulse"></i>

                        </div>

                        <h2 class="fw-bold text-success">

                            {{ $device->heartRates->count() }}

                        </h2>

                        <p class="text-muted mb-0">

                            Total Heart Rate

                        </p>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card-premium text-center shadow-hover">

                        <div class="health-icon bg-primary mx-auto mb-3">

                            <i class="fa-solid fa-battery-three-quarters"></i>

                        </div>

                        <h2 class="fw-bold text-primary">

                            {{ $device->battery ?? 0 }}%

                        </h2>

                        <p class="text-muted mb-0">

                            Battery Level

                        </p>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card-premium text-center shadow-hover">

                        <div class="health-icon bg-info mx-auto mb-3">

                            <i class="fa-solid fa-signal"></i>

                        </div>

                        <h2 class="fw-bold text-info">

                            {{ $device->signal_strength ?? 0 }}%

                        </h2>

                        <p class="text-muted mb-0">

                            Signal Strength

                        </p>

                    </div>

                </div>

            </div>

            <div class="card-premium device-card shadow-hover mt-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="fw-bold mb-0">

                        Latest Heart Rate History

                    </h4>

                    <span class="status-badge status-online">

                        {{ $device->heartRates->count() }} Records

                    </span>

                </div>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>BPM</th>

                                <th>SpO₂</th>

                                <th>Temperature</th>

                                <th>Air Quality</th>

                                <th>Recorded At</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($device->heartRates->take(5) as $index => $heart)

                            <tr>

                                <td>

                                    {{ $index + 1 }}

                                </td>

                                <td>

                                    <span class="fw-bold text-danger">

                                        {{ $heart->bpm }}

                                    </span>

                                    BPM

                                </td>

                                <td>

                                    {{ $heart->spo2 }} %

                                </td>

                                <td>

                                    {{ $heart->body_temperature }} °C

                                </td>

                                <td>

                                    {{ $heart->air_quality ?? '-' }}

                                </td>

                                <td>

                                    {{ $heart->recorded_at }}

                                </td>

                            </tr>
                                                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <div class="py-4">

                                        <i class="fa-solid fa-heart-crack fa-3x text-muted mb-3"></i>

                                        <h5 class="mb-2">

                                            Belum Ada Data Heart Rate

                                        </h5>

                                        <p class="text-muted mb-0">

                                            Device ini belum mengirimkan data pembacaan sensor.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection