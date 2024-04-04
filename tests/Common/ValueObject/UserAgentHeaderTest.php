<?php

namespace ArrowSphere\PublicApiClient\Tests\Common\ValueObject;

use ArrowSphere\PublicApiClient\Common\ValueObject\UserAgentHeader;
use PHPUnit\Framework\TestCase;

/**
 * Class UserAgentHeaderTest
 */
class UserAgentHeaderTest extends TestCase
{
    public function testUserAgentHeaderDefault(): void
    {
        $userAgent = (string) new UserAgentHeader();

        $parts = explode(' ', $userAgent);

        self::assertCount(2, $parts);
        self::assertStringStartsWith('ArrowSphereClient/', $parts[0]);
        self::assertEquals('PHP/' . PHP_VERSION, $parts[1]);
    }

    public function testUserAgentHeaderWithTag(): void
    {
        $_ENV['PUBLIC_API_CLIENT_USER_AGENT_TAG'] = 'myApp/0.1.2';

        $userAgent = (string) new UserAgentHeader();

        unset($_ENV['PUBLIC_API_CLIENT_USER_AGENT_TAG']);

        $parts = explode(' ', $userAgent);

        self::assertCount(3, $parts);
        self::assertStringStartsWith('ArrowSphereClient/', $parts[0]);
        self::assertEquals('PHP/' . PHP_VERSION, $parts[1]);
        self::assertEquals('myApp/0.1.2', $parts[2]);
    }
}
