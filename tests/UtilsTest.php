<?php

declare(strict_types=1);
/**
 * This file is part of the codemagpie/array2object package.
 *
 * (c) CodeMagpie Lyf <https://github.com/codemagpie>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CodeMagpie\UtilsTests;

use CodeMagpie\Utils\Utils;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UtilsTest extends TestCase
{
    public function testStringToLine(): void
    {
        $str = 'userInfo';
        self::assertEquals('user_info', Utils::stringToLine($str));
        $str = 'UserInfo';
        self::assertEquals('user_info', Utils::stringToLine($str));
    }

    public function testStringToHump(): void
    {
        $str = 'user_info';
        self::assertEquals('userInfo', Utils::stringToHump($str));
        $str = 'User_Info';
        self::assertEquals('userInfo', Utils::stringToHump($str));
    }

    public function testArrayKeyToHump(): void
    {
        $user = ['user_info' => ['address_info' => 'test']];
        self::assertEquals(['userInfo' => ['addressInfo' => 'test']], Utils::arrayKeyToHump($user));
    }

    public function testArrayKeyToLine(): void
    {
        $user = ['userInfo' => ['addressInfo' => 'test']];
        self::assertEquals(['user_info' => ['address_info' => 'test']], Utils::arrayKeyToLine($user));
    }
}
