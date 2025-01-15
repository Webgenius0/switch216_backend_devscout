@extends('backend.app')
@section('title', 'Dynamic Page')

@push('styles')
@endpush

@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Pages List</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Pages</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Pages List</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">
                    <span class="position-relative table-src-form me-0">
                        <input type="text" class="form-control" placeholder="Search here" id="customSearchBox">
                        <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
                    </span>
                    <a href="{{ route('cms.home_page.banner.create') }}"
                        class="btn btn-outline-primary py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg">
                        <span class="py-sm-1 d-block">
                            <i class="ri-add-line d-none d-sm-inline-block"></i>
                            <span>Add New Banner</span>
                        </span>
                    </a>
                </div>

                <div class="default-table-area style-two all-products">
                    <div class="table-responsive">
                        <table class="table align-middle" id="basic_tables">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sub Title</th>
                                    <th scope="col">Image Upper Title</th>
                                    <th scope="col">Image Upper Sub Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- Custom Pagination -->
                    <div class="pagination-wrapper row justify-content-between align-items-center mt-4">
                        <!-- Previous Button -->
                        <a class="prev-page-btn btn btn-light d-flex align-items-center col-auto" href="#"
                            id="prevPage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                fill="none">
                                <path d="M8.75755 4.94165L3.69922 9.99998L8.75755 15.0583" stroke="#575757"
                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17.8668 10H3.8418" stroke="#575757" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="ms-2">Previous</span>
                        </a>

                        <!-- Pagination Container -->
                        <div class="pagination-container col-auto text-center" id="customPagination">

                        </div>

                        <!-- Next Button -->
                        <a class="next-page-btn btn btn-light d-flex align-items-center col-auto" href="#"
                            id="nextPage">
                            <span class="me-2">Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                fill="none">
                                <path d="M12.8086 4.94165L17.8669 9.99998L12.8086 15.0583" stroke="#575757"
                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M3.69922 10H17.7242" stroke="#575757" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('frontend/assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend') }}/admin/assets/datatables/data-tables.min.js"></script>
    <!--buttons dataTables-->
    <script src="{{ asset('backend') }}/admin/assets/datatables/datatables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/admin/assets/datatables/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/admin/assets/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/admin/assets/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/admin/assets/datatables/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            let dTable = $('#basic_tables').DataTable({
                order: [],
                destroy: true,
                lengthMenu: [
                    [25, 50, 100, 200, 500, -1],
                    [25, 50, 100, 200, 500, "All"]
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
                dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l>>tir",

                ajax: {
                    url: "{{ route('cms.home_page.banner.index') }}",
                    type: "get"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
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
                        data: 'sub_title',
                        name: 'sub_title',
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
                        data: 'sub_description',
                        name: 'sub_description',
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
                    const totalPages = Math.ceil(settings._iRecordsDisplay / settings._iDisplayLength);;
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
                        `<a href="#" class="badge bg-secondary px-3 py-2" data-page="1">1</a>`);
                    if (startPage > 2) {
                        paginationContainer.append(`<span class="ellipsis">...</span>`);
                    }
                }

                // Add the visible page range
                for (let i = startPage; i <= endPage; i++) {
                    paginationContainer.append(
                        `<a href="#" class="btn bg-dark bg-opacity-10 fw-medium text-dark py-2 px-4 ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`
                    );
                }

                // Add ellipsis and last page if needed
                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        paginationContainer.append(`<span class="ellipsis">...</span>`);
                    }
                    paginationContainer.append(
                        `<a href="#" class="pagination-item" data-page="${totalPages}">${totalPages}</a>`);
                }

                // Click event for pagination items
                $('.pagination-item').on('click', function(e) {
                    e.preventDefault();
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
            let statusUrl = '{{ route('cms.home_page.banner.status', ':id') }}';
            showStatusChangeAlert(id, statusUrl);
        }

        // Use the delete confirm alert
        function deleteRecord(event, id) {
            event.preventDefault();
            let deleteUrl = '{{ route('cms.home_page.banner.destroy', ':id') }}';
            showDeleteConfirm(id, deleteUrl);
        }
    </script>
@endpush
