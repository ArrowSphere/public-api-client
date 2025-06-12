<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Billing\ErpExportsClient;
use ArrowSphere\PublicApiClient\Billing\PreferencesClient;
use ArrowSphere\PublicApiClient\Billing\StatementsClient;
use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;
use ArrowSphere\PublicApiClient\Cart\CartClient;
use ArrowSphere\PublicApiClient\Catalog\AddonClient;
use ArrowSphere\PublicApiClient\Catalog\CatalogClient;
use ArrowSphere\PublicApiClient\Catalog\ClassificationClient;
use ArrowSphere\PublicApiClient\Catalog\FamilyClient;
use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Catalog\ProgramClient;
use ArrowSphere\PublicApiClient\Catalog\ServiceClient;
use ArrowSphere\PublicApiClient\Consumption\AnalyticsClient;
use ArrowSphere\PublicApiClient\Consumption\HealthCheckClient;
use ArrowSphere\PublicApiClient\Customers\CustomersClient;
use ArrowSphere\PublicApiClient\General\CheckDomainClient;
use ArrowSphere\PublicApiClient\General\WhoamiClient;
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Monitoring\MonitoringClient;
use ArrowSphere\PublicApiClient\Notification\NotificationClient;
use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Partners\PartnersClient;
use ArrowSphere\PublicApiClient\Quotes\QuotesClient;
use ArrowSphere\PublicApiClient\Subscription\SubscriptionClient;
use ArrowSphere\PublicApiClient\Support\SupportClient;
use BadMethodCallException;
use RuntimeException;

/**
 * Class PublicApiClient
 *
 * Billing clients
 *
 * @method ErpExportsClient getErpExportsClient()
 * @method PreferencesClient getPreferencesClient()
 * @method StatementsClient getStatementsClient()
 *
 * Campaigns clients
 * @method CampaignsClient getCampaignsClient()
 *
 * Cart clients
 * @method CartClient getCartClient()
 *
 * Catalog clients
 * @method AddonClient getAddonClient()
 * @method CatalogClient getCatalogClient()
 * @method ClassificationClient getClassificationClient()
 * @method FamilyClient getFamilyClient()
 * @method OfferClient getOfferClient()
 * @method ProgramClient getProgramClient()
 * @method ServiceClient getServiceClient()
 *
 * Consumption clients
 * @method AnalyticsClient getAnalyticsClient()
 * @method HealthCheckClient getHealthCheckClient()
 *
 * Customers clients
 * @method CustomersClient getCustomersClient()
 *
 * General clients
 * @method CheckDomainClient getCheckDomainClient()
 * @method WhoamiClient getWhoamiClient()
 *
 * Licenses clients
 * @method LicensesClient getLicensesClient()
 *
 * Notification clients
 * @method NotificationClient getNotificationClient()
 *
 * Orders clients
 * @method OrdersClient getOrdersClient()
 *
 * Partners clients
 * @method PartnersClient getPartnersClient()
 *
 * Quotes clients
 * @method QuotesClient getQuotesClient()
 *
 * Support clients
 * @method SupportClient getSupportClient()
 *
 * Monitoring clients
 * @method MonitoringClient getMonitoringClient()
 *
 * Subscription clients
 * @method SubscriptionClient getSubscriptionClient()
 */
class PublicApiClient extends AbstractClient
{
    /**
     * Generates a client based on the method name.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return AbstractClient
     */
    public function __call(string $name, array $arguments)
    {
        if (! str_starts_with($name, 'get') || ! str_ends_with($name, 'Client')) {
            throw new BadMethodCallException('Method not found');
        }

        $clientName = substr($name, 3);
        $dirs = glob(__DIR__ . '/*', GLOB_ONLYDIR);
        if ($dirs === false) {
            throw new RuntimeException('Cannot parse the clients directory');
        }

        foreach ($dirs as $dir) {
            if (file_exists($dir . '/' . $clientName . '.php')) {
                $className = 'ArrowSphere\\PublicApiClient\\' . basename($dir) . '\\' . $clientName;

                return $this->prepareClient($className);
            }
        }

        throw new BadMethodCallException('Method not found');
    }

    /**
     * @param string $className
     *
     * @return AbstractClient
     */
    private function prepareClient(string $className): AbstractClient
    {
        $client = new $className($this->client);

        if(! $client instanceof AbstractClient) {
            throw new RuntimeException('Client must be an instance of AbstractClient');
        }

        if ($this->url !== null) {
            $client->setUrl($this->url);
        }

        if ($this->apiKey !== null) {
            $client->setApiKey($this->apiKey);
        }

        if ($this->accessToken !== null) {
            $client->setAccessToken($this->accessToken);
        }

        $client->setDefaultHeaders($this->defaultHeaders);

        return $client;
    }
}
