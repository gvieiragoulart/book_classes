<?php

namespace Core\UseCase\Booking;

use Core\Domain\Entity\Booking;
use Core\Domain\Exception\InvalidDateException;
use Core\Domain\Repository\BookingRepositoryInterface;
use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\UseCase\DTO\Booking\Create\CreateBookingInputDto;
use Core\UseCase\DTO\Booking\Create\CreateBookingOutputDto;
use DateTime;

class CreateBookingUseCase
{
    public function __construct(
        private BookingRepositoryInterface $bookingRepository,
        private ClassesRepositoryInterface $classesRepository,
    ) {
    }

    public function execute(CreateBookingInputDto $input): CreateBookingOutputDto
    {
        $this->verifyIfClassHaveDate($input->class_id, $input->date);

        $booking = new Booking(
            class_id: $input->class_id,
            name: $input->name,
            date: $input->date,
        );

        $booking = $this->bookingRepository->create($booking);

        return new CreateBookingOutputDto(
            id: $booking->id,
            class_id: $booking->class_id,
            name: $booking->name,
            date: $booking->date,
        );
    }
    
    private function verifyIfClassHaveDate(string $classId, DateTime $date): void
    {
        $class = $this->classesRepository->findById($classId);

        if($date->greaterThanOrEqualTo($class->start_date) && $date->lessThanOrEqualTo($class->end_date)) {
            return;
        }

        throw new InvalidDateException('This class does not have this date!');
    }
}