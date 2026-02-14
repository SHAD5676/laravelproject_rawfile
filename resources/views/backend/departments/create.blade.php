@extends ("backend.layouts.master")

@section("head")
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Department | Biz Admin</title>
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
    <h1 class="text-white">Add Department</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Add Department</li>
    </ol>
  </div>

  <div class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-outline">
          <div class="card-header bg-blue">
            <h5 class="text-white m-b-0">Department Entry Form</h5>
          </div>
          <div class="card-body">
            
            {{-- ONLY ONE ERROR BLOCK NEEDED --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('admin.departments.store') }}">
              @csrf
              <div class="form-group">
                <label>Department Name</label>
                {{-- ADDED minlength and maxlength HERE --}}
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Department Name" required minlength="3" maxlength="10">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" placeholder="Optional details...">{{ old('description') }}</textarea>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

