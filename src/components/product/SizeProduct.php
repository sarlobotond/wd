<?php 

namespace components\product;

class SizeProduct extends Product
{

  private $size;

  function getSize()
  {
    return $this->size;
  }

  function setSize($size)
  {
    $this->size = $size;
  }
}
