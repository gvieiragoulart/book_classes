<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;
use Core\UseCase\Booking\CreateBookingUseCase;
use Core\UseCase\DTO\Booking\Create\CreateBookingInputDto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    public function store(string $id, CreateBookingRequest $request, CreateBookingUseCase $useCase)
    {        
        $booking = $useCase->execute(
            input: new CreateBookingInputDto(
                class_id: $id,
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

    public function show($id)
    {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    }
}
