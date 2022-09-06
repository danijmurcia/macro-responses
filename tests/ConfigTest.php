<?php


use Danimurcia\Responses\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->path_config_file = "./config/responses.php";
        $this->config_file = include($this->path_config_file);
    }

    public function test_exists_responses_file()
    {
        $this->assertFileExists($this->path_config_file);
    }

    public function test_check_if_config_file_is_array()
    {
        $this->assertIsArray($this->config_file);
    }

    public function test_file_structure()
    {
        $this->assertArrayHasKey('results', $this->config_file);
        $this->assertArrayHasKey('codes', $this->config_file);
        $this->assertArrayHasKey('success', $this->config_file['results']);
        $this->assertArrayHasKey('warnings', $this->config_file['results']);
        $this->assertArrayHasKey('errors', $this->config_file['results']);
    }
}