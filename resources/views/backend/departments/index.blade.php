@extends ("backend.layouts.master")

@section("head")
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Department List | Biz Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('')}}/dist/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('')}}/dist/img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{url('')}}/dist/css/style.css">
    <link rel="stylesheet" href="{{url('')}}/dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('')}}/dist/css/skins/_all-skins.min.css">
</head>
@endsection

@section("content")
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Department Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><i class="fa fa-angle-right"></i> Departments</li>
        </ol>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                @if(session('success')) 
                    <div class="alert alert-success">{{session('success')}}</div>    
                @endif
                
                <h4 class="text-black">Department List 
                    <span class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.departments.create') }}">Add Department</a>
                    </span>
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $dept)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $dept->name }}</td>
                                <td>{{ $dept->description }}</td>
                                <td>
                                    <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="post"> 
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('admin.departments.edit', $dept->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>  
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

