@extends('backend.app')
@section('title', 'Subcription Pakage')

@push('styles')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endpush
@section('content')

    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Subcription Pakage</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Subcription Pakage</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Edit</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">


                <div class="mb-4">
                    <h4 class="fs-20 mb-1">Subcription Pakage</h4>
                    <p class="fs-15">Update Subcription Pakage here.</p>
                </div>

                <form action="{{ route('subcription_pakage.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Title input feild --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Title</label>
                                <div class="form-group position-relative">
                                    <input type="text"
                                        class="form-control text-dark ps-5 h-55 @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title', $data->title ?? '') }}" required
                                        placeholder="Enter title here">
                                </div>
                                @error('title')
                                    <div id="title-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Price input feild --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Price</label>
                                <div class="form-group position-relative">
                                    <input type="number"
                                        class="form-control text-dark ps-5 h-55 @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price', $data->price ?? '') }}" required
                                        placeholder="Enter price here">
                                </div>
                                @error('price')
                                    <div id="price-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Days input feild --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Days</label>
                                <div class="form-group position-relative">
                                    <input type="number"
                                        class="form-control text-dark ps-5 h-55 @error('days') is-invalid @enderror"
                                        name="days" value="{{ old('days', $data->days ?? '') }}" required
                                        placeholder="Enter days here" min="01">
                                </div>
                                @error('days')
                                    <div id="days-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Button Text input feild --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Button Text</label>
                                <div class="form-group position-relative">
                                    <input type="text"
                                        class="form-control text-dark ps-5 h-55 @error('button_text') is-invalid @enderror"
                                        name="button_text" value="{{ old('button_text', $data->button_text ?? '') }}"
                                        required placeholder="Enter button text here">
                                </div>
                                @error('button_text')
                                    <div id="button_text-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Description input feild --}}
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Description</label>
                                <div class="form-group position-relative">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                        placeholder="Description here">{{ old('description', $data->description ?? '') }}</textarea>

                                </div>
                                @error('description')
                                    <div id="description-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="reset" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white"
                                    onclick="window.location.href='{{ route('subcription_pakage.index') }}'">Cancel</button>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i
                                        class="ri-check-line text-white fw-medium"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'ImageUpload', 'MediaEmbed'],
                toolbar: ['bold', 'italic', 'heading', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
