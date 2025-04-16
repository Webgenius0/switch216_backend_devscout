<form action="{{ route('contractor.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        {{-- <!-- Category -->
        <div class="col-md-4">
            <div class="form-group mb-4">
                <label class="label text-secondary">Category<span style="color: red">*</span></label>
                <select id="category" class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                    required>
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}
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
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="form-group mb-4">
                <label class="label text-secondary">Is Emergency?<span style="color: red">*</span></label>
                <select class="form-select @error('is_emergency') is-invalid @enderror" name="is_emergency" required>
                    <option value="0" {{ old('is_emergency') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_emergency') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('is_emergency')
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
        <!-- Home Details Fields -->
        <!-- Property Type -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Property Type<span style="color: red">*</span></label>
                <select class="form-select @error('property_type') is-invalid @enderror" name="property_type" required>
                    <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment
                    </option>
                    <option value="Land" {{ old('property_type') == 'Land' ? 'selected' : '' }}>Land</option>
                    <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial
                    </option>
                </select>
                @error('property_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Transaction Type -->
        {{-- <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Transaction Type<span style="color: red">*</span></label>
                <select class="form-select @error('transaction_type') is-invalid @enderror" name="transaction_type" required>
                    <option value="For Rent">For Rent</option>
                    <option value="For Sale">For Sale</option>
                </select>
                @error('transaction_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        <!-- Price Range -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Price<span style="color: red">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ old('price') }}" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Location -->
        {{-- <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="label text-secondary">Location (City/Region)<span style="color: red">*</span></label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        <!-- Number of Bedrooms -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Number of Bedrooms<span style="color: red">*</span></label>
                <select class="form-select @error('bedrooms') is-invalid @enderror" name="bedrooms" required>
                    <option value="1" {{ old('bedrooms') == '1' ? 'selected' : '' }}>1 Bedroom</option>
                    <option value="2" {{ old('bedrooms') == '2' ? 'selected' : '' }}>2 Bedrooms</option>
                    <option value="3" {{ old('bedrooms') == '3' ? 'selected' : '' }}>3+ Bedrooms</option>
                </select>
                @error('bedrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Number of Bathrooms -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Number of Bathrooms<span style="color: red">*</span></label>
                <select class="form-select @error('bathrooms') is-invalid @enderror" name="bathrooms" required>
                    <option value="1" {{ old('bathrooms') == '1' ? 'selected' : '' }}>1+</option>
                    <option value="2" {{ old('bathrooms') == '2' ? 'selected' : '' }}>2+</option>
                    <option value="3" {{ old('bathrooms') == '3' ? 'selected' : '' }}>3+</option>
                </select>
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Furnished? -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Furnished?<span style="color: red">*</span></label>
                <select class="form-select @error('is_furnished') is-invalid @enderror" name="is_furnished" required>
                    <option value="1" {{ old('is_furnished') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_furnished') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('is_furnished')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Service Type -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                <label class="label text-secondary">Service Type<span style="color: red">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                    <option value="sell" {{ old('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                    <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                    {{-- <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event</option>
                    <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Others</option> --}}
                </select>
                @error('type')
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
