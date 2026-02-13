@extends ("backend.layouts.master")

@section("head")
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Department | Biz Admin</title>
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
    <h1 class="text-white">Edit Department</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Department</li>
    </ol>
  </div>

  <div class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-outline">
          <div class="card-header bg-blue">
            <h5 class="text-white m-b-0">Department Edit Form</h5>
          </div>
          <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form method="post" action="{{ route('admin.departments.update', $department->id) }}">
              @csrf
              @method('put')
              <div class="form-group">
                <label>Department Name</label>
                <input type="text" name="name" value="{{ old('name', $department->name) }}" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $department->description) }}</textarea>
              </div>
              <button type="submit" class="btn btn-success">Update</button>
              <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section("scripts")
<script src="{{url('')}}/dist/js/jquery.min.js"></script>
<script src="{{url('')}}/dist/bootstrap/js/bootstrap.min.js"></script>
@endsection