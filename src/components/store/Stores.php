<?php namespace components\store;

use components\store\Store;
use components\product\Product;

class NotEnoughStorageException extends \Exception {}
class NotEnoughProductException extends \Exception {}
class NotEmptyException extends \Exception {} 

class Stores
{

  private $stores = array();

  function addStore(Store $store)
  {
    if (isset($this->stores[$store->getName()])) {
      throw new Exception('Allready exists: ' . $store->getName());
    } else {
      $this->stores[$store->getName()] = $store;
    }
    return $this;
  }

  function removeStore(Store $store, $force = false)
  {
    if (isset($this->stores[$store->getName()])) {
      if (!$force && !$store->isEmpty()) {
        throw new NotEmptyException;
      }
      unset($this->stores[$store->getName()]);
    }
    return $this;
  }

  function addProduct(Product $product, $count)
  {
    $remaining = $count;
    foreach ($this->stores as $store) {
      /* @var $store Store */
      $remaining = $store->addProduct($product, $remaining);
      if ($remaining <= 0) {
        return $this;
      }
    }
    // $remaining > 0
    throw new NotEnoughStorageException("Not enough storages: " . $product->getName());
  }

  function removeProduct(Product $product, $count)
  {
    $remaining = $count;
    foreach ($this->stores as $store) {
      /* @var $store Store */
      $remaining = $store->removeProduct($product, $remaining);
      if ($remaining <= 0) {
        return $this;
      }
    }
    // $remaining > 0
    throw new NotEnoughProductException("Not enough product: " . $product->getName());
  }

  /**
   * @param String $storeName
   * @return Store
   */
  function getStoreByName($storeName)
  {
    return (isset($this->stores[$storeName])) ? $this->stores[$storeName] : null;
  }

  function __toString()
  {
    $ret = PHP_EOL . "Stores" . PHP_EOL;
    foreach ($this->stores as $store) {
      $ret .= $store;
    }
    return $ret . PHP_EOL;
  }
}
