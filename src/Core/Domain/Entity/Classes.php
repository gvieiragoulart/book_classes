<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Classes
{
    use MagicMethods;
    
    public function __construct(
        public Uuid|string $id = '',
        public string $name = '',
        public string $description = '',
        public DateTime $start_date = new DateTime(),
        public DateTime $end_date = new DateTime(),
        public int $capacity = 0,
        public array $bookings = [],
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::generate();

        $this->validate();
    }

    public function update(?string $name, ?string $description,?DateTime $start_date, ?DateTime $end_date, ?int $capacity): void
    {
        $this->name = $name ?? $this->name;
        $this->description = $description ?? $this->description;
        $this->start_date = $start_date ?? $this->start_date;
        $this->end_date = $end_date ?? $this->end_date;
        $this->capacity = $capacity ?? $this->capacity;

        $this->validate();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description ?? '',
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'capacity' => $this->capacity,
        ];
    }

    private function validate()
    {
        DomainValidation::notNull($this->id, 'Id is required');
        DomainValidation::notNull($this->name, 'Name is required');
        DomainValidation::strMaxLenght($this->name, 100, 'Name should not greater than 100 characters');
        DomainValidation::strMinLenght($this->name, 3, 'Name should not less than 3 characters');
        DomainValidation::strCanNullAndMaxLenght($this->description, 100, 'Description should not greater than 100 characters');
        DomainValidation::dateCantLessThan($this->end_date, $this->start_date, 'End date should not less than start date');
        DomainValidation::dateCantLessThan($this->start_date, new DateTime(), 'Start date should not less than today');
        DomainValidation::dateCantLessThan($this->end_date, new DateTime(), 'End date should not less than today');
        DomainValidation::notNull($this->capacity, 'Capacity is required');
    }
}
