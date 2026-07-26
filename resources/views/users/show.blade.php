@extends('layouts.app')

@section('title', 'User Detail')

@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div>

            <h1>
                <i class="fa-solid fa-user text-primary me-2"></i>
                User Profile
            </h1>

            <p>
                Detail informasi pengguna Nadimax.
            </p>

        </div>

        <a
            href="{{ route('users.index') }}"
            class="btn-premium">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

        </a>

    </div>

    <div class="row g-4">

        <div class="col-lg-4">

            <div class="card-premium text-center">

                @if($user->profile_photo)

                    <img
                        src="{{ asset('uploads/profile/'.$user->profile_photo) }}"
                        class="rounded-circle mb-3"
                        width="150"
                        height="150"
                        style="object-fit:cover;">

                @else

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=200"
                        class="rounded-circle mb-3">

                @endif

                <h3>

                    {{ $user->name }}

                </h3>

                <p class="text-muted">

                    {{ $user->email }}

                </p>

                @if($user->subscription)

                    <span class="badge-premium badge-online">

                        {{ $user->subscription->name }}

                    </span>

                @else

                    <span class="badge-premium badge-warning">

                        Free User

                    </span>

                @endif

            </div>

        </div>

        <div class="col-lg-8">

            <div class="card-premium">

                <h4 class="mb-4">

                    Personal Information

                </h4>

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <strong>Phone</strong>

                        <p>

                            {{ $user->phone ?: '-' }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <strong>Gender</strong>

                        <p>

                            {{ $user->gender ?: '-' }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <strong>Birth Date</strong>

                        <p>

                            {{ $user->birth_date ?: '-' }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <strong>Subscription</strong>

                        <p>

                            {{ optional($user->subscription)->name ?? 'Free' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>
        <div class="row g-4 mt-1">

        <div class="col-lg-6">

            <div class="card-premium">

                <h4 class="mb-3">

                    Registered Devices

                </h4>

                @forelse($user->devices as $device)

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                        <div>

                            <strong>

                                {{ $device->device_name }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $device->serial_number }}

                            </small>

                        </div>

                        <span class="badge-premium badge-online">

                            {{ ucfirst($device->status) }}

                        </span>

                    </div>

                @empty

                    <p class="text-muted">

                        No registered device.

                    </p>

                @endforelse

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card-premium">

                <h4 class="mb-3">

                    Latest Heart Rate

                </h4>

                @forelse($user->heartRates->take(5) as $heart)

                    <div class="d-flex justify-content-between border-bottom py-3">

                        <span>

                            {{ $heart->created_at->format('d M Y H:i') }}

                        </span>

                        <strong>

                            {{ $heart->bpm }} BPM

                        </strong>

                    </div>

                @empty

                    <p class="text-muted">

                        No heart rate history.

                    </p>

                @endforelse

            </div>

        </div>

    </div>

    <div class="mt-4">

        <a
            href="{{ route('users.edit',$user) }}"
            class="btn-premium">

            <i class="fa-solid fa-pen me-2"></i>

            Edit User

        </a>

    </div>

</div>

@endsection