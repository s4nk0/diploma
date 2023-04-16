<?php

namespace App\Enums;

enum PhoneVerificationsStatuses :string{
    case PENDING = 'pending';
    case VERIFIED = 'verified';
    case EXPIRED = 'expired';
}
