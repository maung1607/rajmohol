<?php

namespace App\Enum;

enum RoomInfoStatusEnum: string
{
    case PENDING = "Pending";
    case CONFIRMED = "Confirmed";
    case CANCELLED = "Cancelled";
    case COMPLETED = "Completed";
}
