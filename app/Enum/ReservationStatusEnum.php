<?php

namespace App\Enum;

enum ReservationStatusEnum: string
{
    case PENDING = "Pending";
    case CONFIRMED = "Confirmed";
    case CANCELLED = "Cancelled";
    case COMPLETED = "Completed";
}
