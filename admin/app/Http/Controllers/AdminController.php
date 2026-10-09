<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function profile(){

        $adminId = Session::get('admin_id');

        $admin = DB::table('admins')
            ->join('employees', 'admins.id_employee', '=', 'employees.id_employee')
            ->select('admins.*', 'employees.*')
            ->where('admins.id_admin', $adminId)
            ->first();

        return response()->json(['html' => view('profile', compact('admin'))->render()]);
    }

    public function updateProfile(Request $request, $id)
    {

        $adminId = Session::get('admin_id');

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id . ',id_employee',
            'phone' => 'required|string|max:20',
            'cin' => 'required|string|max:20',
            'birthday' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $validatedadmin = $request->validate([
            'username' => 'required|string|unique:admins,username,' .  $adminId . ',id_admin',
            'password' => 'required|string',
        ]);

    
        $employee = Employee::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }
    
            $path = $request->file('image')->store('employees', 'public');
            $validated['image'] = $path;
        }

        Admin::findOrFail($adminId)->update($validatedadmin);
    
        $employee->update($validated);

        Session::put('username', $validatedadmin['username']);
        Session::forget('admin_password');
        Session::put('admin_password', $validatedadmin['password']);
        Session::put('image', $employee->image);


    
        return response()->json([
            'status' => 'success',
            'data' => $employee,
            'image_url' => isset($path) ? asset('storage/' . $path) : asset('storage/' . $employee->image),
            
        ]);
    }
    
    
    public function showAdmin(){
        $roles = Role::all();

        //return view('list_admin', compact('roles'));
        return response()->json(['html' => view('list_admin', compact('roles'))->render()]);
    }

    public function index()
{
    $admins = Admin::join('employees', 'admins.id_employee', '=', 'employees.id_employee')
        ->join('roles', 'admins.id_role', '=', 'roles.id_role')
        ->select(
            'admins.*',
            'employees.first_name',
            'employees.last_name',
            'employees.email',
            'roles.id_role',
            'roles.role'
        )
        ->get();

    return response()->json([
        'status' => 'success',
        'data' => $admins
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string',
            'id_role' => 'required|exists:roles,id_role',
            'id_employee' => 'required|exists:employees,id_employee'
        ]);

        $admin = Admin::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Admin added successfully!',
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'username' => 'required|string|unique:admins,username,' . $id . ',id_admin',
            'password' => 'required|string',
            'status' => 'required|numeric',
            'id_role' => 'required|exists:roles,id_role',
        ]);

        Admin::findOrFail($id)->update($validated);
        return response()->json(['status' => 'success', 'data' => $request->all()]);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
