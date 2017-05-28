<?php 

namespace components\brand;

class BrandModel
{

  private $name;
  private $quality;

  function __construct($name, $quality)
  {
    $this->setName($name);
    $this->setQuality($quality);
  }

  function getName()
  {
    return $this->name;
  }

  function getQuality()
  {
    return $this->quality;
  }

  function setName($name)
  {
    $this->name = $name;
  }

  function setQuality($quality)
  {
    $intQueality = (int) $quality;
    if (1 <= $intQueality && $intQueality <= 5) {
      $this->quality = $intQueality;
    }
  }

  function __toString()
  {
    return "brand: " . $this->getName();
  }
}
