<?php

namespace Core\UseCase\Classes;

use Core\Domain\Repository\ClassesRepositoryInterface;

class DeleteClassesUseCase
{
    protected ClassesRepositoryInterface $repository;

    public function __construct(ClassesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
