@extends('layouts.app')

@section('title','Edit Subscription')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold">

                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>

                Edit Subscription

            </h1>

            <p class="text-muted">

                Perbarui informasi paket subscription.

            </p>

        </div>

        <a href="{{ route('subscription.index') }}" class="btn btn-secondary">

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

    <div class="card-premium">

        <form
            action="{{ route('subscription.update',$subscription->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Package Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$subscription->name) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Price

                    </label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price',$subscription->price) }}"
                        min="0"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Duration (Days)

                    </label>

                    <input
                        type="number"
                        name="duration"
                        class="form-control"
                        value="{{ old('duration',$subscription->duration) }}"
                        min="1"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option
                            value="1"
                            {{ old('status',$subscription->status)=='1' ? 'selected' : '' }}>

                            Active

                        </option>

                        <option
                            value="0"
                            {{ old('status',$subscription->status)=='0' ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

                <div class="col-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control">{{ old('description',$subscription->description) }}</textarea>

                </div>
                                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('subscription.index') }}"
                        class="btn btn-secondary">

                        <i class="fa-solid fa-arrow-left me-2"></i>

                        Cancel

                    </a>

                    <a
                        href="{{ route('subscription.show',$subscription->id) }}"
                        class="btn btn-info">

                        <i class="fa-solid fa-eye me-2"></i>

                        View Detail

                    </a>

                    <button
                        type="submit"
                        class="btn-premium">

                        <i class="fa-solid fa-floppy-disk me-2"></i>

                        Update Subscription

                    </button>

                </div>

            </div>

        </form>

    </div>
    </div>

@endsection