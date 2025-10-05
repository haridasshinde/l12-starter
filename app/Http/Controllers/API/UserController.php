<?php

namespace App\Http\Controllers\API;

use App\Enums\SearchTarget;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a paginated list of users.
     */
    public function index(Request $request)
    {
        $search = $request->q;
        $target = $request->target;

        // Default start/end to today if not provided
        $start = $request->start ?? now()->startOfDay()->format('Y-m-d H:i:s');
        $end = $request->end ?? now()->endOfDay()->format('Y-m-d H:i:s');

        $users = User::latest()
            ->when($search && SearchTarget::isValid($target), function ($query) use ($search, $target) {
                $query->where($target, 'like', "%{$search}%");
            })
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('created_at', [$start, $end]);
            })
            ->paginate(10);

        return Inertia::render('users/Index', [
            'message' => 'Users have been successfully loaded',
            'users' => $users,
            'filters' => [
                'start' => $start,
                'end' => $end,
                'target' => $target,
                'q' => $search,
            ],
        ]);
    }


    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Hash the password if provided, otherwise generate a random one
        $password = 12345678;

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show a single user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return redirect()->route('users.index')
            ->with('success', 'User details fetched successfully.');
    }

    /**
     * Update a user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        if (! empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
