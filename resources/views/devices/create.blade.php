@extends('layouts.app')

@section('title','Tambah Device')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="fa-solid fa-plus-circle text-primary me-2"></i>

                Tambah Device

            </h2>

            <p class="text-muted">

                Tambahkan perangkat Nadimax baru.

            </p>

        </div>

        <a href="{{ route('devices.index') }}" class="btn btn-secondary">

            <i class="fa fa-arrow-left me-2"></i>

            Kembali

        </a>

    </div>

    @if($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form

        action="{{ route('devices.store') }}"

        method="POST">

        @csrf

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Informasi Device

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-lg-6 mb-3">

                        <label class="form-label">

                            Nama Device

                        </label>

                        <input

                            type="text"

                            name="device_name"

                            value="{{ old('device_name') }}"

                            class="form-control"

                            required>

                    </div>

                    <div class="col-lg-6 mb-3">

                        <label class="form-label">

                            Serial Number

                        </label>

                        <input

                            type="text"

                            name="serial_number"

                            value="{{ old('serial_number') }}"

                            class="form-control"

                            required>

                    </div>

                    <div class="col-lg-6 mb-3">

                        <label class="form-label">

                            Firmware

                        </label>

                        <input

                            type="text"

                            name="firmware"

                            value="{{ old('firmware') }}"

                            class="form-control">

                    </div>

                    <div class="col-lg-6 mb-3">

                        <label class="form-label">

                            Pemilik Device

                        </label>

                        <select

                            name="user_id"

                            class="form-select">

                            <option value="">

                                Belum Dipasang

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
                                        <div class="col-lg-4 mb-3">

                        <label class="form-label">

                            Battery (%)

                        </label>

                        <input

                            type="number"

                            min="0"

                            max="100"

                            name="battery"

                            value="{{ old('battery',100) }}"

                            class="form-control">

                    </div>

                    <div class="col-lg-4 mb-3">

                        <label class="form-label">

                            Signal (%)

                        </label>

                        <input

                            type="number"

                            min="0"

                            max="100"

                            name="signal_strength"

                            value="{{ old('signal_strength',100) }}"

                            class="form-control">

                    </div>

                    <div class="col-lg-4 mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select

                            name="status"

                            class="form-select">

                            <option value="Online">

                                Online

                            </option>

                            <option value="Offline">

                                Offline

                            </option>

                            <option value="Maintenance">

                                Maintenance

                            </option>

                        </select>

                    </div>

                    <div class="col-lg-12">

                        <div class="alert alert-info">

                            <strong>

                                Catatan

                            </strong>

                            <hr>

                            Device Code akan dibuat otomatis oleh sistem ketika device disimpan.

                        </div>

                    </div>

                </div>

            </div>
                        <div class="card-footer bg-white text-end">

                <a

                    href="{{ route('devices.index') }}"

                    class="btn btn-secondary">

                    Batal

                </a>

                <button

                    class="btn btn-primary">

                    <i class="fa fa-save me-2"></i>

                    Simpan Device

                </button>

            </div>

        </div>

    </form>

</div>

@endsection