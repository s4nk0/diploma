<?php

namespace App\Enums;

enum StatusEnum :string
{
    case STATUS_MODERATION_ACCEPTED_TITLE = 'Принято';
    case STATUS_MODERATION_ACCEPTED_ID = '1';
    case STATUS_MODERATION_PROCESSING_TITLE = 'В обработке';
    case STATUS_MODERATION_PROCESSING_ID = '2';
    case STATUS_MODERATION_NOT_ACCEPTED_TITLE = 'Не принято';
    case STATUS_MODERATION_NOT_ACCEPTED_ID = '3';
}
