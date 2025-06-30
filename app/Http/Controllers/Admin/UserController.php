<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users, with optional search filtering.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
            'role'                  => 'required|string|in:user,admin',
            'status'                => 'required|in:pending,active,inactive,deleted',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form to edit an existing user.
     */
    public function edit(User $user)
    {
        $orders = $user->orders()->latest()->get();

        // Collect unique shipping addresses from user's orders
        $addresses = $orders->pluck('shipping_address')->unique()->filter();

        return view('admin.users.edit', compact('user', 'orders', 'addresses'));
    }

    /**
     * Update user information, including optional password update.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $user->id,
            'password'              => 'nullable|string|min:8|confirmed',
            'role'                  => 'required|string|in:user,admin',
            'status'                => 'required|in:pending,active,inactive,deleted',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Soft-delete user by changing status to 'deleted'.
     */
    public function destroy(User $user)
    {
        $user->update(['status' => 'deleted']);

        return redirect()->route('admin.users.index')
            ->with('success', 'User marked as deleted.');
    }
}
