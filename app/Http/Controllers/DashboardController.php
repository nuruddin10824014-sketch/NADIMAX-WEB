<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Heartrate;
use App\Models\Subscription;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistic
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $totalDevices = Device::count();

        $onlineDevices = Device::where('status', 'Online')->count();

        $offlineDevices = Device::where('status', 'Offline')->count();

        $maintenanceDevices = Device::where('status', 'Maintenance')->count();

        $totalSubscriptions = Subscription::count();

        /*
        |--------------------------------------------------------------------------
        | Latest Data
        |--------------------------------------------------------------------------
        */

        $latestHeartRate = Heartrate::with('user', 'device')
            ->latest('recorded_at')
            ->first();

        $latestDevice = Device::latest()->first();

        /*
        |--------------------------------------------------------------------------
        | Recent User
        |--------------------------------------------------------------------------
        */

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Sensor
        |--------------------------------------------------------------------------
        */

        $recentHeartRates = Heartrate::with('user', 'device')
            ->latest('recorded_at')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart
        |--------------------------------------------------------------------------
        */

        $chartData = Heartrate::latest('recorded_at')
            ->take(20)
            ->get()
            ->reverse()
            ->values();

        $chartLabels = $chartData
            ->pluck('recorded_at')
            ->map(function ($time) {
                return $time->format('H:i');
            });

        $chartValues = $chartData->pluck('bpm');

        return view('dashboard.index', compact(

            'totalUsers',

            'totalDevices',

            'onlineDevices',

            'offlineDevices',

            'maintenanceDevices',

            'totalSubscriptions',

            'latestHeartRate',

            'latestDevice',

            'recentUsers',

            'recentHeartRates',

            'chartLabels',

            'chartValues'

        ));
    }
}