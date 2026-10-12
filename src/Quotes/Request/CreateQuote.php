<?php

namespace ArrowSphere\PublicApiClient\Quotes\Request;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Customer;
use ArrowSphere\PublicApiClient\Quotes\Request\SubEntities\Item;

class CreateQuote extends AbstractEntity
{
    public const COLUMN_PROMOTION_CODE = 'promotionCode';
    public const COLUMN_CUSTOMER = 'customer';
    public const COLUMN_ITEMS = 'items';

    /**
     * @var string|null
     */
    #[Property()]
    protected ?string $promotionCode = null;

    /**
     * @var Customer|null
     */
    #[Property(type: Customer::class)]
    protected ?Customer $customer = null;

    /**
     * @var Item[]|null
     */
    #[Property(type: Item::class, isArray: true)]
    protected ?array $items = [];

    /**
     * @param array{
     *     promotionCode?: string,
     *     customer: array{reference: string},
     *     items: array{
     *          arrowSpherePriceBandSku:string,
     *          quantity:int,
     *          prices?:array{
     *              customer?:array{
     *                  rate:array{
     *                      rate:string,
     *                      value:float
     *                  },
     *                  fixedPrice:float
     *              }
     *          }
     *     }
     * } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getPromotionCode(): ?string
    {
        return $this->promotionCode;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @return Item[]|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }
}
