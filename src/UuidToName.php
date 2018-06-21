<?php

namespace Nonegrame\UuidToName;

use Nonegrame\UuidToName\Exception\NotUuidException;

class UuidToName
{
    public function __construct()
    {
    }

    public function uuidToName(string $uuid): string
    {
        $isUuid = preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $uuid);
        if (!$isUuid) {
            throw new NotUuidException("param not uuid");
        }

        return "John Doe";
    }
}