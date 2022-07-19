<?php

namespace App\Exceptions\Owner;

use Symfony\Component\HttpFoundation\Response;

class BadRequestException extends BaseRequestException
{
    public function __construct(string $message = "", array $extras = [])
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST, $extras);
    }
}
