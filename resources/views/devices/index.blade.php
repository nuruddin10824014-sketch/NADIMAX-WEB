@extends('layouts.app')

@section('title','Device Management')

@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div>

            <h1>

                <i class="fa-solid fa-microchip text-primary me-2"></i>

                Device Management

            </h1>

            <p>

                Monitoring seluruh perangkat Nadimax secara realtime.

            </p>

        </div>

        <a
            href="{{ route('devices.create') }}"
            class="btn-premium">

            <i class="fa-solid fa-plus me-2"></i>

            Add Device

        </a>

    </div>

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

    @endif

    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">

            <div class="card-premium stat-card">

                <div class="health-icon bg-primary">

                    <i class="fa-solid fa-microchip"></i>

                </div>

                <h6>

                    Total Device

                </h6>

                <h2>

                    {{ $totalDevices }}

                </h2>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card-premium stat-card">

                <div class="health-icon bg-success">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <h6>

                    Online

                </h6>

                <h2 class="text-success">

                    {{ $onlineDevices }}

                </h2>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card-premium stat-card">

                <div class="health-icon bg-danger">

                    <i class="fa-solid fa-circle-xmark"></i>

                </div>

                <h6>

                    Offline

                </h6>

                <h2 class="text-danger">

                    {{ $offlineDevices }}

                </h2>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card-premium stat-card">

                <div class="health-icon bg-warning">

                    <i class="fa-solid fa-screwdriver-wrench"></i>

                </div>

                <h6>

                    Maintenance

                </h6>

                <h2 class="text-warning">

                    {{ $maintenanceDevices }}

                </h2>

            </div>

        </div>

    </div>

    <div class="row g-4 mb-4">

        <div class="col-lg-6">

            <div class="card-premium">

                <small class="text-muted">

                    Average Battery

                </small>

                <h3>

                    {{ $averageBattery }}%

                </h3>

                <div class="progress-premium">

                    <div
                        class="progress-fill"
                        style="width: {{ $averageBattery }}%">
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card-premium">

                <small class="text-muted">

                    Average Signal

                </small>

                <h3>

                    {{ $averageSignal }}%

                </h3>

                <div class="progress-premium">

                    <div
                        class="progress-fill"
                        style="width: {{ $averageSignal }}%">
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card-premium">

        <form
            method="GET"
            class="row g-3 mb-4">

            <div class="col-lg-6">

                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword }}"
                    class="form-control"
                    placeholder="Cari nama device, kode atau serial number...">

            </div>

            <div class="col-lg-3">

                <select
                    name="status"
                    class="form-select">

                    <option value="">Semua Status</option>

                    <option
                        value="Online"
                        {{ $status=='Online' ? 'selected' : '' }}>

                        Online

                    </option>

                    <option
                        value="Offline"
                        {{ $status=='Offline' ? 'selected' : '' }}>

                        Offline

                    </option>

                    <option
                        value="Maintenance"
                        {{ $status=='Maintenance' ? 'selected' : '' }}>

                        Maintenance

                    </option>

                </select>

            </div>

            <div class="col-lg-3 d-flex gap-2">

                <button
                    class="btn-premium w-100">

                    Search

                </button>

                <a
                    href="{{ route('devices.index') }}"
                    class="btn btn-secondary w-100">

                    Reset

                </a>

            </div>

        </form>

        <div class="row g-4">
            @forelse($devices as $device)

<div class="col-xl-4 col-lg-6">

    <div class="card-premium device-card h-100 shadow-hover">

        <div class="d-flex justify-content-between align-items-start mb-3">

            <div>

                <h4 class="mb-1">

                    {{ $device->device_name }}

                </h4>

                <small class="text-muted">

                    {{ $device->device_code }}

                </small>

            </div>

           <span
    class="status-badge
    @if($device->status == 'Online')
        status-online
    @elseif($device->status == 'Offline')
        status-offline
    @else
        status-maintenance
    @endif">

    {{ $device->status }}

