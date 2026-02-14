<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/img/favicon-16x16.png') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/font-awesome/css/font-awesome.min.css') }}">

    <style>
        .user-type-buttons { margin-bottom: 25px; text-align: center; }
        .user-type-buttons .btn-group { width: 100%; box-shadow: 0 2px 5px rgba(0, 0, 0, .1); }
        .user-type-buttons .btn-group .btn {
            width: 25%;
            padding: 12px 0;
            border: 0;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: .5px;
            background-color: #f8f9fa;
            color: #495057;
        }
        .user-type-buttons .btn-group .btn.active {
            background: linear-gradient(45deg, #3c8dbc, #367fa9);
            color: #fff;
            box-shadow: 0 4px 10px rgba(60, 141, 188, .4);
        }
        .login-box-body { border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, .1); padding: 35px 30px; }
        .has-feedback .form-control.sty1 { border-radius: 30px; padding-left: 20px; height: 45px; border: 1px solid #e0e0e0; }
        .btn-primary { background: linear-gradient(45deg, #3c8dbc, #367fa9); border: 0; border-radius: 30px; }
        .auth-alert { margin-bottom: 15px; border-radius: 10px; }
    </style>
</head>
<body class="login-page">
@php
    $availableRoles = ['user', 'admin', 'manager', 'employee'];
    $currentRole = old('login_role', $loginRole ?? request('type', 'user'));
    if (! in_array($currentRole, $availableRoles, true)) {
        $currentRole = 'user';
    }

    $routeByRole = [
        'user' => route('login'),
        'admin' => route('admin.login'),
        'manager' => route('manager.login'),
        'employee' => route('employee.login'),
    ];

    $labelByRole = [
        'user' => 'User',
        'admin' => 'Admin',
        'manager' => 'Manager',
        'employee' => 'Employee',
    ];
@endphp

<div class="login-box">
    <div class="login-box-body">
        @if ($errors->any())
            <div class="alert alert-danger auth-alert">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success auth-alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="user-type-buttons">
            <div class="btn-group" role="group" aria-label="User Type">
                <button type="button" class="btn btn-default role-btn {{ $currentRole === 'admin' ? 'active' : '' }}" data-role="admin">
                    <i class="fa fa-user-secret"></i> Admin
                </button>
                <button type="button" class="btn btn-default role-btn {{ $currentRole === 'manager' ? 'active' : '' }}" data-role="manager">
                    <i class="fa fa-briefcase"></i> Manager
                </button>
                <button type="button" class="btn btn-default role-btn {{ $currentRole === 'employee' ? 'active' : '' }}" data-role="employee">
                    <i class="fa fa-user"></i> Employee
                </button>
                <button type="button" class="btn btn-default role-btn {{ $currentRole === 'user' ? 'active' : '' }}" data-role="user">
                    <i class="fa fa-users"></i> User
                </button>
            </div>
        </div>

        <h3 class="login-box-msg" id="login-title">{{ $labelByRole[$currentRole] }} Sign In</h3>

        <form action="{{ $routeByRole[$currentRole] }}" method="post" id="login-form">
            @csrf
            <input type="hidden" name="login_role" id="login-role-input" value="{{ $currentRole }}">

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control sty1" placeholder="Email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control sty1" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-xs-4 m-t-1">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit-btn">{{ $labelByRole[$currentRole] }} Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('dist/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    (function () {
        const routeByRole = @json($routeByRole);
        const labelByRole = @json($labelByRole);
        const roleInput = document.getElementById('login-role-input');
        const form = document.getElementById('login-form');
        const title = document.getElementById('login-title');
        const submit = document.getElementById('submit-btn');

        function setRole(role) {
            document.querySelectorAll('.role-btn').forEach((btn) => {
                btn.classList.toggle('active', btn.dataset.role === role);
            });

            form.action = routeByRole[role];
            roleInput.value = role;
            title.textContent = labelByRole[role] + ' Sign In';
            submit.textContent = labelByRole[role] + ' Sign In';
        }

        document.querySelectorAll('.role-btn').forEach((btn) => {
            btn.addEventListener('click', function () {
                setRole(this.dataset.role);
            });
        });

        setRole(roleInput.value);
    })();
</script>
</body>
</html>
