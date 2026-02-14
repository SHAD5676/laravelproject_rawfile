@extends('backend.layouts.master')

@section('content')

<div class="row mb-3">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Employee Management</h2>
            <a class="btn btn-success" href="{{ route('admin.employees.create') }}">Create New Employee</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $key => $employee)
            <tr>
                <td>{{ $employees->firstItem() + $key }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->designation }}</td>
                <td>
                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline">

                        <a class="btn btn-info" href="{{ route('admin.employees.show', $employee->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('admin.employees.edit', $employee->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this employee?')">Delete</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {!! $employees->links() !!}
</div>

@endsection
