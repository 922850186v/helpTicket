<?php 

namespace App\Enums;

enum TicketStatus : string
{
    case OPEN = 'Open';
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
}