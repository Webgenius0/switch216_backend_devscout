@extends('frontend.dashboard.contractor.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.contractor.partials.header')
@endsection
@push('styles')
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-main-content p-5">

        <!-- Subscription Details Section -->
        <div class="section-title mt-5 text-2xl font-semibold text-gray-800 mb-4">Subscription Details</div>
        @php
            $remainingDays = Auth::user()->getUserSubscriptionRemainingDays();
        @endphp

        @if ($remainingDays > 0)
            <p class="text-green-600">Your remaining subscription days: {{intval( $remainingDays) }} day(s)</p>
        @else
            <p class="text-red-600">You have no active subscription or it has expired.</p>
        @endif

        <div class="">
            @forelse ($subcriptions as $subcription)
                <!-- Subscription Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="w-full bg-white border border-gray-300 shadow-lg rounded-lg">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Details</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">Subscription Package Name:</td>
                                <td class="py-3 px-6">{{ $subcription->package->title ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">Amount Paid:</td>
                                <td class="py-3 px-6">${{ $subcription->amount_paid ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">Payment Status:</td>
                                <td class="py-3 px-6 capitalize">{{ $subcription->payment_status ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">Start Date:</td>
                                <td class="py-3 px-6">
                                    {{ \Carbon\Carbon::parse($subcription->start_date)->format('F j, Y') }}</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">End Date:</td>
                                <td class="py-3 px-6">{{ \Carbon\Carbon::parse($subcription->end_date)->format('F j, Y') }}
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100 bg-warning">
                                <td class="py-3 px-6 font-medium">Remaining Days:</td>
                                <td class="py-3 px-6">{{ intval($subcription->getRemainingDays()) }} day(s)</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 font-medium">Package Description:</td>
                                <td class="py-3 px-6 text-sm">{!! $subcription->package->description !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="text-center text-gray-500 mt-4">No subscriptions found.</p>
            @endforelse


        </div>
        <!-- dashboard appointments end -->

    </div>
    <!-- dashboard content end -->
@endsection




@push('scripts')
@endpush
