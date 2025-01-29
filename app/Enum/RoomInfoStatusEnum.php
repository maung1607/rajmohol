<?php

namespace App\Enum;

enum RoomInfoStatusEnum: string
{
    case AVAILABLE = "Available";
    case OCCOPEID = "Occopeid";
    case MAINTENANCE = "Maintenance";
}
