<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_StoreLocatorGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\StoreLocatorGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\StoreLocator\Api\GuestLocationsInterface;
use Mageplaza\StoreLocator\Helper\Data;
use Mageplaza\StoreLocator\Model\LocationsRepository;

/**
 * Class PickupLocations
 * @package Mageplaza\StoreLocatorGraphQl\Model\Resolver
 */
class PickupLocations implements ResolverInterface
{
    /**
     * @var LocationsRepository
     */
    protected $locationsRepository;
    /**
     * @var Data
     */
    protected $helperData;
    /**
     * @var GuestLocationsInterface
     */
    protected $guestPickupLocations;

    /**
     * PickupLocations constructor.
     *
     * @param LocationsRepository $locationsRepository
     * @param GuestLocationsInterface $guestPickupLocations
     * @param Data $helperData
     */
    public function __construct(
        LocationsRepository $locationsRepository,
        GuestLocationsInterface $guestPickupLocations,
        Data $helperData
    ) {
        $this->locationsRepository  = $locationsRepository;
        $this->helperData           = $helperData;
        $this->guestPickupLocations = $guestPickupLocations;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $result = $this->guestPickupLocations->getLocations($args['cartId']);

        return $this->getResult($result);
    }

    /**
     * @param $searchResult
     *
     * @return array
     */
    public function getResult($searchResult)
    {
        return [
            'total_count' => $searchResult->getTotalCount(),
            'items'       => $searchResult->getItems(),
        ];
    }
}
