@extends('layouts.app')

@section('title','Edit Heart Rate')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-pen-to-square text-warning me-2"></i>

                Edit Heart Rate Record

            </h1>

            <p class="text-muted mb-0">

                Perbarui data monitoring sensor.

            </p>

        </div>

        <a href="{{ route('heart-rate.index') }}" class="btn-premium">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>

                Terjadi Kesalahan

            </strong>

            <hr>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('heart-rate.update',$heartrate) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card-premium">

                    <h4 class="fw-bold mb-4">

                        Sensor Information

                    </h4>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                User

                            </label>

                            <select
                                name="user_id"
                                class="form-select"
                                required>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('user_id',$heartrate->user_id)==$user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Device

                            </label>

                            <select
                                name="device_id"
                                class="form-select"
                                required>

                                @foreach($devices as $device)

                                    <option
                                        value="{{ $device->id }}"
                                        {{ old('device_id',$heartrate->device_id)==$device->id ? 'selected' : '' }}>

                                        {{ $device->device_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Heart Rate (BPM)

                            </label>

                            <input
                                type="number"
                                name="bpm"
                                class="form-control"
                                value="{{ old('bpm',$heartrate->bpm) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                SpO₂ (%)

                            </label>

                            <input
                                type="number"
                                name="spo2"
                                class="form-control"
                                value="{{ old('spo2',$heartrate->spo2) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Body Temperature (°C)

                            </label>

                            <input
                                type="number"
                                step="0.1"
                                name="body_temperature"
                                class="form-control"
                                value="{{ old('body_temperature',$heartrate->body_temperature) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Air Quality

                            </label>

                            <input
                                type="number"
                                name="air_quality"
                                class="form-control"
                                value="{{ old('air_quality',$heartrate->air_quality) }}">

                        </div>

                        <div class="col-md-12 mb-4">

                            <label class="form-label">

                                Recorded At

                            </label>

                            <input
                                type="datetime-local"
                                name="recorded_at"
                                class="form-control"
                                value="{{ old('recorded_at',$heartrate->recorded_at->format('Y-m-d\TH:i')) }}"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-premium">

                    <h4 class="fw-bold mb-4">

                        Current Status

                    </h4>

                    <div class="alert alert-info">

                        <strong>BPM</strong>

                        <hr>

                        {{ $heartrate->bpm }} BPM

                    </div>

                    <div class="alert alert-success">

                        <strong>SpO₂</strong>

                        <hr>

                        {{ $heartrate->spo2 }}%

                    </div>

                    <div class="alert alert-warning">

                        <strong>Temperature</strong>

                        <hr>

                        {{ number_format($heartrate->body_temperature,1) }}°C

                    </div>

                    <div class="alert alert-secondary">

                        <strong>Air Quality</strong>

                        <hr>

                        {{ $heartrate->air_quality ?? '-' }}

                    </div>
                                        <div class="d-grid gap-2 mt-4">

                        <button
                            type="submit"
                            class="btn-premium">

                            <i class="fa-solid fa-floppy-disk me-2"></i>

                            Update Record

                        </button>

                        <a
                            href="{{ route('heart-rate.show',$heartrate) }}"
                            class="btn btn-outline-primary">

                            <i class="fa-solid fa-eye me-2"></i>

                            View Detail

                        </a>

                        <a
                            href="{{ route('heart-rate.index') }}"
                            class="btn btn-light border">

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection