<?php

namespace Nonegrame\UuidToName;

use Nonegrame\UuidToName\Exception\NotUuidException;
use Nonegrame\UuidToName\Service\ConstValue;

class UuidToName
{
    public function convertToName(string $uuid): string
    {
        $isUuid = preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $uuid);
        if (!$isUuid) {
            throw new NotUuidException("param not uuid");
        }

        $uuidArray = explode("-", $uuid);
        $uuidIntArray = [];
        foreach ($uuidArray as $uuidPiece) {
            $uuidIntArray[] = $this->uuidPieceToInt($uuidPiece);
        }

        $nameTemplateArray = explode(" ", $this->pickConstArrayValue(ConstValue::NAME_FORMATS, $uuidIntArray[1]));
        $uuidNameArray = [];
        $constClass = new \ReflectionClass(ConstValue::class);
        foreach ($nameTemplateArray as $template) {
            $uuidNameArray[] = $this->switchTemplate($template, $uuidIntArray, $constClass);
        }

        return implode(" ", $uuidNameArray);
    }

    protected function uuidPieceToInt(string $piece)
    {
        $stringArray = str_split($piece);
        $sum = 1;
        foreach ($stringArray as $string) {
            $sum = $sum * ConstValue::ORD[$string];
        }

        // 扣除一個變動值, 避免最後都是偶數的狀況
        return $sum - ConstValue::ORD[end($stringArray)];
    }

    /**
     * 使用神秘演算法挑出 constArray 裡面的值
     * @param array $constArray
     * @param int $uuidInt
     * @return string
     */
    protected function pickConstArrayValue(array $constArray, int $uuidInt): string
    {
        $arrayCount = count($constArray);
        $key = $uuidInt % $arrayCount;
        return $constArray[$key];
    }

    protected function switchTemplate(string $template, array $uuidIntArray, \ReflectionClass $constClass)
    {
        $constArray = $constClass->getConstant($template);
        switch ($template) {
            case "FIRST_NAME_MALE":
            case "FIRST_NAME_FEMALE":
                $name = $this->pickConstArrayValue($constArray, $uuidIntArray[0]);
                break;
            case "LAST_NAME":
                $name = $this->pickConstArrayValue($constArray, $uuidIntArray[4]);
                break;
            case "TITLE_MALE":
            case "TITLE_FEMALE":
                $name = $this->pickConstArrayValue($constArray, $uuidIntArray[3]);
                break;
            case "SUFFIX":
                $name = $this->pickConstArrayValue($constArray, $uuidIntArray[2]);
                break;
            default:
                $name = "";
                break;
        }
        return $name;
    }
}