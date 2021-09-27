<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Campaigns\Entities\Asset\AssetImage;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class AssetImageTest
 */
class AssetImageTest extends AbstractEntityTest
{
    public const CLASS_NAME = AssetImage::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'url'    => 'https://s3.us-east-1.amazonaws.com/my-super-bucket',
                    'fields' => [
                        'Key'                  => 'assets/00000000-1111-2222-aaaa-123412341234/98765432-aaaa-bbbb-cccc-123412344321',
                        'bucket'               => 'my-super-bucket',
                        'X-Amz-Algorithm'      => 'AWS4-HMAC-SHA256',
                        'X-Amz-Credential'     => 'blabla/20210927/eu-west-1/s3/aws4_request',
                        'X-Amz-Date'           => '20210927T103402Z',
                        'X-Amz-Security-Token' => 'my super security token',
                        'Policy'               => 'my marvelous policy',
                        'X-Amz-Signature'      => '1337 signature',
                    ],
                ],
                'expected' => <<<JSON
{
    "url": "https:\/\/s3.us-east-1.amazonaws.com\/my-super-bucket",
    "fields": {
        "Key": "assets\/00000000-1111-2222-aaaa-123412341234\/98765432-aaaa-bbbb-cccc-123412344321",
        "bucket": "my-super-bucket",
        "X-Amz-Algorithm": "AWS4-HMAC-SHA256",
        "X-Amz-Credential": "blabla\/20210927\/eu-west-1\/s3\/aws4_request",
        "X-Amz-Date": "20210927T103402Z",
        "X-Amz-Security-Token": "my super security token",
        "Policy": "my marvelous policy",
        "X-Amz-Signature": "1337 signature"
    }
}
JSON
                ,
            ],
        ];
    }
}
