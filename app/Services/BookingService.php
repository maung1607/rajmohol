<?php

namespace App\Services;

use App\Enum\PaymentStatusEnum;
use App\Models\Address;
use App\Models\Payments;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingService
{
    public function createBooking($request)
    {

        try {
            Log::info($request);
            // Step 1: Create or retrieve the user
            $user = $this->createUser($request);
            Log::info($user);

            // Step 2: Add the address
            $address = $this->addAddress($user->id, $request);
            Log::info($address);
            // Step 3: Create the payment
            $payment = $this->createPayment($request);
            Log::info($payment);
            // Step 4: Generate a unique booking ID
            $uniqueBookingId = $this->generateUniqueBookingId();

            // Step 5: Create the reservation

            $checkInDate = Carbon::parse($request->check_in_date);
            $checkOutDate = Carbon::parse($request->check_out_date);
            $dayRange = $checkInDate->diffInDays($checkOutDate) ?: 1;
            $reservation = Reservation::create([
                'booking_id' => $uniqueBookingId,
                'payment_id' => $payment->id,
                'customer_id' => $user->id,
                'address_id' => $address->id,
                'creator_id' => auth()->id(),
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'day_range' => $dayRange,
                'adults' => $request->adults,
                'children' => $request->children,
                'special_request' => $request->special_request ?? '',
                'status' => $request->status,
            ]);


      

            return $reservation; 
        } catch (\Exception $e) {
            Log::error('Booking creation failed: ' . $e->getMessage());
            throw $e; 
        }
    }

    private function generateUniqueBookingId()
    {
        do {
            $bookingId = random_int(1000000, 9999999); 
        } while ($this->bookingIdExists($bookingId)); 
    
        return $bookingId;
    }
    
    private function bookingIdExists($bookingId)
    {
        return Reservation::where('booking_id', $bookingId)->exists();
    }
    
    public function createUser($request)
    {
        // Retrieve or create a new user
        return User::firstOrCreate(
            [
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password'=> '',
            ],
            [
                'name' => $request->name,
            ]
        );
    }

    public function addAddress($customerId, $request)
    {
        // Create a new address for the customer
        return Address::create([
            'customer_id' => $customerId,
            'nid' => $request->nid ?? '',
            'address' => $request->address ?? '',
            'city' => $request->city ?? '',
            'postal_code' => $request->postal_code,
        ]);
    }

    public function createPayment($request)
    {
        // Create a payment record
        $dueAmount = $request->actual_amount - $request->paid_amount;
        $status = PaymentStatusEnum::PENDING;
        if($dueAmount !==0)
        {
            $status = PaymentStatusEnum::DUE;
        }
        else {
            $status = PaymentStatusEnum::PENDING;
        }
        return Payments::create([
            'payment_number' => $this->generateUniqueBookingId(),
            'actual_amount' => $request->actual_amount,
            'total_amount' => $request->actual_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->actual_amount - $request->paid_amount,
            'discount' => $request->discount ?? 0,
            'payment_method' => $request->payment_method,
            'status' => $status,
            'payment_date' => $request->payment_date ?? now(),
        ]);
    }




    
}
