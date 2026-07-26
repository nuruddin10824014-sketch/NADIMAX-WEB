@extends('layouts.app')

@section('title','Workout Schedule')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-dumbbell text-primary me-2"></i>

                Workout Schedule

            </h1>

            <p class="text-muted mb-0">

                Kelola seluruh jadwal latihan pengguna Nadimax.

            </p>

        </div>

        <div>

            <a href="{{ route('workout.create') }}" class="btn-premium">

                <i class="fa-solid fa-plus me-2"></i>

                Add Workout

            </a>

        </div>

    </div>

    <div class="card-premium mb-4">

        <div class="row">

            <div class="col-md-3">

                <div class="summary-box">

                    <small>Total Schedule</small>

                    <h2>{{ \App\Models\Workoutschedule::count() }}</h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="summary-box">

                    <small>Active</small>

                    <h2 class="text-success">

                        {{ \App\Models\Workoutschedule::where('status',1)->count() }}

                    </h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="summary-box">

                    <small>Inactive</small>

                    <h2 class="text-danger">

                        {{ \App\Models\Workoutschedule::where('status',0)->count() }}

                    </h2>

                </div>

            </div>

            <div class="col-md-3">

                <div class="summary-box">

                    <small>Total Users</small>

                    <h2>

                        {{ \App\Models\User::count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card-premium">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                Workout List

            </h4>

            <input
                type="text"
                class="form-control"
                placeholder="Search workout..."
                style="max-width:250px;">

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>User</th>

                        <th>Workout</th>

                        <th>Day</th>

                        <th>Start</th>

                        <th>End</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse(\App\Models\Workoutschedule::latest()->get() as $workout)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $workout->user->name }}</td>

                        <td>{{ $workout->title }}</td>
                        <td>

                            <span class="fw-semibold">

                                {{ $workout->day }}

                            </span>

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($workout->start_time)->format('H:i') }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($workout->end_time)->format('H:i') }}

                        </td>

                        <td>

                            @if($workout->status)

                                <span class="badge bg-success">

                                    Active

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('workout.show',$workout->id) }}"
                                    class="btn btn-info btn-sm">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <a
                                    href="{{ route('workout.edit',$workout->id) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    action="{{ route('workout.destroy',$workout->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this workout schedule?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">

                            <div class="text-center py-5">

                                <i class="fa-solid fa-dumbbell fa-3x text-secondary mb-3"></i>

                                <h5 class="fw-bold">

                                    No Workout Schedule Found

                                </h5>

                                <p class="text-muted mb-4">

                                    Belum ada jadwal workout yang ditambahkan.

                                </p>

                                <a
                                    href="{{ route('workout.create') }}"
                                    class="btn-premium">

                                    <i class="fa-solid fa-plus me-2"></i>

                                    Add First Workout

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
    </div>

@endsection