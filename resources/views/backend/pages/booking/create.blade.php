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
                        <div class="col-md-4">
                            <label for="check_in_date" class="form-label">Check-In Date*</label>
                            <input type="date" id="check_in_date" name="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror" value="{{ old('check_in_date') }}" required>
                            @error('check_in_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="check_out_date" class="form-label">Check-Out Date*</label>
                            <input type="date" id="check_out_date" name="check_out_date" class="form-control @error('check_out_date') is-invalid @enderror" value="{{ old('check_out_date') }}" required>
                            @error('check_out_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Customer Name*</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Customer Details -->
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label for="email" class="form-label">Email Address*</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="phone_number" class="form-label">Phone Number*</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="adults" class="form-label">Adults*</label>
                            <input type="text" id="adults" name="adults" class="form-control @error('adults') is-invalid @enderror" value="{{ old('address_line_1') }}" required>
                            @error('adults')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="children" class="form-label">Children*</label>
                            <input type="text" id="children" name="adults" class="form-control @error('children') is-invalid @enderror" value="{{ old('children') }}" required>
                            @error('children')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">City*</label>
                            <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State*</label>
                            <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" required>
                            @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <!-- Address -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="postal_code" class="form-label">Postal Code*</label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" required>
                            @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <label for="actual_amount" class="form-label">Actual Amount*</label>
                            <input type="number" id="actual_amount" name="actual_amount" class="form-control @error('actual_amount') is-invalid @enderror" value="{{ old('actual_amount') }}" required>
                            @error('actual_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="paid_amount" class="form-label">Paid Amount*</label>
                            <input type="number" id="paid_amount" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" value="{{ old('paid_amount') }}" required>
                            @error('paid_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="payment_method" class="form-label">Payment Method*</label>
                            <select id="payment_method" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                <option value="">Select</option>
                                <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Online" {{ old('payment_method') == 'Online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Payment Details -->
                    <div class="row mb-3">

                        {{--
                        <div class="col-md-4">
                            <label for="special_request" class="form-label">Special Request</label>
                            <textarea id="special_request" name="special_request" class="form-control @error('special_request') is-invalid @enderror">{{ old('special_request') }}</textarea>
                        @error('special_request')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-4">
                        <label for="assign_rooms" class="form-label">Assign Rooms*</label>
                        <select name="assign_rooms" class="form-control select2" multiple="">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                            <option>Option 6</option>
                        </select>
                        @error('assign_rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="status" class="form-label">Status*</label>
                        <select id="status" name="status" class="form-control  @error('status') is-invalid @enderror" required>
                            <option value="">Select</option>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Booking</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
