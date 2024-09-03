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

    #[Property()]
    protected ?string $promotionCode = null;

    #[Property(type: Customer::class)]
    protected ?Customer $customer = null;

    #[Property(type: Item::class, isArray: true, required: true)]
    protected array $items;

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
     *                  value:float
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
}
