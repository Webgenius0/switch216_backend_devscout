<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Profile</h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset($data->avatar) }}" class="img-fluid rounded-circle border p-2" alt="User Avatar"
                        width="100" height="100" style="border-radius: 50%;">
                </div>
                <div class="col-md-9">
                    <h5 class="fw-bold">{{ $data->name }}</h5>
                    <p class="mb-1"><strong>Email:</strong> {{ $data->email }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge bg-{{ $data->status === 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
 
    {{-- for Contactor --}}
    @if ($data->role === 'contactor')
        <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Services Provided</h5>
            </div>
            <div class="card-body">
                @if ($data->services->isNotEmpty())
                    <div class="row">
                        @foreach ($data->services as $service)
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm">
                                    <img src="{{ asset($service->cover_image) }}" class="card-img-top"
                                        alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="fw-bold">{{ $service->title }}</h6>
                                        <p class="text-muted">{{ Str::limit($service->description, 80) }}</p>
                                        <p class="mb-1"><strong>Category ID:</strong> {{ $service->category_id }}</p>
                                        <p class="mb-1"><strong>Subcategory ID:</strong>
                                            {{ $service->subcategory_id }}</p>
                                        <p class="mb-1"><strong>Price:</strong>
                                            ${{ number_format($service->price, 2) }}</p>
                                        <p class="mb-1"><strong>Type:</strong> {{ ucfirst($service->type) }}</p>
                                        <p class="mb-1"><strong>Status:</strong>
                                            <span
                                                class="badge bg-{{ $service->status === 'active' ? 'success' : 'warning' }}">
                                                {{ ucfirst($service->status) }}
                                            </span>
                                        </p>
                                        <a href="{{ $service->video_url }}" class="btn btn-sm btn-primary"
                                            target="_blank">Watch Video</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">No services found.</p>
                @endif
            </div>
        </div>

    @endif


    {{-- for customer --}}
    @if ($data->role === 'customer')
        <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Bookings</h5>
            </div>
            <div class="card-body">
                @if ($data->bookings->isNotEmpty())
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Booking Date</th>
                                <th>Service ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                    <td>{{ $booking->service_id }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">No bookings found.</p>
                @endif
            </div>
        </div>
    @endif
</div>
