@extends('layouts.backend.app')
@section('title')
    Booking | Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center border p-3">
                    <h2 class="text-center mb-4">Edit Booking - {{ $reservation->booking_id }}</h2>
                    <a href="{{ route('booking.index') }}" class="btn btn-info">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('success') }}
                            </div>
                    @endif
                    <form action="{{ route('booking.update') }}" method="POST">
                        @csrf

                        <!-- Check-In and Check-Out Dates -->
                        <div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="check_in_date" class="form-label">Check-In Date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="check_in_date" name="check_in_date"
                                        class="form-control @error('check_in_date') is-invalid @enderror"
                                        value="{{ $reservation->check_in_date ?? old('check_in_date') }}" required>
                                    @error('check_in_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_out_date" class="form-label">Check-Out Date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="check_out_date" name="check_out_date"
                                        class="form-control @error('check_out_date') is-invalid @enderror"
                                        value="{{ $reservation->check_out_date ?? old('check_out_date') }}" required>
                                    @error('check_out_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Customer Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $reservation?->customer?->name ?? old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- Customer Details -->
                        <div class="row mb-3">

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $reservation?->customer?->email ?? old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="phone_number" class="form-label">Phone Number<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="phone_number" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ $reservation?->customer?->email ?? old('email') }}" required>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="nid" class="form-label">NID<span class="text-danger">*</span></label>
                                <input type="text" id="nid" name="nid"
                                    class="form-control @error('nid') is-invalid @enderror"
                                    value="{{ $reservation?->address?->nid ?? old('nid') }}" required>
                                @error('nid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="adults" class="form-label">Adults<span class="text-danger">*</span></label>
                                <input type="number" id="adults" name="adults"
                                    class="form-control @error('adults') is-invalid @enderror"
                                    value="{{ $reservation?->adults ?? old('adults') }}" required>
                                @error('adults')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="children" class="form-label">Children<span class="text-danger">*</span></label>
                                <input type="number" id="children" name="children"
                                    class="form-control @error('children') is-invalid @enderror"
                                    value="{{ $reservation?->children ?? old('children') }}" required>
                                @error('children')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                <input type="text" id="city" name="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ $reservation?->address?->city ?? old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <!-- Address -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="postal_code" class="form-label">Postal Code<span
                                        class="text-danger">*</span></label>
                                <input type="number" id="postal_code" name="postal_code"
                                    class="form-control @error('postal_code') is-invalid @enderror"
                                    value="{{ $reservation?->address?->postal_code ?? old('postal_code') }}" required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="address" class="form-label">Address<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="address" name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ $reservation?->address?->address ?? old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-md-4">
                                <label for="actual_amount" class="form-label">Actual Amount<span
                                        class="text-danger">*</span></label>
                                <input type="number" id="actual_amount" name="actual_amount"
                                    class="form-control @error('actual_amount') is-invalid @enderror"
                                    value="{{ $reservation?->payment?->actual_amount ?? old('actual_amount') }}" required>
                                @error('actual_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="paid_amount" class="form-label">Paid Amount<span
                                        class="text-danger">*</span></label>
                                <input type="number" id="paid_amount" name="paid_amount"
                                    class="form-control @error('paid_amount') is-invalid @enderror"
                                    value="{{ $reservation?->payment?->paid_amount ?? old('paid_amount') }}" required>
                                @error('paid_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="payment_method" class="form-label">Payment Method
                                   <span
                                        class="text-danger">*</span></label>
                                <select id="payment_method" name="payment_method"
                                    class="form-control @error('payment_method') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="Credit Card"
                                        {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="Cash"
                                        {{ ($reservation?->payment?->payment_method ?? old('payment_method')) === 'Cash' ? 'selected' : '' }}>
                                        Cash
                                    </option>
                                    <option value="Online"
                                        {{ ($reservation?->payment?->payment_method ?? old('payment_method')) === 'Online' ? 'selected' : '' }}>
                                        Online</option>
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
                                <label for="assign_rooms" class="form-label">Assign Rooms<span
                                        class="text-danger">*</span></label>
                                <select name="assign_rooms[]" class="form-control select2" multiple
                                    placeholder="Select Room Numbers">
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            @if (
                                                (isset($reservation) && in_array($room->id, $reservation?->assign_rooms->pluck('room_info_id')->toArray())) ||
                                                    (old('assign_rooms') && in_array($room->id, (array) old('assign_rooms')))) selected @endif>
                                            {{ $room->room_number }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assign_rooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="status" class="form-label">
                                    Status<span class="text-danger">*</span> 
                                </label>
                                <select id="status" name="status"
                                    class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    <option value="Pending"
                                        {{ ($reservation?->status ?? old('status')) === 'Pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="Confirmed"
                                        {{ ($reservation?->status ?? old('status')) === 'Confirmed' ? 'selected' : '' }}>
                                        Confirmed</option>
                                    <option value="Cancelled"
                                        {{ ($reservation?->status ?? old('status')) === 'Cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
