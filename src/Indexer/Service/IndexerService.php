<?php

namespace Vav\Indexer\Service;


use Magento\Framework\Indexer\IndexerInterface;
use Magento\Indexer\Model\Indexer\Collection;
use Magento\Indexer\Model\Indexer\CollectionFactory;
use Vav\Indexer\Api\Service\IndexerServiceInterface;

class IndexerService implements IndexerServiceInterface
{
    const PRODUCT_INDEXERS = [
        'catalog_product_attribute', // good
        'inventory', // good
        'catalogrule_product', // good
        'cataloginventory_stock', // good
        'catalog_product_price', // good
        'catalogsearch_fulltext', // good
    ];

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function reindex(array $ids)
    {
        foreach ($this->getIndexers() as $indexer) {
            $indexer->reindexList($ids);
        }
    }

    /**
     * @return IndexerInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getIndexers()
    {
        $indexers = [];
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $indexers = array_filter($collection->getItems(), function($indexer) {
            /** @var IndexerInterface $indexer */
            return in_array($indexer->getId(), self::PRODUCT_INDEXERS, true);
        });

        return $indexers;
    }
}
