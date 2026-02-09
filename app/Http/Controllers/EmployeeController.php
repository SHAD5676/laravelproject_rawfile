<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employees = Employee::latest()->paginate(5);

        return view('admin.employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:employees',
            'phone'       => 'nullable',
            'designation' => 'nullable',
            'password'    => 'required|min:6',
        ]);

        Employee::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'designation' => $request->designation,
            'password'    => bcrypt($request->password),
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): View
    {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:employees,email,' . $employee->id,
            'phone'       => 'nullable',
            'designation' => 'nullable',
        ]);

        $employee->update($request->only([
            'name',
            'email',
            'phone',
            'designation'
        ]));

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully');
    }
}
