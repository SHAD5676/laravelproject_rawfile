<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        // 'with' eager loads the department to prevent database lag
        $employees = User::with('department')->latest()->paginate(10);
        return view('backend.employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $departments = Department::all(); // Fetch departments for the dropdown
        return view('backend.employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'department_id' => 'required|exists:departments,id',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Secure hash
            'department_id' => $request->department_id,
            'phone' => $request->phone,
            'designation' => $request->designation,
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully!');
    }

    public function edit(User $employee)
    {
        $departments = Department::all();
        return view('backend.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
        ]);

        $data = $request->only(['name', 'email', 'department_id', 'phone', 'designation']);

        // Only update password if admin typed a new one
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully!');
    }
}