<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeviceController extends Controller
{
    /**
     * ======================================================
     * DEVICE LIST
     * ======================================================
     */

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status  = $request->status;

        $query = Device::with([
            'user',
            'heartRates'
        ]);

        if ($keyword) {

            $query->where(function ($q) use ($keyword) {

                $q->where('device_name', 'like', "%{$keyword}%")
                    ->orWhere('device_code', 'like', "%{$keyword}%")
                    ->orWhere('serial_number', 'like', "%{$keyword}%");

            });

        }

        if ($status) {

            $query->where('status', $status);

        }

        $devices = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('devices.index', [

            'devices' => $devices,

            'keyword' => $keyword,

            'status' => $status,

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            'totalDevices' => Device::count(),

            'onlineDevices' => Device::where(
                'status',
                'Online'
            )->count(),

            'offlineDevices' => Device::where(
                'status',
                'Offline'
            )->count(),

            'maintenanceDevices' => Device::where(
                'status',
                'Maintenance'
            )->count(),

            'averageBattery' => round(
                Device::avg('battery') ?? 0
            ),

            'averageSignal' => round(
                Device::avg('signal_strength') ?? 0
            ),

        ]);
    }

    /**
     * ======================================================
     * CREATE FORM
     * ======================================================
     */

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view(
            'devices.create',
            compact('users')
        );
    }

    /**
     * ======================================================
     * STORE DEVICE
     * ======================================================
     */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => [
                'nullable',
                'exists:users,id'
            ],

            'device_name' => [
                'required',
                'max:100'
            ],

            'serial_number' => [
                'required',
                'unique:devices,serial_number'
            ],

            'firmware' => [
                'nullable',
                'max:50'
            ],

            'battery' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'signal_strength' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'status' => [
                'required',
                Rule::in([
                    'Online',
                    'Offline',
                    'Maintenance'
                ])
            ],

        ]);

                /*
        |--------------------------------------------------------------------------
        | Generate Device Information
        |--------------------------------------------------------------------------
        */

        $validated['device_code'] =
            'NDMX-' .
            strtoupper(
                substr(
                    md5(
                        uniqid()
                    ),
                    0,
                    6
                )
            );

        $validated['api_key'] =
            bin2hex(
                random_bytes(16)
            );

        $validated['last_sync'] = now();

        Device::create($validated);

        return redirect()
            ->route('devices.index')
            ->with(
                'success',
                'Device berhasil ditambahkan.'
            );
    }

    /**
     * ======================================================
     * DETAIL DEVICE
     * ======================================================
     */

    public function show(Device $device)
    {
        $device->load([

            'user',

            'heartRates' => function ($query) {

                $query->latest();

            }

        ]);

        return view(
            'devices.show',
            compact('device')
        );
    }

    /**
     * ======================================================
     * EDIT FORM
     * ======================================================
     */

    public function edit(Device $device)
    {
        $users = User::orderBy('name')
            ->get();

        return view(
            'devices.edit',
            compact(
                'device',
                'users'
            )
        );
    }

    /**
     * ======================================================
     * UPDATE DEVICE
     * ======================================================
     */

    public function update(
        Request $request,
        Device $device
    )
    {
        $validated = $request->validate([

            'user_id' => [
                'nullable',
                'exists:users,id'
            ],

            'device_name' => [
                'required',
                'max:100'
            ],

            'serial_number' => [

                'required',

                Rule::unique('devices')
                    ->ignore($device->id)

            ],

            'firmware' => [
                'nullable',
                'max:50'
            ],

            'battery' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'signal_strength' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100'
            ],

            'status' => [

                'required',

                Rule::in([
                    'Online',
                    'Offline',
                    'Maintenance'
                ])

            ],

        ]);
                $validated['last_sync'] = now();

        $device->update($validated);

        return redirect()
            ->route('devices.index')
            ->with(
                'success',
                'Device berhasil diperbarui.'
            );
    }

    /**
     * ======================================================
     * DELETE DEVICE
     * ======================================================
     */

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()
            ->route('devices.index')
            ->with(
                'success',
                'Device berhasil dihapus.'
            );
    }
}