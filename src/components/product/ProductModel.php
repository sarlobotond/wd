<?php 

namespace components\product;

use components\brand\Brand;

class ProductModel
{

  private $itemNumber;
  private $name;
  private $price;
  private $brand;

  /**
   * @param String $itemNumber
   * @param String $name
   * @param Integer $price
   * @param String $brand
   */
  function __construct($itemNumber, $name, $price, Brand $brand)
  {
    $this->itemNumber = $itemNumber;
    $this->name = $name;
    $this->price = $price;
    $this->brand = $brand;
  }

  function getItemNumber()
  {
    return $this->itemNumber;
  }

  function getName()
  {
    return $this->name;
  }

  function getPrice()
  {
    return $this->price;
  }

  function getBrand()
  {
    return $this->brand;
  }

  function setItemNumber($itemNumber)
  {
    $this->itemNumber = $itemNumber;
  }

  function setName($name)
  {
    $this->name = $name;
  }

  function setPrice($price)
  {
    $this->price = $price;
  }

  function setBrand(Brand $brand)
  {
    $this->brand = $brand;
  }

  function __toString()
  {
    return "product: " . $this->getName();
  }
}
