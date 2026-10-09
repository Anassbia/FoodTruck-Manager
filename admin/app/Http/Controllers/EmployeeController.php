<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    
    public function showEmploiees(){
        $jobs = Job::all();
        $roles = Role::all();

        //return view('list_employees', compact('roles', 'jobs'));
        return response()->json(['html' => view('list_employees', compact('roles', 'jobs'))->render()]);
    }

    public function index(){

        $employees = Employee::join('jobs', 'employees.id_job', '=', 'jobs.id_job')
        ->join('services', 'jobs.id_service', '=', 'services.id_service')
        ->select('employees.*', 'jobs.job', 'services.service')
        ->get();

        return response()->json([
            'status' => 'success',
            'data' =>$employees
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'cin' => 'required|string|max:20',
            'salary' => 'required|numeric',
            'birthday' => 'required|date',
            'id_job' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employees', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        $employee = Employee::create($validatedData);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Employee saved successfully!',
        ]);
    }
    


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id . ',id_employee',
            'phone' => 'required|string|max:20',
            'cin' => 'required|string|max:20',
            'salary' => 'required|numeric',
            'birthday' => 'required|date',
            'id_job' => 'required|integer',
            'status' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
    
        $employee = Employee::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($employee->image && Storage::exists($employee->image)) {
                Storage::delete($employee->image);
            }
    
            $path = $request->file('image')->store('employees', 'public');
            $validated['image'] = $path;
        }
    
        $employee->update($validated);
    
        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
