<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Restaurant Register</title>

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
    <x-header />

    <div class="page-content">
        <div class="content-wrapper">
            <div class="content d-flex justify-content-center align-items-center">

                <form class="login-form" method="POST" action="{{ route('restaurant.register') }}">
                    @csrf

                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-store icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Register your restaurant</h5>
                                <span class="d-block text-muted">Join us and grow your business</span>
                            </div>

                            <!-- Owner Information -->
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Owner full name" value="{{ old('name') }}" required autofocus>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email" value="{{ old('email') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Phone number" value="{{ old('phone') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-phone2 text-muted"></i>
                                </div>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="Confirm password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <!-- Restaurant Information -->
                            <hr class="my-3">

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" name="restaurant_name" class="form-control @error('restaurant_name') is-invalid @enderror"
                                       placeholder="Restaurant name" value="{{ old('restaurant_name') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-shop text-muted"></i>
                                </div>
                                @error('restaurant_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Restaurant description (optional)" rows="3">{{ old('description') }}</textarea>
                                <div class="form-control-feedback">
                                    <i class="icon-pencil text-muted"></i>
                                </div>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                       placeholder="Restaurant address" value="{{ old('address') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-location4 text-muted"></i>
                                </div>
                                @error('address')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register Restaurant <i class="icon-circle-right2 ml-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}">Already have an account? Sign in</a>
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
