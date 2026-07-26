@extends('layouts.app')

@section('title','Tambah Heart Rate')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-heart-circle-plus text-danger me-2"></i>

                Add Heart Rate Record

            </h1>

            <p class="text-muted mb-0">

                Tambahkan data monitoring sensor secara manual.

            </p>

        </div>

        <a href="{{ route('heart-rate.index') }}" class="btn-premium">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    @if ($errors->any())

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
        action="{{ route('heart-rate.store') }}"
        method="POST">

        @csrf

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

                                <option value="">

                                    Choose User

                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('user_id')==$user->id?'selected':'' }}>

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

                                <option value="">

                                    Choose Device

                                </option>

                                @foreach($devices as $device)

                                    <option
                                        value="{{ $device->id }}"
                                        {{ old('device_id')==$device->id?'selected':'' }}>

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
                                value="{{ old('bpm') }}"
                                placeholder="80"
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
                                value="{{ old('spo2') }}"
                                placeholder="98"
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
                                value="{{ old('body_temperature') }}"
                                placeholder="36.7"
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
                                value="{{ old('air_quality') }}"
                                placeholder="120">

                        </div>

                        <div class="col-md-12 mb-4">

                            <label class="form-label">

                                Recorded At

                            </label>

                            <input
                                type="datetime-local"
                                name="recorded_at"
                                class="form-control"
                                value="{{ old('recorded_at') }}"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-premium">

                    <h4 class="fw-bold mb-4">

                        Information

                    </h4>

                        <div class="alert alert-info">

                            <strong>

                                BPM

                            </strong>

                            <hr>

                            Normal Heart Rate:
                            <br>

                            60 - 100 BPM

                        </div>

                        <div class="alert alert-success">

                            <strong>

                                SpO₂

                            </strong>

                            <hr>

                            Normal Oxygen:
                            <br>

                            ≥ 95%

                        </div>

                        <div class="alert alert-warning">

                            <strong>

                                Temperature

                            </strong>

                            <hr>

                            Normal Body Temperature:
                            <br>

                            36.0°C - 37.5°C

                        </div>
                                                <div class="alert alert-secondary">

                            <strong>

                                Air Quality

                            </strong>

                            <hr>

                            Nilai AQI akan digunakan untuk monitoring kualitas udara di sekitar pengguna.

                        </div>

                        <div class="d-grid gap-2 mt-4">

                            <button
                                type="submit"
                                class="btn-premium">

                                <i class="fa-solid fa-floppy-disk me-2"></i>

                                Save Record

                            </button>

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