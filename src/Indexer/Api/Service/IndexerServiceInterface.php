<?php

namespace Vav\Indexer\Api\Service;


interface IndexerServiceInterface
{
    /**
     * Reindex all indexers for given array of products.
     *
     * @param int[] $ids
     */
    public function reindex(array $ids);
}
