<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Booking;

interface BookingRepositoryInterface
{
    public function findById(string $id): Booking;
    public function create(Booking $data): Booking;
    public function update(string $id, Booking $data): Booking;
    public function delete(string $id): bool;
}