@extends('layouts.app')

@section('title', 'Setting Detail')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/setting.css') }}">
@endpush

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1>

                <i class="fa-solid fa-gears me-2"></i>

                Setting Detail

            </h1>

            <p>

                View complete system configuration information.

            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('setting.index') }}" class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

            <a href="{{ route('setting.edit', $setting->id) }}" class="btn btn-warning">

                <i class="fa-solid fa-pen me-2"></i>

                Edit

            </a>

        </div>

    </div>

    <div class="card-premium">

        <div class="row">

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Application Name

                </label>

                <div class="detail-box">

                    {{ $setting->app_name }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Company Name

                </label>

                <div class="detail-box">

                    {{ $setting->company_name ?: '-' }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Email

                </label>

                <div class="detail-box">

                    {{ $setting->email ?: '-' }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Phone

                </label>

                <div class="detail-box">

                    {{ $setting->phone ?: '-' }}

                </div>

            </div>

            <div class="col-12 mb-4">

                <label class="form-label">

                    Address

                </label>

                <div class="detail-box">

                    {{ $setting->address ?: '-' }}

                </div>

            </div>
                        <div class="col-md-4 mb-4">

                <label class="form-label">

                    Timezone

                </label>

                <div class="detail-box">

                    {{ $setting->timezone }}

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <label class="form-label">

                    Language

                </label>

                <div class="detail-box text-uppercase">

                    {{ $setting->language }}

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <label class="form-label">

                    Theme

                </label>

                <div class="detail-box">

                    <span class="badge bg-primary text-capitalize">

                        {{ $setting->theme }}

                    </span>

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Logo

                </label>

                <div class="detail-box">

                    @if($setting->logo)

                        <img
                            src="{{ asset('storage/' . $setting->logo) }}"
                            alt="Logo"
                            style="max-height:70px;">

                    @else

                        -

                    @endif

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label">

                    Favicon

                </label>

                <div class="detail-box">

                    @if($setting->favicon)

                        <img
                            src="{{ asset('storage/' . $setting->favicon) }}"
                            alt="Favicon"
                            style="max-height:45px;">

                    @else

                        -

                    @endif

                </div>

            </div>

            <hr class="my-4">
                        <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('setting.index') }}" class="btn btn-secondary">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    Back

                </a>

                <a href="{{ route('setting.edit', $setting->id) }}" class="btn btn-warning">

                    <i class="fa-solid fa-pen me-2"></i>

                    Edit Setting

                </a>

            </div>

        </div>

    </div>

</div>

@endsection