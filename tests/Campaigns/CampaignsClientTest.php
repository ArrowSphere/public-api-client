<?php

namespace ArrowSphere\PublicApiClient\Tests\Campaigns;

use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;
use ArrowSphere\PublicApiClient\Campaigns\Entities\Asset\Asset;
use ArrowSphere\PublicApiClient\Campaigns\Entities\Asset\AssetUploadUrl;
use ArrowSphere\PublicApiClient\Campaigns\Entities\Banner;
use ArrowSphere\PublicApiClient\Campaigns\Entities\Campaign;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
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
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetCampaignsRaw(): void
    {
        $this->client->setPage(1);
        $this->client->setPerPage(10);
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns?abc=def&ghi=0&per_page=10')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getCampaignsRaw([
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testGetCampaignsRaw
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetCampaignsWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $campaigns = $this->client->getCampaigns([
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($campaigns);
    }

    /**
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testGetCampaignsWithPagination(): void
    {
        $response = json_encode([
            'data'       => [
                'campaigns' => [],
            ],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/campaigns?abc=def&ghi=0&per_page=100'],
                ['get', 'https://www.test.com/campaigns?abc=def&ghi=0&page=2&per_page=100'],
                ['get', 'https://www.test.com/campaigns?abc=def&ghi=0&page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getCampaigns([
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($test);
    }

    public function testGetCampaigns(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "campaigns": [
      {
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
      },
      {
        "reference": "bbb-bbb-bbbb-bbb",
        "name": "My campaign 2",
        "category": "BANNER 2",
        "createdAt": "2021-12-25T16:00:00Z",
        "rules": {
          "locations": [],
          "roles": [],
          "marketplaces": [],
          "subscriptions": [],
          "resellers": [],
          "endCustomers": []
        },
        "weight": 2,
        "banners": [
          {
            "backgroundImageUuid": "bbbb-bbb-bbbb-bbb-11"
          },
          {
            "backgroundImageUuid": "ccc-ccc-cccc-ccc-22"
          },
          {
            "backgroundImageUuid": "ddd-ddd-dddd-ddd-33"
          }
        ],
        "landingPage": {
          "header": {
            "backgroundImageUuid": "eee-eee-eeee-eee-44",
            "vendorLogoUuid": "fff-fff-fffff-fff-55"
          },
          "body": {
            "backgroundImageUuid": "ggg-ggg-gggg-ggg-66"
          }
        }
      }
    ]
  },
  "pagination": {
    "per_page": 100,
    "current_page": 1,
    "total_page": 1,
    "total": 2,
    "next": null,
    "previous": null
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getCampaigns([
            'abc' => 'def',
            'ghi' => false,
        ]);
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Campaign $campaign */
        $campaign = array_shift($list);
        self::assertInstanceOf(Campaign::class, $campaign);

        self::assertInstanceOf(Campaign::class, $campaign);
        self::assertSame('aaa-aaa-aaaa-aaa', $campaign->getReference());
        self::assertSame('My campaign', $campaign->getName());
        self::assertSame('BANNER', $campaign->getCategory());
        self::assertSame('2021-06-25T16:00:00Z', $campaign->getCreatedAt());
        self::assertNull($campaign->getDeletedAt());

        $rules = $campaign->getRules();
        self::assertEmpty($rules->getLocations());
        self::assertEmpty($rules->getRoles());
        self::assertEmpty($rules->getMarketplaces());
        self::assertEmpty($rules->getSubscriptions());
        self::assertEmpty($rules->getResellers());
        self::assertEmpty($rules->getEndCustomers());

        self::assertSame(1, $campaign->getWeight());

        $banners = $campaign->getBanners();
        self::assertCount(3, $banners);

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('bbbb-bbb-bbbb-bbb-bb', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ccc-ccc-cccc-ccc-cc', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ddd-ddd-dddd-ddd-dd', $banner->getBackgroundImageUuid());

        $landingPage = $campaign->getLandingPage();
        self::assertNull($landingPage->getUrl());

        $header = $landingPage->getHeader();
        self::assertSame('eee-eee-eeee-eee-ee', $header->getBackgroundImageUuid());
        self::assertNull($header->getBackgroundColor());
        self::assertSame('', $header->getBaseline());
        self::assertNull($header->getTextColor());
        self::assertSame('', $header->getTitle());
        self::assertSame('fff-fff-fffff-fff-ff', $header->getVendorLogoUuid());

        $body = $landingPage->getBody();
        self::assertSame('', $body->getTitle());
        self::assertSame('ggg-ggg-gggg-ggg-gg', $body->getBackgroundImageUuid());
        self::assertSame('', $body->getType());
        self::assertSame('', $body->getDescription());
        self::assertNull($body->getVideoUrl());

        $footer = $landingPage->getFooter();
        self::assertSame('', $footer->getTitle());
        self::assertSame('#FFF', $footer->getTextColor());
        self::assertSame('', $footer->getBackgroundColor());
        self::assertSame('', $footer->getButtonText());
        self::assertSame('', $footer->getButtonUrl());

        self::assertEmpty($footer->getFeatures());

        /** @var Campaign $campaign */
        $campaign = array_shift($list);
        self::assertInstanceOf(Campaign::class, $campaign);

        self::assertInstanceOf(Campaign::class, $campaign);
        self::assertSame('bbb-bbb-bbbb-bbb', $campaign->getReference());
        self::assertSame('My campaign 2', $campaign->getName());
        self::assertSame('BANNER 2', $campaign->getCategory());
        self::assertSame('2021-12-25T16:00:00Z', $campaign->getCreatedAt());
        self::assertNull($campaign->getDeletedAt());

        $rules = $campaign->getRules();
        self::assertEmpty($rules->getLocations());
        self::assertEmpty($rules->getRoles());
        self::assertEmpty($rules->getMarketplaces());
        self::assertEmpty($rules->getSubscriptions());
        self::assertEmpty($rules->getResellers());
        self::assertEmpty($rules->getEndCustomers());

        self::assertSame(2, $campaign->getWeight());

        $banners = $campaign->getBanners();
        self::assertCount(3, $banners);

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('bbbb-bbb-bbbb-bbb-11', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ccc-ccc-cccc-ccc-22', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ddd-ddd-dddd-ddd-33', $banner->getBackgroundImageUuid());

        $landingPage = $campaign->getLandingPage();
        self::assertNull($landingPage->getUrl());

        $header = $landingPage->getHeader();
        self::assertSame('eee-eee-eeee-eee-44', $header->getBackgroundImageUuid());
        self::assertNull($header->getBackgroundColor());
        self::assertSame('', $header->getBaseline());
        self::assertNull($header->getTextColor());
        self::assertSame('', $header->getTitle());
        self::assertSame('fff-fff-fffff-fff-55', $header->getVendorLogoUuid());

        $body = $landingPage->getBody();
        self::assertSame('', $body->getTitle());
        self::assertSame('ggg-ggg-gggg-ggg-66', $body->getBackgroundImageUuid());
        self::assertSame('', $body->getType());
        self::assertSame('', $body->getDescription());
        self::assertNull($body->getVideoUrl());

        $footer = $landingPage->getFooter();
        self::assertSame('', $footer->getTitle());
        self::assertSame('#FFF', $footer->getTextColor());
        self::assertSame('', $footer->getBackgroundColor());
        self::assertSame('', $footer->getButtonText());
        self::assertSame('', $footer->getButtonUrl());

        self::assertEmpty($footer->getFeatures());
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
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
        "isActivated": true,
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
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE)
            ->willReturn(new Response(200, [], 'OK USA'))
        ;

        $this->client->getCampaignRaw(self::CAMPAIGN_REFERENCE);
    }

    public function testGetCampaign(): void
    {
        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "isActivated": true,
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

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE)
            ->willReturn(new Response(200, [], $expected))
        ;

        $campaign = $this->client->getCampaign(self::CAMPAIGN_REFERENCE);

        self::assertInstanceOf(Campaign::class, $campaign);
        self::assertSame('aaa-aaa-aaaa-aaa', $campaign->getReference());
        self::assertSame('My campaign', $campaign->getName());
        self::assertSame('BANNER', $campaign->getCategory());
        self::assertSame('2021-06-25T16:00:00Z', $campaign->getCreatedAt());
        self::assertNull($campaign->getDeletedAt());

        $rules = $campaign->getRules();
        self::assertEmpty($rules->getLocations());
        self::assertEmpty($rules->getRoles());
        self::assertEmpty($rules->getMarketplaces());
        self::assertEmpty($rules->getSubscriptions());
        self::assertEmpty($rules->getResellers());
        self::assertEmpty($rules->getEndCustomers());

        self::assertSame(1, $campaign->getWeight());

        $banners = $campaign->getBanners();
        self::assertCount(3, $banners);

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('bbbb-bbb-bbbb-bbb-bb', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ccc-ccc-cccc-ccc-cc', $banner->getBackgroundImageUuid());

        /** @var Banner $banner */
        $banner = array_shift($banners);
        self::assertInstanceOf(Banner::class, $banner);
        self::assertSame('ddd-ddd-dddd-ddd-dd', $banner->getBackgroundImageUuid());

        $landingPage = $campaign->getLandingPage();
        self::assertNull($landingPage->getUrl());

        $header = $landingPage->getHeader();
        self::assertSame('eee-eee-eeee-eee-ee', $header->getBackgroundImageUuid());
        self::assertNull($header->getBackgroundColor());
        self::assertSame('', $header->getBaseline());
        self::assertNull($header->getTextColor());
        self::assertSame('', $header->getTitle());
        self::assertSame('fff-fff-fffff-fff-ff', $header->getVendorLogoUuid());

        $body = $landingPage->getBody();
        self::assertSame('', $body->getTitle());
        self::assertSame('ggg-ggg-gggg-ggg-gg', $body->getBackgroundImageUuid());
        self::assertSame('', $body->getType());
        self::assertSame('', $body->getDescription());
        self::assertNull($body->getVideoUrl());

        $footer = $landingPage->getFooter();
        self::assertSame('', $footer->getTitle());
        self::assertSame('#FFF', $footer->getTextColor());
        self::assertSame('', $footer->getBackgroundColor());
        self::assertSame('', $footer->getButtonText());
        self::assertSame('', $footer->getButtonUrl());

        self::assertEmpty($footer->getFeatures());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetActiveCampaignRaw(): void
    {
        $expected = <<<JSON
{
    "data": {
        "reference": "aaa-aaa-aaaa-aaa",
        "name": "My campaign",
        "category": "BANNER",
        "isActivated": true,
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
            ->with('get', 'https://www.test.com/campaigns/active')
            ->willReturn(new Response(200, [], $expected))
        ;

        $this->client->getActiveCampaignRaw();
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaignAssetsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets')
            ->willReturn(new Response(200, [], 'OK USA'))
        ;

        $this->client->getCampaignAssetsRaw(self::CAMPAIGN_REFERENCE);
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
                "url": "https://www.example.com"
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

        $assets = $this->client->getCampaignAssets(self::CAMPAIGN_REFERENCE);
        self::assertCount(1, $assets);
        $asset = array_shift($assets);
        self::assertInstanceOf(Asset::class, $asset);
        self::assertSame('https://www.example.com', $asset->getUrl());
        self::assertSame('bbbb-bbb-bbbb-bbbb-bb', $asset->getUuid());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCampaignAssetsUploadUrlRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets/upload')
            ->willReturn(new Response(200, [], 'OK USA'))
        ;

        $this->client->getCampaignAssetsUploadUrlRaw(self::CAMPAIGN_REFERENCE);
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
        "assets": [
            {
                "uuid": "bbbb-bbb-bbbb-bbb-bb",
                "image": {
                    "url": "https://image-url",
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
            }
        ]
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/campaigns/' . self::CAMPAIGN_REFERENCE . '/assets/upload')
            ->willReturn(new Response(200, [], $expected))
        ;

        $assetUploadUrls = $this->client->getCampaignAssetsUploadUrl(self::CAMPAIGN_REFERENCE);

        self::assertCount(1, $assetUploadUrls);

        /** @var AssetUploadUrl $assetUploadUrl */
        $assetUploadUrl = array_shift($assetUploadUrls);
        self::assertInstanceOf(AssetUploadUrl::class, $assetUploadUrl);
        self::assertSame('bbbb-bbb-bbbb-bbb-bb', $assetUploadUrl->getUuid());

        $assetImage = $assetUploadUrl->getImage();
        self::assertSame('https://image-url', $assetImage->getUrl());

        $assetImageFields = $assetImage->getFields();
        self::assertSame('assets/00000000-1111-2222-aaaa-123412341234/98765432-aaaa-bbbb-cccc-123412344321', $assetImageFields->getKey());
        self::assertSame('my-super-bucket', $assetImageFields->getBucket());
        self::assertSame('AWS4-HMAC-SHA256', $assetImageFields->getAmzAlgorithm());
        self::assertSame('blabla/20210927/eu-west-1/s3/aws4_request', $assetImageFields->getAmzCredential());
        self::assertSame('20210927T103402Z', $assetImageFields->getAmzDate());
        self::assertSame('my super security token', $assetImageFields->getAmzSecurityToken());
        self::assertSame('my marvelous policy', $assetImageFields->getPolicy());
        self::assertSame('1337 signature', $assetImageFields->getAmzSignature());
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