</span>

        </div>

        <div class="mb-3">

    <div class="d-flex justify-content-between align-items-center mb-2">

        <span>🔋 Battery</span>

        <strong>{{ $device->battery ?? 0 }}%</strong>

    </div>

    <div class="progress-premium">

        <div

            class="progress-fill

            @if(($device->battery ?? 0) < 30)

                progress-danger

            @elseif(($device->battery ?? 0) < 70)

                progress-warning

            @endif"

            style="width: {{ $device->battery ?? 0 }}%">

        </div>

    </div>

</div>

        <div class="mb-3">

    <div class="d-flex justify-content-between align-items-center mb-2">

        <span>📶 Signal</span>

        <strong>{{ $device->signal_strength ?? 0 }}%</strong>

    </div>

    <div class="progress-premium">

        <div

            class="progress-fill"

            style="width: {{ $device->signal_strength ?? 0 }}%">

        </div>

    </div>

</div>
                <div class="mb-3">

            <strong>

                ❤️ Last Heart Rate

            </strong>

            <br>

            @php
    $latestHeartRate = $device->heartRates->sortByDesc('created_at')->first();
@endphp

            @if($latestHeartRate)

                <span class="fw-bold text-danger">

                    {{ $latestHeartRate->bpm }} BPM

                </span>

            @else

                <span class="text-muted">

                    Belum ada data

                </span>

            @endif

        </div>

        <div class="mb-3">

            <strong>

                Firmware

            </strong>

            <br>

            <span class="text-muted">

                {{ $device->firmware ?: '-' }}

            </span>

        </div>

        <div class="mb-3">

            <strong>

                API Key

            </strong>

            <br>

            <code>

                {{ \Illuminate\Support\Str::limit($device->api_key, 20) }}

            </code>

        </div>

        <div class="mb-4">

            <strong>

                Last Sync

            </strong>

            <br>

            @if($device->last_sync)

                <span class="text-success">

                    {{ $device->last_sync->diffForHumans() }}

                </span>

            @else

                <span class="text-muted">

                    Never

                </span>

            @endif

        </div>

        <div class="d-grid gap-2">

            <a

                href="{{ route('devices.show',$device) }}"

                class="btn-premium text-center">

                <i class="fa-solid fa-eye me-2"></i>

                View Detail

            </a>

            <div class="row">

                <div class="col-6">

                    <a

                        href="{{ route('devices.edit',$device) }}"

                        class="btn-warning-premium w-100"
                        <i class="fa-solid fa-pen"></i>

                    </a>

                </div>

                <div class="col-6">

                    <form

                        action="{{ route('devices.destroy',$device) }}"

                        method="POST">

                        @csrf

                        @method('DELETE')

                        <button

                            onclick="return confirm('Yakin ingin menghapus device ini?')"

                            class="btn-danger-premium w-100"

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@empty

<div class="col-12">

    <div class="card-premium text-center py-5">

        <i class="fa-solid fa-microchip fa-4x text-secondary mb-4"></i>

        <h3>

            Belum Ada Device

        </h3>

        <p class="text-muted">

            Tambahkan perangkat pertama untuk mulai monitoring.

        </p>

        <a

            href="{{ route('devices.create') }}"

            class="btn-premium mt-3">

            <i class="fa-solid fa-plus me-2"></i>

            Add Device

        </a>

    </div>

</div>

@endforelse
        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div class="text-muted">

                Menampilkan

                <strong>

                    {{ $devices->firstItem() ?? 0 }}

                </strong>

                -

                <strong>

                    {{ $devices->lastItem() ?? 0 }}

                </strong>

                dari

                <strong>

                    {{ $devices->total() }}

                </strong>

                device

            </div>

            <div>

                {{ $devices->links() }}

            </div>

        </div>

    </div>

</div>

@endsection