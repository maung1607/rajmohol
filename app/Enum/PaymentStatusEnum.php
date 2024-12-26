<?php

namespace App\Enum;

enum PaymentStatusEnum: string
{
    case PENDING = "Pending";
    case DUE = "Due";
    case COMPLETED = "Completed";
    case FAILED = "Failed";
}
