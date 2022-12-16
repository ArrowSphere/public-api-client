<?php

namespace ArrowSphere\PublicApiClient\Tests\Cart;

trait CartMockedDataTrait
{
    private $idToken = 'eyJraWQiOiJxNWdzODdGNVJmaUp5bDZRQldXRzYwaUpRTmRQTmxiMlwvNzZtWDhicGVrQT0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiIxMDMzZTE4Mi03Y2U5LTQzOTktODk4Yy01';
    private $itemId = '70993353-0db8-4d12-8880-d6eece73f93f';

    protected $defaultHeaders = [];

    /**
     * @return array
     */
    public function generateDefaultHeaders(): array
    {
        return $this->defaultHeaders = [
            'Authorization' => $this->idToken
        ];
    }

    /**
     * @return array
     */
    public function generateMockedCartItem(): array
    {
        return [
            'itemId'                  => $this->itemId,
            'offerName'               => 'Microsoft 365 standard',
            'priceBandArrowsphereSku' => '031C9E47-4802-4248-838E-778FB1D2CC05',
            'quantity'                => 5
        ];
    }
}
