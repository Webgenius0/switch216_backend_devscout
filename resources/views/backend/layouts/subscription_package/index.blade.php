@extends('backend.app')
@section('title', 'CMS Page')

@push('styles')
    {{-- CKEditor CDN --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}
    {{-- <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style> --}}
@endpush

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Service List</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Service</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Service List</span>
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
                                            data-bs-toggle="modal" data-bs-target="#CreateSubscription">
                                            <span class="py-sm-1 d-block">
                                                <i class="ri-add-line d-none d-sm-inline-block"></i>
                                                <span>Add New Subscription</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="default-table-area style-two all-products border-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle" id="basic_tables">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Days</th>
                                                        <th scope="col">Button Text</th>
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
        <div class="modal fade" id="CreateSubscription" tabindex="-1" aria-labelledby="CreateSubscriptionLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="CreateSubscriptionLabel" class="modal-title">Add New Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="service-form">
                            @csrf
                            <div class="mb-3">
                                <label for="subscriptionTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="subscriptionTitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="subscriptionPrice" class="form-label">Price</label>
                                <input type="number" class="form-control" id="subscriptionPrice" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="subscriptionDays" class="form-label">Days</label>
                                <input type="text" class="form-control" id="subscriptionDays" name="days"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="subscriptionButtontext" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="subscriptionButtontext"
                                    name="button_text" required>
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
    <div class="modal fade" id="EditSubscriptionContainer" tabindex="-1"
        aria-labelledby="EditSubscriptionContainerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditSubscriptionContainerLabel">Edit Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden input to store city ID -->
                    <input type="hidden" id="contractor_subscription_package_id">

                    <div class="mb-3">
                        <label for="subscriptionTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="subscriptionTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="subscriptionPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="subscriptionPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description1" name="description" required>{{ $subscription->description ?? '' }}  </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="subscriptionDays" class="form-label">Days</label>
                        <input type="text" class="form-control" id="subscriptionDays" name="days" required>
                    </div>
                    <div class="mb-3">
                        <label for="subscriptionButtontext" class="form-label">Button Text</label>
                        <input type="text" class="form-control" id="subscriptionButtontext" name="button_text"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateSubscription()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Initialize CKEditor for the first textarea if it exists
        //     if (document.querySelector('#description')) {
        //         ClassicEditor
        //             .create(document.querySelector('#description'), {
        //                 removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'ImageUpload',
        //                     'MediaEmbed'
        //                 ],
        //                 toolbar: ['bold', 'italic', 'heading', '|', 'undo', 'redo']
        //             })
        //             .catch(error => {
        //                 console.error('Error initializing CKEditor on #description:', error);
        //             });
        //     }

        //     // Initialize CKEditor for the second textarea if it exists
        //     if (document.querySelector('#description1')) {
        //         ClassicEditor
        //             .create(document.querySelector('#description1'), {
        //                 removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'ImageUpload',
        //                     'MediaEmbed'
        //                 ],
        //                 toolbar: ['bold', 'italic', 'heading', '|', 'undo', 'redo']
        //             })
        //             .catch(error => {
        //                 console.error('Error initializing CKEditor on #description1:', error);
        //             });
        //     }
        // });
    </script>





    <script>
        $('#service-form').on('submit', function(event) {
            event.preventDefault();

            let submitButton = $('#submitButton');
            submitButton.prop('disabled', true).text('Submitting...');

            let storeUrl = '{{ route('contractor_subscription_package.store') }}';
            let formData = new FormData(this);
            // console.log(formData);
            // formData.forEach((value, key) => {
            //     console.log(key, value);
            // });
            console.log(document.querySelector('#description').value);
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
                processing: false,
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
                    url: "{{ route('contractor_subscription_package.index') }}",
                    type: "get"
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
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
                        data: 'price',
                        name: 'price',
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
                        data: 'description',
                        name: 'description',
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
                        data: 'days',
                        name: 'days',
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
                        data: 'button_text',
                        name: 'button_text',
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
            let statusUrl = '{{ route('contractor_subscription_package.status', ':id') }}';
            showStatusChangeAlert(id, statusUrl);
        }

        // Use the delete confirm alert
        function deleteRecord(event, id) {
            event.preventDefault();
            let deleteUrl = '{{ route('contractor_subscription_package.destroy', ':id') }}';
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
                url: "{{ route('contractor_subscription_package.edit', ':id') }}".replace(':id',
                    id), // Correctly replace :id in the URL
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#EditSubscriptionContainer #contractor_subscription_package_id').val(response.data
                            .id);
                        $('#EditSubscriptionContainer #subscriptionTitle').val(response.data.title);
                        $('#EditSubscriptionContainer #subscriptionPrice').val(response.data.price);
                        $('#EditSubscriptionContainer #description1').val(response.data.description);
                        $('#EditSubscriptionContainer #subscriptionDays').val(response.data.days);
                        $('#EditSubscriptionContainer #subscriptionButtontext').val(response.data.button_text);
                        $('#EditSubscriptionContainer').modal('show'); // Show modal
                    } else {
                        alert("Something went wrong!");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching subscription data:", error);
                    alert("There was an error fetching the subscription data.");
                }
            });
        }
    </script>

    {{-- <script>
        function viewModel(id) {
    $.ajax({
        url: "{{ route('contractor_subscription_package.edit', ':id') }}".replace(':id', id),
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('#EditSubscriptionContainer #contractor_subscription_package_id').val(response.data.id);
                $('#EditSubscriptionContainer #subscriptionTitle').val(response.data.title);
                $('#EditSubscriptionContainer #subscriptionPrice').val(response.data.price);
                // Updated line: Use the correct ID for description
                $('#EditSubscriptionContainer #description1').val(response.data.description);
                $('#EditSubscriptionContainer #subscriptionDays').val(response.data.days);
                $('#EditSubscriptionContainer #subscriptionButtontext').val(response.data.button_text);
                $('#EditSubscriptionContainer').modal('show'); // Show modal
            } else {
                alert("Something went wrong!");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching subscription data:", error);
            alert("There was an error fetching the subscription data.");
        }
    });
}

    </script> --}}

    <script>
        function updateSubscription() {
            let contractor_subscription_package_id = $('#EditSubscriptionContainer #contractor_subscription_package_id')
                .val(); // Get the city ID from the hidden field
            let title = $('#EditSubscriptionContainer #subscriptionTitle').val();
            let price = $('#EditSubscriptionContainer #subscriptionPrice').val();
            let description = $('#EditSubscriptionContainer #description1').val();
            let days = $('#EditSubscriptionContainer #subscriptionDays').val();
            let button_text = $('#EditSubscriptionContainer #subscriptionButtontext').val();


            // Send the update request via AJAX
            $.ajax({
                url: "{{ route('contractor_subscription_package.update', ':id') }}".replace(':id',
                    contractor_subscription_package_id), // Dynamically replace :id with city_id
                type: "PUT", // PUT for updating
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for protection
                    title: title,
                    price: price,
                    description: description,
                    days: days,
                    button_text: button_text,
                },
                success: function(response) {
                    if (response.success) {
                        $('#EditSubscriptionContainer').modal('hide'); // Close modal on success
                        $('#basic_tables').DataTable().ajax.reload(); // Reload the DataTable to reflect changes

                        // Show a success message
                        flasher.success(response.message);

                    } else {
                        flasher.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating Subscription:", error);
                    flasher.error(response.message);
                }
            });
        }
    </script>

    {{-- <script>
        function updateSubscription() {
    let contractor_subscription_package_id = $('#EditSubscriptionContainer #contractor_subscription_package_id').val();
    let title = $('#EditSubscriptionContainer #subscriptionTitle').val();
    let price = $('#EditSubscriptionContainer #subscriptionPrice').val();
    // Updated line: Use the correct ID for description
    let description = $('#EditSubscriptionContainer #description1').val();
    let days = $('#EditSubscriptionContainer #subscriptionDays').val();
    let button_text = $('#EditSubscriptionContainer #subscriptionButtontext').val();

    $.ajax({
        url: "{{ route('contractor_subscription_package.update', ':id') }}".replace(':id', contractor_subscription_package_id),
        type: "PUT",
        data: {
            _token: "{{ csrf_token() }}",
            title: title,
            price: price,
            description: description,
            days: days,
            button_text: button_text,
        },
        success: function(response) {
            if (response.success) {
                $('#EditSubscriptionContainer').modal('hide');
                $('#basic_tables').DataTable().ajax.reload();
                flasher.success(response.message);
            } else {
                flasher.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating Subscription:", error);
            // Optional: provide a fallback error message
            flasher.error(xhr.responseJSON ? xhr.responseJSON.message : 'Error updating subscription.');
        }
    });
}

    </script> --}}
@endpush
