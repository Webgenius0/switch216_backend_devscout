@extends('backend.app')
@section('title', 'CMS Page')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">City List</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">City</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">City List</span>
                    </li>
                </ol>
            </nav>
        </div>
        {{-- ---------------------- --}}
        <div class="row justify-content-center">
            <div class="col-xl-12 col-xxl-12 col-lg-12">
                <div class="card bg-white border-0 rounded-3 mb-4">
                    <div class="card-body p-4">

                        <div class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="card bg-white border-0 rounded-3 mb-4">
                                <div class="card-body p-0">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">
                                        <span class="position-relative table-src-form me-0">
                                            <input type="text" class="form-control" placeholder="Search here"
                                                id="customSearchBox">
                                            <i
                                                class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
                                        </span>
                                        <a href="javascript:void(0)"
                                            class="btn btn-outline-primary py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg"
                                            data-bs-toggle="modal" data-bs-target="#CreateServiceContainer">
                                            <span class="py-sm-1 d-block">
                                                <i class="ri-add-line d-none d-sm-inline-block"></i>
                                                <span>Add New City</span>
                                            </span>
                                        </a>
                                    </div>

                                    <div class="default-table-area style-two all-products">
                                        <div class="table-responsive">
                                            <table class="table align-middle" id="basic_tables">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Status</th>
                                                        <th class="text-center" scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- Data will be fetched using AJAX --}}
                                                

                                                </tbody>
                                            </table>
                                        </div>
                                        <div
                                            class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                                            <span class="fs-12 fw-medium"></span>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination mb-0 justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link icon" aria-label="Previous" href="#"
                                                            id="prevPage">
                                                            <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                                        </a>
                                                    </li>
                                                    <!-- Pagination Container !-->
                                                    <li class="row " id="customPagination">
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link icon" aria-label="Next" href="#"
                                                            id="nextPage">
                                                            <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{-- --------------- view modal------------ --}}
        <!-- Create Service Modal -->
        <div class="modal fade" id="CreateServiceContainer" tabindex="-1" aria-labelledby="CreateServiceContainerLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="CreateServiceContainerLabel" class="modal-title">Add New City</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="service-form">
                            @csrf
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">City Name</label>
                                <input type="text" class="form-control" id="serviceName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="serviceStatus" class="form-label">Status</label>
                                <select class="form-control" id="serviceStatus" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div id="show-error"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- --------------- view edit modal------------ --}}
    <div class="modal fade" id="EditCityContainer" tabindex="-1" aria-labelledby="EditCityContainerLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditCityContainerLabel">Edit City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden input to store city ID -->
                    <input type="hidden" id="city_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">City Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateCity()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $('#service-form').on('submit', function(event) {
            event.preventDefault();

            let submitButton = $('#submitButton');
            submitButton.prop('disabled', true).text('Submitting...');

            let storeUrl = '{{ route('cities.store') }}';
            let formData = new FormData(this);

            $.ajax({
                url: storeUrl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        flasher.success(response?.message);
                        $('#basic_tables').DataTable().ajax.reload();
                        $('#service-form').trigger("reset");
                        $('.btn-close').trigger('click');
                    } else {
                        flasher.error('Something went wrong.');
                    }
                },
                error: function(response) {
                    if (response.responseJSON.errors) {
                        $('#show-error').html(
                            `<div class="text-danger">${response.responseJSON.message}</div>`
                        );
                    }
                },
                complete: function() {
                    submitButton.prop('disabled', false).text('Save');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let dTable = $('#basic_tables').DataTable({
                order: [],
                destroy: true,
                lengthMenu: [
                    [10, 25, 50, 100, 200, 500, -1],
                    [10, 25, 50, 100, 200, 500, "All"]
                ],
                processing: true,
                responsive: true,
                serverSide: true,
                paging: true, // Disable built-in pagination
                language: {
                    lengthMenu: `<span style="margin-left: 20px;">Show _MENU_ entries</span>`,
                    processing: `<div class="text-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`
                },
                scroller: {
                    loadingIndicator: false
                },
                // Remove the default search box
                dom: "<'row justify-content-between table-topbar'<'col-md-6 col-sm-4 px-0'l>>tir",

                ajax: {
                    url: "{{ route('cities.index') }}",
                    type: "get"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data.length > 50) {
                                return data.substring(0, 50) + '...';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(settings) {
                    const totalPages = Math.ceil(settings._iRecordsDisplay / settings._iDisplayLength);
                    const currentPage = settings._iDisplayStart / settings._iDisplayLength + 1;
                    updateCustomPagination(totalPages, currentPage);
                }
            });

            $('#customSearchBox').on('keyup', function() {
                dTable.search(this.value).draw();
            });

            $('#customSearchBox').on('keyup', function() {
                dTable.search(this.value).draw();
            });

            // Custom pagination logic with ellipsis
            function updateCustomPagination(totalPages, currentPage) {
                const paginationContainer = $('#customPagination');
                paginationContainer.empty();

                const maxVisiblePages = 5; // Number of visible pages before and after the current page
                let startPage, endPage;

                // Determine the start and end page range
                if (totalPages <= maxVisiblePages) {
                    startPage = 1;
                    endPage = totalPages;
                } else {
                    if (currentPage <= Math.floor(maxVisiblePages / 2)) {
                        startPage = 1;
                        endPage = maxVisiblePages;
                    } else if (currentPage + Math.floor(maxVisiblePages / 2) >= totalPages) {
                        startPage = totalPages - maxVisiblePages + 1;
                        endPage = totalPages;
                    } else {
                        startPage = currentPage - Math.floor(maxVisiblePages / 2);
                        endPage = currentPage + Math.floor(maxVisiblePages / 2);
                    }
                }

                // Add first page and ellipsis if needed
                if (startPage > 1) {
                    paginationContainer.append(
                        ` <li class="page-item col-1"><a class="page-link active" href="#" data-page="1">1</a></li>`
                    );
                   
                }

                // Add the visible page range
                for (let i = startPage; i <= endPage; i++) {
                    paginationContainer.append(
                        ` <li class="page-item col-1"><a class="pagination-item page-link ${i === currentPage ? 'active' : ''}" href="#" data-page="${i}">${i}</a></li>`
                    );
                }

                // Click event for pagination items
                $('.pagination-item').on('click', function(e) {
                    e.preventDefault();
                    console.log('pagination-item')
                    const page = $(this).data('page');
                    if (!$(this).hasClass('disabled')) {
                        dTable.page(page - 1).draw('page'); // DataTables is 0-based index, so subtract 1
                    }
                });

                // Click event for 'Previous' button
                $('#prevPage').off().on('click', function(e) {
                    e.preventDefault();
                    if (currentPage > 1) {
                        dTable.page(currentPage - 2).draw('page');
                    }
                });

                // Click event for 'Next' button
                $('#nextPage').off().on('click', function(e) {
                    e.preventDefault();
                    // console.log('nextPage')
                    if (currentPage < totalPages) {
                        dTable.page(currentPage).draw('page');
                    }
                });
            }

        });
    </script>


                



    <script src="{{ asset('backend/admin/assets/custom-actions.js') }}"></script>
    <script>
        // Use the status change alert
        function changeStatus(event, id) {
            event.preventDefault();
            let statusUrl = '{{ route('cities.status', ':id') }}';
            showStatusChangeAlert(id, statusUrl);
        }

        // Use the delete confirm alert
        function deleteRecord(event, id) {
            event.preventDefault();
            let deleteUrl = '{{ route('cities.destroy', ':id') }}';
            showDeleteConfirm(id, deleteUrl);
        }
    </script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>

    {{-- for update data --}}

    <script>
        function viewModel(id) {
            $.ajax({
                url: "{{ route('cities.edit', ':id') }}".replace(':id', id), // Correctly replace :id in the URL
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Populate the form fields with the response data
                        $('#EditCityContainer #city_id').val(response.data.id); // Store city ID in hidden input
                        $('#EditCityContainer #name').val(response.data.name); // Populate city name field
                        $('#EditCityContainer #status').val(response.data.status); // Populate status dropdown

                        // Show the modal
                        $('#EditCityContainer').modal('show');
                    } else {
                        alert("Something went wrong!");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching city data:", error);
                    alert("There was an error fetching the city data.");
                }
            });
        }
    </script>

    <script>
        function updateCity() {
            let city_id = $('#EditCityContainer #city_id').val(); // Get the city ID from the hidden field
            let name = $('#EditCityContainer #name').val(); // Get the updated city name
            let status = $('#EditCityContainer #status').val(); // Get the updated status

            // Send the update request via AJAX
            $.ajax({
                url: "{{ route('cities.update', ':id') }}".replace(':id',
                    city_id), // Dynamically replace :id with city_id
                type: "PUT", // PUT for updating
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for protection
                    name: name,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        $('#EditCityContainer').modal('hide'); // Close modal on success
                        $('#basic_tables').DataTable().ajax.reload(); // Reload the DataTable to reflect changes

                        // Show a success message
                        flasher.success(response.message);

                    } else {
                        flasher.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating city:", error);
                    flasher.error(response.message);
                }
            });
        }
    </script>
@endpush
