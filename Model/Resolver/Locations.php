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

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\StoreLocator\Helper\Data;
use Mageplaza\StoreLocator\Model\LocationsRepository;

/**
 * Class Attributes
 * @package Mageplaza\StoreLocatorGraphQl\Model\Resolver
 */
class Locations implements ResolverInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var LocationsRepository
     */
    protected $locationsRepository;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Attributes constructor.
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param LocationsRepository $locationsRepository
     * @param Data $helperData
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LocationsRepository $locationsRepository,
        Data $helperData
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->locationsRepository   = $locationsRepository;
        $this->helperData            = $helperData;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $this->validate($args);
        $searchCriteria = $this->searchCriteriaBuilder->build('mp_store_locator', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->locationsRepository->getLocations($searchCriteria);

        return $this->getResult($searchResult, $args);
    }

    /**
     * @param array $args
     * @throws GraphQlInputException
     */
    public function validate($args)
    {
        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }

        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }

    /**
     * @param SearchResultsInterface $searchResult
     * @param array $args
     * @return array
     * @throws GraphQlInputException
     */
    public function getResult($searchResult, $args)
    {
        return [
            'total_count' => $searchResult->getTotalCount(),
            'items'       => $searchResult->getItems(),
            'page_info'   => $this->getPageInfo($searchResult, $args)
        ];
    }

    /**
     * @param SearchResultsInterface $searchResult
     * @param array $args
     *
     * @return array
     * @throws GraphQlInputException
     */
    private function getPageInfo($searchResult, $args)
    {
        $totalPages  = ceil($searchResult->getTotalCount() / $args['pageSize']);
        $currentPage = $args['currentPage'];

        if ($currentPage > $totalPages && $searchResult->getTotalCount() > 0) {
            throw new GraphQlInputException(
                __(
                    'currentPage value %1 specified is greater than the %2 page(s) available.',
                    [$currentPage, $totalPages]
                )
            );
        }

        return [
            'pageSize'        => $args['pageSize'],
            'currentPage'     => $currentPage,
            'hasNextPage'     => $currentPage < $totalPages,
            'hasPreviousPage' => $currentPage > 1,
            'startPage'       => 1,
            'endPage'         => $totalPages,
        ];
    }
}
