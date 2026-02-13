<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $departments = Department::latest()->paginate(5);
        return view('backend.departments.index', compact('departments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        $request->validate([
            // CHANGE: Replaced max:255 with min:3|max:10
            'name'        => 'required|min:3|max:10|unique:departments,name',
            'description' => 'nullable|max:500',
        ], [
            // Custom messages for the new rules
            'name.required' => 'Please enter a department name.',
            'name.unique'   => 'This department already exists.',
            'name.min'      => 'The department name must be at least 3 characters.',
            'name.max'      => 'The department name cannot be more than 10 characters.',
        ]);

        Department::create($request->all());

        return redirect()->route('admin.departments.index')
                        ->with('success', 'Department created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): View
    {
        // This was missing! It tells Laravel which department to edit.
        return view('backend.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Department $department)
    {
        $request->validate([
            // CHANGE: Added min:3 and max:10 here as well
            'name'        => 'required|min:3|max:10|unique:departments,name,' . $department->id,
            'description' => 'nullable|max:500',
        ], [
            'name.min' => 'The department name must be at least 3 characters.',
            'name.max' => 'The department name cannot be more than 10 characters.',
        ]);

        $department->update($request->all());

        return redirect()->route('admin.departments.index')
                        ->with('success', 'Department updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();

        return redirect()->route('admin.departments.index')
                        ->with('success', 'Department deleted successfully.');
    }
}