<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EzFood - Welcome</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <style>
        .role-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <x-header />

    <div class="page-content">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container">
                <h1 class="mb-2">Welcome to EzFood</h1>
                <p class="lead mb-0">Order delicious food from your favorite restaurants</p>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="container py-5">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-10">
                        <h2 class="text-center mb-4">Choose Which Account to Login</h2>
                        <p class="text-center text-muted mb-5">
                            Select how you'd like to access EzFood
                        </p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!-- Customer Role Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card role-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="icon-user icon-3x text-primary"></i>
                                </div>
                                <h5 class="card-title mb-3">Customer</h5>
                                <p class="card-text text-muted mb-4">
                                    Order food from your favorite restaurants and track your orders
                                </p>
                                <div class="btn-group-vertical w-100" role="group">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm mb-2">
                                        <i class="icon-enter mr-1"></i> Login
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="icon-user-plus mr-1"></i> Register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Restaurant Owner Role Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card role-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="fas fa-shopping-basket fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title mb-3">Restaurant Owner</h5>
                                <p class="card-text text-muted mb-4">
                                    Manage your restaurant, menu items, and customer orders
                                </p>
                                <div class="btn-group-vertical w-100" role="group">
                                    <a href="{{ route('restaurant.login') }}" class="btn btn-success btn-sm mb-2">
                                        <i class="icon-enter mr-1"></i> Login
                                    </a>
                                    <a href="{{ route('restaurant.register') }}" class="btn btn-outline-success btn-sm">
                                        <i class="icon-user-plus mr-1"></i> Register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>
</html>