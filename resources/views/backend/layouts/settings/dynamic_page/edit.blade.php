@extends('backend.app')
@section('title', 'Update Dynamic Page')

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

<main>
    <h2 class="section-title">Update Dynamic page</h2>
        <nav aria-label="breadcrumb tm-breadcumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tm-breadcumb-item">
                    <a href="{{route('dynamic.page.index')}}">Dynamic page</a>
                </li>
                <li class="breadcrumb-item tm-breadcumb-item active" aria-current="page">
                    Update Dynamic page
                </li>
            </ol>
        </nav>
    <div class="addbooking-form-area">
        <form action="{{ route('dynamic.page.update', $data->id) }}" method="POST" class="tm-form mt-5" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for update actions -->
            <div class="form-field-wrapper">
                {{-- ------------------- Page Title Input Field ------------- --}}
                <div class="form-group">
                    <label for="page_title">Page Title</label>
                    <input class="form-control @error('page_title') is-invalid @enderror" type="text"
                        name="page_title" placeholder="Enter Page Title here"
                        value="{{ old('page_title', $data->page_title) }}">
                    @error('page_title')
                        <div id="page_title-error" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-field-wrapper">
                {{-- ------------------- Page Content Input Field ------------- --}}
                <div class="form-group">
                    <label for="page_content">Page Content</label>
                    <textarea name="page_content" class="form-control @error('page_content') is-invalid @enderror" id="page_content" placeholder="Page Content here">{{ old('page_content', $data->page_content) }}</textarea>
                    @error('page_content')
                        <div id="page_content-error" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="tm-booking-btn-wrapper" style="justify-content: start;">
                <button type="reset" onclick="window.location.href='{{route('dynamic.page.index')}}'">Cancel</button>
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</main>

@endsection

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#page_content'), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'ImageUpload', 'MediaEmbed'],
            toolbar: ['bold', 'italic', 'heading', '|', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
