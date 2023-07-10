<?php

namespace Core\UseCase\DTO\Booking;

class BookingOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $date,
        public string $class_id,
    ){
    }
}