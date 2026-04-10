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
                        <h2 class="text-center mb-4">Please register before proceeding to EzFood</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!-- Customer Role Card -->
                    <div class="col-md-5 mb-4">
                        <div class="card role-card h-100 border-primary-300 border-2">
                            <div class="card-body text-center d-flex flex-column h-100 p-4">
                                <div class="mb-4">
                                    <i class="icon-user icon-3x text-primary border-primary border-3 rounded-round p-3"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Customer</h4>
                                <p class="text-muted flex-grow-1 mb-4">Order delicious food from your favorite restaurants and track your orders in real-time.</p>
                                <a href="{{ route('register.customer') }}" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                                    Register as Customer <i class="icon-circle-right2 ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Restaurant Owner Role Card -->
                    <div class="col-md-5 mb-4">
                        <div class="card role-card h-100 border-success-300 border-2">
                            <div class="card-body text-center d-flex flex-column h-100 p-4">
                                <div class="mb-4">
                                    <i class="icon-store icon-3x text-success border-success border-3 rounded-round p-3"></i>
                                </div>
                                <h4 class="font-weight-bold mb-3">Restaurant Owner</h4>
                                <p class="text-muted flex-grow-1 mb-4">Reach more customers, manage your menu easily, and grow your culinary business with us.</p>
                                <a href="{{ route('restaurant.register') }}" class="btn btn-success btn-block rounded-pill py-2 font-weight-bold">
                                    Register as Restaurant <i class="icon-circle-right2 ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary font-weight-bold">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <x-footer />
</body>

</html>