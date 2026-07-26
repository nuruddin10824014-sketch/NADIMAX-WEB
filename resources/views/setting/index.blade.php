@extends('layouts.app')

@section('title', 'Settings')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/setting.css') }}">
@endpush

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>
                <i class="fa-solid fa-gear me-2"></i>
                System Settings
            </h1>

            <p>
                Configure application information and preferences.
            </p>
        </div>

        <a href="{{ route('setting.create') }}" class="btn btn-premium">
            <i class="fa-solid fa-plus me-2"></i>
            Add Setting
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- Summary -->
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="summary-box">

                <small>Total Settings</small>

                <h2>{{ $settings->total() }}</h2>

            </div>

        </div>

        <div class="col-md-4">

            <div class="summary-box">

                <small>Timezone</small>

                <h2>
                    {{ $settings->first()->timezone ?? '-' }}
                </h2>

            </div>

        </div>

        <div class="col-md-4">

            <div class="summary-box">

                <small>Theme</small>

                <h2 class="text-capitalize">
                    {{ $settings->first()->theme ?? '-' }}
                </h2>

            </div>

        </div>

    </div>

    <!-- Card -->
    <div class="card-premium">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th width="60">#</th>

                        <th>Application</th>

                        <th>Company</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Theme</th>

                        <th width="220" class="text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>
                                        @forelse($settings as $setting)

                        <tr>

                            <td>{{ $loop->iteration + ($settings->firstItem() - 1) }}</td>

                            <td>

                                <strong>{{ $setting->app_name }}</strong>

                            </td>

                            <td>{{ $setting->company_name ?? '-' }}</td>

                            <td>{{ $setting->email ?? '-' }}</td>

                            <td>{{ $setting->phone ?? '-' }}</td>

                            <td>

                                <span class="badge bg-primary text-capitalize">

                                    {{ $setting->theme }}

                                </span>

                            </td>

                            <td class="text-center">

                                <a href="{{ route('setting.show', $setting->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <a href="{{ route('setting.edit', $setting->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form action="{{ route('setting.destroy', $setting->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this setting?')">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="text-center py-5">

                                    <i class="fa-solid fa-gears fa-4x text-secondary mb-3"></i>

                                    <h5>No Settings Found</h5>

                                    <p class="text-muted">

                                        Click the button above to create the first setting.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $settings->links() }}

        </div>
            </div>

</div>

@endsection