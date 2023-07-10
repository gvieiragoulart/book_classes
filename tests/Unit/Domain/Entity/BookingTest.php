<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Booking;
use Core\Domain\Exception\EntityValidationException;
use DateTime;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class BookingTest extends TestCase
{
    public function testAttributes()
    {
        $booking = new Booking(
            id: Uuid::uuid4(),
            class_id: Uuid::uuid4(),
            name: 'Booking 1',
            date: new DateTime('08/08/2023'),
        );

        $this->assertNotEmpty($booking->id());
        $this->assertEquals('Booking 1', $booking->name);
    }

    public function testUpdate()
    {
        $booking = new Booking(
            id: Uuid::uuid4(),
            class_id: Uuid::uuid4(),
            name: 'Booking 1',
            date: new DateTime('08/08/2023'),
        );

        $booking->update(
            name: 'Booking 2',
            date: new DateTime('08/08/2023'),
        );

        $this->assertEquals('Booking 2', $booking->name);
    }

    public function testToArray()
    {
        $booking = new Booking(
            id: Uuid::uuid4(),
            class_id: Uuid::uuid4(),
            name: 'Booking 1',
            date: new DateTime('08/08/2023'),
        );

        $this->assertNotEmpty($booking->toArray());
    }

    public function testValidation()
    {
        $this->expectException(EntityValidationException::class);

        $booking = new Booking(
            id: Uuid::uuid4(),
            name: 'Booking 1',
            date: new DateTime('08/08/2023'),
        );

        $booking->update(
            name: 'Booking 2',
            date: new DateTime('08/08/2023'),
        );
    }
}