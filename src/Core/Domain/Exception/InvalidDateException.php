<?php

namespace Core\Domain\Exception;

use Exception;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

class InvalidDateException extends Exception
{
    public function __construct(string $message = "Date must be valid",
    int $code = Response::HTTP_BAD_REQUEST,
    Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
