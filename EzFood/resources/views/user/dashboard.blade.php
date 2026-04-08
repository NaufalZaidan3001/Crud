<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

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

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-static">
        <div class="navbar-brand">
            <a href="{{ url('/') }}" class="d-inline-block">
                <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <span class="navbar-text ml-md-3">
                <span class="badge badge-mark border-orange-300 mr-2"></span>
                Welcome, {{ Auth::user()->name }}!
            </span>

            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user mr-2"></i>
                        Account
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user"></i> Profile</a>
                        <a href="#" class="dropdown-item"><i class="icon-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="icon-switch2"></i> Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Navigation
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#">
                                    <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt="">
                                </a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                                <div class="font-size-xs opacity-50">
                                    <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div></li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="icon-home4"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Tasks</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Tasks">
                                <li class="nav-item"><a href="#" class="nav-link">View Tasks</a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Add Task</a></li>
                            </ul>
                        </li>

                        <!-- /main -->

                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->
        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Dashboard</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none">
                        <div class="breadcrumb justify-content-center">
                            <a href="#" class="breadcrumb-elements-item">
                                <i class="icon-comment-discussion mr-2"></i>
                                Support
                            </a>

                            <div class="breadcrumb-elements-item dropdown p-0">
                                <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('global_assets/images/flags/us.png') }}" alt="">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item"><img src="{{ asset('global_assets/images/flags/us.png') }}" alt=""> English</a>
                                    <a href="#" class="dropdown-item"><img src="{{ asset('global_assets/images/flags/de.png') }}" alt=""> Deutsch</a>
                                    <a href="#" class="dropdown-item"><img src="{{ asset('global_assets/images/flags/ru.png') }}" alt=""> Русский</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">

                <!-- Dashboard content -->
                <div class="row">
                    <div class="col-xl-12">

                        <!-- Marketing campaigns -->
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title">Welcome to Your Dashboard</h6>
                                <div class="header-elements">
                                    <span class="badge badge-success badge-pill">Active</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="card card-body">
                                            <div class="media">
                                                <div class="mr-3 align-self-center">
                                                    <i class="icon-pointer icon-2x text-success-400"></i>
                                                </div>

                                                <div class="media-body text-right">
                                                    <h3 class="font-weight-semibold mb-0">3,450</h3>
                                                    <span class="text-uppercase font-size-sm text-muted">Total Tasks</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="card card-body">
                                            <div class="media">
                                                <div class="mr-3 align-self-center">
                                                    <i class="icon-users icon-2x text-info-400"></i>
                                                </div>

                                                <div class="media-body text-right">
                                                    <h3 class="font-weight-semibold mb-0">1,200</h3>
                                                    <span class="text-uppercase font-size-sm text-muted">Active Users</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="card card-body">
                                            <div class="media">
                                                <div class="mr-3 align-self-center">
                                                    <i class="icon-cog icon-2x text-warning-400"></i>
                                                </div>

                                                <div class="media-body text-right">
                                                    <h3 class="font-weight-semibold mb-0">89</h3>
                                                    <span class="text-uppercase font-size-sm text-muted">Pending Tasks</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="card card-body">
                                            <div class="media">
                                                <div class="mr-3 align-self-center">
                                                    <i class="icon-checkmark3 icon-2x text-danger-400"></i>
                                                </div>

                                                <div class="media-body text-right">
                                                    <h3 class="font-weight-semibold mb-0">3,361</h3>
                                                    <span class="text-uppercase font-size-sm text-muted">Completed Tasks</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /marketing campaigns -->

                    </div>
                </div>
                <!-- /dashboard content -->

            </div>
            <!-- /content area -->

            <!-- Footer -->
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
                        &copy; {{ date('Y') }} EzFood. All rights reserved.
                    </span>
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>
</html>