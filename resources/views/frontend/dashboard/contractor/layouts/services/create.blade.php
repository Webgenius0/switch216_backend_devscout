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
                <p class="fs-15">Provider Tag: {{$categories[0]->name}}</p>
            </div>
            @if ($categories[0]->name === 'Real Estate')
                @include('frontend.dashboard.contractor.layouts.services.real_state_form')
            @elseif ($categories[0]->name === 'Car')
                @include('frontend.dashboard.contractor.layouts.services.car_form')
            @elseif ($categories[0]->name === 'Restaurant')
                @include('frontend.dashboard.contractor.layouts.services.restaurant_form')
            @else
                @include('frontend.dashboard.contractor.layouts.services.all_category_form')
            @endif

        </div>
    </div>
@endsection


@push('scripts')
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
                    accept: 'image/jpeg,image/png,image/jpg',
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
