<?php 

namespace components\store;

use components\product\Product;
use components\store\StoreModel;

class Store extends StoreModel
{

    private $stock = array();

    /**
     * Add product to store
     * 
     * @param Product $product
     * @param int $count
     * @return int remaining products
     */
    function addProduct(Product $product, $count = 1)
    {
        $freeCapacity = $this->getFreeCapacity();
        $storable = ($count > $freeCapacity) ? $freeCapacity : $count;
        if (isset($this->stock[$product->getStoreKey()])) {
            $this->stock[$product->getStoreKey()] += $storable;
        } else {
            if ($storable > 0) {
                $this->stock[$product->getStoreKey()] = $storable;
            }
        }
        return $count - $storable;
    }

    /**
     * Remove product from store
     * 
     * @param Product $product
     * @param int $count
     * @return int missig products
     */
    function removeProduct(Product $product, $count = 1)
    {
        if (isset($this->stock[$product->getStoreKey()])) {
            $this->stock[$product->getStoreKey()] -= $count;
        }
        $remaining = $this->stock[$product->getStoreKey()];
        if ($remaining < 1) {
            unset($this->stock[$product->getStoreKey()]);
        }
        return -1 * $remaining;
    }

    private function getFreeCapacity()
    {
        return $this->getCapacity() - array_sum($this->stock);
    }

    function isEmpty()
    {
        return empty($this->stock);
    }

    function getStockpile(Product $product)
    {
        if (isset($this->stock[$product->getStoreKey()])) {
            return $this->stock[$product->getStoreKey()];
        } else {
            return 0;
        }
    }

    function __toString()
    {
        $ret = parent::__toString() . PHP_EOL;
        $ret .= ' items:' . PHP_EOL;
        foreach ($this->stock as $product => $count) {
            $ret .= '  ' . $product . ': ' . $count . PHP_EOL;
        }
        return $ret;
    }
}
