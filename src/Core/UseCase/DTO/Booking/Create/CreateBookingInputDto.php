<?php

namespace Core\UseCase\DTO\Booking\Create;

use DateTime;
use Ramsey\Uuid\Uuid;

class CreateBookingInputDto
{
    public function __construct(
        public Uuid|string $class_id,
        public string $name,
        public DateTime $date,
    ) {
    }
}
