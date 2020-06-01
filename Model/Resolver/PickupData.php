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
use Mageplaza\StoreLocator\Helper\Data;
use Mageplaza\StoreLocator\Model\LocationsRepository;

/**
 * Class PickupData
 * @package Mageplaza\StoreLocatorGraphQl\Model\Resolver
 */
class PickupData implements ResolverInterface
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
     * ConfigData constructor.
     *
     * @param LocationsRepository $locationsRepository
     * @param Data $helperData
     */
    public function __construct(
        LocationsRepository $locationsRepository,
        Data $helperData
    ) {
        $this->locationsRepository = $locationsRepository;
        $this->helperData          = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return $this->locationsRepository->getPickupData(isset($args['storeId']) ? $args['storeId'] : null);
    }
}
