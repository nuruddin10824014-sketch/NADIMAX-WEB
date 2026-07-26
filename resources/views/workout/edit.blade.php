@extends('layouts.app')

@section('title','Edit Workout Schedule')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">

                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>

                Edit Workout Schedule

            </h1>

            <p class="text-muted">

                Perbarui informasi jadwal workout pengguna.

            </p>

        </div>

        <a href="{{ route('workout.index') }}" class="btn btn-secondary">

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

        <form
            action="{{ route('workout.update',$workout->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

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
                                {{ old('user_id',$workout->user_id)==$user->id ? 'selected' : '' }}>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Workout Title

                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title',$workout->title) }}"
                        required>

                </div>

                <div class="col-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ old('description',$workout->description) }}</textarea>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Day

                    </label>

                    <select
                        name="day"
                        class="form-select"
                        required>

                        @php
                            $days = [
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday',
                                'Saturday',
                                'Sunday'
                            ];
                        @endphp

                        @foreach($days as $day)

                            <option
                                value="{{ $day }}"
                                {{ old('day',$workout->day)==$day ? 'selected' : '' }}>

                                {{ $day }}

                            </option>

                        @endforeach

                    </select>

                </div>
                                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Start Time

                    </label>

                    <input
                        type="time"
                        name="start_time"
                        class="form-control"
                        value="{{ old('start_time', \Carbon\Carbon::parse($workout->start_time)->format('H:i')) }}"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        End Time

                    </label>

                    <input
                        type="time"
                        name="end_time"
                        class="form-control"
                        value="{{ old('end_time', \Carbon\Carbon::parse($workout->end_time)->format('H:i')) }}"
                        required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option
                            value="1"
                            {{ old('status',$workout->status)=='1' ? 'selected' : '' }}>

                            Active

                        </option>

                        <option
                            value="0"
                            {{ old('status',$workout->status)=='0' ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('workout.index') }}"
                    class="btn btn-secondary">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    Cancel

                </a>

                <a
                    href="{{ route('workout.show',$workout->id) }}"
                    class="btn btn-info">

                    <i class="fa-solid fa-eye me-2"></i>

                    View Detail

                </a>

                <button
                    type="submit"
                    class="btn-premium">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Update Workout

                </button>

            </div>

        </form>

    </div>
</div>

@endsection