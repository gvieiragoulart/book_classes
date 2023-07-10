<?php

namespace Core\UseCase\Booking;

use Core\Domain\Repository\BookingRepositoryInterface;
use Core\UseCase\DTO\Booking\BookingOutputDto;
use PhpParser\Builder\Class_;

class FindBookingUseCase
{
    public function __construct(
        private BookingRepositoryInterface $bookingRepository,
    ) {
    }

    public function execute(string $id): BookingOutputDto
    {
        $booking = $this->bookingRepository->findById($id);

        return new BookingOutputDto(
            id: $booking->id,
            name: $booking->name,
            date: $booking->date,
            class_id: $booking->class_id,
        );
    }
}