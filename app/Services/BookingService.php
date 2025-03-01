<?php

namespace App\Services;

use App\Enum\PaymentMethodEnum;
use App\Enum\PaymentStatusEnum;
use App\Enum\RoomInfoStatusEnum;
use App\Models\Address;
use App\Models\AssignRoom;
use App\Models\Payments;
use App\Models\Reservation;
use App\Models\RoomInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookingService
{
    public function clientBooking($request)
    {
        try {
            Log::info($request);
            // Step 1: Create or retrieve the user
            $user = $this->createUser($request);
            Log::info($user);

            // Step 2: Add the address
            $address = $this->addAddress($user->id, $request);
            Log::info($address);

            // Step 3: Generate Unique Booking ID
            $uniqueBookingId = $this->generateUniqueBookingId();

            // Step 4: Convert Dates to MySQL Format
            $checkInDate = Carbon::createFromFormat('m/d/Y h:i A', $request->check_in_date);
            $checkOutDate = Carbon::createFromFormat('m/d/Y h:i A', $request->check_out_date);

            // Step 5: Calculate the number of days (fixing diffInDays)
            $dayRange = $checkInDate->diffInDays($checkOutDate) ?: 1;
            // Step 6: Create the payment
            $payment = $this->createPayment($request);
            // Step 7: Create Reservation
            $reservation = Reservation::create([
                'booking_id' => $uniqueBookingId,
                'customer_id' => $user->id,
                'payment_id' => $payment->id,
                'address_id' => $address->id,
                'creator_id' => $user->id ?? null,
                'check_in_date' => $checkInDate->format('Y-m-d H:i:s'), // Store correctly formatted date
                'check_out_date' => $checkOutDate->format('Y-m-d H:i:s'), // Store correctly formatted date
                'adults' => $request->adults,
                'children' => $request->children,
                'special_request' => $request->special_request ?? '',
                'day_range' => $dayRange,
                'status' => "Pending",

            ]);

            return $reservation;
        } catch (\Exception $e) {
            Log::error('Booking creation failed: ' . $e->getMessage());
            throw $e;
        }
    }
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
                'password' => '',
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
        if ($dueAmount !== 0) {
            $status = PaymentStatusEnum::DUE;
        } elseif ($dueAmount == 0) {
            $status = PaymentStatusEnum::COMPLETED;
        } else {
            $status = PaymentStatusEnum::PENDING;
        }


        return Payments::create([
            'payment_number' => $this->generateUniqueBookingId(),
            'actual_amount' => $request->actual_amount ?? 0,
            'total_amount' => $request->actual_amount ?? 0,
            'paid_amount' => $request->paid_amount ?? 0,
            'due_amount' => $dueAmount ?? 0,
            'discount' => $request->discount ?? 0,
            'payment_method' => $request->payment_method ?? PaymentMethodEnum::ONLINE,
            'status' => $status,
            'payment_date' => $request->payment_date ?? now(),
        ]);
    }

    /********* Update Booking **********/
    public function updateBooking($request)
    {

        try {

            $checkInDate = Carbon::parse($request->check_in_date);
            $checkOutDate = Carbon::parse($request->check_out_date);
            $dayRange = $checkInDate->diffInDays($checkOutDate) ?: 1;

            // Retrieve the reservation object
            $reservation = Reservation::find($request->id);

            if (!$reservation) {
                return back()->withErrors(['error' => 'Reservation not found.']);
            }

            // Update reservation
            $reservation->update([
                'creator_id' => auth()->id(),
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'day_range' => $dayRange,
                'adults' => $request->adults,
                'children' => $request->children,
                'status' => $request->status,
            ]);

            // Update address if it exists
            if ($reservation->address_id) {
                Address::where('id', $reservation->address_id)->update([
                    'nid' => $request->nid ?? '',
                    'address' => $request->address ?? '',
                    'city' => $request->city ?? '',
                    'postal_code' => $request->postal_code,
                ]);
            }

            // Calculate due amount & determine status
            $dueAmount = $request->actual_amount - $request->paid_amount;
            $status = ($dueAmount > 0) ? PaymentStatusEnum::DUE : PaymentStatusEnum::COMPLETED;

            // Update payment if it exists
            if ($reservation->payment_id) {
                Payments::where('id', $reservation->payment_id)->update([
                    'payment_number' => $this->generateUniqueBookingId(),
                    'actual_amount' => $request->actual_amount,
                    'total_amount' => $request->actual_amount,
                    'paid_amount' => $request->paid_amount,
                    'due_amount' => $dueAmount,
                    'discount' => $request->discount ?? 0,
                    'payment_method' => $request->payment_method,
                    'status' => $status,
                ]);
            }

            if ($reservation && $request->assign_rooms) {

                $existingAssignedRooms = AssignRoom::where('reservation_id', $reservation->id)->pluck('room_info_id')->toArray();


                $newAssignedRooms = $request->assign_rooms;
                $roomsToAdd = array_diff($newAssignedRooms, $existingAssignedRooms);
                $roomsToRemove = array_diff($existingAssignedRooms, $newAssignedRooms);


                if (!empty($roomsToRemove)) {
                    AssignRoom::where('reservation_id', $reservation->id)
                        ->whereIn('room_info_id', $roomsToRemove)
                        ->delete();


                    RoomInfo::whereIn('id', $roomsToRemove)->update([
                        'status' => RoomInfoStatusEnum::AVAILABLE,
                    ]);
                }


                foreach ($roomsToAdd as $roomId) {
                    AssignRoom::create([
                        'reservation_id' => $reservation->id,
                        'room_info_id' => $roomId,
                    ]);
                }

                RoomInfo::whereIn('id', $newAssignedRooms)->update([
                    'status' => RoomInfoStatusEnum::OCCOPEID,
                ]);
            }

            return $reservation;
        } catch (\Exception $e) {
            Log::error('Booking creation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
