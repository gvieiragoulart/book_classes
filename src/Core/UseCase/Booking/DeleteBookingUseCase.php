<?php

namespace Core\UseCase\Booking;

use Core\Domain\Repository\BookingRepositoryInterface;

class DeleteBookingUseCase
{
    protected BookingRepositoryInterface $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
