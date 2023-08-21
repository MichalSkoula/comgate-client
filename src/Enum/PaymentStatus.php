<?php
declare(strict_types=1);

namespace Comgate\Enum;

class PaymentStatus
{
    public const PENDING = 'PENDING';
    public const PAID = 'PAID';
    public const CANCELLED = 'CANCELLED';
    public const AUTHORIZED = 'AUTHORIZED';
}