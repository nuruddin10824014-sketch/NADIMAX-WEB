<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = User::with('subscription');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('phone', 'like', "%{$keyword}%");
            });
        }

        $users = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('users.index', [
            'users' => $users,
            'keyword' => $keyword,

            // Statistik
            'totalUsers'        => User::count(),
            'maleUsers'         => User::where('gender', 'Male')->count(),
            'femaleUsers'       => User::where('gender', 'Female')->count(),
            'subscriptionUsers' => User::whereNotNull('subscription_id')->count(),
        ]);
    }

    /**
     * Form tambah user.
     */
    public function create()
    {
        $subscriptions = Subscription::where('status', true)
            ->orderBy('name')
            ->get();

        return view('users.create', compact('subscriptions'));
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'gender' => [
                'nullable',
                Rule::in(['Male', 'Female']),
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'subscription_id' => [
                'nullable',
                'exists:subscriptions,id',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

        ]);

        if ($request->hasFile('profile_photo')) {

            $photo = $request->file('profile_photo');

            $filename = time() . '_' . $photo->getClientOriginalName();

            $photo->move(public_path('uploads/profile'), $filename);

            $validated['profile_photo'] = $filename;
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Detail user.
     */
    public function show(User $user)
    {
        $user->load([
            'subscription',
            'devices',
            'heartRates',
        ]);

        return view('users.show', compact('user'));
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        $subscriptions = Subscription::where('status', true)
            ->orderBy('name')
            ->get();

        return view('users.edit', compact('user', 'subscriptions'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'gender' => [
                'nullable',
                Rule::in(['Male', 'Female']),
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'subscription_id' => [
                'nullable',
                'exists:subscriptions,id',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:8',
            ],

        ]);

        if ($request->hasFile('profile_photo')) {

            if (
                $user->profile_photo &&
                file_exists(public_path('uploads/profile/' . $user->profile_photo))
            ) {
                unlink(public_path('uploads/profile/' . $user->profile_photo));
            }

            $photo = $request->file('profile_photo');

            $filename = time() . '_' . $photo->getClientOriginalName();

            $photo->move(public_path('uploads/profile'), $filename);

            $validated['profile_photo'] = $filename;
        }

        if (!empty($validated['password'])) {

            $validated['password'] = Hash::make($validated['password']);

        } else {

            unset($validated['password']);

        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        if (
            $user->profile_photo &&
            file_exists(public_path('uploads/profile/' . $user->profile_photo))
        ) {
            unlink(public_path('uploads/profile/' . $user->profile_photo));
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}