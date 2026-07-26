<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Workoutschedule;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workoutschedule::with('user')
                        ->latest()
                        ->paginate(10);

        return view('workout.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('workout.create', compact('users'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'day'         => 'required|string|max:20',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'status'      => 'required|boolean',
        ]);

        Workoutschedule::create([
            'user_id'     => $request->user_id,
            'title'       => $request->title,
            'description' => $request->description,
            'day'         => $request->day,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'status'      => $request->status,
        ]);

        return redirect()
            ->route('workout.index')
            ->with('success', 'Workout schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workout = Workoutschedule::with('user')->findOrFail($id);

        return view('workout.show', compact('workout'));
    }
        /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $workout = Workoutschedule::findOrFail($id);

        $users = User::orderBy('name')->get();

        return view('workout.edit', compact('workout', 'users'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'day'         => 'required|string|max:20',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
            'status'      => 'required|boolean',
        ]);

        $workout = Workoutschedule::findOrFail($id);

        $workout->update([
            'user_id'     => $request->user_id,
            'title'       => $request->title,
            'description' => $request->description,
            'day'         => $request->day,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'status'      => $request->status,
        ]);

        return redirect()
            ->route('workout.index')
            ->with('success', 'Workout schedule updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $workout = Workoutschedule::findOrFail($id);

        $workout->delete();

        return redirect()
            ->route('workout.index')
            ->with('success', 'Workout schedule deleted successfully.');
    }
    }