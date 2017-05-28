<?php 

namespace components\store;

class StoreModel
{

  private $name;
  private $address;
  private $capacity;

  //private $products; // ez ide kell?

  function getName()
  {
    return $this->name;
  }

  function getAddress()
  {
    return $this->address;
  }

  function getCapacity()
  {
    return $this->capacity;
  }

  function setName($name)
  {
    $this->name = $name;
  }

  function setAddress($address)
  {
    $this->address = $address;
  }

  function setCapacity($capacity)
  {
    $this->capacity = $capacity;
  }

  function __toString()
  {
    return "store: " . $this->getName();
  }

  /**
   * @param type $name
   * @param type $address
   * @param type $capacity
   */
  function __construct($name, $address, $capacity)
  {
    $this->name = $name;
    $this->address = $address;
    $this->capacity = $capacity;
  }
}
