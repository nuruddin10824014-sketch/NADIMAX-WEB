<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Heartrate;

class DashboardApiController extends Controller
{
    public function latest()
    {
        $heartRate = Heartrate::with('user','device')
            ->latest('recorded_at')
            ->first();

        $device = Device::latest()->first();

        $chart = Heartrate::latest('recorded_at')
            ->take(20)
            ->get()
            ->reverse()
            ->values();

        return response()->json([

            'heart_rate' => $heartRate,

            'device' => $device,

            'chart' => [

                'labels' => $chart->pluck('recorded_at')
                    ->map(fn($item)=>$item->format('H:i')),

                'values' => $chart->pluck('bpm')

            ]

        ]);
    }
}