<?php

namespace Core\UseCase\DTO\Classes;

class ClassesOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $start_date,
        public string $end_date,
        public int $capacity,
        public ?array $bookings = [],
    ){
    }
}