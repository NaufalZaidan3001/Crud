<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pending Approval</title>

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

                <div class="card mb-0" style="max-width: 500px;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="icon-info icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-3">Registration Pending Approval</h5>
                            <p class="text-muted mb-4">
                                Thank you for registering your restaurant! Your restaurant has been submitted for admin approval.
                            </p>
                            <p class="text-muted mb-4">
                                <strong>{{ Auth::user()->restaurant->restaurant_name }}</strong> is now pending verification. Our admin team will review your restaurant details and approve or reject your application within 24-48 hours.
                            </p>
                            <p class="text-muted mb-4">
                                You will receive an email notification once your restaurant has been approved or if additional information is needed.
                            </p>
                            
                            <div class="alert alert-info mb-4">
                                <i class="icon-checkmark text-success"></i> Your account is active. Once approved, you can start managing your restaurant menu and orders.
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-switch2 mr-2"></i> Logout for now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <x-footer />
        </div>
    </div>
</body>
</html>
