<?php

namespace Core\UseCase\DTO\Classes\Update;

class UpdateClassesInputDto
{
    public function __construct(
        public string $id,
        public ?string $name,
        public ?string $description,
        public ?string $start_date,
        public ?string $end_date,
        public ?int $capacity,
    ){
    }
}
