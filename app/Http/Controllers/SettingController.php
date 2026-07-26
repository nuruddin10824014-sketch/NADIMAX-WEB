<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::latest()->paginate(10);

        return view('setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'app_name'      => 'required|string|max:255',
            'company_name'  => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string',
            'timezone'      => 'required|string|max:100',
            'language'      => 'required|string|max:20',
            'theme'         => 'required|string|max:20',
        ]);

        Setting::create($request->only([
            'app_name',
            'company_name',
            'email',
            'phone',
            'address',
            'timezone',
            'language',
            'theme',
        ]));

        return redirect()
            ->route('setting.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $setting = Setting::findOrFail($id);

        return view('setting.show', compact('setting'));
    }
        /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = Setting::findOrFail($id);

        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'app_name'      => 'required|string|max:255',
            'company_name'  => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string',
            'timezone'      => 'required|string|max:100',
            'language'      => 'required|string|max:20',
            'theme'         => 'required|string|max:20',
        ]);

        $setting->update($request->only([
            'app_name',
            'company_name',
            'email',
            'phone',
            'address',
            'timezone',
            'language',
            'theme',
        ]));

        return redirect()
            ->route('setting.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $setting = Setting::findOrFail($id);

        $setting->delete();

        return redirect()
            ->route('setting.index')
            ->with('success', 'Setting deleted successfully.');
    }
}