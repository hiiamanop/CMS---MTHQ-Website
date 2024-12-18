<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdministratorController extends Controller
{
    /**
     * Display a listing of administrators.
     */
    public function index()
    {
        // Fetch users with role_id 1 or 2 (administrators)
        $administrators = User::whereIn('role_id', [1, 2])
            ->with('role')
            ->paginate(10);

        return view('administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new administrator.
     */
    public function create()
    {
        // Fetch only administrator roles
        $roles = Role::whereIn('id', [1, 2])->get();
        return view('administrators.create', compact('roles'));
    }

    /**
     * Store a newly created administrator in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                'max:255', 
                Rule::unique('users', 'email')
            ],
            'password' => 'required|string|min:8|confirmed',
            'role_id' => [
                'required', 
                Rule::in([1, 2])  // Restrict to admin roles
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $administrator = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);

            return redirect()->route('administrators.index')
                ->with('success', 'Administrator created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create administrator: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified administrator.
     */
    public function show($id)
    {
        $administrator = User::whereIn('role_id', [1, 2])
            ->with('role')
            ->findOrFail($id);

        return view('administrators.show', compact('administrator'));
    }

    /**
     * Show the form for editing the specified administrator.
     */
    public function edit($id)
    {
        $administrator = User::whereIn('role_id', [1, 2])
            ->findOrFail($id);
        
        $roles = Role::whereIn('id', [1, 2])->get();
        
        return view('administrators.edit', compact('administrator', 'roles'));
    }

    /**
     * Update the specified administrator in storage.
     */
    public function update(Request $request, $id)
    {
        $administrator = User::whereIn('role_id', [1, 2])
            ->findOrFail($id);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                'max:255', 
                Rule::unique('users', 'email')->ignore($administrator->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => [
                'required', 
                Rule::in([1, 2])  // Restrict to admin roles
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $administrator->update($updateData);

            return redirect()->route('administrators.index')
                ->with('success', 'Administrator updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update administrator: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified administrator from storage.
     */
    public function destroy($id)
    {
        try {
            $administrator = User::whereIn('role_id', [1, 2])
                ->findOrFail($id);

            // Prevent deleting the last super admin
            $superAdminCount = User::where('role_id', 1)->count();
            if ($administrator->role_id == 1 && $superAdminCount <= 1) {
                return redirect()->back()
                    ->with('error', 'Cannot delete the last super administrator.');
            }

            $administrator->delete();

            return redirect()->route('administrators.index')
                ->with('success', 'Administrator deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete administrator: ' . $e->getMessage());
        }
    }
}