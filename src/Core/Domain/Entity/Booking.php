<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Booking
{
    use MagicMethods;
    
    public function __construct(
        public Uuid|string $id = '',
        public Uuid|string $class_id = '',
        public string $name = '',
        public DateTime $date = new DateTime(),

    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::generate();

        $this->validate();
    }

    public function update(?string $name, ?DateTime $date): void
    {
        $this->name = $name ?? $this->name;
        $this->date = $date ?? $this->date;

        $this->validate();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'class_id' => $this->class_id,
            'name' => $this->name,
            'date' => $this->date,
        ];
    }

    private function validate()
    {
        DomainValidation::notNull($this->id, 'id is required');
        DomainValidation::notNull($this->class_id, 'class_id is required');
        DomainValidation::notNull($this->name, 'Name is required');
        DomainValidation::strMaxLenght($this->name, 100, 'Name should not greater than 100 characters');
        DomainValidation::strMinLenght($this->name, 3, 'Name should not less than 3 characters');
        DomainValidation::dateCantLessThan($this->date, new DateTime(), 'Start date should not less than today');
    }
}
