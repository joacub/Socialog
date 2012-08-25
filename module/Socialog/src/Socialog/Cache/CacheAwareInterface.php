<?php

namespace Socialog\Cache;

use Zend\Cache\Storage\StorageInterface;

interface CacheAwareInterface
{
    public function setCacheStorage(StorageInterface $storage);
    public function getCacheStorage();
}
