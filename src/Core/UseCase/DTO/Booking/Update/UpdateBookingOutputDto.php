<?php

namespace Core\UseCase\DTO\Booking\Update;

use DateTime;
use Ramsey\Uuid\Uuid;

class UpdateBookingOutputDto
{
    public function __construct(
        public Uuid|string $id,
        public Uuid|string $class_id,
        public string $name,
        public DateTime $date,
    ) {
    }
}
