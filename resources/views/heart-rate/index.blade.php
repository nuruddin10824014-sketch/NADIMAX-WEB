@extends('layouts.app')

@section('title','Heart Rate Monitoring')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                <i class="fa-solid fa-heart-pulse text-danger me-2"></i>
                Heart Rate Monitoring
            </h1>

            <p class="text-muted mb-0">
                Monitoring data sensor detak jantung, SpO₂, suhu tubuh dan kualitas udara.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('heart-rate.create') }}" class="btn-premium">

                <i class="fa-solid fa-plus me-2"></i>

                Add Record

            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- Statistik -->

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Total Record

                </small>

                <h2 class="fw-bold mt-2">

                    {{ number_format($heartRates->total()) }}

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

                    <small>BPM</small>

                </h2>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Average SpO₂

                </small>

                <h2 class="fw-bold mt-2 text-success">

                    {{ number_format(\App\Models\Heartrate::avg('spo2'),1) }}%

                </h2>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <small class="text-muted">

                    Body Temperature

                </small>

                <h2 class="fw-bold mt-2 text-warning">

                    {{ number_format(\App\Models\Heartrate::avg('body_temperature'),1) }}°C

                </h2>

            </div>

        </div>

    </div>

    <!-- Filter -->

    <div class="card-premium mb-4">

        <form method="GET">

            <div class="row g-3">

                <div class="col-lg-3">

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        value="{{ $keyword }}"
                        placeholder="Search BPM / SpO₂">

                </div>

                <div class="col-lg-3">

                    <select
                        name="user_id"
                        class="form-select">

                        <option value="">

                            All Users

                        </option>

                        @foreach($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ $userId==$user->id?'selected':'' }}>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-3">

                    <select
                        name="device_id"
                        class="form-select">

                        <option value="">

                            All Device

                        </option>

                        @foreach($devices as $device)

                            <option
                                value="{{ $device->id }}"
                                {{ $deviceId==$device->id?'selected':'' }}>

                                {{ $device->device_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-3 d-grid">

                    <button class="btn-premium">

                        <i class="fa-solid fa-filter me-2"></i>

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>

    <!-- Table -->

    <div class="card-premium">

        <div class="table-responsive">

            <table class="table align-middle table-hover">

                <thead>

                <tr>

                    <th>User</th>

                    <th>Device</th>

                    <th>BPM</th>

                    <th>SpO₂</th>

                    <th>Temp</th>

                    <th>Air</th>

                    <th>Recorded</th>

                    <th width="150">

                        Action

                    </th>

                </tr>

                </thead>

                <tbody>
                                    @forelse($heartRates as $heart)

                <tr>

                    <td>

                        <div class="fw-semibold">

                            {{ $heart->user->name }}

                        </div>

                    </td>

                    <td>

                        <div>

                            {{ $heart->device->device_name }}

                        </div>

                    </td>

                    <td>

                        @if($heart->bpm < 60)

                            <span class="badge bg-warning">

                                {{ $heart->bpm }} BPM

                            </span>

                        @elseif($heart->bpm <= 100)

                            <span class="badge bg-success">

                                {{ $heart->bpm }} BPM

                            </span>

                        @else

                            <span class="badge bg-danger">

                                {{ $heart->bpm }} BPM

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($heart->spo2 >= 95)

                            <span class="badge bg-success">

                                {{ $heart->spo2 }}%

                            </span>

                        @elseif($heart->spo2 >= 90)

                            <span class="badge bg-warning">

                                {{ $heart->spo2 }}%

                            </span>

                        @else

                            <span class="badge bg-danger">

                                {{ $heart->spo2 }}%

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($heart->body_temperature < 37.5)

                            <span class="badge bg-success">

                                {{ number_format($heart->body_temperature,1) }}°C

                            </span>

                        @elseif($heart->body_temperature < 38.5)

                            <span class="badge bg-warning">

                                {{ number_format($heart->body_temperature,1) }}°C

                            </span>

                        @else

                            <span class="badge bg-danger">

                                {{ number_format($heart->body_temperature,1) }}°C

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($heart->air_quality)

                            <span class="badge bg-info">

                                {{ $heart->air_quality }}

                            </span>

                        @else

                            <span class="text-muted">

                                -

                            </span>

                        @endif

                    </td>

                    <td>

                        <div>

                            {{ $heart->recorded_at->format('d M Y') }}

                        </div>

                        <small class="text-muted">

                            {{ $heart->recorded_at->format('H:i') }}

                        </small>

                    </td>

                    <td>

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('heart-rate.show',$heart) }}"
                                class="btn btn-info btn-sm">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a
                                href="{{ route('heart-rate.edit',$heart) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('heart-rate.destroy',$heart) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8">

                        <div class="text-center py-5">

                            <i class="fa-solid fa-heart-circle-xmark fa-4x text-secondary mb-3"></i>

                            <h5 class="fw-bold">

                                Belum ada data Heart Rate

                            </h5>

                            <p class="text-muted">

                                Silakan tambahkan data monitoring terlebih dahulu.

                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

                </tbody>
                            </table>

        </div>

        <div class="card-footer bg-white border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div class="text-muted">

                    Showing

                    <strong>

                        {{ $heartRates->firstItem() ?? 0 }}

                    </strong>

                    -

                    <strong>

                        {{ $heartRates->lastItem() ?? 0 }}

                    </strong>

                    of

                    <strong>

                        {{ $heartRates->total() }}

                    </strong>

                    records

                </div>

                <div>

                    {{ $heartRates->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection