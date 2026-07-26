@extends('layouts.app')

@section('title','Edit Device')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="mb-1">

                <i class="fa-solid fa-pen-to-square text-warning me-2"></i>

                Edit Device

            </h1>

            <p class="text-muted mb-0">

                Perbarui informasi perangkat Nadimax.

            </p>

        </div>

        <a href="{{ route('devices.index') }}"
           class="btn-premium">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">

                Terjadi kesalahan.

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('devices.update',$device) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card-premium">

                    <h4 class="fw-bold mb-4">

                        Device Information

                    </h4>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Device Name

                            </label>

                            <input
                                type="text"
                                name="device_name"
                                class="form-control"
                                value="{{ old('device_name',$device->device_name) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Serial Number

                            </label>

                            <input
                                type="text"
                                name="serial_number"
                                class="form-control"
                                value="{{ old('serial_number',$device->serial_number) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Firmware

                            </label>

                            <input
                                type="text"
                                name="firmware"
                                class="form-control"
                                value="{{ old('firmware',$device->firmware) }}">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Device Owner

                            </label>

                            <select
                                name="user_id"
                                class="form-select">

                                <option value="">

                                    -- Belum Dipasang --

                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('user_id',$device->user_id)==$user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="form-label">

                                Battery (%)

                            </label>

                            <input
                                type="number"
                                name="battery"
                                class="form-control"
                                min="0"
                                max="100"
                                value="{{ old('battery',$device->battery) }}">

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="form-label">

                                Signal (%)

                            </label>

                            <input
                                type="number"
                                name="signal_strength"
                                class="form-control"
                                min="0"
                                max="100"
                                value="{{ old('signal_strength',$device->signal_strength) }}">

                        </div>

                        <div class="col-md-4 mb-4">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option value="Online" {{ old('status',$device->status)=='Online' ? 'selected' : '' }}>
                                    Online
                                </option>

                                <option value="Offline" {{ old('status',$device->status)=='Offline' ? 'selected' : '' }}>
                                    Offline
                                </option>

                                <option value="Maintenance" {{ old('status',$device->status)=='Maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-premium">

                    <h4 class="fw-bold mb-4">

                        Device Information

                    </h4>

                    <div class="mb-4">

                        <label class="text-muted">

                            Device Code

                        </label>

                        <code class="d-block mt-2">

                            {{ $device->device_code }}

                        </code>

                    </div>

                    <div class="mb-4">

                        <label class="text-muted">

                            API Key

                        </label>

                        <code class="d-block mt-2">

                            {{ $device->api_key }}

                        </code>

                    </div>

                    <div class="mb-4">

                        <label class="text-muted">

                            Last Sync

                        </label>

                        <h6 class="mt-2">

                            {{ $device->last_sync ?? '-' }}

                        </h6>

                    </div>

                    <div class="mb-4">

                        <label class="text-muted">

                            Created At

                        </label>

                        <h6 class="mt-2">

                            {{ $device->created_at->format('d M Y H:i') }}

                        </h6>

                    </div>

                    <div class="d-grid gap-2 mt-4">

                        <button
                            type="submit"
                            class="btn-premium">

                            <i class="fa-solid fa-floppy-disk me-2"></i>

                            Update Device

                        </button>

                        <a
                            href="{{ route('devices.show',$device) }}"
                            class="btn btn-light border">

                            View Detail

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection