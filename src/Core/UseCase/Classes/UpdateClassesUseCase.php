<?php

namespace Core\UseCase\Classes;

use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\UseCase\DTO\Classes\Update\UpdateClassesInputDto;
use Core\UseCase\DTO\Classes\Update\UpdateClassesOutputDto;

class UpdateClassesUseCase
{
    protected ClassesRepositoryInterface $repository;

    public function __construct(ClassesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateClassesInputDto $input): UpdateClassesOutputDto
    {
        $class = $this->repository->findById($input->id);

        $class->update(
            name: $input->name,
            description: $input->description,
            start_date: $input->start_date,
            end_date: $input->end_date,
            capacity: $input->capacity,
        );

        $class = $this->repository->update($input->id,$class);

        return new UpdateClassesOutputDto(
            id: $class->id(),
            name: $class->name,
            description: $class->description,
            start_date: $class->start_date,
            end_date: $class->end_date,
            capacity: $class->capacity,
            bookings: $class->bookings,
        );
    }
}
