<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        // Paginate the roles, showing 10 per page
        $roles = Role::paginate(10);

        return view('role.index', compact('roles'));
    }


    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        // Jika menggunakan view, kembalikan halaman create
        return view('role.create');
    }

    /**
     * Store a newly created role in the database.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'role' => 'required|unique:roles,role'
        ]);

        try {
            Role::create($validatedData);

            // Use flash session to pass success message
            return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan role: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified role.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => 'required|unique:roles,role,' . $id
        ]);

        $role = Role::findOrFail($id);
        $role->update($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Update the specified role in the database.
     */


    /**
     * Remove the specified role from the database.
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);

            // Check if any users are using this role
            $userCount = User::where('role_id', $role->id)->count();

            if ($userCount > 0) {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete role. There are ' . $userCount . ' users assigned to this role.');
            }

            $role->delete();

            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')
                ->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }
}
