<?php

namespace Macros;

use Danimurcia\Responses\Tests\TestCase;
use Illuminate\Support\Facades\Response;

class ErrorTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_if_exists_macro()
    {
        $this->assertTrue(Response::hasMacro('error'));
    }

    public function test_error_response_without_message()
    {
        $response = response()->error([], 500, []);
        $this->assertEquals(
            json_encode(['result' => 'ERRORS', 'message' => [], 'errors' => []]),
            json_encode($response->original)
        );
    }

    public function test_error_response_with_message()
    {
        $response = response()->error([], 500, [['code' => 'E_000000001']]);
        $this->assertEquals(
            json_encode(['result' => 'ERRORS', 'message' => [], 'errors' => [['code' => 'E_000000001', 'message' => 'errors.E_000000001']]]),
            json_encode($response->original)
        );
    }

    public function test_validate_structure()
    {
        $message = 'Ha habido un error';
        $response = response()->error(compact('message'), 500, [['code' => 'E_000000001']]);
        $this->assertEquals(
            json_encode(['result' => 'ERRORS', 'message' => ['message' => $message], 'errors' => [['code' => 'E_000000001', 'message' => 'errors.E_000000001']]]),
            json_encode($response->original)
        );
    }

}