<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Biz Admin - Multipurpose bootstrap 4 admin templates</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="uxliner" />
    <!-- v4.1.3 -->
    <link rel="stylesheet" href="{{ url('') }}/dist/bootstrap/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('') }}/dist/img/favicon-16x16.png">

    <!-- Google Font -->
    <link href="{{ url('') }}/https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"
        rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('') }}/dist/css/style.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/simple-lineicon/simple-line-icons.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="{{ url('') }}/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="{{ url('') }}/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Custom styles for user type buttons -->
    <style>
        .user-type-buttons {
            margin-bottom: 25px;
            text-align: center;
        }

        .user-type-buttons .btn-group {
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-type-buttons .btn-group .btn {
            width: 33.33%;
            padding: 12px 0;
            border: none;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .user-type-buttons .btn-group .btn:first-child {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .user-type-buttons .btn-group .btn:last-child {
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .user-type-buttons .btn-group .btn.active {
            background: linear-gradient(45deg, #3c8dbc, #367fa9);
            color: white;
            box-shadow: 0 4px 10px rgba(60, 141, 188, 0.4);
        }

        .user-type-buttons .btn-group .btn i {
            margin-right: 5px;
        }

        .login-box-msg {
            margin-top: 15px;
            margin-bottom: 25px;
            font-weight: 600;
            color: #555;
            position: relative;
        }

        .login-box-msg:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: linear-gradient(to right, #3c8dbc, #367fa9);
            border-radius: 2px;
        }

        .has-feedback .form-control.sty1 {
            border-radius: 30px;
            padding-left: 20px;
            height: 45px;
            border: 1px solid #e0e0e0;
            box-shadow: none;
        }

        .has-feedback .form-control.sty1:focus {
            border-color: #3c8dbc;
            box-shadow: 0 0 5px rgba(60, 141, 188, 0.3);
        }

        .btn-primary {
            background: linear-gradient(45deg, #3c8dbc, #367fa9);
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #367fa9, #3c8dbc);
            box-shadow: 0 4px 10px rgba(60, 141, 188, 0.4);
        }

        .login-box-body {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 35px 30px;
        }

        .social-auth-links .btn {
            border-radius: 30px;
            margin: 5px 0;
        }

        .checkbox label {
            color: #777;
        }

        .pull-right {
            color: #3c8dbc;
        }

        .pull-right:hover {
            color: #367fa9;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-box-body">

            <!-- User Type Toggle Buttons -->
            <div class="user-type-buttons">
                <div class="btn-group" role="group" aria-label="User Type">
                    <button type="button" class="btn btn-default active" id="btn-admin" onclick="setUserType('admin')">
                        <i class="fa fa-user-secret"></i> Admin
                    </button>
                    <button type="button" class="btn btn-default" id="btn-manager" onclick="setUserType('manager')">
                        <i class="fa fa-briefcase"></i> Manager
                    </button>
                    <button type="button" class="btn btn-default" id="btn-employee" onclick="setUserType('employee')">
                        <i class="fa fa-user"></i> Employee
                    </button>
                </div>
            </div>

            <!-- Dynamic Title -->
            <h3 class="login-box-msg" id="login-title">Admin Sign In</h3>

            <!-- Login Form -->
            <form action="{{ route('admin.login') }}" method="post" id="login-form">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control sty1" placeholder="Email" id="email-input">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control sty1" placeholder="Password"
                        id="password-input">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div>
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <a href="{{ url('') }}/pages-recover-password.html" class="pull-right">
                                <i class="fa fa-lock"></i> Forgot pwd?
                            </a>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4 m-t-1">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit-btn">Admin Sign
                            In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- Demo credentials hint (optional) -->
            <div class="text-center" style="margin-top: 15px; font-size: 12px; color: #999;">
                <i class="fa fa-info-circle"></i> Demo: admin@example.com / Admin1205
            </div>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="{{ url('') }}/#" class="btn btn-block btn-social btn-facebook btn-flat">
                    <i class="fa fa-facebook"></i> Sign in using Facebook
                </a>
                <a href="{{ url('') }}/#" class="btn btn-block btn-social btn-google btn-flat">
                    <i class="fa fa-google-plus"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <div class="m-t-2">
                Don't have an account? <a href="{{ url('') }}/pages-register.html" class="text-center">Sign
                    Up</a>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ url('') }}/dist/js/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/bootstrap/js/bootstrap.min.js"></script>

    <!-- template -->
    <script src="{{ url('') }}/dist/js/bizadmin.js"></script>

    <!-- for demo purposes -->
    <script src="{{ url('') }}/dist/js/demo.js"></script>

    <!-- User Type Switching Script -->
    <script type="text/javascript">
        function setUserType(type) {
            // Update button active states
            document.getElementById('btn-admin').classList.remove('active');
            document.getElementById('btn-manager').classList.remove('active');
            document.getElementById('btn-employee').classList.remove('active');
            document.getElementById('btn-' + type).classList.add('active');

            // Update login title
            const titles = {
                'admin': 'Admin Sign In',
                'manager': 'Manager Sign In',
                'employee': 'Employee Sign In'
            };
            document.getElementById('login-title').textContent = titles[type];

            // Update form action
            const form = document.getElementById('login-form');
            const routes = {
                'admin': '{{ route('admin.login') }}',
                'manager': '{{ route('manager.login') }}',
                'employee': '{{ route('employee.login') }}'
            };
            form.action = routes[type];

            // Update submit button text
            const submitBtn = document.getElementById('submit-btn');
            const btnTexts = {
                'admin': 'Admin Sign In',
                'manager': 'Manager Sign In',
                'employee': 'Employee Sign In'
            };
            submitBtn.textContent = btnTexts[type];

            // Update demo credentials hint
            const demoHint = document.querySelector('.text-center i.fa-info-circle').parentNode;
            const demoEmails = {
                'admin': 'admin@example.com',
                'manager': 'manager@example.com',
                'employee': 'employee@example.com'
            };
            demoHint.textContent = ' Demo: ' + demoEmails[type] + ' / Admin1205';
        }

        // Set default user type on page load
        document.addEventListener('DOMContentLoaded', function() {
            setUserType('admin');
        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5b7257d2afc2c34e96e78bfc/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
