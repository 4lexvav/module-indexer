### Magento 2 Module Indexer
Provides CLI command for partial product indexation.

### Problem
While debugging it can be necessary to run reindex in order to exclude problem with data inconsistency. It can be painful to run reindex on stores with large product collection.  
This module leverages Magento built-in methods to run partial product reindex, and provides CLI command on top of them.

### Installation
```
composer require 4lexvav/module-indexer
php bin/magento module:enable Vav_Indexer
php bin/magento setup:upgrade
```

### Usage:
```
php bin/magento 4lexvav:indexer <products>

products - Space-separated list of products IDs to reindex.
```