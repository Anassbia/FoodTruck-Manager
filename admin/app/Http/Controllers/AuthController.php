<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Employee;


class AuthController extends Controller
{
    // Login function
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $admin = Admin::where('username', $credentials['username'])->first();
        $id=$admin->id_employee;
        $employee = Employee::findOrFail($id);
        
        if ($admin && $credentials['password'] == $admin->password) {
           
            Session::put('admin_id', $admin->id_admin);
            Session::put('username', $admin->username);
            Session::put('image', $employee->image);
            Session::put('employee_id', $admin->id_employee);
            Session::put('admin_password', $admin->password);
            Session::put('admin_role', $admin->id_role);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Logout function
    public function logout()
    {
        session()->forget('admin_id');
        Session::flush();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful'
        ]);
    }

    // Check if user is authenticated
    public function checkAuth()
    {
        if (Session::has('admin_id')) {
            return response()->json([
                'authenticated' => true,
                'admin_id' => Session::get('admin_id'),
                'admin_username' => Session::get('admin_username'),
                'admin_password' => Session::get('admin_password'),
                'admin_role' => Session::get('admin_role'),
            ]);
        }

        return response()->json([
            'authenticated' => false
        ]);
    }
}
