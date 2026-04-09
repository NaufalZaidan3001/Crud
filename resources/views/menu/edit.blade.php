<!DOCTYPE html>
<html lang="en">
<x-layout.head title="Edit: {{ $menu->item_name }}" />

<body>
    <x-layout.navbar />
    <div class="page-content">
        <x-layout.sidebar-panel />
        
        <div class="content-wrapper">
            <x-layout.page-header title="Edit Menu Item" :breadcrumbs="['Menu', 'Edit Item']" />

            <div class="content">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-bold"><i class="icon-pencil5 mr-2 text-primary"></i> Edit Dish</h6>
                    </div>

                    <div class="card-body border-top">
                        <form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Item Name <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="item_name" value="{{ old('item_name', $menu->item_name) }}" class="form-control @error('item_name') is-invalid @enderror">
                                    @error('item_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Description</label>
                                <div class="col-lg-10">
                                    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $menu->description) }}</textarea>
                                    @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Price (Rp) <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="number" name="price" value="{{ old('price', $menu->price) }}" class="form-control @error('price') is-invalid @enderror" min="0" step="500">
                                    @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            @if($menu->image)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Current Image</label>
                                <div class="col-lg-10">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Current Image" class="rounded" style="max-height: 150px; border: 1px solid #ddd; padding: 3px;">
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ $menu->image ? 'Replace Image' : 'Upload Image' }}</label>
                                <div class="col-lg-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                        <label class="custom-file-label" for="image">Choose file to overwrite existing</label>
                                    </div>
                                    @error('image') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Availability</label>
                                <div class="col-lg-10 mt-1">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="availability" id="availability" value="1" {{ old('availability', $menu->availability) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="availability">Available for ordering</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-4 pt-3 border-top">
                                <a href="{{ route('restaurant.dashboard') }}" class="btn btn-light rounded-pill mr-2"><i class="icon-cross2 mr-1"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary rounded-pill font-weight-bold"><i class="icon-checkmark3 mr-1"></i> Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <x-layout.footer />
        </div>
    </div>
    <script>
        $('.custom-file-input').on('change',function(){
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
</body>
</html>
