<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>

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
            <div class="content">
                <div class="page-header page-header-light">
                    <div class="page-header-content header-elements-md-inline">
                        <div class="page-title">
                            <h4><i class="icon-dashboard mr-2"></i> <span class="font-weight-semibold">Admin Dashboard</span></h4>
                            <span class="d-block text-muted">Overview of managed restaurants</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-2"><i class="icon-store2 icon-3x text-primary"></i></div>
                                <h5 class="card-title">Total Restaurants</h5>
                                <h2 class="font-weight-bold">{{ $totalRestaurants }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-2"><i class="icon-hour-glass2 icon-3x text-warning"></i></div>
                                <h5 class="card-title">Pending Restaurants</h5>
                                <h2 class="font-weight-bold">{{ $pendingRestaurants }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-2"><i class="icon-checkmark3 icon-3x text-success"></i></div>
                                <h5 class="card-title">Approved Restaurants</h5>
                                <h2 class="font-weight-bold">{{ $approvedRestaurants }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title">Restaurant Approvals</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Owner Email</th>
                                                <th>Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($restaurants as $restaurant)
                                            <tr>
                                                <td>{{ $restaurant->id }}</td>
                                                <td>{{ $restaurant->restaurant_name }}</td>
                                                <td>{{ optional($restaurant->user)->email }}</td>
                                                <td class="text-capitalize">{{ $restaurant->status }}</td>
                                                <td class="text-center">
                                                    @if($restaurant->status === 'pending')
                                                            <div class="d-flex justify-content-center">
                                                                <form method="POST" action="{{ route('admin.approval.approve', $restaurant->id) }}" class="mr-2">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form method="POST" action="{{ route('admin.approval.reject', $restaurant->id) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            </div>
                                                    @else
                                                    <span class="badge badge-{{ $restaurant->status === 'approved' ? 'success' : 'danger' }}">{{ ucfirst($restaurant->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No restaurants found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footer />
        </div>
    </div>
</body>

</html>