<?php 

namespace components\product;

class Product extends ProductModel
{

    public function getStoreKey()
    {
        return $this->getItemNumber();
    }

    public function __toString()
    {
        return parent::__toString() . ' ' . $this->getStoreKey();
    }
}
