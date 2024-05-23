<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminManagementDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminManagementDataTable $dataTable) : View | JsonResponse
    {
        return $dataTable -> render('admin.admin-management.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.admin-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'in:admin'],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        toastr()->success('Created Successfully');

        return redirect()->route('admin.admin-management.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $admin = User::findOrFail($id);
        return view('admin.admin-management.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    if ($id == 1) {
        throw ValidationException::withMessages([
            'id' => ['You do not have the permission to update super admin']
        ]);
    }

    $request->validate([
        'name' => ['required', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email,'.$id],
        'role' => ['required', 'in:admin'],
    ]);

    // Check if password field is present and filled
    if ($request->filled('password')) {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/']
        ]);

        // Update the password if provided
        $user->password = bcrypt($request->password);
    }

    // Update other user details
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();

        toastr()->success('Data has been updated Sucessfully');

        return redirect()->route('admin.admin-management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if ($id == 1) {
            throw ValidationException::withMessages([
                'id' => ['You do not have the permission to delete super admin']
            ]);
        }
    try {
        $admin = User::findOrFail($id);
        $admin->delete();

        // Return a success response if deletion is successful
        return response()->json(['status' => 'success', 'message' => 'Deleted Successfully!']);
    } catch (\Exception $e) {
        // If an exception occurs (e.g., user not found), return an error response
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}
}

