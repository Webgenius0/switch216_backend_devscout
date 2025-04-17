<section>
    <h2 class="section-title">Top Cars in our city</h2>
    {{-- <p class="se--common--pera2 se--bottom">Looking for service? <a class="se--link" href="#">click here</a></p> --}}
    <div class="filters-container mt-2">
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Car Type</label> --}}
                <input class="form-control" wire:model.live.debounce.250ms="location" placeholder="Location"
                    type="text" />
            </div>
        </div>
        <!-- Property Type -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Property Type</label> --}}
                <select class="form-select" name="property_type" wire:model.change="property_type">
                    <option value="" selected>Property Type</option>
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Land">Land</option>
                    <option value="Commercial">Commercial
                    </option>
                </select>
            </div>
        </div>
        <!-- Number of Bedrooms -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Number of Bedrooms</label> --}}
                <select class="form-select" name="bedrooms" wire:model.change="bedrooms">
                    <option value="" selected>Number of Bedrooms</option>
                    <option value="1">1 Bedroom</option>
                    <option value="2">2 Bedrooms</option>
                    <option value="3">3+ Bedrooms</option>
                </select>
            </div>
        </div>

        <!-- Number of Bathrooms -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Number of Bathrooms</label> --}}
                <select class="form-select" name="bathrooms" wire:model.change="bathrooms">
                    <option value="" selected>Number of Bathrooms</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                </select>
            </div>
        </div>

        <!-- Furnished? -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Furnished?</label> --}}
                <select class="form-select" name="is_furnished" wire:model.change="is_furnished">
                    <option value="" selected>Furnished?</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <!-- Price Range -->
        <div class="col-md-2">
            <div class="form-group mb-4">
                {{-- <label class="label text-secondary">Price</label> --}}
                <select class="form-select @error('price') is-invalid @enderror" name="price" id="price"
                    wire:model.change="price_range">
                    <option value="" selected>Select Price Range</option>
                    <option value="0 - 10,000">0 - 10,000</option>
                    <option value="10,000 - 50,000">10,000 - 50,000</option>
                    <option value="50,000 - 100,000">50,000 - 100,000</option>
                    <option value="100,000+">100,000+</option>
                </select>
            </div>
        </div>

        <!-- Subcategory Dropdown -->
        <fieldset class="filter-input-wrapper">
            <select wire:change="subcategory" class="form-control" hidden>
                <option value="">Subcategory</option>
                {{-- @foreach ($subcategories as $subCategoryItem)
                <option value="{{ $subCategoryItem->id }}">{{ $subCategoryItem->name }}</option>
            @endforeach --}}
            </select>
        </fieldset>



        <fieldset class="filter-input-wrapper">
            <div class="toggle-container">
                <input type="checkbox" id="emergency-toggle" class="toggle-checkbox" wire:model="serching_is_emergency"
                    wire:click="$toggle('serching_is_emergency')" />
                <label for="emergency-toggle" class="toggle"></label>
                <label for="emergency-toggle" class="toggle-label">Available Emergency Service</label>
            </div>
        </fieldset>
    </div>

    <div class="service-providers mt-4 mt-md-5" data-aos="fade-down">
        <!-- here will sow all services  -->
        @forelse($services as $key => $service)
            <div data-href="{{ route('service.single_show', $service->id) }}" class="item item-link">
                <div class="img-container">
                    <img src="{{ asset($service->cover_image ?? '') }}" alt="" />
                </div>
                <div class="text-content">
                    <div class="heading">
                        <div>
                            <h4 class="section-card-title">{{ $service->title ?? ' ' }}</h4>
                            <div class="location">
                                <div style="width: 30px;"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="22" viewBox="0 0 16 22" fill="none">
                                        <path
                                            d="M10.5 8C10.5 9.38071 9.38071 10.5 8 10.5C6.61929 10.5 5.5 9.38071 5.5 8C5.5 6.61929 6.61929 5.5 8 5.5C9.38071 5.5 10.5 6.61929 10.5 8Z"
                                            stroke="#757575" stroke-width="1.5" />
                                        <path
                                            d="M9.2574 16.4936C8.92012 16.8184 8.46932 17 8.00015 17C7.53099 17 7.08018 16.8184 6.7429 16.4936C3.6543 13.5008 -0.48481 10.1575 1.53371 5.30373C2.6251 2.67932 5.24494 1 8.00015 1C10.7554 1 13.3752 2.67933 14.4666 5.30373C16.4826 10.1514 12.3536 13.5111 9.2574 16.4936Z"
                                            stroke="#757575" stroke-width="1.5" />
                                        <path d="M14 19C14 20.1046 11.3137 21 8 21C4.68629 21 2 20.1046 2 19"
                                            stroke="#757575" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span>{{ $service->user->userAddresses()->first()->location ?? ' ' }}</span>
                            </div>
                        </div>
                        <div class="rating">
                            <span>{{ $service->user->contactorStatistics()->first()?->rank ?? 'Silver' }}</span>
                            {{-- Star Rating --}}
                            {{-- @for ($i = 0; $i < floor($service->user->getContactorProfileCounter()['contactor_average_rating']); $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.2795 2.41205C7.35287 2.28615 7.45796 2.1817 7.58429 2.1091C7.71063 2.0365 7.85379 1.99829 7.9995 1.99829C8.14521 1.99829 8.28838 2.0365 8.41471 2.1091C8.54105 2.1817 8.64614 2.28615 8.7195 2.41205L10.5828 5.61071L14.2015 6.39471C14.3438 6.42565 14.4756 6.49335 14.5836 6.59107C14.6916 6.68879 14.7721 6.81312 14.8171 6.95166C14.8621 7.09021 14.87 7.23812 14.84 7.38066C14.81 7.5232 14.7432 7.65539 14.6462 7.76405L12.1795 10.5247L12.5528 14.208C12.5676 14.3531 12.544 14.4994 12.4845 14.6325C12.4249 14.7656 12.3315 14.8807 12.2136 14.9664C12.0956 15.0521 11.9573 15.1054 11.8123 15.1209C11.6674 15.1363 11.5209 15.1135 11.3875 15.0547L7.9995 13.5614L4.6115 15.0547C4.47811 15.1135 4.33163 15.1363 4.18667 15.1209C4.04171 15.1054 3.90336 15.0521 3.78542 14.9664C3.66748 14.8807 3.57408 14.7656 3.51455 14.6325C3.45502 14.4994 3.43144 14.3531 3.44617 14.208L3.8195 10.5247L1.35284 7.76471C1.25565 7.65606 1.18867 7.52382 1.15858 7.38119C1.12848 7.23856 1.13633 7.09053 1.18133 6.95188C1.22633 6.81323 1.30692 6.68882 1.41504 6.59105C1.52316 6.49328 1.65504 6.42558 1.7975 6.39471L5.41617 5.61071L7.2795 2.41205Z"
                                        fill="#FFC700" />
                                </svg>
                            @endfor --}}
                            <span>({{ number_format($service->user->contactorStatistics()->first()?->last_60_days_average_rating ?? '0', 1) }})</span>
                        </div>
                    </div>
                    <p class="section-card-text mt-2 mb-2">
                        {{ $service->description ?? ' ' }}
                    </p>
                    <a class="action mt-4" href="{{ route('service.single_show', $service->id) }}">
                        <span>View Profile</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13"
                            fill="none">
                            <path
                                d="M16.5303 7.03033C16.8232 6.73744 16.8232 6.26256 16.5303 5.96967L11.7574 1.1967C11.4645 0.903806 10.9896 0.903806 10.6967 1.1967C10.4038 1.48959 10.4038 1.96447 10.6967 2.25736L14.9393 6.5L10.6967 10.7426C10.4038 11.0355 10.4038 11.5104 10.6967 11.8033C10.9896 12.0962 11.4645 12.0962 11.7574 11.8033L16.5303 7.03033ZM0 7.25H16V5.75H0L0 7.25Z"
                                fill="#FF6600" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty

            <span class="d-flex justify-content-center align-items-center vh-100">
                <h1 class="text-center">Service Not Found.</h1>
            </span>
        @endforelse

    </div>
    {{ $services->links() }}
</section>
