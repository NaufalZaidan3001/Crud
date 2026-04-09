<!DOCTYPE html>
<html lang="en">
<x-layout.head title="Menu List" />

<body>

    <x-layout.navbar />

    <div class="page-content">

        <x-layout.sidebar-panel />

        <div class="content-wrapper">

            <x-layout.page-header title="Menu" :breadcrumbs="['Menu']" />

            <div class="content">

                @if(session('success'))
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <span class="font-weight-semibold">Success!</span> {{ session('success') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title font-weight-bold">
                            <i class="icon-list mr-2 text-primary"></i> 
                            @if(Auth::user()->role === 'restaurant') My Menu @else Browse Menu @endif
                        </h6>
                        <div class="header-elements">
                            @if(Auth::user()->role === 'restaurant')
                            <a href="{{ route('menu.create') }}" class="btn btn-primary btn-sm rounded-pill font-weight-bold">
                                <i class="icon-plus2 mr-1"></i> Add Menu Item
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Customer Grid View --}}
                        @if(Auth::user()->role !== 'restaurant')
                            @if($menus->isEmpty())
                                <div class="text-center py-5 text-muted">
                                    <i class="icon-list icon-3x d-block mb-3"></i>
                                    <p>No menu items available right now.</p>
                                </div>
                            @else
                                <div class="row">
                                    @foreach($menus as $menu)
                                    <div class="col-sm-6 col-xl-4 mb-4">
                                        <div class="card h-100" style="border-radius: 10px; overflow: hidden; transition: box-shadow 0.2s;">
                                            @if($menu->image)
                                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->item_name }}" style="height: 160px; object-fit: cover; width: 100%;">
                                            @else
                                                <div style="height: 160px; background: #e0e0e0; display: flex; align-items: center; justify-content: center;">
                                                    <span class="text-muted"><i class="icon-image2 icon-2x"></i></span>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title font-weight-bold mb-1">{{ $menu->item_name }}</h6>
                                                <p class="text-muted font-size-sm mb-3 flex-grow-1">
                                                    {{ Str::limit($menu->description, 60, '...') ?? 'No description.' }}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <span class="text-primary font-weight-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                                    <a href="{{ route('menu.show', $menu) }}" class="btn btn-sm btn-primary rounded-pill">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-3">{{ $menus->links() }}</div>
                            @endif
                        
                        {{-- Restaurant Table View --}}
                        @else
                            @if($menus->isEmpty())
                                <div class="text-center py-5 text-muted">
                                    <i class="icon-list icon-3x d-block mb-3"></i>
                                    <p>No menu items yet. <a href="{{ route('menu.create') }}">Add your first item!</a></p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Availability</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="font-weight-semibold">{{ $menu->item_name }}</td>
                                                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($menu->availability)
                                                        <span class="badge badge-success">Available</span>
                                                    @else
                                                        <span class="badge badge-danger">Unavailable</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('menu.show', $menu) }}" class="btn btn-sm btn-light rounded-pill mr-1"><i class="icon-eye"></i> View</a>
                                                    <a href="{{ route('menu.edit', $menu) }}" class="btn btn-sm btn-info rounded-pill mr-1"><i class="icon-pencil5"></i> Edit</a>
                                                    <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this menu item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded-pill"><i class="icon-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">{{ $menus->links() }}</div>
                            @endif
                        @endif
                    </div>
                </div>

            </div>

            <x-layout.footer />

        </div>
    </div>

</body>
</html>