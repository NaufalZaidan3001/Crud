{{-- components/layout/page-header.blade.php --}}
@props(['title' => 'Dashboard', 'breadcrumbs' => []])

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>{{ $title }}</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                {{ $actions ?? '' }}
            </div>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                @foreach($breadcrumbs as $key => $crumb)
                @if($loop->last)
                <span class="breadcrumb-item active">{{ is_numeric($key) ? $crumb : $key }}</span>
                @else
                <a href="{{ is_numeric($key) ? '#' : $crumb }}" class="breadcrumb-item">{{ is_numeric($key) ? $crumb : $key }}</a>
                @endif
                @endforeach
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

    </div>
</div>