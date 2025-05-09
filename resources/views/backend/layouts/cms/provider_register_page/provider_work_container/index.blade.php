@extends('backend.app')
@section('title', 'CMS Page')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">CMS Provider Register Work List</h3>


            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">CMS Provider Register Work</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">CMS Provider Register Work List</span>
                    </li>
                </ol>
            </nav>
        </div>
        {{-- ---------------------- --}}
        <div class="row justify-content-center">
            <div class="col-xl-12 col-xxl-12 col-lg-12">
                <div class="card bg-white border-0 rounded-3 mb-4">
                    <div class="card-body p-4">

                        <div class="mb-4">
                            <h4 class="fs-20 mb-1">CMS Register Page Provider Work Container</h4>
                            <p class="fs-15">Update Register Page Provider Work Container and site details here.</p>
                        </div>

                        <form action="{{ route('cms.provider_page.work.update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Title Field -->
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Title<span class="text-danger">*</span></label>
                                        <div class="form-group position-relative">
                                            <input type="text"
                                                class="form-control text-dark ps-5 h-55 @error('title') is-invalid @enderror"
                                                name="title"
                                                value="{{ old('title', $RegisterProviderWorkContainer->title ?? '') }}" required=""
                                                placeholder="Enter Title here">
                                        </div>
                                        @error('title')
                                            <div id="title-error" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Subtitle Field -->
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Description<span
                                                class="text-danger">*</span></label>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control text-dark ps-5 h-55 " name="description" required=""
                                                placeholder="Enter description here">{{ old('description', $RegisterProviderWorkContainer->description ?? '') }}</textarea>
                                        </div>
                                        @error('description')
                                            <div id="description-error" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Subtitle Field -->
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Button Text<span
                                                class="text-danger">*</span></label>
                                        <div class="form-group position-relative">
                                            <input type="text"
                                                class="form-control text-dark ps-5 h-55 @error('button_text') is-invalid @enderror"
                                                name="button_text"
                                                value="{{ old('button_text', $RegisterProviderWorkContainer->button_text ?? '') }}"
                                                required placeholder="Enter Title here">
                                        </div>
                                        @error('button_text')
                                            <div id="button_text-error" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Subtitle Field -->
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <label class="label text-secondary mb-1">Video<span
                                                class="text-danger">*</span></label>
                                        <input class="dropify form-control @error('image') is-invalid @enderror"
                                            type="file" name="image"
                                            data-default-file="{{ isset($RegisterProviderWorkContainer) && $RegisterProviderWorkContainer->image ? asset($RegisterProviderWorkContainer->image) : '' }}">
                                        @error('image')
                                            <div id="image-error" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                {{-- <button type="submit" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> --}}
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i
                                        class="ri-check-line text-white fw-medium"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        {{-- ---------------  --}}

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
@endpush
