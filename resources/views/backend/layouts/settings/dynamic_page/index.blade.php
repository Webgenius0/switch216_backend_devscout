@extends('backend.app')
@section('title', 'Dynamic Page')

@push('styles')
<style>
    .dataTables_length label {
    font-weight: bold; /* Make label bold */
    margin-right: 10px; /* Space between label and select */
}

.dataTables_length select {
    border: 1px solid #ccc; /* Change border color */
    border-radius: 5px; /* Round the corners */
    padding: 5px; /* Add some padding */
    font-size: 14px; /* Change font size */
    background-color: #f9f9f9; /* Change background color */
}
</style>
@endpush

@section('content')
    <main>
        <h2 class="section-title">Dynamic Page</h2>
        <div class="filter-wrapper">
            <div class="search-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                    <path
                        d="M22.7832 22L20.7832 20M2.7832 11.5C2.7832 6.25329 7.0365 2 12.2832 2C17.5299 2 21.7832 6.25329 21.7832 11.5C21.7832 16.7467 17.5299 21 12.2832 21C7.0365 21 2.7832 16.7467 2.7832 11.5Z"
                        stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input type="text" id="customSearchBox" placeholder="Search" class="form-control" />
            </div>
            <a href="{{ route('dynamic.page.create') }}" class="button button-pri" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6 12H18" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 18V6" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Add Dynamic Page</span>
            </a>
        </div>
        <div class="table-wrapper">
            <div class="table-container" style="padding: 25px">
                <table id="basic_tables" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Page Title</th>
                            <th scope="col">Page Content</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Custom Pagination -->
            <div class="pagination-wrapper">
                <a class="prev-page-btn" href="#" id="prevPage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                        fill="none">
                        <path d="M8.75755 4.94165L3.69922 9.99998L8.75755 15.0583" stroke="#575757" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17.8668 10H3.8418" stroke="#575757" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Previous</span>
                </a>
                <div class="pagination-container" id="customPagination">

                </div>
                <a class="next-page-btn" href="#" id="nextPage">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                        fill="none">
                        <path d="M12.8086 4.94165L17.8669 9.99998L12.8086 15.0583" stroke="#575757" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3.69922 10H17.7242" stroke="#575757" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

        </div>
    </main>

@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/js/datatables/data-tables.min.js"></script>
    <!--buttons dataTables-->
    <script src="{{ asset('backend') }}/js/datatables/datatables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/js/datatables/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/js/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/js/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/js/datatables/buttons.print.min.js"></script>

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
                    lengthMenu: "Show _MENU_ entries",
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
                    url: "{{ route('dynamic.page.index') }}",
                    type: "get",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'page_title',
                        name: 'page_title',
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
                        data: 'page_content',
                        name: 'page_content',
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

            // Custom search box functionality
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
                    paginationContainer.append(`<a href="#" class="pagination-item" data-page="1">1</a>`);
                    if (startPage > 2) {
                        paginationContainer.append(`<span class="ellipsis">...</span>`);
                    }
                }

                // Add the visible page range
                for (let i = startPage; i <= endPage; i++) {
                    paginationContainer.append(
                        `<a href="#" class="pagination-item ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`
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
     <script src="{{ asset('backend/js/custom-actions.js') }}"></script>
     <script>
         // Use the status change alert
         function changeStatus(event, id) {
             event.preventDefault();
             let statusUrl = '{{ route('dynamic.page.status', ':id') }}';
             showStatusChangeAlert(id, statusUrl);
         }

         // Use the delete confirm alert
         function deleteRecord(event, id) {
             event.preventDefault();
             let deleteUrl = '{{ route('dynamic.page.destroy', ':id') }}';
             showDeleteConfirm(id, deleteUrl);
         }
     </script>

@endpush
