<?php

namespace Danimurcia\Responses\Tests;

use Danimurcia\Responses\MacroServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * @throws \ReflectionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        config(['responses.results.success' => 'SUCCESS']);
        config(['responses.results.warnings' => 'WARNINGS']);
        config(['responses.results.errors' => 'ERRORS']);
        config(['responses.codes.W_000000001' => 'warnings.W_000000001']);
        config(['responses.codes.E_000000001' => 'errors.E_000000001']);
        $this->createDummyprovider()->register();
    }

    /**
     * @throws \ReflectionException
     */
    protected function createDummyprovider(): object
    {
        $reflectionClass = new \ReflectionClass(MacroServiceProvider::class);
        return $reflectionClass->newInstanceWithoutConstructor();
    }
}