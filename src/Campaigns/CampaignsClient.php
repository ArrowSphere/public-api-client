<?php

namespace ArrowSphere\PublicApiClient\Campaigns;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Campaigns\Entities\Campaign;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ReflectionException;

/**
 * Class CampaignsClient
 */
class CampaignsClient extends AbstractClient
{
    /**
     * @var string The path of the List Campaigns end point
     */
    private const FIND_PATH = '/campaigns';

    /**
     * @param string $reference
     *
     * @return Campaign|null
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function getCampaign(string $reference): ?Campaign
    {
        $response = $this->getCampaignRaw($reference);
        $data = $this->decodeResponse($response);
        $result = null;
        if ($data['data']) {
            $result = new Campaign($data['data']);
        }

        return $result;
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCampaignRaw(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = self::FIND_PATH . "/$reference";

        return $this->get();
    }

    /**
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCampaigns(): string
    {
        $this->path = self::FIND_PATH;

        return $this->get();
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCampaignAssets(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = self::FIND_PATH . "/$reference/assets";

        return $this->get();
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getCampaignAssetsUploadUrl(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = self::FIND_PATH . "/$reference/assets/upload";

        return $this->get();
    }

    /**
     * @param array $params
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function createCampaign(array $params): string
    {
        $this->path = self::FIND_PATH;

        return $this->post([
            'category' => $params['category'],
            'name'     => $params['name'],
        ]);
    }

    /**
     * @param array $params
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function saveCampaign(array $params, string $reference): string
    {
        $this->path = self::FIND_PATH . "/$reference";

        return $this->put($params['campaign']);
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function duplicateCampaign(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = self::FIND_PATH . "/$reference/duplicate";

        return $this->post([]);
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteCampaign(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = self::FIND_PATH . "/$reference";

        return $this->delete();
    }

    /**
     * @param string $campaignRef
     * @param string $assetRef
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteAsset(string $campaignRef, string $assetRef): string
    {
        $campaignRef = urlencode($campaignRef);
        $assetRef = urlencode($assetRef);
        $this->path = self::FIND_PATH . "/$campaignRef/assets/$assetRef";

        return $this->delete();
    }
}
