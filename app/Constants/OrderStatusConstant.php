<?php

namespace App\Constants;

class OrderStatusConstant
{
    const DRAFT = 'draft';
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const COMPLETED = 'completed';


    const ALL = [
        self::DRAFT, self::PENDING, self::PROCESSING, self::COMPLETED
    ];
}
