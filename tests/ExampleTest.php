<?php

use Example\Example;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function test_example_returns_true()
    {
        $example = new Example();

        $this->assertTrue($example->test());
    }
}
