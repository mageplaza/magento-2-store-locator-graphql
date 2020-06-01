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

use Magento\Framework\App\RequestInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\StoreLocator\Helper\Data;
use Mageplaza\StoreLocator\Model\LocationsRepository;

/**
 * Class ConfigData
 * @package Mageplaza\StoreLocatorGraphQl\Model\Resolver
 */
class ConfigData extends AbstractResolver
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * ConfigData constructor.
     *
     * @param LocationsRepository $locationsRepository
     * @param Data $helperData
     * @param RequestInterface $request
     */
    public function __construct(
        LocationsRepository $locationsRepository,
        Data $helperData,
        RequestInterface $request
    ) {
        $this->request             = $request;

        parent::__construct($locationsRepository, $helperData);
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        parent::resolve($field, $context, $info, $value, $args);

        $params = $this->request->getParams();
        $params = array_merge($params, $args);
        $this->request->setParams($params);

        return $this->locationsRepository->getDataConfigLocation();
    }
}
