@extends('layouts.backend.app')

@section('title', 'Booking | Details')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Booking ID: #{{ $reservation->booking_id }}</div>
                        </div>
                        <hr>

                        <!-- Customer & Payment Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    {{ $reservation->customer->name ?? 'N/A' }}<br>
                                    {{ $reservation->customer->email ?? 'N/A' }}<br>
                                    {{ $reservation->customer->phone_number ?? 'N/A' }}<br>
                                    {{ $reservation->address->city ?? 'N/A' }} - {{ $reservation->address->postal_code ?? '' }}, 
                                    {{ $reservation->address->address ?? 'N/A' }}
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{ $reservation->payment->payment_method ?? 'N/A' }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h2>Booking Summary</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="section-title">Booking Info</h4>
                                <ul class="list-unstyled">
                                    <li><strong>Check-in Date:</strong> {{ $reservation->check_in_date ?? 'N/A' }}</li>
                                    <li><strong>Check-out Date:</strong> {{ $reservation->check_out_date ?? 'N/A' }}</li>
                                    <li><strong>Adults:</strong> {{ $reservation->adults ?? 0 }}</li>
                                    <li><strong>Children:</strong> {{ $reservation->children ?? 0 }}</li>
                                    <li><strong>Day Range:</strong> {{ $reservation->day_range ?? 'N/A' }}</li>
                                    <li><strong>Status:</strong> {{ $reservation->status ?? 'N/A' }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <h4 class="section-title">Payment Info</h4>
                                <ul class="list-unstyled ">
                                    <li><strong>Total Amount:</strong> {{ number_format($reservation->payment->total_amount ?? 0, 2) }} Tk</li>
                                    <li><strong>Actual Amount:</strong> {{ number_format($reservation->payment->actual_amount ?? 0, 2) }} Tk</li>
                                    <li><strong>Paid Amount:</strong> {{ number_format($reservation->payment->paid_amount ?? 0, 2) }} Tk</li>
                                    <li><strong>Due Amount:</strong> {{ number_format($reservation->payment->due_amount ?? 0, 2) }} Tk</li>
                                    <li><strong>Payment Status:</strong> {{ $reservation->payment->status ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Assigned Rooms Table -->
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Room Type</th>
                                        <th>Class</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reservation->assign_rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_info->room_number ?? 'N/A' }}</td>
                                        <td>{{ $room->room_info->room_type ?? 'N/A' }}</td>
                                        <td>{{ $room->room_info->room_class->name ?? 'N/A' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No assigned rooms</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Invoice Total -->
                        <div class="row mt-4">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                        {{ number_format($reservation->payment->total_amount ?? 0, 2) }} Tk
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-md-right">
                            <div class="float-lg-left mb-lg-0 mb-3">
                              <a href="{{ route('booking.index') }}" class="btn btn-secondary btn-icon icon-left">Back</a>
                            </div>
                            <a href="{{ route('booking.pdf',['booking_id'=>$reservation->booking_id]) }}" target="_blank" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</a>
                          </div>

                    </div>
                </div> 
            </div>
        </div>
    </div> 
</div>
@endsection
