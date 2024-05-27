<?php 

namespace App\Enums;


enum TicketStatus {
    const OPEN = 'open';
    const RESOLVED = 'resolved';
    const REJECTED = 'rejected';
}