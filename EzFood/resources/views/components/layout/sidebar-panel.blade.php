{{-- components/layout/sidebar-panel.blade.php --}}
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    {{-- Sidebar mobile toggler --}}
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
    {{-- /sidebar mobile toggler --}}

    <x-sidebar />
    <x-main-user />
</div>
