<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Tests the handling of HTTP responses with a real Guzzle client, whose default handler stack throws
 * Guzzle exceptions on 4xx and 5xx responses unless the request disables them.
 */
class AbstractClientHttpErrorsTest extends TestCase
{
    private const VERBS = ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];

    /**
     * @return array<string, array{string}>
     */
    public static function verbProvider(): array
    {
        $data = [];
        foreach (self::VERBS as $verb) {
            $data[$verb] = [$verb];
        }

        return $data;
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function errorProvider(): array
    {
        $data = [];
        foreach (self::VERBS as $verb) {
            foreach ([400, 401, 403, 422, 500, 503] as $statusCode) {
                $data["$verb $statusCode"] = [$verb, $statusCode];
            }
        }

        return $data;
    }

    /**
     * @dataProvider verbProvider
     *
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testReturnsTheBodyOfASuccessfulResponse(string $verb): void
    {
        self::assertSame('OK', $this->createClient(new Response(200, [], 'OK'))->send($verb));
    }

    /**
     * @dataProvider verbProvider
     *
     * @throws GuzzleException
     */
    public function testThrowsNotFoundExceptionOnA404Response(string $verb): void
    {
        $client = $this->createClient(new Response(404, [], '{"error":"Resource not found"}'));

        try {
            $client->send($verb);
            self::fail('A NotFoundException should have been thrown');
        } catch (NotFoundException $exception) {
            self::assertSame(404, $exception->getCode());
            self::assertNotNull($exception->getResponse());
            self::assertSame('{"error":"Resource not found"}', $exception->getResponse()->getBody()->getContents());
        }
    }

    /**
     * @dataProvider errorProvider
     *
     * @throws GuzzleException
     */
    public function testThrowsPublicApiClientExceptionOnAnErrorResponse(string $verb, int $statusCode): void
    {
        $client = $this->createClient(new Response($statusCode, [], '{"error":"Something went wrong"}'));

        try {
            $client->send($verb);
            self::fail('A PublicApiClientException should have been thrown');
        } catch (PublicApiClientException $exception) {
            self::assertNotInstanceOf(NotFoundException::class, $exception);
            self::assertSame($statusCode, $exception->getCode());
            self::assertStringContainsString('{"error":"Something went wrong"}', $exception->getMessage());
            self::assertNotNull($exception->getResponse());
            self::assertSame('{"error":"Something went wrong"}', $exception->getResponse()->getBody()->getContents());
        }
    }

    private function createClient(Response $response): TestedClient
    {
        $client = new TestedClient(new Client(['handler' => HandlerStack::create(new MockHandler([$response]))]));
        $client->setUrl('https://www.test.com');

        return $client;
    }
}

/**
 * Exposes the protected HTTP methods of AbstractClient.
 */
class TestedClient extends AbstractClient
{
    /**
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function send(string $verb): string
    {
        $this->path = '/resource';

        return match ($verb) {
            'GET'    => $this->get(),
            'POST'   => (string) $this->post([]),
            'PATCH'  => (string) $this->patch([]),
            'PUT'    => (string) $this->put(),
            'DELETE' => $this->delete(),
        };
    }
}
