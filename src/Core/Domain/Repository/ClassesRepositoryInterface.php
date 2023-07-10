<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Classes;

interface ClassesRepositoryInterface
{
    public function findAll(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function findById(string $id): Classes;
    public function create(Classes $data): Classes;
    public function update(string $id, Classes $data): Classes;
    public function delete(string $id): bool;
}