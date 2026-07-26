<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::latest()->paginate(10);

        return view('subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:1',
            'status'      => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        Subscription::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('subscription.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('subscription.show', compact('subscription'));
    }
        /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|integer|min:1',
            'status'      => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $subscription = Subscription::findOrFail($id);

        $subscription->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('subscription.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();

        return redirect()
            ->route('subscription.index')
            ->with('success', 'Subscription deleted successfully.');
    }
    }