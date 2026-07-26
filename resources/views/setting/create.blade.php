@extends('layouts.app')

@section('title', 'Create Setting')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/setting.css') }}">
@endpush

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1>
                <i class="fa-solid fa-gears me-2"></i>
                Create Setting
            </h1>

            <p>
                Add a new system configuration.
            </p>

        </div>

        <a href="{{ route('setting.index') }}" class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card-premium">

        <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Application Name
                    </label>

                    <input
                        type="text"
                        name="app_name"
                        class="form-control"
                        value="{{ old('app_name') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Company Name
                    </label>

                    <input
                        type="text"
                        name="company_name"
                        class="form-control"
                        value="{{ old('company_name') }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}">

                </div>
                                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="form-control">{{ old('address') }}</textarea>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Timezone
                    </label>

                    <select name="timezone" class="form-select">

                        <option value="Asia/Jakarta"
                            {{ old('timezone') == 'Asia/Jakarta' ? 'selected' : '' }}>
                            Asia/Jakarta
                        </option>

                        <option value="Asia/Makassar"
                            {{ old('timezone') == 'Asia/Makassar' ? 'selected' : '' }}>
                            Asia/Makassar
                        </option>

                        <option value="Asia/Jayapura"
                            {{ old('timezone') == 'Asia/Jayapura' ? 'selected' : '' }}>
                            Asia/Jayapura
                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Language
                    </label>

                    <select name="language" class="form-select">

                        <option value="id"
                            {{ old('language') == 'id' ? 'selected' : '' }}>
                            Indonesia
                        </option>

                        <option value="en"
                            {{ old('language') == 'en' ? 'selected' : '' }}>
                            English
                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Theme
                    </label>

                    <select name="theme" class="form-select">

                        <option value="light"
                            {{ old('theme') == 'light' ? 'selected' : '' }}>
                            Light
                        </option>

                        <option value="dark"
                            {{ old('theme') == 'dark' ? 'selected' : '' }}>
                            Dark
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Favicon
                    </label>

                    <input
                        type="file"
                        name="favicon"
                        class="form-control">

                </div>

                <hr class="my-4">
                                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('setting.index') }}" class="btn btn-secondary">

                        <i class="fa-solid fa-arrow-left me-2"></i>

                        Cancel

                    </a>

                    <button type="submit" class="btn btn-premium">

                        <i class="fa-solid fa-floppy-disk me-2"></i>

                        Save Setting

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
