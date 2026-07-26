@extends('layouts.app')

@section('title', 'User Management')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="page-header">

        <div>

            <h1>
                <i class="fa-solid fa-users text-primary me-2"></i>
                User Management
            </h1>

            <p>
                Manage all registered Nadimax users.
            </p>

        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-user-plus"></i>
    <span>Add User</span>
</a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show mb-4">

        <i class="fa-solid fa-circle-check me-2"></i>

        {{ session('success') }}

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

    @endif

    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Total Users

                        </small>

                        <h2 class="mt-2">

                            {{ $users->total() }}

                        </h2>

                    </div>

                    <div class="health-icon primary">

                        <i class="fa-solid fa-users"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Male

                        </small>

                        <h2 class="mt-2">

                            {{ \App\Models\User::where('gender','Male')->count() }}

                        </h2>

                    </div>

                    <div class="health-icon success">

                        <i class="fa-solid fa-person"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Female

                        </small>

                        <h2 class="mt-2">

                            {{ \App\Models\User::where('gender','Female')->count() }}

                        </h2>

                    </div>

                    <div class="health-icon danger">

                        <i class="fa-solid fa-person-dress"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card-premium">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Subscription

                        </small>

                        <h2 class="mt-2">

                            {{ \App\Models\User::whereNotNull('subscription_id')->count() }}

                        </h2>

                    </div>

                    <div class="health-icon warning">

                        <i class="fa-solid fa-crown"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Main Card --}}
    <div class="card-premium">

        <div class="users-toolbar">

            <div>

                <h4 class="mb-1">

                    Registered Users

                </h4>

                <small class="text-muted">

                    Total {{ $users->total() }} users registered

                </small>

            </div>

        </div>

        {{-- Search --}}
        <form
            method="GET"
            class="toolbar mb-4">

            <div class="users-search">

                <i class="fa-solid fa-search"></i>

                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword }}"
                    placeholder="Search user by name, email or phone...">

            </div>

        </form>

        {{-- User Grid --}}
        <div class="user-grid">

            @forelse($users as $user)

            <div class="user-card">

                @if($user->profile_photo)

                    <img
                        src="{{ asset('uploads/profile/'.$user->profile_photo) }}"
                        alt="{{ $user->name }}">

                @else

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff"
                        alt="{{ $user->name }}">

                @endif

                <h4>

                    {{ $user->name }}

                </h4>

                <span>

                    {{ $user->email }}

                </span>
                                <div class="user-info">

                    <div>

                        <strong>
                            Phone
                        </strong>

                        <span>
                            {{ $user->phone ?: '-' }}
                        </span>

                    </div>

                    <div>

                        <strong>
                            Gender
                        </strong>

                        <span>

                            @if($user->gender == 'Male')
                                Male
                            @elseif($user->gender == 'Female')
                                Female
                            @else
                                -
                            @endif

                        </span>

                    </div>

                    <div>

                        <strong>
                            Subscription
                        </strong>

                        <span>

                            @if($user->subscription)

                                {{ $user->subscription->name }}

                            @else

                                Free

                            @endif

                        </span>

                    </div>

                    <div>

                        <strong>
                            Status
                        </strong>

                        <span class="badge-online badge-premium">

                            Active

                        </span>

                    </div>

                </div>

                <div class="d-grid gap-2 mt-3">

                    <a
                        href="{{ route('users.show',$user) }}"
                        class="btn-premium text-center">

                        <i class="fa-solid fa-eye me-2"></i>

                        View Detail

                    </a>

                </div>

                <div class="row mt-3">

                    <div class="col-6">

                        <a
                            href="{{ route('users.edit',$user) }}"
                            class="btn btn-warning w-100">

                            <i class="fa-solid fa-pen"></i>

                        </a>

                    </div>

                    <div class="col-6">

                        <form
                            action="{{ route('users.destroy',$user) }}"
                            method="POST">

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus user ini?')"
                                class="btn btn-danger w-100">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12">

                <div class="text-center py-5">

                    <i class="fa-solid fa-users-slash fa-4x text-secondary mb-3"></i>

                    <h4>

                        Belum Ada User

                    </h4>

                    <p class="text-muted">

                        Silakan tambahkan user pertama.

                    </p>

                    <a
                        href="{{ route('users.create') }}"
                        class="btn-premium">

                        Tambah User

                    </a>

                </div>

            </div>

            @endforelse

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                Menampilkan

                <strong>

                    {{ $users->firstItem() ?? 0 }}

                </strong>

                -

                <strong>

                    {{ $users->lastItem() ?? 0 }}

                </strong>

                dari

                <strong>

                    {{ $users->total() }}

                </strong>

                user

            </div>

            <div>

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

@endsection