<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Booking;

interface BookingRepositoryInterface
{
    public function paginate(string $userId, string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function findAll(string $filter = '', string $order = 'DESC'): array;
    public function findById(string $id): Booking;
    public function create(Booking $data): Booking;
    public function update(string $id, Booking $data): Booking;
    public function delete(string $id): bool;
}