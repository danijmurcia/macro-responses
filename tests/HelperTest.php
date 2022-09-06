<?php

use Danimurcia\Responses\Tests\TestCase;

class HelperTest extends TestCase
{
    public function test_code_does_not_exists()
    {
        $codeAndMessage = getErrorMessagesByCode([['code' => 'code_that_does_not_exist']]);
        $this->assertIsObject($codeAndMessage);
        $this->assertEquals(collect(), $codeAndMessage);
    }

    public function test_helper_get_messages()
    {
        $codeAndMessage = getErrorMessagesByCode([['code' => 'W_000000001']]);
        $this->assertEquals(json_encode($codeAndMessage), json_encode([['code' => 'W_000000001', 'message' => 'warnings.W_000000001']]));
    }
}