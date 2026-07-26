<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Heartrate;
use App\Models\Device;

class HeartRateApiController extends Controller
{
    /**
     * Endpoint penerima data dari ESP32.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_code' => 'required|string',

            'bpm' => 'required|numeric',

            'spo2' => 'required|numeric',

            'body_temperature' => 'required|numeric',

            'air_quality' => 'nullable|numeric',

            'battery' => 'nullable|numeric|min:0|max:100',

            'signal_strength' => 'nullable|numeric|min:0|max:100',
        ]);

        $device = Device::where(
            'device_code',
            $validated['device_code']
        )->first();

        if (!$device) {

            return response()->json([
                'success' => false,
                'message' => 'Device tidak ditemukan.'
            ], 404);
        }

        $device->update([

            'battery' => $validated['battery'] ?? $device->battery,

            'signal_strength' => $validated['signal_strength'] ?? $device->signal_strength,

            'status' => 'Online',

            'last_sync' => now(),
        ]);

        $heartRate = Heartrate::create([

            'user_id' => $device->user_id,

            'device_id' => $device->id,

            'bpm' => $validated['bpm'],

            'spo2' => $validated['spo2'],

            'body_temperature' => $validated['body_temperature'],

            'air_quality' => $validated['air_quality'] ?? null,

            'recorded_at' => now(),
        ]);

        return response()->json([

            'success' => true,

            'message' => 'Data berhasil diterima.',

            'data' => $heartRate,
        ], 201);
    }
}