@extends('frontend.dashboard.contractor.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.contractor.partials.header')
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <!-- Include Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
@endpush

@section('content')
    <div class="col-12 p-5">
        <div class="card-body p-4 bg-white rounded ">
            <div class="mb-4">
                <h4 class="fs-20 mb-1">Create Service</h4>
                <p class="fs-15">Create new service here.</p>
            </div>

            <form action="{{ route('contractor.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Category -->
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
                    </div>
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
                    <!-- Is Emergency -->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Service Type<span style="color: red">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                <option value="sell" {{ old('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                                <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                                <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event
                                </option>
                                <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single
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
                                name="cover_image" accept="image/jpeg,png,jpg" required id="cover_image">
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
                                name="gallery_images[]" accept="image/jpeg,png,jpg" multiple id="gallery-images">
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

        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>

    <!-- JavaScript to Enable & Filter Subcategories -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const subcategorySelect = document.getElementById('subcategory');

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.options[this.selectedIndex];
                const subcategories = JSON.parse(selectedCategory.getAttribute('data-subcategories'));

                // Clear and disable subcategory dropdown if no category selected
                subcategorySelect.innerHTML =
                    '<option value="" selected disabled>Select Subcategory</option>';
                subcategorySelect.disabled = true;

                if (subcategories.length > 0) {
                    subcategories.forEach(subcategory => {
                        let option = new Option(subcategory.name, subcategory.id);
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false; // Enable subcategory dropdown
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let uploadedImages = [];
            const dropzone = $('#gallery-dropzone');
            const previewContainer = $('#preview-container');
            const galleryImagesInput = $('#gallery-images')[0];
            const maxFiles = 20; // Maximum allowed file uploads

            dropzone.on('dragover', function(event) {
                event.preventDefault();
                dropzone.addClass('border-primary');
            });

            dropzone.on('dragleave', function() {
                dropzone.removeClass('border-primary');
            });

            dropzone.on('drop', function(event) {
                event.preventDefault();
                dropzone.removeClass('border-primary');
                let files = event.originalEvent.dataTransfer.files;
                handleFiles(files);
            });

            dropzone.on('click', function() {
                let fileInput = $('<input>', {
                    type: 'file',
                    accept: 'image/jpeg,png,jpg',
                    multiple: true
                }).on('change', function(event) {
                    handleFiles(event.target.files);
                });
                fileInput.trigger('click');
            });

            function handleFiles(files) {
                // console.log(files.length)
                if (uploadedImages.length >= maxFiles || files.length >= maxFiles) {
                    flasher.warning(`You can only upload up to ${maxFiles} images.`);
                    // alert(`You can only upload up to ${maxFiles} images.`);
                    return;
                }
                $.each(files, function(index, file) {
                    const maxSize = 2 * 1024 * 1024; // 2MB limit

                    if (file.size > maxSize) {
                        // alert(`File "${file.name}" size exceeds the maximum allowed size (2MB).`);
                        // console.log(`File "${file.name}" exceeds 2MB and will not be uploaded.`);
                        flasher.error(`"${file.name}" exceeds 2MB and will not be uploaded.`);
                        return;
                    }
                    // Check if file is already uploaded
                    if (uploadedImages.some(img => img.name === file.name && img.size === file.size)) {
                        flasher.warning(`"${file.name}" is already added.`);
                        return;
                    }



                    if (file.type.startsWith('image/')) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            let imgUrl = event.target.result;
                            uploadedImages.push(file);
                            updateGalleryImagesInput();

                            // Create preview
                            let previewCard = $('<div>', {
                                class: 'position-relative rounded overflow-hidden shadow-sm m-2'
                            });

                            let imgElement = $('<img>', {
                                src: imgUrl,
                                class: 'img-thumbnail rounded',
                                css: {
                                    height: '200px',
                                    width: '200px'
                                }
                            });

                            let deleteButton = $('<button>', {
                                html: '&times;',
                                class: 'position-absolute top-0 end-0 btn-sm btn-danger rounded-circle'
                            }).on('click', function() {
                                uploadedImages = uploadedImages.filter(item => item !== file);
                                previewCard.remove();
                                updateGalleryImagesInput();
                            });

                            previewCard.append(imgElement, deleteButton);
                            previewContainer.append(previewCard);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            function updateGalleryImagesInput() {
                let dataTransfer = new DataTransfer();
                $.each(uploadedImages, function(index, file) {
                    dataTransfer.items.add(file);
                });
                galleryImagesInput.files = dataTransfer.files;
                // console.log(galleryImagesInput.files);
            }
        });
    </script>
@endpush
