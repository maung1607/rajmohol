<?php

namespace App\Enum;

enum PaymentMethodEnum: string
{
    case CREDIT_CARD = "Credit Card";
    case CASH = "Cash";
    case ONLINE = "Online";
}
