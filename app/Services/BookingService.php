<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Payments;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function createBooking($request)
    {
        DB::beginTransaction(); 

        try {
            // Step 1: Create or retrieve the user
            $user = $this->createUser($request);

            // Step 2: Add the address
            $address = $this->addAddress($user->id, $request);

            // Step 3: Create the reservation
            $uniqueBookingId = $this->generateUniqueBookingId();
            $payment = $this->createPayment($request);
            $reservation = Reservation::create([
                'booking_id' => $uniqueBookingId,
                'payment_id' => $payment->id,
                'customer_id' => $user->id,
                'creator_id' => auth()->id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'day_range' => $request->day_range,
                'special_request' => $request->special_request,
                'status' => $request->status,
            ]);

            DB::commit(); 

            return $reservation; 
        } catch (\Exception $e) {
            DB::rollBack(); 
            throw $e; 
        }
    }

    private function generateUniqueBookingId()
    {
        
        return time();
    }

    public function createUser($request)
    {
        $user = User::where('email', $request->email)
            ->orWhere('phone_number', $request->phone_number)
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
        }

        return $user;
    }

    public function addAddress($customerId, $request)
    {
        $address = Address::create([
            'customer_id' => $customerId,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2 ?? null,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return $address;
    }
    public function createPayment($request)
    {
        $payment = Payments::create([
            'payment_number' => $this->generateUniqueBookingId(),
            'actual_amount' => $request->actual_amount,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->due_amount,
            'discount' => $request->discount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'payment_date' => $request->payment_date,
        ]);
        return $payment;

    }


}