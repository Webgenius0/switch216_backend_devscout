{{-- here add a model start --}}
<x-modal id="CreateServiceContainer" title="Add New" labelledby="customModalLabel" size="modal-lg" saveButton="Submit">

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">

            <form action="" method="POST"enctype="multipart/form-data" id="request-form">
                @csrf
                <div class="row">
                    <span id="show-error"></span>
                    <!-- Image Field -->
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <label class="label text-secondary mb-1">Image<span class="text-danger">*</span></label>
                            <input class="dropify form-control @error('image') is-invalid @enderror" type="file"
                                name="image"
                                data-default-file="">
                            @error('image')
                                <div id="image-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16" id="submitButton">
                                <i class="ri-check-line text-white fw-medium"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

</x-modal>
{{-- here add a model end --}}
