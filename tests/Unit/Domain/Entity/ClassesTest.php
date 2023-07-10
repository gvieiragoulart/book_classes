<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Classes;
use Core\Domain\Exception\EntityValidationException;
use DateTime;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ClassesTest extends TestCase
{
    public function testAttributes()
    {
        $classes = new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 10,
        );

        $this->assertNotEmpty($classes->id());
        $this->assertEquals('Class 1', $classes->name);
        $this->assertEquals('Description 1', $classes->description);
        $this->assertEquals(10, $classes->capacity);
    }

    public function testUpdate()
    {
        $classes = new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 10,
        );

        $classes->update(
            name: 'Class 2',
            description: 'Description 2',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 20,
        );

        $this->assertEquals('Class 2', $classes->name);
        $this->assertEquals('Description 2', $classes->description);
        $this->assertEquals(20, $classes->capacity);
    }

    public function testToArray()
    {
        $classes = new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 10,
        );

        $this->assertIsArray($classes->toArray());
    }

    public function testValidate()
    {
        $this->expectException(EntityValidationException::class);

        new Classes(
            id: Uuid::uuid4(),
            name: '',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 10,
        );
    }

    public function testValidateDateLessThanToday()
    {
        $this->expectException(EntityValidationException::class);

        new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2020'),
            end_date: new DateTime('08/12/2023'),
            capacity: 10,
        );
    }

    public function testValidateDateLessThanStartDate()
    {
        $this->expectException(EntityValidationException::class);

        new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2020'),
            capacity: 10,
        );
    }

    public function testValidateCapacityLessThanOne()
    {
        $this->expectException(EntityValidationException::class);

        new Classes(
            id: Uuid::uuid4(),
            name: 'Class 1',
            description: 'Description 1',
            start_date: new DateTime('08/08/2023'),
            end_date: new DateTime('08/12/2023'),
            capacity: 0,
        );
    }
}