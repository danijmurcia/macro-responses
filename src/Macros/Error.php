<?php

namespace Danimurcia\Responses\Macros;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class Error
{
    public function __invoke(): void
    {
        Response::macro('error', function ($message, $status = HttpResponse::HTTP_INTERNAL_SERVER_ERROR, array $errors = [], array $headers = []) {
            $errors = getErrorMessagesByCode($errors);

            return Response::json([
                'result' => config('responses.results.errors'),
                'message' => $message,
                'errors' => $errors,
            ], $status, $headers);
        });
    }
}