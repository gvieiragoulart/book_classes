<?php

namespace Core\UseCase\DTO\Booking\Update;

use DateTime;
use Ramsey\Uuid\Uuid;

class UpdateBookingInputDto
{
    public function __construct(
        public Uuid|string $id,
        public string $name,
        public ?DateTime $date,
    ) {
    }
}
