<?php

namespace Core\UseCase\Classes;

use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\UseCase\DTO\Classes\ClassesOutputDto;
use Core\UseCase\DTO\Classes\FindAll\FindAllClassesOutputDto;

class FindClassUseCase
{
    public function __construct(
        private ClassesRepositoryInterface $classesRepository,
    ) {
    }

    public function execute(string $id): ClassesOutputDto
    {
        $class = $this->classesRepository->findById($id);

        return new ClassesOutputDto(
            id: $class->id,
            name: $class->name,
            description: $class->description,
            start_date: $class->start_date,
            end_date: $class->end_date,
            capacity: $class->capacity,
            bookings: $class->bookings,
        );
    }
}