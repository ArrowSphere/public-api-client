<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Catalog\AddonClient;
use ArrowSphere\PublicApiClient\Catalog\ClassificationClient;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Catalog\ProgramClient;
use ArrowSphere\PublicApiClient\Catalog\ServiceClient;
use ArrowSphere\PublicApiClient\General\WhoamiClient;
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;

/**
 * Class PublicApiClient
 */
class PublicApiClient extends AbstractClient
{
    /**
     * @return WhoamiClient
     */
    public function getWhoamiClient(): WhoamiClient
    {
        return (new WhoamiClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return OfferClient
     */
    public function getOfferClient(): OfferClient
    {
        return (new OfferClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ProgramClient
     */
    public function getProgramClient(): ProgramClient
    {
        return (new ProgramClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return AddonClient
     */
    public function getAddonClient(): AddonClient
    {
        return (new AddonClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ClassificationClient
     */
    public function getClassificationClient(): ClassificationClient
    {
        return (new ClassificationClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ServiceClient
     */
    public function getServiceClient(): ServiceClient
    {
        return (new ServiceClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return LicensesClient
     */
    public function getLicensesClient(): LicensesClient
    {
        return (new LicensesClient($this->curler))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }
}
