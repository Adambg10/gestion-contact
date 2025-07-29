<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\User;
use Modules\Ladmin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ladmin()->allows(['ladmin.user.index']);

        if (request()->has('datatables')) {
            return $this->renderDataTable();
        }

        // For now, let's pass users directly to the view for debugging
        $users = User::all();
        return ladmin()->view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ladmin()->allows(['ladmin.user.create']);

        return ladmin()->view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ladmin()->allows(['ladmin.user.create']);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('ladmin.user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // ladmin()->allows(['ladmin.user.edit']);

        // Load the user's contacts
        $user->load('contacts');

        return ladmin()->view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // ladmin()->allows(['ladmin.user.edit']);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('ladmin.user.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // ladmin()->allows(['ladmin.user.delete']);

        $user->delete();

        return redirect()->route('ladmin.user.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Render data for DataTables
     */
    private function renderDataTable()
    {
        $users = User::select(['id', 'name', 'email', 'created_at']);

        return datatables($users)
            ->addColumn('action', function ($user) {
                $editBtn = '<a href="' . route('ladmin.user.edit', $user->id) . '?' . http_build_query(ladmin()->back()) . '" class="btn btn-sm btn-outline-primary me-1">
                    <i class="fa-solid fa-edit"></i> Edit
                </a>';
                
                $deleteBtn = '<form method="POST" action="' . route('ladmin.user.destroy', $user->id) . '" style="display: inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this user?\')">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>';

                return $editBtn . $deleteBtn;
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
