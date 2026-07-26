<?php

namespace App\Http\Controllers;

use App\Models\Heartrate;
use App\Models\User;
use App\Models\Device;
use Illuminate\Http\Request;

class HeartRateController extends Controller
{
    /**
     * Menampilkan daftar data sensor.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $userId = $request->user_id;
        $deviceId = $request->device_id;

        $heartRates = Heartrate::with([
                'user',
                'device'
            ])
            ->when($keyword, function ($query) use ($keyword) {

                $query->where('bpm', 'like', "%{$keyword}%")
                    ->orWhere('spo2', 'like', "%{$keyword}%")
                    ->orWhere('body_temperature', 'like', "%{$keyword}%");

            })
            ->when($userId, function ($query) use ($userId) {

                $query->where('user_id', $userId);

            })
            ->when($deviceId, function ($query) use ($deviceId) {

                $query->where('device_id', $deviceId);

            })
            ->latest('recorded_at')
            ->paginate(15)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        $devices = Device::orderBy('device_name')->get();

        return view(
            'heart-rate.index',
            compact(
                'heartRates',
                'users',
                'devices',
                'keyword',
                'userId',
                'deviceId'
            )
        );
    }

    /**
     * Detail pembacaan sensor.
     */
    public function show(Heartrate $heartrate)
    {
        $heartrate->load([
            'user',
            'device'
        ]);

        return view(
            'heart-rate.show',
            compact('heartrate')
        );
    }

    /**
     * Form tambah data manual.
     */
    public function create()
    
    {
        $users = User::orderBy('name')->get();

        $devices = Device::orderBy('device_name')->get();

        return view(
            'heart-rate.create',
            compact(
                'users',
                'devices'
            )
        );
    }
    /**
 * Form edit data sensor.
 */
public function edit(Heartrate $heartrate)
{
    $users = User::orderBy('name')->get();

    $devices = Device::orderBy('device_name')->get();

    return view(
        'heart-rate.edit',
        compact(
            'heartrate',
            'users',
            'devices'
        )
    );
}

/**
 * Update data sensor.
 */
public function update(Request $request, Heartrate $heartrate)
{
    $validated = $request->validate([

        'user_id' => 'required|exists:users,id',

        'device_id' => 'required|exists:devices,id',

        'bpm' => 'required|numeric|min:20|max:250',

        'spo2' => 'required|numeric|min:50|max:100',

        'body_temperature' => 'required|numeric|min:30|max:45',

        'air_quality' => 'nullable|numeric',

        'recorded_at' => 'required|date',

    ]);

    $heartrate->update($validated);

    return redirect()
        ->route('heart-rate.show', $heartrate)
        ->with(
            'success',
            'Data Heart Rate berhasil diperbarui.'
        );
}
    /**
     * Simpan data sensor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => 'required|exists:users,id',

            'device_id' => 'required|exists:devices,id',

            'bpm' => 'required|numeric|min:20|max:250',

            'spo2' => 'required|numeric|min:50|max:100',

            'body_temperature' => 'required|numeric|min:30|max:45',

            'air_quality' => 'nullable|numeric',

            'recorded_at' => 'required|date',

        ]);

        Heartrate::create($validated);

        return redirect()
            ->route('heart-rate.index')
            ->with(
                'success',
                'Data Heart Rate berhasil ditambahkan.'
            );
    }

    /**
     * Hapus data.
     */
    public function destroy(Heartrate $heartrate)
    {
        $heartrate->delete();

        return redirect()
            ->route('heart-rate.index')
            ->with(
                'success',
                'Data berhasil dihapus.'
            );
    }
}