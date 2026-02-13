@extends ("backend.layouts.master")

@section("head")
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Employee | Biz Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{url('')}}/dist/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('')}}/dist/css/style.css">
  <link rel="stylesheet" href="{{url('')}}/dist/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{url('')}}/dist/css/skins/_all-skins.min.css">
</head>
@endsection

@section("content")
<div class="content-wrapper">
  <div class="content-header sty-one">
    <h1 class="text-white">Edit Employee</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Employee</li>
    </ol>
  </div>

  <div class="content">
    <div class="card card-outline">
      <div class="card-header bg-blue">
        <h5 class="text-white m-b-0">Employee Edit Form</h5>
      </div>
      <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('admin.employees.update', $employee->id) }}">
          @csrf
          @method('put')
          <div class="row">
              <div class="col-md-6 form-group">
                <label>Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="form-control" required>
              </div>
              <div class="col-md-6 form-group">
                <label>Email Address *</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control" required>
              </div>
              
              <div class="col-md-6 form-group">
                <label>Password <small class="text-danger">(Leave blank to keep current password)</small></label>
                <input type="password" name="password" class="form-control" minlength="8">
              </div>
              <div class="col-md-6 form-group">
                <label>Department *</label>
                <select name="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label>Designation</label>
                <input type="text" name="designation" value="{{ old('designation', $employee->designation) }}" class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="form-control">
              </div>
          </div>

          <button type="submit" class="btn btn-success mt-3">Update Employee</button>
          <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section("scripts")
<script src="{{url('')}}/dist/js/jquery.min.js"></script>
<script src="{{url('')}}/dist/bootstrap/js/bootstrap.min.js"></script>
@endsection