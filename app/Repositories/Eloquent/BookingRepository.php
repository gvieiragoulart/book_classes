<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking as ModelsBooking;
use App\Models\Classes;
use Core\Domain\Entity\Booking;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\BookingRepositoryInterface;

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
