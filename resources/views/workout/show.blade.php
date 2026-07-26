@extends('layouts.app')

@section('title','Workout Detail')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-dumbbell text-primary me-2"></i>

                Workout Detail

            </h1>

            <p class="text-muted mb-0">

                Informasi lengkap jadwal workout pengguna.

            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('workout.edit',$workout->id) }}"
                class="btn btn-warning">

                <i class="fa-solid fa-pen me-2"></i>

                Edit

            </a>

            <a
                href="{{ route('workout.index') }}"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card-premium">

        <div class="row">

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    User

                </label>

                <div class="detail-box">

                    {{ $workout->user->name }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Workout Title

                </label>

                <div class="detail-box">

                    {{ $workout->title }}

                </div>

            </div>

            <div class="col-12 mb-4">

                <label class="form-label fw-bold">

                    Description

                </label>

                <div class="detail-box" style="min-height:120px;">

                    {{ $workout->description ?: '-' }}

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <label class="form-label fw-bold">

                    Day

                </label>

                <div class="detail-box">

                    {{ $workout->day }}

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <label class="form-label fw-bold">

                    Start Time

                </label>

                <div class="detail-box">

                    {{ \Carbon\Carbon::parse($workout->start_time)->format('H:i') }}

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <label class="form-label fw-bold">

                    End Time

                </label>

                <div class="detail-box">

                    {{ \Carbon\Carbon::parse($workout->end_time)->format('H:i') }}

                </div>

            </div>
                        <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Status

                </label>

                <div class="detail-box">

                    @if($workout->status)

                        <span class="badge bg-success">

                            Active

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Inactive

                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Created At

                </label>

                <div class="detail-box">

                    {{ $workout->created_at->format('d M Y H:i') }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Last Updated

                </label>

                <div class="detail-box">

                    {{ $workout->updated_at->format('d M Y H:i') }}

                </div>

            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">

            <a
                href="{{ route('workout.edit', $workout->id) }}"
                class="btn btn-warning">

                <i class="fa-solid fa-pen-to-square me-2"></i>

                Edit Workout

            </a>

            <form
                action="{{ route('workout.destroy', $workout->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus workout ini?')">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger">

                    <i class="fa-solid fa-trash me-2"></i>

                    Delete

                </button>

            </form>

        </div>

    </div>
    </div>

@endsection