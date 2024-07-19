<?php

namespace ArrowSphere\PublicApiClient\Orders;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Orders\Entities\GetOrdersResponse;
use ArrowSphere\PublicApiClient\Orders\Entities\Order;
use ArrowSphere\PublicApiClient\Orders\Entities\OrderHistory;
use ArrowSphere\PublicApiClient\Orders\Request\CreateOrder;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;
use Generator;

class OrdersClient extends AbstractClient
{
    /**
     * Lists the orders.
     *
     * @return Generator<Order>
     *
     * @throws \ArrowSphere\PublicApiClient\Exception\EntityValidationException
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrders(?OrdersFilters $ordersFilters): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getOrdersRaw($ordersFilters === null ? [] : $ordersFilters->jsonSerialize());
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data']['orders'] as $data) {
                yield new Order($data);
            }
        }
    }

    /**
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrdersRaw(array $parameters = []): string
    {
        $this->path = '/orders';

        return $this->get($parameters);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrdersPage(OrdersFilters $ordersFilters, int $page = 1): GetOrdersResponse
    {
        if (empty($this->perPage)) {
            $this->setPerPage(100);
        }
        $this->setPage($page);

        $rawResponse = $this->getOrdersRaw($ordersFilters->jsonSerialize());
        $response = $this->decodeResponse($rawResponse);

        return new GetOrdersResponse($response);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\EntityValidationException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function createOrder(CreateOrder $order): string
    {
        $this->path = '/orders';
        $rawResponse = $this->post($order->jsonSerialize());
        $response = $this->decodeResponse($rawResponse->__toString());

        return $response['data']['reference'];
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrder(string $orderReference): Order
    {
        $this->path = '/orders/' . urlencode($orderReference);
        $rawResponse = $this->get();
        $response = $this->getResponseData($rawResponse);

        return new Order($response['orders'][0]);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function updateOrder(string $orderReference, string $poNumber): void
    {
        $payload = ['PO_number' => $poNumber];
        $this->path = '/orders/' . urlencode($orderReference);

        $this->patch($payload);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function resubmitOrder(string $orderReference): void
    {
        $this->path = '/orders/' . urlencode($orderReference) . '/resubmit';
        $this->patch([]);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function cancelOrder(string $orderReference): void
    {
        $this->path = '/orders/' . urlencode($orderReference) . '/cancel';
        $this->patch([]);
    }

    /**
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function validateOrder(string $orderReference): void
    {
        $this->path = '/orders/' . urlencode($orderReference) . '/validate';
        $this->patch([]);
    }

    /**
     * @return OrderHistory[]
     *
     * @throws \ArrowSphere\PublicApiClient\Exception\EntityValidationException
     * @throws \ArrowSphere\PublicApiClient\Exception\NotFoundException
     * @throws \ArrowSphere\PublicApiClient\Exception\PublicApiClientException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderHistory(string $orderReference, array $parameters = []): array
    {
        $this->path = '/orders/' . urlencode($orderReference) . '/history';

        $rawResponse = $this->get($parameters);
        $response = $this->getResponseData($rawResponse);

        return array_map(static fn ($item) => new OrderHistory($item), $response);
    }
}
