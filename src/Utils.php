<?php

declare(strict_types=1);
/**
 * This file is part of the codemagpie/utils package.
 *
 * (c) CodeMagpie Lyf <https://github.com/codemagpie>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CodeMagpie\Utils;

use ReflectionClass;

class Utils
{
    public static function stringToLine(string $string): string
    {
        $replaceString = preg_replace_callback('/([A-Z])/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $string);

        return trim(preg_replace('/_{2,}/', '_', $replaceString), '_');
    }

    public static function stringToHump(string $string): string
    {
        return lcfirst(implode('', array_map('ucfirst', explode('_', $string))));
    }

    public static function arrayKeyToLine(array $array): array
    {
        $convert = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $convert[is_string($key) ? self::stringToLine($key) : $key] = self::arrayKeyToLine($value);
            } else {
                $convert[is_string($key) ? self::stringToLine($key) : $key] = $value;
            }
        }
        return $convert;
    }

    public static function arrayKeyToHump(array $array): array
    {
        $convert = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $convert[is_string($key) ? self::stringToHump($key) : $key] = self::arrayKeyToHump($value);
            } else {
                $convert[is_string($key) ? self::stringToHump($key) : $key] = $value;
            }
        }
        return $convert;
    }

    public static function getEnumValues(string $enumClass): array
    {
        $ref = new ReflectionClass($enumClass);
        return array_values($ref->getConstants());
    }
}
