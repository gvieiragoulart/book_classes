<?php

namespace Core\UseCase\Classes;

use Core\Domain\Entity\Classes;
use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\UseCase\DTO\Classes\FindAll\FindAllClassesInputDto;
use Core\UseCase\DTO\Classes\FindAll\FindAllClassesOutputDto;

class FindAllClassesUseCase
{
    public function __construct(
        private ClassesRepositoryInterface $classesRepository,
    ) {
    }

    public function execute(FindAllClassesInputDto $input): FindAllClassesOutputDto
    {
        $classes = $this->classesRepository->findAll(
            filter: $input->filter,
            order: $input->order
        );

        return new FindAllClassesOutputDto(
            items: $classes->items(),
            total: $classes->total(),
            next_page_url: $classes->nextPageUrl(),
            current_page: $classes->currentPage(),
            last_page: $classes->lastPage(),
            first_page: $classes->firstPage(),
            per_page: $classes->perPage(),
            to: $classes->to(),
            from: $classes->from(),
        );
    }
}