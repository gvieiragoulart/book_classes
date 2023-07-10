<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;
use Core\UseCase\Booking\CreateBookingUseCase;
use Core\UseCase\Booking\DeleteBookingUseCase;
use Core\UseCase\Booking\FindBookingUseCase;
use Core\UseCase\Booking\UpdateBookingUseCase;
use Core\UseCase\DTO\Booking\Create\CreateBookingInputDto;
use Core\UseCase\DTO\Booking\Update\UpdateBookingInputDto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /*
    * Create a new booking
    *
    * header Accept application/json
    * header Content-Type application/json
    * @queryParam class_id string required
    * body name string required
    * body date date required. Example: 12/12/2021
    */
    public function store(string $class_id, CreateBookingRequest $request, CreateBookingUseCase $useCase)
    {        
        $booking = $useCase->execute(
            input: new CreateBookingInputDto(
                class_id: $class_id,
                name: $request->name,
                date: Carbon::parse($request->date),
            )
        );

        return $this->sendDataWithMessage(
            message: 'Booked successfully!',
            data: BookingResource::make($booking),
            statusCode: Response::HTTP_CREATED
        );
    }

    /*
    * Get a booking
    *
    * header Accept application/json
    * header Content-Type application/json
    * @queryParam class_id string required
    * @queryParam id string required
    */
    public function show(string $class_id, string $id, FindBookingUseCase $useCase)
    {
        $booking = $useCase->execute($id);

        return $this->sendDataWithMessage(
            message: 'Booking retrieved successfully!',
            data: BookingResource::make($booking),
            statusCode: Response::HTTP_OK
        );
    }

    /*
    * Update a booking
    *
    * header Accept application/json
    * header Content-Type application/json
    * @queryParam class_id string required
    * @queryParam id string required
    * body name string required
    * body date date required. Example: 12/12/2021
    */
    public function update(string $class_id, string $id, UpdateBookingRequest $request,UpdateBookingUseCase $useCase)
    {
        $booking = $useCase->execute(
            input: new UpdateBookingInputDto(
                id: $id,
                name: $request->name,
                date: !empty($request->date) ? Carbon::createFromFormat('d/m/Y', $request->date) : null,
            )
        );

        return $this->sendDataWithMessage(
            message: 'Booking updated successfully!',
            data: BookingResource::make($booking),
            statusCode: Response::HTTP_OK
        );
    }

    /*
    * Delete a booking
    *
    * header Accept application/json
    * header Content-Type application/json
    * @queryParam class_id string required
    * @queryParam id string required
    */
    public function destroy(string $class_id, string $id, DeleteBookingUseCase $useCase)
    {
        $useCase->execute($id);

        return $this->sendMessage(
            message: 'Booking deleted successfully!',
            statusCode: Response::HTTP_OK
        );
    }
}
