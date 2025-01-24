<?php

namespace App\Services;

use App\Models\Payments;

class PaymentService{

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
    private function generateUniqueBookingId()
    {
        
        return time();
    }
}
