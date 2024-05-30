<?php

namespace App\Enums;

enum TicketStatus: string
{
    case ACTIVE = 'A';
    case COMPLETE = 'C';
    case HOLD = 'H';
    case CANCELLED = 'X';
}