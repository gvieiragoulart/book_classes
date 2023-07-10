<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking as ModelsBooking;
use App\Models\Classes;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\Booking;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\BookingRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class BookingRepository implements BookingRepositoryInterface
{
    private $model;

    public function __construct(ModelsBooking $model)
    {
        $this->model = $model;
    }

    public function create(Booking $booking): Booking
    {
        if (! Classes::find($booking->class_id)) {
            throw new NotFoundException('Class not found!');
        }

        $booking = $this->model->create(
            $booking->toArray()
        );

        return $this->mapModelToEntity($booking);
    }

    public function update(string $id, Booking $data): Booking
    {
        if (! $booking = $this->model->find($data->id)) {
            throw new NotFoundException();
        }

        $booking->update(
            $data->toArray()
        );

        $booking->save();

        return $this->mapModelToEntity($booking);
    }

    public function delete(string $id): bool
    {
        if (! $booking = $this->model->find($id)) {
            throw new NotFoundException();
        }

        return $booking->delete();
    }

    public function findById(string $id): Booking
    {
        if (! $booking = $this->model->find($id)) {
            throw new NotFoundException();
        }

        return $this->mapModelToEntity($booking);
    }

    public function paginate(string $userId, string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model->orderBy('created_at', $order);
        $query->where('user_id', $userId);
        if ($filter) {
            $query->where(function ($query) use ($filter) {
                $query->orWhere('name', 'like', '%'.$filter.'%');
                $query->orWhere('second_name', 'like', '%'.$filter.'%');
                $query->orWhere('email', 'like', '%'.$filter.'%');
                $query->orWhere('number', 'like', '%'.$filter.'%');
            });
        }

        $pagination =  $query->paginate(
            perPage: $totalPage,
            page: $page
        );

        return new PaginationPresenter($pagination);
    }

    public function findAll(string $filter = '', string $order = 'DESC'): array
    {
        $query = $this->model->orderBy('created_at', $order);
        if ($filter) {
            $query->where(function ($query) use ($filter) {
                $query->orWhere('name', 'like', '%'.$filter.'%');
                $query->orWhere('second_name', 'like', '%'.$filter.'%');
                $query->orWhere('email', 'like', '%'.$filter.'%');
                $query->orWhere('phone', 'like', '%'.$filter.'%');
            });
        }

        return $query->get()->all();
    }

    private function mapModelToEntity(ModelsBooking $model): Booking
    {
        return new Booking(
            id: $model->id,
            class_id: $model->class_id,
            name: $model->name,
            date: $model->date,
        );
    }
}
