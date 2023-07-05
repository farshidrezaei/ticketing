<?php

namespace App\Enums;

enum TicketStatusEnum: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case ANSWERED = 'answered';
    case CLOSED = 'closed';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
