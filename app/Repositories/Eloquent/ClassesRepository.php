<?php

namespace App\Repositories\Eloquent;

use App\Models\Classes as ModelsClasses;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\Classes;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\ClassesRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class ClassesRepository implements ClassesRepositoryInterface
{
    private $model;

    public function __construct(ModelsClasses $model)
    {
        $this->model = $model;
    }

    public function create(Classes $classes): Classes
    {
        $classes = $this->model->create(
            $classes->toArray()
        );

        return $this->mapModelToEntity($classes);
    }

    public function update(string $id, Classes $data): Classes
    {
        if (! $classes = $this->model->find($data->id)) {
            throw new NotFoundException();
        }

        $classes->update(
            $data->toArray()
        );

        $classes->save();

        return $this->mapModelToEntity($classes);
    }

    public function delete(string $id): bool
    {
        if (! $classes = $this->model->find($id)) {
            throw new NotFoundException();
        }

        return $classes->delete();
    }

    public function findById(string $id): Classes
    {
        if (! $class = $this->model->find($id)) {
            throw new NotFoundException();
        }

        return $this->mapModelToEntity($class);
    }

    public function findAll(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model->orderBy('created_at', $order);
        if ($filter) {
            $query->where(function ($query) use ($filter) {
                $query->orWhere('name', 'like', '%'.$filter.'%');
                $query->orWhere('description', 'like', '%'.$filter.'%');
                $query->orWhere('start_date', 'like', '%'.$filter.'%');
                $query->orWhere('end_date', 'like', '%'.$filter.'%');
                $query->orWhere('capacity', 'like', '%'.$filter.'%');
            });
        }

        $pagination =  $query->with('bookings')->paginate(
            perPage: $totalPage,
            page: $page
        );

        return new PaginationPresenter($pagination);
    }

    private function mapModelToEntity(ModelsClasses $model): Classes
    {
        return new Classes(
            id: $model->id,
            name: $model->name,
            description: $model->description,
            start_date: $model->start_date,
            end_date: $model->end_date,
            capacity: $model->capacity,
            bookings: $model->bookings()->get()->toArray() ?? []
        );
    }
}
