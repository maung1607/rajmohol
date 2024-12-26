<?php

namespace App\Enum;

enum PublishStatus: int
{
    case PUBLISH = 1;
    case UNPUBLISH = 0;
}
