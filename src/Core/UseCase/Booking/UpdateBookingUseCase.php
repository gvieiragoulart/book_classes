<?php

namespace Core\UseCase\Booking;

use Core\Domain\Repository\BookingRepositoryInterface;
use Core\UseCase\DTO\Booking\Update\UpdateBookingInputDto;
use Core\UseCase\DTO\Booking\Update\UpdateBookingOutputDto;

class UpdateBookingUseCase
{
    protected BookingRepositoryInterface $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateBookingInputDto $input): UpdateBookingOutputDto
    {
        $booking = $this->repository->findById($input->id);

        $booking->update(
            name: $input->name,
            date: $input->date,
        );

        $booking = $this->repository->update($input->id,$booking);

        return new UpdateBookingOutputDto(
            id: $booking->id(),
            class_id: $booking->class_id,
            name: $booking->name,
            date: $booking->date,
        );
    }
}
