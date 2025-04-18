<form action="{{ route('contractor.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        {{-- <!-- Category -->
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Category<span style="color: red">*</span></label>
                <select id="category" class="form-select @error('category_id') is-invalid @enderror"
                    name="category_id" required>
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                            data-subcategories="{{ json_encode($category->subCategories) }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Subcategory -->
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Subcategory<span style="color: red">*</span></label>
                <select id="subcategory" class="form-select @error('subcategory_id') is-invalid @enderror"
                    name="subcategory_id" {{ old('subcategory_id') ? '' : 'disabled' }} required>
                    <option value="" selected disabled>Select Subcategory</option>
                    @if (old('subcategory_id'))
                        <option value="{{ old('subcategory_id') }}" selected>
                            {{ \App\Models\SubCategory::find(old('subcategory_id'))->name }}
                        </option>
                    @endif
                </select>
                @error('subcategory_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}
        <!-- Is Emergency -->
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Is Emergency?<span style="color: red">*</span></label>
                <select class="form-select @error('is_emergency') is-invalid @enderror" name="is_emergency"
                    required>
                    <option value="0" {{ old('is_emergency') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_emergency') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('is_emergency')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Service Type -->
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Service Type<span style="color: red">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                    <option value="sell" {{ old('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                    <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                    <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event
                    </option>
                    <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Others
                    </option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Title -->
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="label text-secondary">Title <span style="color: red">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title') }}" required placeholder="Enter Title here">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="label text-secondary">Description<span style="color: red">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required
                    placeholder="Enter Description here">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Cover Image -->
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="label text-secondary">Cover Image<span style="color: red">*</span></label>
                <input type="file" class="form-control dropify @error('cover_image') is-invalid @enderror"
                    name="cover_image" accept="image/jpeg,image/png,image/jpg" required id="cover_image">
                @error('cover_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Gallery Image Upload -->
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="label text-secondary">Gallery Images<span style="color: red">*</span></label>
                <div id="gallery-dropzone"
                    class="dropzone border rounded p-4 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="ri-upload-cloud-2-line fs-40 text-primary"></i>
                        <p class="text-secondary m-0">Drag & Drop or Click to Upload</p>
                    </div>
                </div>
                {{-- <input type="hidden" id="gallery-images"> --}}
                <input type="file" hidden class="form-control @error('cover_image') is-invalid @enderror"
                    name="gallery_images[]" accept="image/jpeg,image/png,image/jpg" multiple id="gallery-images">
                @error('gallery_images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Preview Container -->
        <div class="col-md-12 mt-3">
            <div id="preview-container" class="d-flex flex-wrap gap-3"></div>
        </div>




        <!-- Submit Button -->
        <div class="col-md-12 mt-3 text-end">

        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">

            {{-- <a href="{{ route('contractor.services.index') }}"
                class="btn btn-outline-dark py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg">
                <span class="py-sm-1 d-block">
                    <i class="ri-add-line d-none d-sm-inline-block"></i>
                    <span>Cancle</span>
                </span>
            </a> --}}
            <button type="submit" class="btn btn-primary py-2 px-4 fw-medium">
                <i class="ri-check-line text-white fw-medium"></i> Submit
            </button>
        </div>
    </div>
</form>