<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\General\WhoamiClient;
use ArrowSphere\PublicApiClient\PublicApiClient;
use PHPUnit\Framework\TestCase;
use Throwable;

class PublicApiClientTest extends TestCase
{
    public static function providerTestCall(): array
    {
        return [
            'whoami' => [
                'className' => 'WhoamiClient',
                'result' => [
                    'instance' => WhoamiClient::class,
                ],
            ],
            'nonexistent' => [
                'className' => 'NonexistentClient',
                'result' => [
                    'exception' => true,
                ],
            ]
        ];
    }

    /**
     * @dataProvider providerTestCall
     *
     * @param string $className
     * @param array $result
     */
    public function testCall(string $className, array $result): void
    {
        $publicApiClient = new PublicApiClient();

        try {
            $methodName = 'get' . $className;
            $client = $publicApiClient->$methodName();

            if (isset($result['instance'])) {
                self::assertInstanceOf($result['instance'], $client);
            } elseif (isset($result['exception'])) {
                self::fail('Should have thrown an exception');
            }
        } catch (Throwable $t) {
            if (isset($result['exception'])) {
                self::assertTrue(true);
            } else {
                self::fail('Should not have thrown an exception (exception message: ' . $t->getMessage() . ')');
            }
        }
    }
}
