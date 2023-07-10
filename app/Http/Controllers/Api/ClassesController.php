<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Http\Resources\ClassesResource;
use Carbon\Carbon;
use Core\UseCase\Classes\CreateClassesUseCase;
use Core\UseCase\Classes\DeleteClassesUseCase;
use Core\UseCase\Classes\FindAllClassesUseCase;
use Core\UseCase\Classes\FindClassUseCase;
use Core\UseCase\Classes\UpdateClassesUseCase;
use Core\UseCase\DTO\Classes\Create\CreateClassesInputDto;
use Core\UseCase\DTO\Classes\FindAll\FindAllClassesInputDto;
use Core\UseCase\DTO\Classes\Update\UpdateClassesInputDto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassesController extends Controller
{
    public function index(FindAllClassesUseCase $useCase)
    { 
        $classes = $useCase->execute(
            input: new FindAllClassesInputDto(
                filter: request()->query('filter', ''),
                order: request()->query('order', 'DESC'),
                page: request()->query('page', 1),
                totalPage: request()->query('totalPage', 15),
            )
        );

        return $this->sendPaginatedData(
            message: 'Classes retrieved successfully!',
            total: $classes->total,
            nextPage: $classes->next_page_url,
            data: ClassesResource::collection($classes->items)
        );
    }

    public function store(CreateClassesRequest $request, CreateClassesUseCase $useCase)
    {
        $classes = $useCase->execute(
            input: new CreateClassesInputDto(
                name: $request->name,
                description: $request->description,
                start_date: Carbon::createFromFormat('d/m/Y', $request->start_date),
                end_date: Carbon::createFromFormat('d/m/Y', $request->end_date),
                capacity: $request->capacity,
            )
        );

        return $this->sendDataWithMessage(
            message: 'Classes created successfully!',
            data: ClassesResource::make($classes),
            statusCode: Response::HTTP_CREATED
        );
    }

    public function show(string $id, FindClassUseCase $useCase)
    {
        $class = $useCase->execute($id);

        return $this->sendDataWithMessage(
            message: 'Class retrieved successfully!',
            data: ClassesResource::make($class),
            statusCode: Response::HTTP_OK
        );
    }

    public function update(string $id, UpdateClassesRequest $request, UpdateClassesUseCase $useCase)
    {
        $classes = $useCase->execute(
            input: new UpdateClassesInputDto(
                id: $id,
                name: $request->name,
                description: $request->description,
                start_date: !empty($request->start_date) ? Carbon::createFromFormat('d/m/Y', $request->start_date) : null,
                end_date: !empty($request->end_date) ? Carbon::createFromFormat('d/m/Y', $request->end_date) : null,
                capacity: $request->capacity,
            )
        );

        return $this->sendDataWithMessage(
            message: 'Classes updated successfully!',
            data: ClassesResource::make($classes),
            statusCode: Response::HTTP_OK
        );
    }

    public function destroy(string $id, DeleteClassesUseCase $useCase)
    {
        $useCase->execute($id);

        return $this->sendMessage(
            message: 'Classes deleted successfully!',
            statusCode: Response::HTTP_OK
        );
    }
}
