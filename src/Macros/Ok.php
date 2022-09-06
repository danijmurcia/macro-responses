<?php

namespace Danimurcia\Responses\Macros;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class Ok
{
    public function __invoke(): void
    {
        // La respuesta OK, puede ser tanto un success como un warning en función de si obtiene un listado de códigos de warnings
        Response::macro('ok', function (array $data = [], $status = HttpResponse::HTTP_OK, array $warnings = [], array $headers = []) {
            $result = count($warnings) === 0 ? config('responses.results.success') : config('responses.results.warnings');
            $warnings = getErrorMessagesByCode($warnings);

            return Response::json([
                'result' => $result,
                'body' => $data,
                'warnings' => $warnings,
            ], $status, $headers);
        });
    }
}