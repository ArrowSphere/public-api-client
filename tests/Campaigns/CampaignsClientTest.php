<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns;

use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class CampaignsClientTest
 *
 * @property CampaignsClient $client
 */
class CampaignsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = CampaignsClient::class;

    protected const ASSET_REFERENCE = 'bbb-bbb-bbbb-bb';
    protected const CAMPAIGN_REFERENCE = 'aaa-aaa-aaaa-aaa';

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaigns(): void
    {
        $this->client->setPage(1);
        $this->client->setPerPage(10);
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns?per_page=10')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getCampaigns();
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testCreateCampaign(): void
    {
        $payload = [
            'category' => 'BANNER',
            'name'     => 'My campaign',
        ];

        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "createdAt": "2021-06-25T16:00:00Z",
        "rules": {
            "locations": [],
            "roles": [],
            "marketplaces": [],
            "subscriptions": [],
            "resellers": [],
            "endCustomers": []
        },
        "weight": 1,
        "banners": [
            {
                "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb"
            }, 
            {
                "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc"
            }, 
            {
                "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd"
            }
        ],
        "landingPage": {
            "header": {
                "backgroundImageUuid": "eee-eee-eeee-eee-ee",
                "vendorLogoUuid": "fff-fff-fffff-fff-ff"
            },
            "body": {
                "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg"
            }
        }
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/campaigns',
                [
                    'headers' => [
                        'apiKey' => '123456'
                    ],
                    'body'    => json_encode($payload),
                ]
            )
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->createCampaign($payload);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaignRaw(): void
    {
        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "createdAt": "2021-06-25T16:00:00Z",
        "rules": {
            "locations": [],
            "roles": [],
            "marketplaces": [],
            "subscriptions": [],
            "resellers": [],
            "endCustomers": []
        },
        "weight": 1,
        "banners": [
            {
                "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb"
            }, 
            {
                "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc"
            }, 
            {
                "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd"
            }
        ],
        "landingPage": {
            "header": {
                "backgroundImageUuid": "eee-eee-eeee-eee-ee",
                "vendorLogoUuid": "fff-fff-fffff-fff-ff"
            },
            "body": {
                "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg"
            }
        }
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE)
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->getCampaignRaw(self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaignAssets(): void
    {
        $expected = <<<JSON
{
    "data": {
        "assets": [
            {
                "uuid": "bbbb-bbb-bbbb-bbbb-bb",
                "url": ""
            }
        ]
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets')
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->getCampaignAssets(self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaignAssetsUploadUrl(): void
    {
        $expected = <<<JSON
{
    "data": {
        "banners": [
            {
                "uuid": "bbbb-bbb-bbbb-bbb-bb",
                "image": {
                    "url": "https://image-url",
                    "fields": {
                        "Key": "assets/6def2e63-ca33-49de-9939-329f7f67c3ca/banner0.png",
                        "bucket": "bucketName",
                        "X-Amz-Algorithm": "AWS4-HMAC-SHA256",
                        "X-Amz-Credential": "ASIAXR4KPOTAUXHLNGWB/20210713/eu-west-1/s3/aws4_request",
                        "X-Amz-Date": "20210713T083654Z",
                        "X-Amz-Security-Token": "LOremIPsumDOLorSItamEtconSEcTeTuRaDIpisIcingEliT",
                        "Policy": "LOremIPsumDOLorSItamEtconSEcTeTuRaDIpisIcingEliT",
                        "X-Amz-Signature": "LOremIPsumDOLorSItamEtconSEcTeTuRaDIpisIcingEliT"
                    }
                }
            }
        ]
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets/upload')
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->getCampaignAssetsUploadUrl(self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testSaveCampaign(): void
    {
        $payload = <<<JSON
{
    "name": "My campaign",
    "category": "BANNER",
    "createdAt": "2021-06-25T16:00:00Z",
    "rules": {
        "locations": [],
        "roles": [],
        "marketplaces": [],
        "subscriptions": [],
        "resellers": [],
        "endCustomers": []
    },
    "weight": 1,
    "banners": [
        {
            "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
            "type": "PICTURE"
        }, 
        {
            "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc"
        }, 
        {
            "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd"
        }
    ],
    "landingPage": {
        "header": {
            "backgroundImageUuid": "eee-eee-eeee-eee-ee",
            "vendorLogoUuid": "fff-fff-fffff-fff-ff"
        },
        "body": {
            "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg"
        }
    }
}
JSON;

        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "createdAt": "2021-06-25T16:00:00Z",
        "rules": {
            "locations": [],
            "roles": [],
            "marketplaces": [],
            "subscriptions": [],
            "resellers": [],
            "endCustomers": []
        },
        "weight": 1,
        "banners": [
            {
                "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
                "type": "PICTURE"
            }, 
            {
                "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc"
            }, 
            {
                "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd"
            }
        ],
        "landingPage": {
            "header": {
                "backgroundImageUuid": "eee-eee-eeee-eee-ee",
                "vendorLogoUuid": "fff-fff-fffff-fff-ff"
            },
            "body": {
                "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg"
            }
        }
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'put',
                'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE,
                [
                    'headers' => [
                        'apiKey' => '123456'
                    ],
                    'body'    => $payload,
                ]
            )
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->saveCampaign(['campaign' => $payload], self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testDeleteCampaign(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE)
            ->willReturn(new Response(204, [], null));

        $this->client->deleteCampaign(self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testDuplicateCampaign(): void
    {
        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "createdAt": "2021-06-25T16:00:00Z",
        "rules": {
            "locations": [],
            "roles": [],
            "marketplaces": [],
            "subscriptions": [],
            "resellers": [],
            "endCustomers": []
        },
        "weight": 1,
        "banners": [
            {
                "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-bb",
                "type": "PICTURE"
            }, 
            {
                "backgroundImageUuid": "ccc-ccc-cccc-ccc-cc"
            }, 
            {
                "backgroundImageUuid": "ddd-ddd-dddd-ddd-dd"
            }
        ],
        "landingPage": {
            "header": {
                "backgroundImageUuid": "eee-eee-eeee-eee-ee",
                "vendorLogoUuid": "fff-fff-fffff-fff-ff"
            },
            "body": {
                "backgroundImageUuid": "ggg-ggg-gggg-ggg-gg"
            }
        }
    }
}
JSON;

        // This line is to have minified JSON because it's what will be generated in the payload
        $expected = json_encode(json_decode($expected, true));

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/duplicate')
            ->willReturn(new Response(200, [], $expected));

        $this->client->duplicateCampaign(self::CAMPAIGN_REFERENCE);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testDeleteAsset(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('delete', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets/' . self::ASSET_REFERENCE)
            ->willReturn(new Response(204, [], null));

        $this->client->deleteAsset(self::CAMPAIGN_REFERENCE, self::ASSET_REFERENCE);
    }
}
