{{-- here add a model start --}}
<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-4">
        <form action="" method="PUT"enctype="multipart/form-data" id="request-form-update">
            @csrf
            @method('PUT')
            <div class="row">
                <input type="hidden" name="request_id" value="{{ $data->id }}">

                <div class="row">
                   
                    <!-- Title Field -->
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Title<span class="text-danger">*</span></label>
                            <div class="form-group position-relative">
                                <input type="text"
                                    class="form-control text-dark ps-5 h-55 @error('sub_title') is-invalid @enderror"
                                    name="sub_title" value="{{ old('sub_title',$data->sub_title ?? '') }}" required placeholder="Enter Title here">
                            </div>
                        </div>
                    </div>

                    <!-- Subtitle Field -->
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Description<span class="text-danger">*</span></label>
                            <div class="form-group position-relative">
                                <textarea class="form-control text-dark ps-5 h-55 " name="sub_description" required=""
                                    placeholder="Enter description here">{{ old('sub_description',$data->sub_description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Image Field -->
                <div class="col-lg-12">
                    <span id="show-error"></span>
                    <div class="form-group ">
                        <label class="label text-secondary mb-1">Image<span class="text-danger">*</span></label>
                        <input class="dropify form-control @error('background_image') is-invalid @enderror" type="file"
                            name="background_image"
                            data-default-file="{{ $data->background_image ? asset($data->background_image) : '' }}">
                        @error('background_image')
                            <div id="image-error" class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4">
                    <div class="d-flex flex-wrap gap-3">
                        {{-- <button type="submit" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> --}}
                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"
                            id="submitButtonUpdate"> <i class="ri-check-line text-white fw-medium"></i> Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>


    {{-- here add a model end --}}
