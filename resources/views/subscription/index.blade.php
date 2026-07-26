@extends('layouts.app')

@section('title','Subscription')

@section('content')

<div class="container-fluid">

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">

                <i class="fa-solid fa-credit-card text-primary me-2"></i>

                Subscription Plans

            </h1>

            <p class="text-muted mb-0">

                Kelola seluruh paket langganan Nadimax.

            </p>

        </div>

        <a
            href="{{ route('subscription.create') }}"
            class="btn-premium">

            <i class="fa-solid fa-plus me-2"></i>

            Add Subscription

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row g-4 mb-4">

        <div class="col-md-3">

            <div class="summary-box">

                <small>Total Package</small>

                <h2>

                    {{ \App\Models\Subscription::count() }}

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="summary-box">

                <small>Active</small>

                <h2 class="text-success">

                    {{ \App\Models\Subscription::where('status',1)->count() }}

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="summary-box">

                <small>Inactive</small>

                <h2 class="text-danger">

                    {{ \App\Models\Subscription::where('status',0)->count() }}

                </h2>

            </div>

        </div>

        <div class="col-md-3">

            <div class="summary-box">

                <small>Average Price</small>

                <h2 class="text-primary">

                    Rp {{ number_format(\App\Models\Subscription::avg('price'),0,',','.') }}

                </h2>

            </div>

        </div>

    </div>

    <div class="card-premium">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold mb-0">

                Subscription List

            </h4>

            <input
                type="text"
                class="form-control"
                placeholder="Search subscription..."
                style="max-width:260px;">

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Package</th>

                        <th>Price</th>

                        <th>Duration</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($subscriptions as $subscription)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <strong>

                                {{ $subscription->name }}

                            </strong>

                        </td>

                        <td>

                            Rp {{ number_format($subscription->price,0,',','.') }}

                        </td>
                                                <td>

                            {{ $subscription->duration }} Days

                        </td>

                        <td>

                            @if($subscription->status)

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
                                    href="{{ route('subscription.show', $subscription->id) }}"
                                    class="btn btn-info btn-sm">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <a
                                    href="{{ route('subscription.edit', $subscription->id) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form
                                    action="{{ route('subscription.destroy', $subscription->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this subscription?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="text-center py-5">

                                <i class="fa-solid fa-credit-card fa-3x text-secondary mb-3"></i>

                                <h5 class="fw-bold">

                                    No Subscription Found

                                </h5>

                                <p class="text-muted mb-4">

                                    Belum ada paket subscription yang tersedia.

                                </p>

                                <a
                                    href="{{ route('subscription.create') }}"
                                    class="btn-premium">

                                    <i class="fa-solid fa-plus me-2"></i>

                                    Add First Subscription

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4 d-flex justify-content-end">

            {{ $subscriptions->links() }}

        </div>

    </div>
    </div>

@endsection