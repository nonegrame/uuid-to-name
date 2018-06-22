<?php

namespace Nonegrame\UuidToName\Tests;

use Nonegrame\UuidToName\Exception\NotUuidException;
use Nonegrame\UuidToName\UuidToName;

class UuidToNameTest extends \PHPUnit\Framework\TestCase
{
    public function test_uuidToName_param_not_uuid()
    {
        // arrange
        $this->expectException(NotUuidException::class);

        $class = new UuidToName();

        // act
        $class->convertToName("hi");

        // assert
    }

    public function test_uuidToName_param_uuid()
    {
        // arrange
        $class = new UuidToName();

        // act
        $result = $class->convertToName("6cbdd473-4ed4-4842-a439-811843c794a4");
        $result2 = $class->convertToName("6cbdd473-4ed4-4842-a439-811843c794a4");

        // assert
        $this->assertSame($result, $result2);
    }
}