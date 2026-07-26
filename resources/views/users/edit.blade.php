@extends('layouts.app')

@section('title','Edit User')

@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div>

            <h1>

                <i class="fa-solid fa-user-pen text-primary me-2"></i>

                Edit User

            </h1>

            <p>

                Perbarui informasi pengguna Nadimax.

            </p>

        </div>

        <a
            href="{{ route('users.show',$user) }}"
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
        action="{{ route('users.update',$user) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card-premium">

            <div class="row g-4">

                <div class="col-lg-4">

                    <div class="text-center">

                        @if($user->profile_photo)

                        <img
                            id="preview"
                            src="{{ asset('uploads/profile/'.$user->profile_photo) }}"
                            class="rounded-circle shadow"
                            width="180"
                            height="180"
                            style="object-fit:cover;">

                        @else

                        <img
                            id="preview"
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=200"
                            class="rounded-circle shadow">

                        @endif

                        <div class="mt-4">

                            <input
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
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
                                class="form-control"
                                name="name"
                                value="{{ old('name',$user->name) }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email',$user->email) }}"
                                required>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Phone

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                value="{{ old('phone',$user->phone) }}">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Gender

                            </label>

                            <select
                                class="form-select"
                                name="gender">

                                <option value="">Choose</option>

                                <option
                                    value="Male"
                                    @selected($user->gender=='Male')>

                                    Male

                                </option>

                                <option
                                    value="Female"
                                    @selected($user->gender=='Female')>

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
                                class="form-control"
                                name="birth_date"
                                value="{{ old('birth_date',$user->birth_date) }}">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Subscription

                            </label>

                            <select
                                class="form-select"
                                name="subscription_id">

                                <option value="">

                                    Free User

                                </option>

                                @foreach($subscriptions as $subscription)

                                <option
                                    value="{{ $subscription->id }}"
                                    @selected($subscription->id==$user->subscription_id)>

                                    {{ $subscription->name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                New Password

                            </label>

                            <input
                                type="password"
                                class="form-control"
                                name="password">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Confirm Password

                            </label>

                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation">

                        </div>

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-3">

                <a
                    href="{{ route('users.show',$user) }}"
                    class="btn btn-secondary">

                    Cancel

                </a>

                <button
                    class="btn-premium">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Update User

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

    if(!e.target.files.length) return;

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