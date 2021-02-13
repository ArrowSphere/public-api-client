<?php

namespace ArrowSphere\PublicApiClient\Consumption;

use ArrowSphere\PublicApiClient\Consumption\Entities\HealthCheckItem;
use ArrowSphere\PublicApiClient\Consumption\Enum\ConstantEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;

/**
 * Class HealthCheckClient
 */
class HealthCheckClient extends AbstractConsumptionClient
{
    /**
     * @param array $classification The list of classification (SAAS, IAAS...)
     * @param array $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param array $marketPlace The list of marketPlace (FR, UK, US...)
     *
     * @return HealthCheckItem[]
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|\ReflectionException
     */
    public function getItem(array $classification = [], array $vendorCode = [], array $marketPlace = []) : array
    {
        $response = $this->getItemRaw($classification, $vendorCode, $marketPlace);
        $data = $this->decodeResponse($response);
        $result = [];
        if ($data['data'] && $data['data']['details']) {
            foreach ($data['data']['details'] as $item) {
                $result[] = new HealthCheckItem($item);
            }
        }

        return $result;
    }

    /**
     * @param array $classification The list of classification (SAAS, IAAS...)
     * @param array $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param array $marketPlace The list of marketPlace (FR, UK, US...)
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getItemRaw(array $classification = [], array $vendorCode = [], array $marketPlace = []): string
    {
        $this->path = '/healthcheck';

        return $this->get([
            ConstantEnum::CLASSIFICATION => $classification,
            ConstantEnum::VENDOR         => $vendorCode,
            ConstantEnum::MARKETPLACE    => $marketPlace
        ]);
    }
}
