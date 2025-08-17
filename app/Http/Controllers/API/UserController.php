<?php

namespace App\Http\Controllers\API;

use App\Enums\SearchTarget;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        $users = User::latest()
            ->when($search && SearchTarget::isValid($target), function ($query) use ($search, $target) {
                $query->where($target, 'like', "%{$search}%");
            })
            ->when($request->start && $request->end, function ($q) use ($request) {
                $q->whereBetween('created_at', [
                    $request->start,
                    $request->end,
                ]);
            })
            ->paginate(10);

        return Inertia::render('users/Index', [
            'message' => 'This is data passed from Laravel!',
            'users' => $users,
        ]);
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully.',
            'data' => $user,
        ], 201);
    }

    /**
     * Show a single user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
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

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully.',
            'data' => $user,
        ]);
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully.',
        ]);
    }
}
