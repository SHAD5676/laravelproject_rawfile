@extends ("backend.layouts.master")

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Employee</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.employees.index') }}">
                Back
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text"
                       name="name"
                       value="{{ $employee->name }}"
                       class="form-control"
                       placeholder="Employee Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email"
                       name="email"
                       value="{{ $employee->email }}"
                       class="form-control"
                       placeholder="Employee Email">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text"
                       name="phone"
                       value="{{ $employee->phone }}"
                       class="form-control"
                       placeholder="Phone Number">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Designation:</strong>
                <input type="text"
                       name="designation"
                       value="{{ $employee->designation }}"
                       class="form-control"
                       placeholder="Designation">
            </div>
        </div>

        {{-- password update optional --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>New Password (optional):</strong>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Leave blank to keep current password">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>

    </div>

</form>

@endsection

@section("scripts")
<script src="{{url('')}}/dist/js/jquery.min.js"></script>
<script src="{{url('')}}/dist/bootstrap/js/bootstrap.min.js"></script>
@endsection