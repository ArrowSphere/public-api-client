<?php

namespace ArrowSphere\PublicApiClient\Tests\Support;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Support\SupportClient;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class SupportClientTest
 *
 * @property SupportClient $client
 */
class SupportClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = SupportClient::class;

    private const TEST_ISSUE = <<<JSON
{
    "id": 12345,
    "title": "[Platform issue] How to reset my Microsoft Password ?",
    "topicId": 1,
    "description": "Hi, I would Like to reset my password, how can I do this?<br>Thanks in advance!",
    "endCustomerRef": "XSP12345",
    "language": "en",
    "offer": {
        "sku": "031C9E47-4802-4248-838E-778FB1D2CC05",
        "name": "Office 365 Business Essentials",
        "vendor": "Microsoft"
    },
    "priority": 2,
    "status": "PENDING_ARROW",
    "createdBy": {
        "email": "Gunn.Wærsted@telenor.com",
        "firstName": "Gunn",
        "lastName": "Wærsted",
        "phone": "408-867-5309"
    },
    "supportPlan": {
        "label": "Premium End Customer Support",
        "sku": "ARWMS-ECSUP-PREM-GOLD",
        "sourcePortal": "Arrowsphere"
    },
    "program": "MSCSP",
    "additionalData": [
        {
            "name": "endCustomerDomainName",
            "value": "myendcustomerdomainename@onmicrosoft.com"
        }
    ],
    "created": "2020-02-01T19:00:00.000Z",
    "updated": "2020-02-03T15:00:00.000Z",
    "source": "api"
}
JSON;

    private const TEST_TOPIC = <<<JSON
{

    "id": 1,
    "name": "platformIssue",
    "label": "Microsoft platform issue",
    "premium": true,
    "classification": "Saas",
    "description": "Our experts will cross-reference your designs and solutions against Microsoft best practices and guidelines to ensure the planned design will be suitable. Alongside this, our experts will use their vast knowledge and check your designs against known issues / their past experiences, to make the migration of your services as smooth as possible. Ideal for if you are migrating your entire environment / a large portion of your environment to the cloud."
}
JSON;

    private const TEST_COMMENT = <<<JSON
{

    "id": 12345,
    "body": "Hi, I would like to reset my Microsoft password, how can I do this?<br>Best Regards<br>Gunn",
    "date": "2020-02-01T13:42:00+01:00",
    "createdBy": {
        "email": "Gunn.Wærsted@telenor.com",
        "firstName": "Gunn",
        "lastName": "Wærsted",
        "phone": "408-867-5309"
    }
}
JSON;

    private const TEST_ATTACHMENT = <<<JSON
{

    "id": 12345,
    "fileName": "capture.png",
    "mimeType": "image/png",
    "content": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+P+/HgAFhAJ/wlseKgAAAABJRU5ErkJggg=="
}
JSON;

    public function testCreateIssue(): void
    {
        $response = <<<JSON
{
    "status": 201,
    "data": {
        "id": 123
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/support/issues?abc=def&ghi=0')
            ->willReturn(new Response(201, [], $response));

        $issueId = $this->client->createIssue([], [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame(123, $issueId);
    }

    public function testListIssuesWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues?abc=def&ghi=0')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);

        $this->client->listIssues([
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function testListIssues(): void
    {
        $response = '{"status": 200, "data": [' . self::TEST_ISSUE . ']}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $issues = $this->client->listIssues([
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertCount(1, $issues);

        $issue = reset($issues);

        self::assertSame(json_decode(self::TEST_ISSUE, true), $issue);
    }

    public function testGetIssue(): void
    {
        $response = '{"status": 200, "data": ' . self::TEST_ISSUE . '}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues/123?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $issue = $this->client->getIssue(123, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame(json_decode(self::TEST_ISSUE, true), $issue);
    }

    public function testCloseIssue(): void
    {
        $payload = [
            [
                "op" => "replace",
                "path" => "status",
                "value" => "CLOSED"

            ],
            [
                "op" => "replace",
                "path" => "statusDetails",
                "value" => "RESOLVED"
            ]
        ];

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('patch', 'https://www.test.com/support/issues/123?abc=def&ghi=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->closeIssue(123, $payload, [
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    public function testListTopics(): void
    {
        $response = '{"status": 200, "data": [' . self::TEST_TOPIC . ']}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/topics?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $topics = $this->client->listTopics([
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertCount(1, $topics);

        $topic = reset($topics);

        self::assertSame(json_decode(self::TEST_TOPIC, true), $topic);
    }

    public function testListComments(): void
    {
        $response = '{"status": 200, "data": [' . self::TEST_COMMENT . ']}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues/123/comments?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $comments = $this->client->listComments(123, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertCount(1, $comments);

        $issue = reset($comments);

        self::assertSame(json_decode(self::TEST_COMMENT, true), $issue);
    }

    public function testListAllComments(): void
    {
        $response = '{"status": 200, "data": [' . self::TEST_COMMENT . '], "pagination": {}}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues/123/comments')
            ->willReturn(new Response(200, [], $response));

        $comments = $this->client->listAllComments(123);

        self::assertCount(1, $comments);

        $issue = reset($comments);

        self::assertSame(json_decode(self::TEST_COMMENT, true), $issue);
    }

    public function testAddComment(): void
    {
        $payload = [];

        $response = <<<JSON
{
    "status": 201,
    "data": {
        "id": 123
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/support/issues/123/comments?abc=def&ghi=0')
            ->willReturn(new Response(201, [], $response));

        $commentId = $this->client->addComment(123, $payload, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame(123, $commentId);
    }

    public function testAddAttachment(): void
    {
        $payload = [];

        $response = <<<JSON
{
    "status": 201,
    "data": {
        "id": 123
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/support/issues/123/attachments?abc=def&ghi=0')
            ->willReturn(new Response(201, [], $response));

        $attachmentId = $this->client->addAttachment(123, $payload, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame(123, $attachmentId);
    }

    public function testListAttachments(): void
    {
        $response = '{"status": 200, "data": [' . self::TEST_ATTACHMENT . '], "pagination": {}}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues/123/attachments?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $attachments = $this->client->listAttachments(123, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertCount(1, $attachments);

        $attachment = reset($attachments);

        self::assertSame(json_decode(self::TEST_ATTACHMENT, true), $attachment);
    }

    public function testGetAttachment(): void
    {
        $response = '{"status": 200, "data": ' . self::TEST_ATTACHMENT . '}';

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/support/issues/123/attachments/12345?abc=def&ghi=0')
            ->willReturn(new Response(200, [], $response));

        $attachment = $this->client->getAttachment(123, 12345, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame(json_decode(self::TEST_ATTACHMENT, true), $attachment);
    }
}
