<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Billing\PreferencesClient;
use ArrowSphere\PublicApiClient\Billing\StatementsClient;
use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;
use ArrowSphere\PublicApiClient\Catalog\AddonClient;
use ArrowSphere\PublicApiClient\Catalog\ClassificationClient;
use ArrowSphere\PublicApiClient\Catalog\FamilyClient;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Catalog\ProgramClient;
use ArrowSphere\PublicApiClient\Catalog\ServiceClient;
use ArrowSphere\PublicApiClient\Customers\CustomersClient;
use ArrowSphere\PublicApiClient\General\CheckDomainClient;
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
        return (new WhoamiClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return CheckDomainClient
     */
    public function getCheckDomainClient(): CheckDomainClient
    {
        return (new CheckDomainClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return OfferClient
     */
    public function getOfferClient(): OfferClient
    {
        return (new OfferClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ProgramClient
     */
    public function getProgramClient(): ProgramClient
    {
        return (new ProgramClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return AddonClient
     */
    public function getAddonClient(): AddonClient
    {
        return (new AddonClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ClassificationClient
     */
    public function getClassificationClient(): ClassificationClient
    {
        return (new ClassificationClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return ServiceClient
     *
     * @deprecated use getFamilyClient() instead
     */
    public function getServiceClient(): ServiceClient
    {
        return (new ServiceClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return FamilyClient
     */
    public function getFamilyClient(): FamilyClient
    {
        return (new FamilyClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return LicensesClient
     */
    public function getLicensesClient(): LicensesClient
    {
        return (new LicensesClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return CustomersClient
     */
    public function getCustomersClient(): CustomersClient
    {
        return (new CustomersClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return StatementsClient
     */
    public function getBillingStatementsClient(): StatementsClient
    {
        return (new StatementsClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return PreferencesClient
     */
    public function getBillingPreferencesClient(): PreferencesClient
    {
        return (new PreferencesClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }

    /**
     * @return CampaignsClient
     */
    public function getCampaignsClient(): CampaignsClient
    {
        return (new CampaignsClient($this->client))
            ->setUrl($this->url)
            ->setApiKey($this->apiKey);
    }
}
