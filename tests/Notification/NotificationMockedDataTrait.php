<?php

namespace ArrowSphere\PublicApiClient\Tests\Notification;

trait NotificationMockedDataTrait
{
    private $idToken = 'eyJraWQiOiJxNWdzODdGNVJmaUp5bDZRQldXRzYwaUpRTmRQTmxiMlwvNzZtWDhicGVrQT0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiIxMDMzZTE4Mi03Y2U5LTQzOTktODk4Yy01';
    private $id = '70993353-0db8-4d12-8880-d6eece73f93f';

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
    public function generateMockedNotification(): array
    {
        return [
            'id'          => $this->id,
            'userName'    => 'beatrice kido',
            'created'     => 6765765372,
            'expires'     => 8787687655,
            'subject'     => 'Order fulfilled - [XSP656567]',
            'content'     => 'Your order has been fulfilled with success',
            'hasBeenRead' => 0
        ];
    }
}
