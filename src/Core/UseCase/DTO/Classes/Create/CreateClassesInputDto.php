<?php

namespace Core\UseCase\DTO\Classes\Create;

use DateTime;

class CreateClassesInputDto
{
    public function __construct(
        public string $name,
        public string $description,
        public DateTime $start_date,
        public DateTime $end_date,
        public int $capacity,
    ) {
    }
}
