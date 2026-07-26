@extends('layouts.app')

@section('title','Tambah User')

@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div>

            <h1>

                <i class="fa-solid fa-user-plus text-primary me-2"></i>

                Add New User

            </h1>

            <p>

                Tambahkan pengguna baru ke sistem Nadimax.

            </p>

        </div>

        <a
            href="{{ route('users.index') }}"
            class="btn-premium">

            <i class="fa-solid fa-arrow-left me-2"></i>

            Back

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
        action="{{ route('users.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="card-premium">

            <div class="row g-4">

                <div class="col-lg-4">

                    <div class="text-center">

                        <img
                            id="preview"
                            src="https://ui-avatars.com/api/?name=User&background=2563eb&color=fff&size=200"
                            class="rounded-circle shadow"
                            width="180"
                            height="180"
                            style="object-fit:cover;">

                        <div class="mt-4">

                            <input
                                type="file"
                                name="profile_photo"
                                id="profile_photo"
                                class="form-control">

                        </div>

                    </div>

                </div>

                <div class="col-lg-8">
                                        <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">

                                Full Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Phone

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Gender

                            </label>

                            <select
                                name="gender"
                                class="form-select">

                                <option value="">Choose</option>

                                <option value="Male">

                                    Male

                                </option>

                                <option value="Female">

                                    Female

                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Birth Date

                            </label>

                            <input
                                type="date"
                                name="birth_date"
                                class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Subscription

                            </label>

                            <select
                                name="subscription_id"
                                class="form-select">

                                <option value="">

                                    Free User

                                </option>

                                @foreach($subscriptions as $subscription)

                                <option
                                    value="{{ $subscription->id }}">

                                    {{ $subscription->name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Confirm Password

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-3">

                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-secondary">

                    Cancel

                </a>

                <button
                    class="btn-premium">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Save User

                </button>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

document
.getElementById('profile_photo')
.addEventListener('change',function(e){

    const reader=new FileReader();

    reader.onload=function(){

        document
        .getElementById('preview')
        .src=reader.result;

    }

    reader.readAsDataURL(e.target.files[0]);

});

</script>

@endpush