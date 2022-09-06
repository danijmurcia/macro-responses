<?php

namespace Macros;

use Danimurcia\Responses\Tests\TestCase;
use Illuminate\Support\Facades\Response;


class OkTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_if_exists_macro()
    {
        $this->assertTrue(Response::hasMacro('ok'));
    }

    public function test_response_without_warnings()
    {
        $response = response()->ok([], 200, []);
        $this->assertEquals(
            json_encode(['result' => 'SUCCESS', 'body' => [], 'warnings' => []]),
            json_encode($response->original)
        );
    }

    public function test_response_with_warnings()
    {
        $response = response()->ok([], 200, [['code' => 'W_000000001']]);
        $this->assertEquals(
            json_encode(['result' => 'WARNINGS', 'body' => [], 'warnings' => [['code' => 'W_000000001', 'message' => 'warnings.W_000000001']]]),
            json_encode($response->original)
        );
    }

    public function test_validate_structure()
    {
        $data = ['name' => 'test', 'age' => 43];

        $response = response()->ok(compact('data'), 200, []);
        $this->assertEquals(
            json_encode(['result' => 'SUCCESS', 'body' => ['data' => $data], 'warnings' => []]),
            json_encode($response->original)
        );
    }
}