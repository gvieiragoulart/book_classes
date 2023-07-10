<?php

namespace Core\UseCase\Classes;

use Core\Domain\Entity\Classes;
use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\UseCase\DTO\Classes\Create\CreateClassesInputDto;
use Core\UseCase\DTO\Classes\Create\CreateClassesOutputDto;

class CreateClassesUseCase
{
    public function __construct(
        private ClassesRepositoryInterface $classesRepository,
    ) {
    }

    public function execute(CreateClassesInputDto $input): CreateClassesOutputDto
    {
        $classes = new Classes(
            name: $input->name,
            description: $input->description,
            start_date: $input->start_date,
            end_date: $input->end_date,
            capacity: $input->capacity,
        );

        $classes = $this->classesRepository->create($classes);

        return new CreateClassesOutputDto(
            $classes->id,
            $classes->name,
            $classes->description,
            $classes->start_date,
            $classes->end_date,
            $classes->capacity,
        );
    }
}