@extends('layouts.app')

@section('title','Heart Rate Detail')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-heart-pulse text-danger me-2"></i>

                Heart Rate Detail

            </h1>

            <p class="text-muted mb-0">

                Detail hasil monitoring sensor Nadimax.

            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('heart-rate.edit',$heartrate) }}"
                class="btn btn-warning">

                <i class="fa-solid fa-pen me-2"></i>

                Edit

            </a>

            <a
                href="{{ route('heart-rate.index') }}"
                class="btn-premium">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-4">

            <div class="card-premium text-center">

                <div class="mb-4">

                    <i class="fa-solid fa-heart-pulse fa-5x text-danger"></i>

                </div>

                <h4 class="fw-bold">

                    {{ $heartrate->user->name }}

                </h4>

                <p class="text-muted mb-4">

                    {{ $heartrate->device->device_name }}

                </p>

                @if($heartrate->bpm < 60)

                    <span class="badge bg-warning fs-6 px-3 py-2">

                        LOW HEART RATE

                    </span>

                @elseif($heartrate->bpm <= 100)

                    <span class="badge bg-success fs-6 px-3 py-2">

                        NORMAL

                    </span>

                @else

                    <span class="badge bg-danger fs-6 px-3 py-2">

                        HIGH HEART RATE

                    </span>

                @endif

            </div>

            <div class="card-premium mt-4">

                <h5 class="fw-bold mb-3">

                    Device Information

                </h5>

                <table class="table">

                    <tr>

                        <td>Device</td>

                        <td class="text-end">

                            {{ $heartrate->device->device_name }}

                        </td>

                    </tr>

                    <tr>

                        <td>Recorded</td>

                        <td class="text-end">

                            {{ $heartrate->recorded_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                    <tr>

                        <td>User</td>

                        <td class="text-end">

                            {{ $heartrate->user->name }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <div class="col-lg-8">

            <div class="card-premium">

                <h4 class="fw-bold mb-4">

                    Sensor Monitoring

                </h4>

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 text-center">

                            <i class="fa-solid fa-heart-circle-bolt fa-3x text-danger mb-3"></i>

                            <h6>BPM</h6>

                            <h2 class="fw-bold">

                                {{ $heartrate->bpm }}

                            </h2>

                            <small class="text-muted">

                                Beats Per Minute

                            </small>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 text-center">

                            <i class="fa-solid fa-lungs fa-3x text-primary mb-3"></i>

                            <h6>SpO₂</h6>

                            <h2 class="fw-bold">

                                {{ $heartrate->spo2 }}%

                            </h2>

                            <small class="text-muted">

                                Oxygen Saturation

                            </small>

                        </div>

                    </div>
                                        <div class="col-md-6">

                        <div class="border rounded-4 p-4 text-center">

                            <i class="fa-solid fa-temperature-three-quarters fa-3x text-warning mb-3"></i>

                            <h6>

                                Body Temperature

                            </h6>

                            <h2 class="fw-bold">

                                {{ number_format($heartrate->body_temperature,1) }}°C

                            </h2>

                            <small class="text-muted">

                                Body Temperature

                            </small>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 text-center">

                            <i class="fa-solid fa-wind fa-3x text-info mb-3"></i>

                            <h6>

                                Air Quality

                            </h6>

                            <h2 class="fw-bold">

                                {{ $heartrate->air_quality ?? '-' }}

                            </h2>

                            <small class="text-muted">

                                Air Quality Index

                            </small>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-premium mt-4">

                <h4 class="fw-bold mb-4">

                    Health Analysis

                </h4>

                <table class="table align-middle">

                    <tbody>

                        <tr>

                            <td width="220">

                                Heart Rate

                            </td>

                            <td>

                                @if($heartrate->bpm < 60)

                                    <span class="badge bg-warning">

                                        Bradycardia (Low)

                                    </span>

                                @elseif($heartrate->bpm <= 100)

                                    <span class="badge bg-success">

                                        Normal

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Tachycardia (High)

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <td>

                                SpO₂

                            </td>

                            <td>

                                @if($heartrate->spo2 >= 95)

                                    <span class="badge bg-success">

                                        Normal Oxygen

                                    </span>

                                @elseif($heartrate->spo2 >= 90)

                                    <span class="badge bg-warning">

                                        Need Monitoring

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Critical

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Temperature

                            </td>

                            <td>

                                @if($heartrate->body_temperature < 37.5)

                                    <span class="badge bg-success">

                                        Normal

                                    </span>

                                @elseif($heartrate->body_temperature < 38.5)

                                    <span class="badge bg-warning">

                                        Fever

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        High Fever

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Air Quality

                            </td>

                            <td>

                                @if($heartrate->air_quality)

                                    <span class="badge bg-info">

                                        {{ $heartrate->air_quality }}

                                    </span>

                                @else

                                    <span class="text-muted">

                                        No Data

                                    </span>

                                @endif

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>
                        <div class="card-premium mt-4">

                <h4 class="fw-bold mb-4">

                    Record Information

                </h4>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">

                            Recorded Date

                        </label>

                        <h6 class="mt-2 fw-bold">

                            {{ $heartrate->recorded_at->format('d F Y') }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">

                            Recorded Time

                        </label>

                        <h6 class="mt-2 fw-bold">

                            {{ $heartrate->recorded_at->format('H:i:s') }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">

                            Created At

                        </label>

                        <h6 class="mt-2 fw-bold">

                            {{ $heartrate->created_at->format('d M Y H:i') }}

                        </h6>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">

                            Updated At

                        </label>

                        <h6 class="mt-2 fw-bold">

                            {{ $heartrate->updated_at->format('d M Y H:i') }}

                        </h6>

                    </div>

                </div>

            </div>

            <div class="card-premium mt-4">

                <div class="d-flex justify-content-end gap-2 flex-wrap">

                    <a
                        href="{{ route('heart-rate.edit',$heartrate) }}"
                        class="btn btn-warning">

                        <i class="fa-solid fa-pen-to-square me-2"></i>

                        Edit Data

                    </a>

                    <form
                        action="{{ route('heart-rate.destroy',$heartrate) }}"
                        method="POST">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">

                            <i class="fa-solid fa-trash me-2"></i>

                            Delete

                        </button>

                    </form>

                    <a
                        href="{{ route('heart-rate.index') }}"
                        class="btn-premium">

                        <i class="fa-solid fa-arrow-left me-2"></i>

                        Back to List

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection