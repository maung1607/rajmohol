@extends('layouts.backend.app')
@section('title')
Booking | Create
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="d-flex justify-content-between align-items-center border p-3">
                <h2 class="text-center mb-4">Create a Booking</h2>
                <a href="{{ route('booking.index') }}" class="btn btn-info">Back</a>
            </div>
           <div class="card-body">
            
            
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <!-- Check-In and Check-Out Dates -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="check_in_date" class="form-label">Check-In Date</label>
                        <input type="date" id="check_in_date" name="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror" value="{{ old('check_in_date') }}" required>
                        @error('check_in_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="check_out_date" class="form-label">Check-Out Date</label>
                        <input type="date" id="check_out_date" name="check_out_date" class="form-control @error('check_out_date') is-invalid @enderror" value="{{ old('check_out_date') }}" required>
                        @error('check_out_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Customer Details -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Customer Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address_line_1" class="form-label">Address Line 1</label>
                        <input type="text" id="address_line_1" name="address_line_1" class="form-control @error('address_line_1') is-invalid @enderror" value="{{ old('address_line_1') }}" required>
                        @error('address_line_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address_line_2" class="form-label">Address Line 2</label>
                        <input type="text" id="address_line_2" name="address_line_2" class="form-control @error('address_line_2') is-invalid @enderror" value="{{ old('address_line_2') }}">
                        @error('address_line_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" required>
                        @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" required>
                        @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="actual_amount" class="form-label">Actual Amount</label>
                        <input type="number" id="actual_amount" name="actual_amount" class="form-control @error('actual_amount') is-invalid @enderror" value="{{ old('actual_amount') }}" required>
                        @error('actual_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="paid_amount" class="form-label">Paid Amount</label>
                        <input type="number" id="paid_amount" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" value="{{ old('paid_amount') }}" required>
                        @error('paid_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                            <option value="">Select</option>
                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                        @error('payment_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Special Request and Status -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="special_request" class="form-label">Special Request</label>
                        <textarea id="special_request" name="special_request" class="form-control @error('special_request') is-invalid @enderror">{{ old('special_request') }}</textarea>
                        @error('special_request')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control  @error('status') is-invalid @enderror" required>
                            <option value="">Select</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                </div>
            </form>
           </div>
        </div>
    </div>
</div>

@endsection
