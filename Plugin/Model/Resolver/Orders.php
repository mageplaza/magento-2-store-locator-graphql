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

namespace Mageplaza\StoreLocatorGraphQl\Plugin\Model\Resolver;

use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Model\OrderRepository;

/**
 * Class Orders
 * @package Mageplaza\StoreLocatorGraphQl\Plugin\Model\Resolver
 */
class Orders
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * Orders constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param \Magento\SalesGraphQl\Model\Resolver\Orders $orders
     * @param $result
     *
     * @return mixed
     * @throws InputException
     * @throws NoSuchEntityException
     */
    public function afterResolve(\Magento\SalesGraphQl\Model\Resolver\Orders $orders, $result)
    {
        foreach ($result['items'] as &$item) {
            $order                  = $this->orderRepository->get($item['id']);
            $item['mp_time_pickup'] = $order->getMpTimePickup();
        }

        return $result;
    }
}
