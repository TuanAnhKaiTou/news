<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Đồ án đọc báo trực tuyến</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Alertify -->
        <link href="{{ asset('assets/libs/alertify/alertify.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .eyes {
                float: right;
                margin-top: -24px;
                padding-right: 8px;
                opacity: 0.8;
            }
        </style>
    </head>

    <body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <span><img src="assets/images/logo-dark.png" height="26"></span>
                                    <p class="text-muted mb-4 mt-3">Enter your username and password to access admin panel.</p>
                                </div>

                                <h5 class="auth-title">Sign In</h5>

                                <form action="{{ route('do-login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required placeholder="Enter username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required id="password" name="password" placeholder="Enter password">
                                        <span toggle="#password" class="fa fa-eye password eyes"></span>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> Log In </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-alt">
            2020 &copy; Đồ án đọc báo trực tuyến
        </footer>

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <!-- Alertify -->
        <script src="{{ asset('assets/libs/alertify/alertify.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                @if (session('status'))
                    @if (session('status') == 'success')
                        alertify.success("{!! session('msg') !!}");
                    @else
                        alertify.error("{!! session('msg') !!}");
                    @endif
                @endif

                $('#username').focus();

                $(".password").click(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            });
        </script>

    </body>
</html>
