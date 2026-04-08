<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</head>

<body>
    <x-header

    <div class="page-content">
        <div class="content-wrapper">
            <div class="content d-flex justify-content-center align-items-center">

                <form class="login-form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-question7 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Forgot your password?</h5>
                                <span class="d-block text-muted">Enter your email to reset it</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email" value="{{ old('email') }}" required autofocus>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Send Reset Link <i class="icon-circle-right2 ml-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}">Back to Login</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <x-footer />
        </div>
    </div>
</body>
</html>
