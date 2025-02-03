{{-- here add a model start --}}
<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-4">
        <form action="" method="PUT"enctype="multipart/form-data" id="request-form-update">
            @csrf
            @method('PUT')
            <div class="row">
                <span id="show-error"></span>
                <input type="hidden" name="request_id" value="{{ $data->id }}">
                <!-- Name Field -->
                <div class="col-lg-12">
                    <div class="form-group mb-4">
                        <label class="label text-secondary"> Name<span class="text-danger">*</span></label>
                        <div class="form-group position-relative">
                            <input type="text" class="form-control text-dark @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $data->name ?? '') }}" required
                                placeholder="Enter Name here">
                        </div>
                    </div>
                </div>

                <!-- Description Field -->
                <div class="col-lg-12">
                    <div class="form-group mb-4">
                        <label class="label text-secondary">Description<span class="text-danger">*</span></label>
                        <div class="form-group position-relative">
                            <textarea class="form-control text-dark " name="description" required="" placeholder="Enter description here">{{ old('description', $data->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- thumbnail Field -->
            <div class="col-lg-12">
                <div class="form-group ">
                    <label class="label text-secondary mb-1">Thumbnail<span class="text-danger">*</span></label>
                    <input class="dropify form-control @error('thumbnail') is-invalid @enderror" type="file"
                        name="thumbnail" data-default-file="{{ asset($data->thumbnail ?? '') }}">
                    @error('thumbnail')
                        <div id="thumbnail-error" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap gap-3">
                        {{-- <button type="submit" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> --}}
                        <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"
                            id="submitButtonUpdate"> <i class="ri-check-line text-white fw-medium"></i> Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    {{-- here add a model end --}}
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
