@extends('frontend.dashboard.customer.app')

@section('title')
    Dashboard Customer
@endsection
@section('header')
    @include('frontend.dashboard.customer.partials.header')
@endsection
@push('styles')
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-main-content ">

        <!-- dashboard appointments start -->
        <div class="section-title mt-5">Upcoming Appointments</div>
        <div class="dashboard-appointments mt-5">
            @forelse ($bookings as $key=> $booking)
                <div class="item">
                    <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                        <div class="profile d-flex gap-2 flex-wrap">
                            <div class="profile-img">
                                <img src="{{ asset($booking->service->user->avatar ??'backend/assets/images/user.png') }}" alt="">
                            </div>
                            <div class="profile-info">
                                <div class="profile-title">
                                    Danial David
                                </div><span>
                                    Status : {{ $booking->status }}
                                </span>
                                <div class="profile-text d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 16 17" fill="none">
                                        <path
                                            d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                            stroke="#BDBDBD" stroke-width="1.5" />
                                        <path
                                            d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                            stroke="#BDBDBD" stroke-width="1.5" />
                                    </svg>
                                    <span class="ms-2">
                                        Location: {{ $booking->service->user->userAddresses()->first()->location ?? ' ' }}
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="date"> Date:
                            {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') : ' ' }}
                        </div>
                    </div>
                    <div class="text mt-3">
                        Description: {{ $booking->service->description ?? ' ' }}
                    </div>
                    @if ($booking->status !== 'completed' && $booking->status !== 'cancelled' && $booking->status !== 'request_completed')
                        <a class="action mt-5 reschedule-booking-btn" type="button" data-booking-id="{{ $booking->id }}">
                            Reschedule
                        </a>
                    @endif
                    @if ($booking->status !== 'completed' && $booking->status !== 'cancelled' && $booking->status !== 'request_completed')
                        <a href="{{ route('customer.booking.cancle', $booking->id) }}"
                            class="action mt-5 cancelled-booking-btn" type="button">
                            Cancle Booking
                        </a>
                    @endif
                    @if ($booking->status !== 'completed'&& $booking->status !== 'cancelled' && !$booking->booking_date->isFuture())
                        <a class="action mt-5 complete-booking-btn" type="button"
                            onclick="mark_as_complete({{ $booking->id }}, this)" data-booking-id="{{ $booking->id }}">
                            Mark As Complete
                        </a>
                    @endif
                    @if ($booking->status == 'completed' && $booking->reviews->isEmpty())
                        <a class="action mt-5 review-booking-btn" type="button" data-booking-id="{{ $booking->id }}">
                            Given Review
                        </a>
                    @endif
                </div>
            @empty
            @endforelse
        </div>
        <!-- dashboard appointments end -->

    </div>
    <!-- Success Modal -->


    <!-- for review Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="close-btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                            stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.17188 14.8299L14.8319 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.8319 14.8299L9.17188 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <form id="reviewForm" class="p-3 border rounded">
                    @csrf
                    <input type="hidden" name="booking_id" id="bookingIdInput">

                    <div class="mb-3">
                        <label for="rating" class="form-label fw-bold">Rating:</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label fw-bold">Review:</label>
                        <textarea name="review" id="review" class="form-control" rows="4" placeholder="Write your review..." required></textarea>
                    </div>

                    <button type="button" id="submitReview" class="btn btn-primary w-100">Submit Review</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="close-btn" type="button" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                            stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.17188 14.8299L14.8319 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.8319 14.8299L9.17188 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <form id="rescheduleForm" class="p-3 border rounded">
                    @csrf

                    <input type="hidden" name="booking_id" id="reschedule_bookingIdInput">

                    <div class="mb-3">
                        <label for="booking_date" class="form-label fw-bold">New Booking Date:</label>
                        <input type="date" name="booking_date" id="booking_date" class="form-control" required min="{{ date('Y-m-d') }}">
                        <span id="rescheduleFormError"> </span>
                    </div>

                    <button type="submit" id="submitReschedule" class="btn btn-primary w-100">Submit Reschedule
                        Request</button>
                </form>
            </div>
        </div>
    </div>


    <!-- dashboard content end -->
@endsection


@push('scripts')
    <script>
        function mark_as_complete(bookingId, button) {
            event.preventDefault(); // Prevent default action

            let clickedButton = $(button); // Store reference to clicked button

            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure you want to mark this booking as completed?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('customer.booking.mark_as_complete', ':id') }}`.replace(':id',
                            bookingId),
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                flasher.success(response.message);
                                clickedButton.hide(); // Hide only the clicked button
                            } else {
                                flasher.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            flasher.error(xhr.responseJSON.message);
                        }
                    });
                }
            });
        }


        $(document).ready(function() {

            // When the review button is clicked
            $('.review-booking-btn').on('click', function(event) {
                event.preventDefault();

                let bookingId = $(this).data('booking-id'); // Get booking ID
                let clickedButton = $(this); // Store reference to the clicked button

                $("#bookingIdInput").val(bookingId); // Set booking ID in form
                $('#successModal').modal('show'); // Show modal

                // Unbind previous click event to prevent duplicates, then bind new one
                $('#submitReview').off('click').on('click', function() {
                    $.ajax({
                        url: "{{ route('customer.booking.review') }}",
                        type: "POST",
                        data: $('#reviewForm').serialize(),
                        success: function(response) {
                            if (response.success) {
                                flasher.success(response.message);
                                $('#successModal').modal('hide'); // Hide modal
                                $('#reviewForm')[0].reset(); // Reset form
                                clickedButton.hide(); // Hide only the clicked button
                            }
                        },
                        error: function(xhr) {
                            flasher.error(xhr.responseJSON.message);
                        }
                    });
                });
            });
        });

        $(document).ready(function() {
            let rescheduleRoute = "{{ route('customer.booking.reschedule') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.reschedule-booking-btn').on('click', function(event) {
                event.preventDefault();
                let bookingId = $(this).data('booking-id');
                $("#reschedule_bookingIdInput").val(bookingId);
                $('#rescheduleFormError').html('');
                $('#rescheduleModal').modal('show');
            });

            $('#rescheduleForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: rescheduleRoute,
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            flasher.success(response.message);
                            $('#rescheduleModal').modal('hide'); // Hide modal
                            $('#rescheduleForm')[0].reset(); // Reset form
                            $('.reschedule-booking-btn[data-booking-id="' + response.data.id +
                                '"]').hide(); // Hide only the clicked button

                        }
                    },
                    error: function(xhr) {
                        $('#rescheduleFormError').empty();
                        $('#rescheduleFormError').append(`
                        <div style="color:red">${xhr.responseJSON.message}</div>
                        `);
                        flasher.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush
