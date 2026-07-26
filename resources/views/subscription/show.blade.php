@extends('layouts.app')

@section('title','Subscription Detail')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-credit-card text-primary me-2"></i>

                Subscription Detail

            </h1>

            <p class="text-muted mb-0">

                Informasi lengkap paket subscription.

            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('subscription.edit',$subscription->id) }}"
                class="btn btn-warning">

                <i class="fa-solid fa-pen me-2"></i>

                Edit

            </a>

            <a
                href="{{ route('subscription.index') }}"
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

                    Package Name

                </label>

                <div class="detail-box">

                    {{ $subscription->name }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Price

                </label>

                <div class="detail-box">

                    Rp {{ number_format($subscription->price,0,',','.') }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Duration

                </label>

                <div class="detail-box">

                    {{ $subscription->duration }} Days

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Status

                </label>

                <div class="detail-box">

                    @if($subscription->status)

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

            <div class="col-12 mb-4">

                <label class="form-label fw-bold">

                    Description

                </label>

                <div class="detail-box" style="min-height:120px;">

                    {{ $subscription->description ?: '-' }}

                </div>

            </div>
                        <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Created At

                </label>

                <div class="detail-box">

                    {{ $subscription->created_at->format('d M Y H:i') }}

                </div>

            </div>

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Last Updated

                </label>

                <div class="detail-box">

                    {{ $subscription->updated_at->format('d M Y H:i') }}

                </div>

            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2">

            <a
                href="{{ route('subscription.edit', $subscription->id) }}"
                class="btn btn-warning">

                <i class="fa-solid fa-pen-to-square me-2"></i>

                Edit Subscription

            </a>

            <form
                action="{{ route('subscription.destroy', $subscription->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus subscription ini?')">

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